<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => MataPelajaran::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mata_pelajaran' => 'required|unique:mata_pelajarans',
            'nama_mata_pelajaran' => 'required',
            'guru_pengampu' => 'required',
            'jam_pelajaran' => 'required|integer',
            'semester' => 'required',
            'status' => 'required'
        ]);

        $mataPelajaran = MataPelajaran::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data mata pelajaran berhasil ditambahkan',
            'data' => $mataPelajaran
        ]);
    }

    public function show(string $id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $mataPelajaran
        ]);
    }

    public function update(Request $request, string $id)
    {
        $mataPelajaran = MataPelajaran::findOrFail($id);

        $validated = $request->validate([
            'kode_mata_pelajaran' => 'required|unique:mata_pelajarans,kode_mata_pelajaran,' . $id,
            'nama_mata_pelajaran' => 'required',
            'guru_pengampu' => 'required',
            'jam_pelajaran' => 'required|integer',
            'semester' => 'required',
            'status' => 'required'
        ]);

        $mataPelajaran->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data mata pelajaran berhasil diperbarui',
            'data' => $mataPelajaran
        ]);
    }

    public function destroy(string $id)
    {
        MataPelajaran::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data mata pelajaran berhasil dihapus'
        ]);
    }
}