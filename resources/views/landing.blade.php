<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>WebGIS Pendidikan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                  url('/images/education-map.jpg') center/cover no-repeat;
      color: white;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .btn-map i {
      margin-right: 8px;
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fas fa-school"></i> WebGIS Pendidikan
      </a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="display-4 fw-bold">Selamat Datang di WebGIS Pendidikan</h1>
      <p class="lead">Temukan lokasi sekolah dan fasilitas pendidikan melalui peta interaktif</p>
      <a href="{{ route('map.view') }}" class="btn btn-light btn-lg btn-map mt-3">
        <i class="fas fa-location-dot"></i> Lihat Peta
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3">
    <div class="container">
      <small>&copy; {{ date('Y') }} WebGIS Pendidikan - Dibuat oleh Mahasiswa PGWEB</small>
    </div>
  </footer>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    