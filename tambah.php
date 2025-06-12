<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $poli = htmlspecialchars($_POST['poli']);
    $umur = intval($_POST['umur']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $query = "INSERT INTO tbl_pasien (nama, poli, umur, alamat) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssis", $nama, $poli, $umur, $alamat);
    mysqli_stmt_execute($stmt);

    header("Location: pasien.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4eae6;
            color: #3c2f29;
            margin: 0;
            padding: 0;
        }

        .navmenu {
            background-color: #734b2f;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navmenu a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }

        .navmenu a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 30px;
        }

        form {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cbb7a2;
            border-radius: 6px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #9f7e6e;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #734b2f;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .back-link a {
            color: #734b2f;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
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
        <h2>Tambah Data Pasien</h2>
        <form method="post">
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Poli:</label>
            <select name="poli" required>
                <option value="">-- Pilih Poli --</option>
                <option value="Umum">Umum</option>
                <option value="Gigi">Gigi</option>
                <option value="Anak">Anak</option>
                <option value="Kandungan">Kandungan</option>
                <option value="Saraf">Saraf</option>
            </select>

            <label>Umur:</label>
            <input type="number" name="umur" required>

            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>

            <input type="submit" value="Simpan">
        </form>

        <div class="back-link">
            <a href="pasien.php">Kembali ke Data Pasien</a>
        </div>
    </div>

</body>
</html>
