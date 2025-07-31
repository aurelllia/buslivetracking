<?php
session_start();
include "koneksi.php";

$error = "";
if($_POST){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $q = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE username='$username'");
  $data = mysqli_fetch_assoc($q);

  if ($data && $password == $data['password']) {
    $_SESSION['username'] = $user;
    header("Location: dashboard.php");
    exit;
  }

  $error = $data ? "Password salah." : "Username tidak ditemukan.";
}
?>
<!doctype html>
<html>
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title></head>
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
  }

 body {
    background-color: #91C8E4;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  form {
    width: 1332px;
    height: 925px;
    background:#FBFBFB;
    border: 1px solid #FFFFFF;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.4);
    backdrop-filter: blur(2px);
    border-radius: 30px;
    padding: 40px;
    display: flex;
    align-items: center;
  }

  .form-container {
    width: 100%;
    height: 100%;
    display: flex;
    border-radius: 30px;
  }

  .left-box {
    width: 50%;
    padding: 60px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 30px;
  }

  .logo-text {
      display: flex;
      align-items: center;
     
      margin-bottom: 40px;
      padding-left: 20px;
    }

    .logo-text img {
      width: 100px;
      height: 10px;
      object-fit: cover;
      padding-top: 15px 10px;
    }

  .welcome {
    font-size: 36px;
    font-weight: bold;
    line-height: 1.3;
    padding-left: 20px;
    
  }

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 20px;
  margin-bottom: 10px;
  background: #FFFFFF;
  border: none;
  border-radius: 15px;
  font-family: 'Inter', sans-serif;
  font-size: 36px;
  line-height: 44px;
  outline: 2px solid black; 
}

  button[type="submit"] {
    width: 100%;
    padding: 20px;
    border: none;
    background: #23425D;
    border-radius: 50px;
    font-family: 'Inter', sans-serif;
    font-size: 36px;
    line-height: 44px;
    color: #FFFFFF;
    cursor: pointer;
  }

.right-box {
    width: 50%;
    background: url('img/yy.jpg') no-repeat center center;
    background-size: cover;
    border-radius: 20px;
    margin: 20px 0;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.4);
}


 .error {
  color: red;
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  margin-top: 10px;
}
</style>

<body>
  <form method="post">
    <div class="form-container">
      <div class="left-box">
        <div style="display: flex; align-items: center; gap: 10px;">
          <div class="logo-text">
          <img src="img/logo.png" alt="Logo">
        
        </div>
          <div class="welcome">Welcome<br>admin!</div>
        </div>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Log in</button>

        <?php if ($error): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>

      <div class="right-box"></div>
    </div>
  </form>
</body>


</html>