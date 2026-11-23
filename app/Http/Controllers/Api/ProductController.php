<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Product::with('category');

        // Admin pusat bisa melihat semua outlet
        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Pencarian produk
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        $limit = $request->input('limit', 10);

        $products = $query->paginate($limit);

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Admin outlet hanya boleh membuat produk di outlet sendiri
        if ($user->role->name !== 'admin_pusat') {
            $validated['outlet_id'] = $user->outlet_id;
        }

        // Pastikan kategori berasal dari outlet yang sama
        $category = Category::where(
            'category_id',
            $validated['category_id']
        )->where('outlet_id', $validated['outlet_id'])->firstOrFail();

        $path = null;

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('products', 'public');
        }

        $slug = Str::slug($validated['name']);

        // Slug unik per outlet
        $slug = $slug . '-' . $validated['outlet_id'] . '-' . Str::random(5);

        $product = Product::create([
            'outlet_id' => $validated['outlet_id'],
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $category->category_id,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'img' => $path,
            'slug' => $slug,
        ]);

        return new ProductResource($product->load('category'));
    }

    public function show(Request $request, string $id)
    {
        $user = $request->user();

        $query = Product::with('category');

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $product = $query->findOrFail($id);

        return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        $user = $request->user();

        $query = Product::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $product = $query->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Kategori harus berasal dari outlet produk
        Category::where('category_id', $validated['category_id'])
            ->where('outlet_id', $product->outlet_id)
            ->firstOrFail();

        $path = $product->img;

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }

            $path = $request->file('img')->store('products', 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'img' => $path,
        ]);

        return new ProductResource($product->load('category'));
    }

    public function destroy(Request $request, string $id)
    {
        $user = $request->user();

        $query = Product::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $product = $query->findOrFail($id);

        // Jangan hapus produk yang sudah masuk riwayat transaksi
        if ($product->transactionDetails()->exists()) {
            return response()->json([
                'message' => 'Produk sudah digunakan dalam transaksi dan tidak bisa dihapus.'
            ], 422);
        }

        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
