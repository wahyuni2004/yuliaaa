<?php 
require 'session_check.php';
require 'koneksi.php';

$keyword = '';
if (isset($_GET['search'])) {
    $keyword = htmlspecialchars($_GET['search']);
    $query = "SELECT * FROM tbl_pasien WHERE nama LIKE '%$keyword%' OR poli LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM tbl_pasien";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
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
    <div class="top-bar">
        <h2>Data Pasien</h2>
        <form class="search-form" method="get" action="pasien.php">
            <input type="text" name="search" placeholder="Cari nama atau poli..." value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit">Cari</button>
        </form>
        <a href="tambah.php" class="btn">+ Tambah Pasien</a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Poli</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['poli']) ?></td>
                        <td><?= htmlspecialchars($row['umur']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td class="aksi">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
                                <i class="fas fa-edit"></i>Edit
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Hapus data ini?')">
                                <i class="fas fa-trash-alt"></i>Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
