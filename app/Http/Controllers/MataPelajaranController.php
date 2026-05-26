<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $data = MataPelajaran::latest()->get();
        return view('mata-pelajaran.index', compact('data'));
    }

    public function create()
    {
        return view('mata-pelajaran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel',
            'nama_mapel' => 'required|string|max:100',
            'guru_pengampu' => 'nullable|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        MataPelajaran::create($validated);

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.show', compact('data'));
    }

    public function edit($id)
    {
        $data = MataPelajaran::findOrFail($id);
        return view('mata-pelajaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = MataPelajaran::findOrFail($id);

        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:100',
            'guru_pengampu' => 'nullable|string|max:100',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        $data->update($validated);

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = MataPelajaran::findOrFail($id);
        $data->delete();

        return redirect()->route('mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}