<?php
require 'db.php';

$message = $swalType = $swalText = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (strlen($username) < 3 || strlen($password) < 4) {
        $swalType = 'warning';
        $swalText = 'Username dan password harus lebih panjang dari 3 karakter.';
    } else {
        $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $swalType = 'error';
            $swalText = 'Username sudah digunakan.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);
            if ($stmt->execute()) {
                $swalType = 'success';
                $swalText = 'Registrasi berhasil! Silakan login.';
            } else {
                $swalType = 'error';
                $swalText = 'Registrasi gagal. Coba lagi.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4eae6;
            color: #3c2f29;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #9f7e6e;
            border-color: #9f7e6e;
        }

        .btn-primary:hover {
            background-color: #734b2f;
            border-color: #734b2f;
        }

        a {
            color: #734b2f;
        }

        a:hover {
            color: #3c2f29;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4">Form Registrasi</h2>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </p>
    </div>

    <?php if ($swalType && $swalText): ?>
    <script>
        Swal.fire({
            icon: '<?= $swalType ?>',
            title: '<?= $swalType === "success" ? "Berhasil!" : "Oops..." ?>',
            text: '<?= $swalText ?>',
            confirmButtonColor: '#9f7e6e'
        }).then((result) => {
            <?php if ($swalType === 'success'): ?>
                window.location.href = 'login.php';
            <?php endif; ?>
        });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
