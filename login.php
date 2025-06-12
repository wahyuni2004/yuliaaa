<?php
session_start();
include 'db.php';

$login_success = false;
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $login_success = true;
        } else {
            $message = "Password salah.";
        }
    } else {
        $message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap & SweetAlert2 -->
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
        <h2 class="text-center mb-4">Form Login</h2>

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>
    </div>

    <!-- SweetAlert -->
    <?php if (!empty($message)): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '<?= $message ?>',
            confirmButtonColor: '#734b2f'
        });
    </script>
    <?php elseif ($login_success): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: 'Selamat datang, <?= htmlspecialchars($username) ?>',
            confirmButtonColor: '#734b2f',
            timer: 2000,
            timerProgressBar: true,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'dashboard.php';
        });
    </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
