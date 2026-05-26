<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
{
    public function index(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Data materi berhasil ditampilkan.',
                'data' => Materi::latest()->get(),
            ]);
        }

        $materis = Materi::latest()->paginate(10);

        return view('materi.index', compact('materis'));
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nama_mata_pelajaran' => 'nullable|string|max:255',
            'nama_guru' => 'nullable|string|max:255',
            'file_materi' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,zip,rar|max:20480',
        ], [
            'judul_materi.required' => 'Judul materi wajib diisi.',
            'file_materi.mimes' => 'File harus berupa PDF, DOC, DOCX, PPT, PPTX, MP4, ZIP, atau RAR.',
            'file_materi.max' => 'Ukuran file maksimal 20 MB.',
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

        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Data materi berhasil ditambahkan.',
                'data' => $materi,
            ], 201);
        }

        return redirect()
            ->route('materi.index')
            ->with('success', 'Data materi berhasil ditambahkan.');
    }

    public function show(Request $request, Materi $materi)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Detail materi berhasil ditampilkan.',
                'data' => $materi,
            ]);
        }

        return view('materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nama_mata_pelajaran' => 'nullable|string|max:255',
            'nama_guru' => 'nullable|string|max:255',
            'file_materi' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,mp4,zip,rar|max:20480',
        ], [
            'judul_materi.required' => 'Judul materi wajib diisi.',
            'file_materi.mimes' => 'File harus berupa PDF, DOC, DOCX, PPT, PPTX, MP4, ZIP, atau RAR.',
            'file_materi.max' => 'Ukuran file maksimal 20 MB.',
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

        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Data materi berhasil diperbarui.',
                'data' => $materi,
            ]);
        }

        return redirect()
            ->route('materi.index')
            ->with('success', 'Data materi berhasil diperbarui.');
    }

    public function destroy(Request $request, Materi $materi)
    {
        $filePath = public_path('assets/uploads/materi/' . $materi->file_materi);

        if ($materi->file_materi && File::exists($filePath)) {
            File::delete($filePath);
        }

        $materi->delete();

        if ($request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Data materi berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('materi.index')
            ->with('success', 'Data materi berhasil dihapus.');
    }
}