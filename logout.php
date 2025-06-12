<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
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

<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil Logout',
        text: 'Anda akan diarahkan ke halaman utama...',
        confirmButtonColor: '#734b2f',
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false
    }).then(() => {
        window.location.href = 'index.php'; // Arahkan ke halaman utama
    });
</script>

</body>
</html>
