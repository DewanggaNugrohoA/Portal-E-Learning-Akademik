<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        Guru::create($request->all());
        return redirect()->route('guru.index');
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return redirect()->route('guru.index');
    }

    public function destroy($id)
    {
        Guru::findOrFail($id)->delete();
        return redirect()->route('guru.index');
    }
}