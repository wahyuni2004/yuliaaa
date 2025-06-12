<?php
session_start();
require 'koneksi.php';

$isLoggedIn = isset($_SESSION['username']);
$totalPasien = 0;

if ($isLoggedIn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_pasien");
    $data = mysqli_fetch_assoc($result);
    $totalPasien = $data['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4eae6;
            font-family: Arial, sans-serif;
        }

        .hero {
            background-color: #734b2f;
            color: white;
            padding: 50px 30px;
            text-align: center;
            border-radius: 0 0 30px 30px;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: #9f7e6e;
            color: #fff;
            border: none;
        }

        .btn-custom:hover {
            background-color: #5a3824;
        }

        .content {
            padding: 40px 20px;
            text-align: center;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            color: #734b2f;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Selamat Datang di Aplikasi Data Pasien</h1>
        <p class="lead">Kelola data pasien dengan mudah dan cepat.</p>
        <?php if ($isLoggedIn): ?>
            <a href="dashboard.php" class="btn btn-light">Masuk ke Dashboard</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-custom me-2">Login</a>
            <a href="register.php" class="btn btn-outline-light">Daftar</a>
        <?php endif; ?>
    </div>

    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 text-center">
                    <?php if ($isLoggedIn): ?>
                        <h4>Total Pasien Terdaftar:</h4>
                        <h2><?= $totalPasien ?></h2>
                    <?php else: ?>
                        <h4>Silakan login untuk melihat data pasien.</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; <?= date('Y') ?> Website Data Pasien. Dibuat dengan &hearts;.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
