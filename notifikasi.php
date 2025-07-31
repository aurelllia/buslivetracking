<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Updated Sidebar</title>
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
        }

        .background {
            background-image: url('img/background.png');
            /* ganti dengan map background kamu */
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
        .sidebar-bottom {
            width: 100%;
        }

        .sidebar-bottom .btn {
          
            width: 279px;
            height: 60px;
            left: 42px;
            top: 348px;
   background-color: white;
            border-radius: 20px;
        }
           .btn.notifikasi {
      width: 279px;
      height: 60px;
      background: #909090;
      border-radius: 20px;
       font-family: sans-serif;
    font-size: 16px;}

    .up{
display:flex;
width: 3040px;
height: 244px;
background: #E2E2E2;

    }
    </style>
</head>

<body>
    <div class="background">
        <div class="search-bar">
            <input type="text" placeholder="Search..." />
        </div>

        <div class="sidebar">
            <div class="sidebar-top">
                <div class="logo">
                    <img src="img/ptba.png">
                </div>
                <div class="divider"></div>
                <button class="btn inactive">Dashboard</button>
               <button class="btn inactive" onclick="window.location.href='penumpang.php'">Statistik penumpang</button>
               <button class="btn inactive" onclick="window.location.href='supir.php'">Statistik supir</button>
               <button class="btn inactive" onclick="window.location.href='bus.php'">Statistik bus</button>
               <button class="btn notifikasi" onclick="window.location.href='notifikasi.php'">Notifikasi</button>
            </div>
            <div class="sidebar-bottom">
              <button class="btn inactive" onclick="window.location.href='profile.php'">profile</button>
            </div>
        </div>
        <div class="up" type="box"></div>
    </div>
    
</body>

</html>