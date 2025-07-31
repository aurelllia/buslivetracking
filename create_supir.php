<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

       body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
             background-color: #FAF7F3;
        }


        form {
            max-width: 600px;
            width: 100%;
            background-color: white;
            border: 1px solid #FFFFFF;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4);
    
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
            background-color:white;
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
        input[type="password"],
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

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <div class="form-container">
        <div class="left-box">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="welcome">Create a New Account</div>
            </div>
            
            <?php
            include 'koneksi.php';

            function input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = input($_POST['nama']);
                $email = input($_POST['email']);
                $rute = input($_POST['bus']); // Assuming this field is added later

                $sql = "INSERT INTO supir (nama, email, bus) VALUES ('$nama', '$email', '$bus')";

                $hasil = mysqli_query($koneksi, $sql);

                if ($hasil) {
                    header("Location: supir.php");
                } else {
                    echo "Data Gagal disimpan.";
                }
            }
            ?>

            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            
        

            <select name="bus" required>
                <option value="">Pilih Rute</option>
                <option value="1-wayhalim">1-wayhalim</option>
                <option value="12-kemiling">12-kemiling</option>
                <option value="14-sukarame">14-sukarame</option>
                <option value="15-karang">15-karang</option>
            </select>

            <div class="button-group">
                <button type="submit">Daftar</button>
                <button type="submit" onclick="window.location.href='supir.php'">Batal</button>
            </div>
        </div>
    </div>
</form>

</body>
</html>
