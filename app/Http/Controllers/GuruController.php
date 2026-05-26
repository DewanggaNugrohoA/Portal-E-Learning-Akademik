<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // GET ALL DATA
    public function index()
    {
        $guru = Guru::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diambil',
            'data' => $guru
        ]);
    }

    // STORE DATA
    public function store(Request $request)
    {
        $guru = Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'mapel' => $request->mapel,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil ditambahkan',
            'data' => $guru
        ]);
    }

    // SHOW DETAIL
    public function show($id)
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
            'message' => 'Detail data guru',
            'data' => $guru
        ]);
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data guru tidak ditemukan'
            ], 404);
        }

        $guru->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'mapel' => $request->mapel,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    // DELETE DATA
    public function destroy($id)
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
        ]);
    }
}