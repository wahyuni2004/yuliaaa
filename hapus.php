<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
if (isset($_GET['npm'])) {
    include "koneksi.php";
    $npm = $_GET['npm'];

    $hapus = mysqli_query($conn, "DELETE FROM tbl_mahasiswa WHERE npm='$npm'");

    if ($hapus) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil dihapus',
                background: '#fff3e6', /* Soft light brown background */
                confirmButtonColor: '#9f7e6e', /* Soft brown color for button */
                iconColor: '#9f7e6e' /* Soft brown color for icon */
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal dihapus',
                background: '#f8d7da', /* Soft red background */
                confirmButtonColor: '#d33', /* Red for error */
                iconColor: '#d33' /* Red for error icon */
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'NPM tidak ditemukan',
            background: '#fff3e6', /* Soft light brown background */
            confirmButtonColor: '#b8860b', /* Soft yellowish brown for warning button */
            iconColor: '#b8860b' /* Soft yellowish brown for warning icon */
        }).then(() => {
            window.location.href = 'index.php';
        });
    </script>";
}
?>

</body>
</html>
