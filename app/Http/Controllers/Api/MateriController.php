<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data materi berhasil diambil.',
            'data' => $materis,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nama_mata_pelajaran' => 'nullable|string|max:255',
            'nama_guru' => 'nullable|string|max:255',
            'file_materi' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,zip,rar|max:20480',
        ]);

        $fileName = null;

        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            $uploadPath = public_path('assets/uploads/materi');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);
        }

        $materi = Materi::create([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'nama_guru' => $request->nama_guru,
            'file_materi' => $fileName,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data materi berhasil ditambahkan.',
            'data' => $materi,
        ], 201);
    }

    public function show(string $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data materi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail materi berhasil diambil.',
            'data' => $materi,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data materi tidak ditemukan.',
            ], 404);
        }

        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nama_mata_pelajaran' => 'nullable|string|max:255',
            'nama_guru' => 'nullable|string|max:255',
            'file_materi' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,zip,rar|max:20480',
        ]);

        $fileName = $materi->file_materi;

        if ($request->hasFile('file_materi')) {
            $oldFile = public_path('assets/uploads/materi/' . $materi->file_materi);

            if ($materi->file_materi && File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $file = $request->file('file_materi');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            $uploadPath = public_path('assets/uploads/materi');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);
        }

        $materi->update([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'nama_guru' => $request->nama_guru,
            'file_materi' => $fileName,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data materi berhasil diperbarui.',
            'data' => $materi,
        ], 200);
    }

    public function destroy(string $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data materi tidak ditemukan.',
            ], 404);
        }

        $filePath = public_path('assets/uploads/materi/' . $materi->file_materi);

        if ($materi->file_materi && File::exists($filePath)) {
            File::delete($filePath);
        }

        $materi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data materi berhasil dihapus.',
        ], 200);
    }
}