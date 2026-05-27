<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with('guru')->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil diambil.',
            'data' => $nilais,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kkm' => 'required|integer|min:0|max:100',
            'deskripsi_a' => 'required|string',
            'deskripsi_b' => 'required|string',
            'deskripsi_c' => 'required|string',
            'deskripsi_d' => 'required|string',
        ]);

        $nilai = Nilai::create([
            'guru_id' => $request->guru_id,
            'kkm' => $request->kkm,
            'deskripsi_a' => $request->deskripsi_a,
            'deskripsi_b' => $request->deskripsi_b,
            'deskripsi_c' => $request->deskripsi_c,
            'deskripsi_d' => $request->deskripsi_d,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil ditambahkan.',
            'data' => $nilai,
        ], 201);
    }

    public function show(string $id)
    {
        $nilai = Nilai::with('guru')->find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail nilai berhasil diambil.',
            'data' => $nilai,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan.',
            ], 404);
        }

        $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'kkm' => 'required|integer|min:0|max:100',
            'deskripsi_a' => 'required|string',
            'deskripsi_b' => 'required|string',
            'deskripsi_c' => 'required|string',
            'deskripsi_d' => 'required|string',
        ]);

        $nilai->update([
            'guru_id' => $request->guru_id,
            'kkm' => $request->kkm,
            'deskripsi_a' => $request->deskripsi_a,
            'deskripsi_b' => $request->deskripsi_b,
            'deskripsi_c' => $request->deskripsi_c,
            'deskripsi_d' => $request->deskripsi_d,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil diperbarui.',
            'data' => $nilai,
        ], 200);
    }

    public function destroy(string $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan.',
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil dihapus.',
        ], 200);
    }

    public function guru()
    {
        $gurus = Guru::orderBy('nama')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diambil.',
            'data' => $gurus,
        ], 200);
    }
}