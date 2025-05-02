<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Tambah Data Mahasiswa</title>
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
      color: #3c2f29; /* Darker brown color */
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
      background-color: #9f7e6e; /* Soft brown color */
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #734b2f; /* Darker brown on hover */
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
  <h3>Tambah Data Mahasiswa</h3>
  <form action="" method="post" onsubmit="return validateForm()">
    <label for="npm">NPM:</label>
    <input type="text" name="npm" id="npm" required>
    
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" required>
    
    <label for="prodi">Program Studi:</label>
    <select name="prodi" id="prodi" required>
      <option value="">--Pilih Prodi--</option>
      <option value="Pendidikan Informatika">Pendidikan Informatika</option>
      <option value="Teknologi Informasi">Teknologi Informasi</option>
      <option value="Sistem Informasi">Sistem Informasi</option>
      <option value="Teknik Komputer">Teknik Komputer</option>
      <option value="Teknik Informatika">Teknik Informatika</option>
    </select>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="alamat">Alamat:</label>
    <textarea name="alamat" id="alamat" required></textarea>
    
    <input type="submit" name="submit" value="Simpan Data">
  </form>

  <a href="index.php">← Kembali ke Daftar Mahasiswa</a>
</div>

<script>
  function validateForm() {
    const npm = document.getElementById("npm").value.trim();
    const nama = document.getElementById("nama").value.trim();
    const prodi = document.getElementById("prodi").value;
    const email = document.getElementById("email").value.trim();
    const alamat = document.getElementById("alamat").value.trim();

    if (!npm || !nama || !prodi || !email || !alamat) {
      Swal.fire({
        icon: 'warning',
        title: 'Data Tidak Lengkap!',
        text: 'Semua kolom harus diisi!',
        background: '#fff3e6', /* Soft light brown background */
        confirmButtonColor: '#9f7e6e', /* Soft brown color for button */
        iconColor: '#9f7e6e' /* Soft brown color for icon */
      });
      return false; // prevent form submission
    }
    return true; // allow form submission
  }
</script>

<?php
if (isset($_POST['submit'])) {
    include "koneksi.php";
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    if ($npm && $nama && $prodi && $email && $alamat) {
        $query = "INSERT INTO tbl_mahasiswa (npm, nama, prodi, email, alamat) VALUES ('$npm', '$nama', '$prodi', '$email', '$alamat')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil disimpan',
                    background: '#fff3e6', /* Light background */
                    confirmButtonColor: '#9f7e6e', /* Soft brown */
                    iconColor: '#9f7e6e' /* Soft brown */
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    background: '#fff3e6',
                    confirmButtonColor: '#d33',
                    iconColor: '#d33'
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Data Tidak Lengkap!',
                text: 'Semua kolom harus diisi!',
                background: '#fff3e6', /* Soft light brown background */
                confirmButtonColor: '#9f7e6e', /* Soft brown */
                iconColor: '#9f7e6e' /* Soft brown */
            });
        </script>";
    }
}
?>

</body>
</html>
