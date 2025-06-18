@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Tambah Sekolah Baru</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select class="form-select" id="jenjang" name="jenjang" required>
                    <option value="">Pilih Jenjang</option>
                    <option value="PAUD" {{ old('jenjang') == 'PAUD' ? 'selected' : '' }}>PAUD</option>
                    <option value="SD" {{ old('jenjang') == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ old('jenjang') == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ old('jenjang') == 'SMA' ? 'selected' : '' }}>SMA</option>
                    <option value="SMK" {{ old('jenjang') == 'SMK' ? 'selected' : '' }}>SMK</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="lat" class="form-label">Latitude</label>
                <input type="number" step="any" class="form-control" id="lat" name="lat" value="{{ old('lat') }}" required>
            </div>
            <div class="mb-3">
                <label for="lng" class="form-label">Longitude</label>
                <input type="number" step="any" class="form-control" id="lng" name="lng" value="{{ old('lng') }}" required>
            </div>
            <div class="mb-3">
                <label for="akreditasi" class="form-label">Akreditasi</label>
                <input type="text" class="form-control" id="akreditasi" name="akreditasi" value="{{ old('akreditasi') }}">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Sekolah</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                <small class="form-text text-muted">Maksimal 2MB (jpeg, png, jpg, gif, svg)</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('sekolah.manage') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
