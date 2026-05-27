<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diambil',
            'data' => Guru::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'mapel' => 'required|string|max:100',
        ]);

        $guru = Guru::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil ditambahkan',
            'data' => $guru
        ], 201);
    }

    public function show(string $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail guru berhasil diambil',
            'data' => $guru
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nip' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'mapel' => 'required|string|max:100',
        ]);

        $guru->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diperbarui',
            'data' => $guru
        ], 200);
    }

    public function destroy(string $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $guru->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil dihapus'
        ], 200);
    }
}