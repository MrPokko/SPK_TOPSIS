<!-- resources/views/topsis/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Hasil Perhitungan TOPSIS</h2>
        <a href="{{ route('delete.all.items') }}" class="btn btn-danger mb-2" onclick="return confirm('Apakah Anda yakin ingin menghapus semua data?')">Hapus Semua Data</a>
        <table class="table">
            <thead>
                <tr>

                    <th>Nilai Preferensi</th>
                    <th>Urutan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hasilTopsis as $hasil)
                    <tr>

                        <!-- <td>{{ $hasil->nama_alternatif }}</td> -->
                        <td>{{ $hasil->nilai_preferensi }}</td>
                        <td>{{ $hasil->urutan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
