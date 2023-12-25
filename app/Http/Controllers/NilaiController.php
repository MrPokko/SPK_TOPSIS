<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Alternatif;
use App\Models\Kriteria;

class NilaiController extends Controller
{
    public function index()
    {
        $nilais = Nilai::all();
        return view('nilai.index', compact('nilais'));
    }

    public function create()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('nilai.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alternatif' => 'required|exists:alternatifs,id_alternatif',
            'id_kriteria' => 'required|exists:kriterias,id_kriteria',
            'nilai' => 'required|numeric',
        ]);

        Nilai::create($request->all());

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function edit(Nilai $nilai)
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();

        return view('nilai.edit', compact('nilai', 'alternatifs', 'kriterias'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'id_alternatif' => 'required|exists:alternatifs,id_alternatif',
            'id_kriteria' => 'required|exists:kriterias,id_kriteria',
            'nilai' => 'required|numeric',
        ]);

        $nilai->update($request->all());

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus');
    }
}
