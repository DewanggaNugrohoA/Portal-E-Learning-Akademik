<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Data mata pelajaran berhasil diambil',
            'data' => MataPelajaran::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel',
            'nama_mapel' => 'required|string|max:100',
            'guru_pengampu' => 'nullable|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        $data = MataPelajaran::create($validated);

        return response()->json([
            'message' => 'Mata pelajaran berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data mata pelajaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail mata pelajaran berhasil diambil',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data mata pelajaran tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:100',
            'guru_pengampu' => 'nullable|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        $data->update($validated);

        return response()->json([
            'message' => 'Mata pelajaran berhasil diperbarui',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = MataPelajaran::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'Data mata pelajaran tidak ditemukan'
            ], 404);
        }

        $data->delete();

        return response()->json([
            'message' => 'Mata pelajaran berhasil dihapus'
        ], 200);
    }
}