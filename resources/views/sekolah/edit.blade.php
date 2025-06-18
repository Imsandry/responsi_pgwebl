@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Data Sekolah: {{ $sekolah->nama }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Penting untuk metode UPDATE --}}
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $sekolah->nama) }}" required>
            </div>
            <div class="mb-3">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select class="form-select" id="jenjang" name="jenjang" required>
                    <option value="">Pilih Jenjang</option>
                    <option value="PAUD" {{ old('jenjang', $sekolah->jenjang) == 'PAUD' ? 'selected' : '' }}>PAUD</option>
                    <option value="SD" {{ old('jenjang', $sekolah->jenjang) == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('jenjang', $sekolah->jenjang) == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ old('jenjang', $sekolah->jenjang) == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="SMK" {{ old('jenjang', $sekolah->jenjang) == 'SMK' ? 'selected' : '' }}>SMK</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="lat" class="form-label">Latitude</label>
                <input type="number" step="any" class="form-control" id="lat" name="lat" value="{{ old('lat', $sekolah->lat) }}" required>
            </div>
            <div class="mb-3">
                <label for="lng" class="form-label">Longitude</label>
                <input type="number" step="any" class="form-control" id="lng" name="lng" value="{{ old('lng', $sekolah->lng) }}" required>
            </div>
            <div class="mb-3">
                <label for="akreditasi" class="form-label">Akreditasi</label>
                <input type="text" class="form-control" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $sekolah->akreditasi) }}">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Sekolah Saat Ini</label>
                @if ($sekolah->foto)
                    <div class="mb-2">
                        <img src="{{ asset('images/' . $sekolah->foto) }}" alt="Foto {{ $sekolah->nama }}" class="img-thumbnail" style="width: 150px;">
                    </div>
                @else
                    <p>Tidak ada foto saat ini.</p>
                @endif
                <label for="new_foto" class="form-label">Ubah Foto (Opsional)</label>
                <input type="file" class="form-control" id="new_foto" name="foto" accept="image/*">
                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 2MB.</small>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('sekolah.manage') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
