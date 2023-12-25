<!-- resources/views/alternatif/form.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($alternatif) ? 'Edit' : 'Tambah' }} Alternatif</h2>
        @if(isset($alternatif))
            <form action="{{ route('alternatif.update', $alternatif->id_alternatif) }}" method="POST">
                @method('PUT')
        @else
            <form action="{{ route('alternatif.store') }}" method="POST">
        @endif
            @csrf
            <div class="form-group">
                <label for="nama_alternatif">Nama Alternatif:</label>
                <input type="text" class="form-control" id="nama_alternatif" name="nama_alternatif" value="{{ isset($alternatif) ? $alternatif->nama_alternatif : old('nama_alternatif') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
