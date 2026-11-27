<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    // Menampilkan semua outlet
    public function index()
    {
        $outlets = Outlet::withCount([
            'products',
            'categories',
        ])->latest()->get();

        return response()->json([
            'message' => 'Data outlet berhasil diambil',
            'data' => $outlets,
        ]);
    }

    // Menambahkan outlet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $outlet = Outlet::create($validated);

        return response()->json([
            'message' => 'Outlet berhasil ditambahkan',
            'data' => $outlet,
        ], 201);
    }

    // Menampilkan detail outlet
    public function show(Outlet $outlet)
    {
        $outlet->loadCount([
            'products',
            'categories',
        ]);

        return response()->json([
            'message' => 'Detail outlet berhasil diambil',
            'data' => $outlet,
        ]);
    }

    // Mengubah outlet
    public function update(Request $request, Outlet $outlet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $outlet->update($validated);

        return response()->json([
            'message' => 'Outlet berhasil diperbarui',
            'data' => $outlet,
        ]);
    }

    // Menghapus outlet
    public function destroy(Outlet $outlet)
    {
        if (
            $outlet->products()->exists() ||
            $outlet->categories()->exists() ||
            $outlet->users()->exists() ||
            $outlet->transactions()->exists()
        ) {
            return response()->json([
                'message' => 'Outlet tidak bisa dihapus karena masih memiliki data terkait.',
            ], 422);
        }

        $outlet->delete();

        return response()->json([
            'message' => 'Outlet berhasil dihapus',
        ]);
    }
}
