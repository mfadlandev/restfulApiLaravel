<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banjar;
use Illuminate\Http\Request;

class BanjarController extends Controller
{
    // Menampilkan semua data banjar
    public function index()
    {
        return Banjar::all();
    }

    // Menambahkan data banjar
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        return Banjar::create([
            'nama' => $request->nama
            ]);
    }

    // Menampilkan satu data banjar
    public function show(int $id)
    {
        return Banjar::findOrFail($id);
    }

    // Mengubah data banjar
    public function update(Request $request, int $id)
    {
        $banjar = Banjar::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $banjar->update([
            'nama' => $request->nama
            ]);

        return $banjar;
    }

    // Menghapus data banjar
    public function destroy(string $id)
    {
        $banjar = Banjar::findOrFail($id);

        $banjar->delete();

        return response()->json([
            'message' => 'Data banjar berhasil dihapus',
        ]);
    }
}
