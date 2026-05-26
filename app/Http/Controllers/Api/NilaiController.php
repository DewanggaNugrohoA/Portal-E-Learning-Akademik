<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Guru;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function pageIndex()
    {
        return view("nilai.index");
    }

    public function pageCreate()
    {
        return view("nilai.create");
    }

    public function pageEdit($id)
    {
        return view("nilai.edit", compact("id"));
    }

    public function pageShow($id)
    {
        return view("nilai.show", compact("id"));
    }

    public function index()
    {
        $nilais = Nilai::with("guru")->latest()->get();

        return response()->json([
            "status" => "success",
            "message" => "Data Nilai Berhasil Ditampilkan",
            "data" => $nilais
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            "guru_id" => "required|exists:gurus,id",
            "kkm" => "required|integer|min:0|max:100",
            "deskripsi_a" => "required|string",
            "deskripsi_b" => "required|string",
            "deskripsi_c" => "required|string",
            "deskripsi_d" => "required|string",
        ]);

        $nilai = Nilai::create([
            "guru_id" => $request->guru_id,
            "kkm" => $request->kkm,
            "deskripsi_a" => $request->deskripsi_a,
            "deskripsi_b" => $request->deskripsi_b,
            "deskripsi_c" => $request->deskripsi_c,
            "deskripsi_d" => $request->deskripsi_d,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Nilai Berhasil Ditambahkan",
            "data" => $nilai
        ], 201);
    }

    public function show($id)
    {
        $nilai = Nilai::with("guru")->find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Data Nilai Tidak Ditemukan"
            ], 404);
        }

        return response()->json([
            "status" => "success",
            "message" => "Data Nilai Berhasil Ditampilkan",
            "data" => $nilai
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Data Nilai Tidak Ditemukan"
            ], 404);
        }
        $request->validate([
            "guru_id" => "required|exists:gurus,id",
            "kkm" => "required|integer|min:0|max:100",
            "deskripsi_a" => "required|string",
            "deskripsi_b" => "required|string",
            "deskripsi_c" => "required|string",
            "deskripsi_d" => "required|string",
        ]);

        $nilai->update([
            "guru_id" => $request->guru_id,
            "kkm" => $request->kkm,
            "deskripsi_a" => $request->deskripsi_a,
            "deskripsi_b" => $request->deskripsi_b,
            "deskripsi_c" => $request->deskripsi_c,
            "deskripsi_d" => $request->deskripsi_d,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Data Nilai Berhasil Diperbarui",
            "data" => $nilai
        ], 200);
    }
    public function destroy($id)
    {
        $nilai = Nilai::find($id);

        if (!$nilai) {
            return response()->json([
                "status" => "error",
                "message" => "Data Nilai Tidak Ditemukan",
            ], 404);
        }

        $nilai->delete();
        
        return response()->json([
            "status" => "success",
            "message" => "Data Nilai Berhasil Dihapus",
        ], 200);
    }

    public function guru()
    {
        $gurus = Guru::orderBy("nama")->get();

        return response()->json([
            "status" => "success",
            "data" => $gurus,
        ], 200);
    }
}