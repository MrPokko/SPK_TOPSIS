<!-- resources/views/nilai/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Nilai</h2>
        <a href="{{ route('nilai.create') }}" class="btn btn-primary mb-3">Tambah Nilai</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilais as $nilai)
                    <tr>
                        <td>{{ $nilai->alternatif->nama_alternatif }}</td>
                        <td>{{ $nilai->kriteria->nama_kriteria }}</td>
                        <td>{{ $nilai->nilai }}</td>
                        <td>
                            <a href="{{ route('nilai.edit', $nilai->id_nilai) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('nilai.destroy', $nilai->id_nilai) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
