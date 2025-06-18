@extends('layouts.app') {{-- Meng-extend template app.blade.php --}}

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Data Sekolah</h1>

        @if($sekolahs->isEmpty())
            <div class="alert alert-warning" role="alert">
                Tidak ada data sekolah yang ditemukan.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">Jenjang</th>
                            <th scope="col">Akreditasi</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sekolahs as $sekolah)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $sekolah->nama }}</td>
                                <td>{{ $sekolah->jenjang }}</td>
                                <td>{{ $sekolah->akreditasi }}</td>
                                <td>{{ $sekolah->lat }}</td> {{-- Menggunakan 'lat' --}}
                                <td>{{ $sekolah->lng }}</td> {{-- Menggunakan 'lng' --}}
                                <td>
                                    @if ($sekolah->foto)
                                        {{-- Asumsi foto ada di public/images/ --}}
                                        <img src="{{ asset('images/' . $sekolah->foto) }}" alt="{{ $sekolah->nama }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
