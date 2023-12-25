<!-- resources/views/nilai/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Nilai</h2>
        <form action="{{ route('nilai.update', $nilai->id_nilai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_alternatif">Alternatif:</label>
                <select name="id_alternatif" class="form-control">
                    @foreach ($alternatifs as $alternatif)
                        <option value="{{ $alternatif->id_alternatif }}" {{ $nilai->id_alternatif == $alternatif->id_alternatif ? 'selected' : '' }}>
                            {{ $alternatif->nama_alternatif }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="id_kriteria">Kriteria:</label>
                <select name="id_kriteria" class="form-control">
                    @foreach ($kriterias as $kriteria)
                        <option value="{{ $kriteria->id_kriteria }}" {{ $nilai->id_kriteria == $kriteria->id_kriteria ? 'selected' : '' }}>
                            {{ $kriteria->nama_kriteria }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nilai">Nilai:</label>
                <input type="text" name="nilai" class="form-control" value="{{ $nilai->nilai }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
