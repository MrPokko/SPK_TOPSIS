<!-- resources/views/alternatif/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detail Alternatif</h2>
        <p><strong>ID:</strong> {{ $alternatif->id }}</p>
        <p><strong>Nama Alternatif:</strong> {{ $alternatif->nama_alternatif }}</p>
        <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
