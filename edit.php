<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tbl_pasien WHERE id = $id");
$data = mysqli_fetch_assoc($result);

$updated = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $poli = htmlspecialchars($_POST['poli']);
    $umur = intval($_POST['umur']);
    $alamat = htmlspecialchars($_POST['alamat']);

    $query = "UPDATE tbl_pasien SET nama=?, poli=?, umur=?, alamat=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssisi", $nama, $poli, $umur, $alamat, $id);
    mysqli_stmt_execute($stmt);

    $updated = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pasien</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --primary: #9f7e6e;
            --primary-dark: #734b2f;
            --background: #e0d2c6;
            --white: #fff;
            --text-dark: #3c2f29;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--background);
            color: var(--text-dark);
            padding: 2rem;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: var(--white);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(80, 50, 20, 0.15);
        }

        h2 {
            color: var(--primary-dark);
            margin-bottom: 1rem;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.3rem;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            background-color: var(--primary);
            color: var(--white);
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: var(--primary-dark);
        }

        .back-link {
            display: block;
            margin-top: 1rem;
            text-align: center;
            text-decoration: none;
            color: var(--primary-dark);
        }

        .back-link:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-edit"></i> Edit Data Pasien</h2>
        <form method="post">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

            <label>Poli:</label>
            <select name="poli" required>
                <?php
                $daftar_poli = ['Umum', 'Gigi', 'Anak', 'Kandungan'];
                foreach ($daftar_poli as $poli) {
                    $selected = ($poli == $data['poli']) ? 'selected' : '';
                    echo "<option value=\"$poli\" $selected>$poli</option>";
                }
                ?>
            </select>

            <label>Umur:</label>
            <input type="number" name="umur" value="<?= htmlspecialchars($data['umur']) ?>" required>

            <label>Alamat:</label>
            <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>

            <input type="submit" value="Update">
        </form>
        <a class="back-link" href="pasien.php"><i class="fas fa-arrow-left"></i> Kembali ke Data Pasien</a>
    </div>

<?php if ($updated): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Data berhasil diupdate!',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'pasien.php';
    });
    <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">
    <i class="fas fa-pen-to-square"></i> Edit
</a>

</script>
<?php endif; ?>
</body>
</html>
