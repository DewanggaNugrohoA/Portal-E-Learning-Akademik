<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:30|unique:siswas,nis',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:siswas,email',
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $siswa = Siswa::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    public function show(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nis' => [
                'required',
                'string',
                'max:30',
                Rule::unique('siswas', 'nis')->ignore($siswa->id),
            ],
            'nama' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('siswas', 'email')->ignore($siswa->id),
            ],
            'kelas' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $siswa->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil diperbarui',
            'data' => $siswa
        ], 200);
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data siswa berhasil dihapus'
        ], 200);
    }
}