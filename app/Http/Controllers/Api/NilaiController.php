<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::with(['siswa', 'mataPelajaran'])->latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil diambil',
            'data' => $nilais
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'nilai' => 'required|integer|min:0|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $validated['predikat'] = $this->hitungPredikat($validated['nilai']);
        $validated['keterangan'] = $this->hitungKeterangan($validated['nilai'], $validated['kkm']);

        $nilai = Nilai::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil ditambahkan',
            'data' => $nilai
        ], 201);
    }

    public function show(string $id)
    {
        $nilai = Nilai::with(['siswa', 'mataPelajaran'])->find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail nilai berhasil diambil',
            'data' => $nilai
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'nilai' => 'required|integer|min:0|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $validated['predikat'] = $this->hitungPredikat($validated['nilai']);
        $validated['keterangan'] = $this->hitungKeterangan($validated['nilai'], $validated['kkm']);

        $nilai->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil diperbarui',
            'data' => $nilai
        ], 200);
    }

    public function destroy(string $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data nilai tidak ditemukan'
            ], 404);
        }

        $nilai->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data nilai berhasil dihapus'
        ], 200);
    }

    public function siswa()
    {
        $siswas = Siswa::orderBy('nama')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswas
        ], 200);
    }

    public function mataPelajaran()
    {
        $mataPelajarans = MataPelajaran::orderBy('nama_mata_pelajaran')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data mata pelajaran berhasil diambil',
            'data' => $mataPelajarans
        ], 200);
    }

    private function hitungPredikat($nilai)
    {
        if ($nilai >= 90) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C';
        }

        return 'D';
    }

    private function hitungKeterangan($nilai, $kkm)
    {
        return $nilai >= $kkm ? 'Tuntas' : 'Tidak Tuntas';
    }
}