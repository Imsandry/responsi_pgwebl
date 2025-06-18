@extends('layouts.app') {{-- Meng-extend template app.blade.php --}}

@push('styles') {{-- Dorong CSS ini ke bagian head dari app.blade.php --}}
<style>
    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                  url('/images/education-map.jpg') center/cover no-repeat;
      color: white;
      height: calc(100vh - 56px); /* Kurangi tinggi navbar (sekitar 56px) */
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .btn-map i {
      margin-right: 8px;
    }
</style>
@endpush

@section('content') {{-- Konten utama halaman landing --}}
<section class="hero">
  <div class="container">
    <h1 class="display-4 fw-bold">Selamat Datang di WebGIS Pendidikan</h1>
    <p class="lead">Temukan lokasi sekolah dan fasilitas pendidikan melalui peta interaktif</p>
    <a href="{{ route('map.view') }}" class="btn btn-light btn-lg btn-map mt-3">
      <i class="fas fa-location-dot"></i> Lihat Peta
    </a>
  </div>
</section>
@endsection
