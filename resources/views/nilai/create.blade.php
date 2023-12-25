<!-- resources/views/nilai/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Nilai</h2>
        <form action="{{ route('nilai.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_alternatif">Alternatif:</label>
                <select name="id_alternatif" class="form-control">
                    @foreach ($alternatifs as $alternatif)
                        <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->nama_alternatif }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kriteria">Kriteria:</label>
                <select name="id_kriteria" class="form-control">
                    @foreach ($kriterias as $kriteria)
                        <option value="{{ $kriteria->id_kriteria }}">{{ $kriteria->nama_kriteria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" name="nilai" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
