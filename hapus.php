<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$deleted = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Validasi angka

    // Gunakan prepared statement
    $stmt = mysqli_prepare($conn, "DELETE FROM tbl_pasien WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $deleted = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4eae6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<?php if ($deleted): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Data berhasil dihapus!',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        window.location.href = 'pasien.php';
    });
</script>
<?php else: ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Data gagal dihapus!',
        text: 'ID tidak valid atau kesalahan server.',
        confirmButtonColor: '#734b2f'
    }).then(() => {
        window.location.href = 'pasien.php';
    });
</script>
<?php endif; ?>

</body>
</html>
