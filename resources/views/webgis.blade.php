<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Peta Sekolah - WebGIS Pendidikan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    #map {
      height: 100vh;
    }

    .leaflet-div-icon {
      font-size: 1.5rem;
      color: #e74c3c;
      text-align: center;
    }

    .popup-img {
      margin-top: 5px;
      width: 100%;
      max-width: 250px;
      border-radius: 5px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>

  <div id="map"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    const map = L.map('map').setView([5.889, 95.316], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    fetch('{{ route("map.data") }}')
      .then(response => response.json())
      .then(data => {
        L.geoJSON(data, {
          pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {
              icon: L.divIcon({
                className: 'leaflet-div-icon',
                html: '<i class="fas fa-school"></i>',
                iconSize: [30, 30],
                iconAnchor: [15, 15],
              })
            }).bindPopup(`
              <strong>${feature.properties.nama}</strong><br>
              Jenjang: ${feature.properties.jenjang}<br>
              Akreditasi: ${feature.properties.akreditasi}<br>
              <img src="${feature.properties.foto}" class="popup-img" alt="Foto ${feature.properties.nama}">
            `);
          }
        }).addTo(map);
      })
      .catch(error => console.error(error));
  </script>

</body>
</html>
