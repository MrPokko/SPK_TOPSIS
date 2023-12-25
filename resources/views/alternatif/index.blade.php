<!-- resources/views/alternatif/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Alternatif</h2>
        <a href="{{ route('alternatif.create') }}" class="btn btn-success mb-2">Tambah Alternatif</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Alternatif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $alternatif)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $alternatif->nama_alternatif }}</td>
                        <td>
                            <a href="{{ route('alternatif.edit', $alternatif->id_alternatif) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('alternatif.destroy', $alternatif->id_alternatif) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
