<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diambil',
            'data' => Guru::all()
        ]);
    }

    public function store(Request $request)
    {
        $guru = Guru::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil ditambahkan',
            'data' => $guru
        ], 201);
    }

    public function show(string $id)
    {
        $guru = Guru::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $guru
        ]);
    }

    public function update(Request $request, string $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil diupdate',
            'data' => $guru
        ]);
    }

    public function destroy(string $id)
    {
        Guru::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data guru berhasil dihapus'
        ]);
    }
}