<?php
session_start();
include 'koneksi.php';

if (!isset($_GET['id'])) exit(header("Location: supir.php"));
$id = (int)$_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM supir WHERE id_supir = $id");
if (mysqli_num_rows($result) == 0) exit("User tidak ditemukan.");
$user = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama    = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
   $rute = htmlspecialchars($_POST['bus']);

    $update = mysqli_query($koneksi, "UPDATE supir SET 
       nama='$nama', email='$email', bus='$bus'WHERE id_supir=$id");

    exit(header("Location: supir.php"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Penumpang</title>
    <style>
        /* Styling sama seperti sebelumnya */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #CEE2FF;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.53);
            border: 1px solid #FFFFFF;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(2px);
            border-radius: 30px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-container {
            width: 100%;
            display: flex;
            border-radius: 30px;
        }

        .left-box {
            width: 100%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 20px;
        }

        .welcome {
            font-size: 24px;
            font-weight: bold;
            line-height: 1.3;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            background: #FFFFFF;
            border: none;
            border-radius: 10px;
            font-size: 20px;
            outline: 2px solid black;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background: #23425D;
            border-radius: 50px;
            font-size: 20px;
            color: #FFFFFF;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

<form action="" method="POST">
    <div class="form-container">
        <div class="left-box">
            <div class="welcome">Edit Data Penumpang</div>

            <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <select name="bus" required>
                <option value="">Pilih bus</option>
                <option value="1-wayhalim" <?= $user['bus'] == '1-wayhalim' ? 'selected' : '' ?>>1-wayhalim</option>
                <option value="12-kemiling" <?= $user['bus'] == '12-kemiling' ? 'selected' : '' ?>>12-kemiling</option>
                <option value="14-sukarame" <?= $user['bus'] == '14-sukarame' ? 'selected' : '' ?>>14-sukarame</option>
                <option value="15-karang" <?= $user['bus'] == '15-karang' ? 'selected' : '' ?>>15-karang</option>
            </select>

            <div class="button-group">
                <button type="submit">Simpan</button>
                <button type="submit" onclick="window.location.href='supir.php'">Batal</button>
            </div>
        </div>
    </div>
</form>

</body>
</html>
