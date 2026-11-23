<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Category::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'category' => 'required|string|max:100',
        ]);

        // Admin outlet hanya boleh membuat kategori di outlet sendiri
        if ($user->role->name !== 'admin_pusat') {
            $validated['outlet_id'] = $user->outlet_id;
        }

        $category = Category::create([
            'outlet_id' => $validated['outlet_id'],
            'category' => $validated['category'],
        ]);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category
        ], 201);
    }

    public function show(Request $request, string $id)
    {
        $user = $request->user();

        $query = Category::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $category = $query->findOrFail($id);

        return response()->json([
            'message' => 'Detail kategori',
            'data' => $category
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = $request->user();

        $query = Category::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $category = $query->findOrFail($id);

        $validated = $request->validate([
            'category' => 'required|string|max:100',
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui',
            'data' => $category
        ]);
    }

    public function destroy(Request $request, string $id)
    {
        $user = $request->user();

        $query = Category::query();

        if ($user->role->name !== 'admin_pusat') {
            $query->where('outlet_id', $user->outlet_id);
        }

        $category = $query->findOrFail($id);

        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Kategori masih memiliki produk dan tidak bisa dihapus.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
