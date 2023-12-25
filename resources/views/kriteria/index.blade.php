<!-- resources/views/kriteria/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Daftar Kriteria</h2>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-2">Tambah Kriteria</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kriteria</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriterias as $kriteria)
                <tr>
                    <td>{{ $kriteria->id_kriteria }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td>{{ $kriteria->bobot }}</td>
                    <td>
                        <a href="{{ route('kriteria.edit', $kriteria->id_kriteria) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('kriteria.destroy', $kriteria->id_kriteria) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
