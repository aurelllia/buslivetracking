<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Peta</title>

  <!-- Leaflet CSS & JS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    html, body {
      height: 100%;
      width: 100%;
      overflow: hidden;
    }

    .background {
      position: relative;
      height: 100vh;
      width: 100%;
    }

    #map {
      height: 100%;
      width: 100%;
      z-index: 0;
    }

    .search-bar {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: white;
      padding: 10px 20px;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      z-index: 999;
      display: flex;
      align-items: center;
    }

    .search-bar input {
      border: none;
      outline: none;
      font-size: 16px;
      background: transparent;
      width: 300px;
    }

    .sidebar {
      position: absolute;
      top: 35px;
      left: 31px;
      width: 301px;
      height: 953px;
      background-color: #23425D;
      border-radius: 30px;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px 10px;
      justify-content: space-between;
      z-index: 1000;
    }

    .sidebar-top {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    .logo {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: #eee;
      overflow: hidden;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .divider {
      width: 100%;
      height: 1px;
      background-color: #eee;
      margin-top: 10px;
    }

    .btn {
      width: 100%;
      padding: 10px 0;
      border: none;
      border-radius: 15px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn.inactive {
      background-color: white;
      width: 279px;
      height: 60px;
      border-radius: 20px;
      font-size: 16px;
      font-family: sans-serif;
    }

    .btn.inactive:hover {
      background-color: #909090;
    }

    .sidebar-bottom {
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="background">

    <!-- Search bar -->
    <div class="search-bar">
      <input type="text" id="searchInput" placeholder="Cari lokasi di Bandar Lampung..." onkeydown="if(event.key==='Enter') searchLocation()">
    </div>

    <!-- Map -->
    <div id="map"></div>

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-top">
        <div class="logo">
          <img src="img/ptba.png" alt="Logo">
        </div>
        <div class="divider"></div>
        <button class="btn inactive">Dashboard</button>
        <button class="btn inactive" onclick="window.location.href='penumpang.php'">Statistik penumpang</button>
        <button class="btn inactive" onclick="window.location.href='supir.php'">Statistik supir</button>
        <button class="btn inactive" onclick="window.location.href='bus.php'">Statistik bus</button>
        <button class="btn inactive" onclick="window.location.href='notifikasi.php'">Notifikasi</button>
      </div>
      <div class="sidebar-bottom">
        <button class="btn inactive" onclick="window.location.href='profile.php'">Profil</button>
      </div>
    </div>

  </div>

  <!-- JavaScript -->
  <script>
    // Inisialisasi peta ke Bandar Lampung
    const map = L.map('map').setView([-5.4285, 105.2585], 13);

    // Gunakan OpenStreetMap tile
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker default
    const marker = L.marker([-5.4285, 105.2585]).addTo(map)
      .bindPopup('Bandar Lampung')
      .openPopup();

    // Fungsi pencarian
    function searchLocation() {
      const query = document.getElementById('searchInput').value;
      if (!query) return;

      const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&viewbox=104.9,-5.2,105.6,-5.6&bounded=1`;

      fetch(url)
        .then(res => res.json())
        .then(data => {
          if (data.length > 0) {
            const lat = data[0].lat;
            const lon = data[0].lon;
            const displayName = data[0].display_name;

            map.setView([lat, lon], 14);
            marker.setLatLng([lat, lon]).bindPopup(displayName).openPopup();
          } else {
            alert("Lokasi tidak ditemukan di Bandar Lampung.");
          }
        })
        .catch(err => {
          console.error(err);
          alert("Gagal mencari lokasi.");
        });
    }
  </script>
</body>

</html>
