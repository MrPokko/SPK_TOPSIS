<!-- resources/views/kriteria/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Tambah Kriteria</h2>
    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_kriteria">Nama Kriteria:</label>
            <input type="text" name="nama_kriteria" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bobot">Bobot:</label>
            <input type="text" name="bobot" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
