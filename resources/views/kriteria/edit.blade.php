<!-- resources/views/kriteria/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Edit Kriteria</h2>
    <form action="{{ route('kriteria.update', $kriteria->id_kriteria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria:</label>
            <input type="text" name="nama_kriteria" class="form-control" value="{{ $kriteria->nama_kriteria }}" required>
        </div>
        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <input type="text" name="bobot" class="form-control" value="{{ $kriteria->bobot }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
@endsection
