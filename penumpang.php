<?php
session_start();
include 'koneksi.php';

// Proses hapus jika ada ID di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($koneksi, "DELETE FROM penumpang WHERE id_penumpang = $id");
    header("Location: penumpang.php");
    exit;
}
// Ambil statistik online, offline, total akun
$total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM penumpang");
$data_total = mysqli_fetch_assoc($total);

$online = mysqli_query($koneksi, "SELECT COUNT(*) as online FROM penumpang WHERE status='online'");
$data_online = mysqli_fetch_assoc($online);

$offline = mysqli_query($koneksi, "SELECT COUNT(*) as offline FROM penumpang WHERE status='offline'");
$data_offline = mysqli_fetch_assoc($offline);

// Ambil semua data user
$users = mysqli_query($koneksi, "SELECT * FROM penumpang ORDER BY id_penumpang ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Updated Sidebar with Table</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body,
    html {
      height: 100%;
      width: 100%;
      background-color: #FAF7F3;
    }

    .background {
      background-image: url('img/background.png');
      background-size: cover;
      background-position: center;
      height: 100vh;
      position: relative;
    }

    .search-bar {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: white;
      padding: 10px 30px;
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .search-bar input {
      border: none;
      outline: none;
      font-size: 16px;
      background: transparent;
    }

     .sidebar {
            position: absolute;
            top: 0;
            width: 301px;
            height: 953px;
            left: 31px;
            top: 35px;
            background-color: #23425D;
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 10px;
            justify-content: space-between;
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
            left: 42px;
            top: 348px;
            border-radius: 20px;
             font-family: sans-serif;
    font-size: 16px;
        }
         

    .btn.inactive:hover {
      background-color: #909090;
    }

    .btn.penumpang {
      width: 279px;
      height: 60px;
      background: #909090;
      border-radius: 20px;
       font-family: sans-serif;
    font-size: 16px;}

    .sidebar-bottom .btn {
      width: 279px;
      height: 60px;
      background-color: white;
      border-radius: 20px;
    }

.dashboard-cards {
  display: flex;
  justify-content: space-between; /* biar sejajar pinggir */
  gap: 80px;
  margin: 20px auto;
  padding: 0 30px;
  flex-wrap: wrap;
  max-width: calc(100% - 350px); /* posisi kanan sejajar container tabel */
  position: absolute;
  top: 50px;
  left: 350px;
  right: 60px;
 
}

.stat-box {
  background-color: #fff;
  border-radius: 1px;
  color: white;
  padding: 90px;
  flex: 1; /* otomatis sama lebar */
  min-width: 300px;
  max-width: 500px;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  
}


.stat-horizontal {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 15px;
  padding: 30px 10px; /* tambah padding vertikal */
  height: 140px;      /* atau langsung atur tinggi */
}

.stat-horizontal i {
  font-size: 35px;
   
   color:#23425D;
}

.stat-text {
  text-align: center;
   color:#23425D;

}

.stat-text .stat-label {
  font-size: 20px;
  font-weight: bold;
  color:#23425D;
}

.stat-text .stat-number {
  font-size: 28px;
  color: #23425D;}



.stat-box.pink {
  background-color: white;
  border-radius: 8px;
}

.stat-box.blue {
  background-color: white;
  border-radius: 8px;
}

.stat-box.purple {
  background-color: white;
  border-radius: 8px;
}



    .user-table-container {
      position: absolute;
      top: 250px;
      left: 350px;
      right: 20px;
       background-color: #FAF7F3;
      padding: 30px;
      border-radius: 20px;
    }

    .user-table-container input[type="text"] {
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
      width: 250px;
    }

    table {
      width: 100%;
      border-spacing: 0 10px;
    }

    th{
      padding: 12px 20px 20px;
      background-color: #FAF7F3;
      border-radius: 20px;
      text-align: center;
      border: 8px solid #FAF7F3;
    }
    tbody tr {
  background-color: white;
  border-radius: 20px;
  overflow: hidden;

    box-shadow: 0 9px 12px rgba(0, 0, 0, 0.1); /* Tambahkan shadow */
}

tbody tr td {
  border: none;
  padding: 15px;
  text-align: center;
    font-size: 20px;
}


    th {
      background-color: #23425D;
      color: white;
       font-size: 18px;
    }

    .action-icons {
      display: flex;
      justify-content: center;
      gap: 12px;
    }

    .action-icons a {
      color: #23425D;
      font-size: 18px;
      text-decoration: none;
    }

    .action-icons a:hover {
      color: #007bff;
    }

    .top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  
}

.top-bar input[type="text"] {
  padding: 10px;
  border-radius: 5px;
  width: 300px;
  border: 1px solid #ccc;
  padding: 10px; 
  
}

.action {
  padding: 10px;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
      width: 250px;
       background-color: #23425D;
         padding: 20px ; /* tambah padding vertikal */
 font-size: 18px;
 color:white;
   font-weight: bold;
}

  </style>
</head> 

<body>
  <div class="background">

    <div class="sidebar">
      <div class="sidebar-top">
        <div class="logo">
          <img src="img/ptba.png" width="50" height="50">
        </div>
        <div class="divider"></div>
        <button class="btn inactive" onclick="window.location.href='dashboard.php'">Dashboard</button>
        <button class="btn penumpang" onclick="window.location.href='penumpang.php'">Statistik penumpang</button>
        <button class="btn inactive" onclick="window.location.href='supir.php'">Statistik supir</button>
        <button class="btn inactive" onclick="window.location.href='bus.php'">Statistik bus</button>
        <button class="btn inactive" onclick="window.location.href='notifikasi.php'">Notifikasi</button>
      </div>
      <div class="sidebar-bottom">
        <button class="btn inactive" onclick="window.location.href='profile.php'">Profile</button>
      </div>
    </div>

<div class="dashboard-cards">
  <div class="stat-box pink stat-horizontal">
    <i class="fas fa-signal"></i>
    <div class="stat-text">
      <div class="stat-label">Online</div>
      <div class="stat-number"><?= $data_online['online'] ?></div>
    </div>
  </div>

  <div class="stat-box blue stat-horizontal">
    <i class="fas fa-times-circle"></i>
    <div class="stat-text">
      <div class="stat-label">Offline</div>
      <div class="stat-number"><?= $data_offline['offline'] ?></div>
    </div>
  </div>

  <div class="stat-box purple stat-horizontal">
    <i class="fas fa-users"></i>
    <div class="stat-text">
      <div class="stat-label">Total akun</div>
      <div class="stat-number"><?= $data_total['total'] ?></div>
    </div>
  </div>
</div>




    <div class="user-table-container">
 <div class="top-bar">
  <input type="text" id="searchInput" placeholder="Cari akun..." onkeyup="filterTable()">
  <div class="right-action">
    <button class="action" onclick="window.location.href='create.php'">Create</button>
  </div>
</div>

      <table>
        <thead>
          <!-- <tr> -->
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Rute</th>
            <th>Aksi</th>
             <!-- </tr> -->
        </thead>
        <tbody>
          <?php $no = 1; while($user = mysqli_fetch_assoc($users)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($user['nama']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['rute']) ?></td>
            <td>
              <div class="action-icons">
                <a href="edit_penumpang.php?id=<?= $user['id_penumpang'] ?>" title="Edit"><i class="fas fa-pen-to-square"></i></a>
                <a href="penumpang.php?id=<?= $user['id_penumpang'] ?>" title="Hapus" onclick="return confirm('Yakin ingin menghapus user ini?')"><i class="fas fa-trash-alt"></i></a>
              </div>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <script>
function filterTable() {
  const input = document.getElementById("searchInput");
  const filter = input.value.toLowerCase();
  const table = document.querySelector("table tbody");
  const rows = table.getElementsByTagName("tr");

  for (let i = 0; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName("td");
    let found = false;

    for (let j = 1; j < 4; j++) { // kolom 1: nama, 2: email, 3: rute
      if (cells[j]) {
        const textValue = cells[j].textContent || cells[j].innerText;
        if (textValue.toLowerCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    rows[i].style.display = found ? "" : "none";
  }
}
</script>

</body>

</html>
