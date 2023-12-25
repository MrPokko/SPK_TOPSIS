<?php

namespace App\Http\Controllers;
use App\Models\Alternatif;

use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('alternatif.index', compact('alternatifs'));
    }

    public function create()
    {
        return view('alternatif.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alternatif' => 'required|string',
        ]);

        Alternatif::create($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan');
    }

    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.form', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama_alternatif' => 'required|string',
        ]);

        $alternatif->update($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus');
    }
}
