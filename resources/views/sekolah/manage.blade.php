@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Kelola Data Sekolah</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('sekolah.create') }}" class="btn btn-primary mb-3">Tambah Sekolah Baru</a>

        @if($sekolahs->isEmpty())
            <div class="alert alert-warning" role="alert">
                Tidak ada data sekolah yang dapat dikelola.
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sekolahs as $sekolah)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $sekolah->nama }}</td>
                                <td>{{ $sekolah->jenjang }}</td>
                                <td>{{ $sekolah->akreditasi }}</td>
                                <td>{{ $sekolah->lat }}</td>
                                <td>{{ $sekolah->lng }}</td>
                                <td>
                                    @if ($sekolah->foto)
                                        <img src="{{ asset('images/' . $sekolah->foto) }}" alt="{{ $sekolah->nama }}" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sekolah.edit', $sekolah->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('sekolah.destroy', $sekolah->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
