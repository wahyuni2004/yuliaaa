<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4eae6;
            color: #3c2f29;
        }

        .navmenu {
            background-color: #734b2f;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navmenu .left, .navmenu .right {
            display: flex;
            gap: 20px;
        }

        .navmenu a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        .navmenu a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 40px;
        }

        .welcome h2 {
            color: #734b2f;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 25px;
            text-align: center;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin: 10px 0;
            color: #9f7e6e;
        }

        .card p {
            color: #5e5047;
            font-size: 14px;
        }

        .card a {
            display: inline-block;
            margin-top: 12px;
            background-color: #9f7e6e;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
        }

        .card a:hover {
            background-color: #734b2f;
        }

        @media (max-width: 500px) {
            .navmenu {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="navmenu">
    <div class="left">
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="pasien.php">👤 Data Pasien</a> <!-- Ganti ikon di sini -->
        <a href="tambah.php">➕ Tambah Pasien</a>
    </div>
    <div class="right">
        <a href="logout.php">🔓 Logout</a>
    </div>
</div>


<div class="container">
    <div class="welcome">
        <h2>Selamat Datang, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!</h2>
        <p>Berikut beberapa menu yang bisa Anda akses:</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>🩺 Data Pasien</h3>
            <p>Lihat dan kelola daftar pasien yang terdaftar.</p>
            <a href="pasien.php">Lihat Data</a>
        </div>

        <div class="card">
            <h3>➕ Tambah Pasien</h3>
            <p>Tambahkan pasien baru ke dalam sistem.</p>
            <a href="tambah.php">Tambah Data</a>
        </div>

        <div class="card">
            <h3>🔓 Logout</h3>
            <p>Keluar dari sistem dengan aman.</p>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
