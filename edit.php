<?php
include "koneksi.php";
if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $query = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE npm='$npm'");
    $data = mysqli_fetch_assoc($query);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Mahasiswa</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #e0d2c6; /* Soft brown background */
      margin: 0;
      padding: 0;
    }
    .container {
      width: 90%;
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(80, 50, 20, 0.2);
    }
    h3 {
      text-align: center;
      color: #3c2f29;
      margin-bottom: 20px;
    }
    label {
      color: #3c2f29;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ddd;
      border-radius: 6px;
      background-color: #f5f3e6;
    }
    input[type="submit"] {
      background-color: #9f7e6e; 
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #734b2f; 
    }
    a {
      text-decoration: none;
      color: #9f7e6e;
      text-align: center;
      display: block;
      margin-top: 20px;
    }
    a:hover {
      color: #734b2f;
    }
  </style>
</head>
<body>

<div class="container">
  <h3>Edit Data Mahasiswa</h3>
  <form action="" method="post">
    <label for="npm">NPM:</label>
    <input type="text" name="npm" value="<?= $data['npm'] ?>" readonly>

    <label for="nama">Nama:</label>
    <input type="text" name="nama" value="<?= $data['nama'] ?>" required>
    
    <label for="prodi">Program Studi:</label>
    <select name="prodi" required>
      <option value="<?= $data['prodi'] ?>"><?= $data['prodi'] ?></option>
      <option value="Pendidikan Informatika">Pendidikan Informatika</option>
      <option value="Teknologi Informasi">Teknologi Informasi</option>
      <option value="Sistem Informasi">Sistem Informasi</option>
      <option value="Teknik Komputer">Teknik Komputer</option>
      <option value="Teknik Informatika">Teknik Informatika</option>
    </select>
    
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $data['email'] ?>" required>
    
    <label for="alamat">Alamat:</label>
    <textarea name="alamat"><?= $data['alamat'] ?></textarea>
    
    <input type="submit" name="update" value="Update Data">
  </form>

  <a href="index.php">← Kembali ke Daftar Mahasiswa</a>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($conn, "UPDATE tbl_mahasiswa SET nama='$nama', prodi='$prodi', email='$email', alamat='$alamat' WHERE npm='$npm'");
    if ($update) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui',
                confirmButtonColor: '#9f7e6e'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal diperbarui',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}
?>

</body>
</html>
