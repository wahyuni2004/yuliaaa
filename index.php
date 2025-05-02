<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Mahasiswa</title>
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
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(80, 50, 20, 0.2);
    }
    h2 {
      text-align: center;
      color: #3c2f29; /* Darker brown color */
      margin-bottom: 20px;
      font-size: 28px;
    }
    .table-container {
      margin-top: 30px;
      border-radius: 10px;
      overflow: hidden;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }
    th {
      background-color: #9f7e6e; /* Modern light brown */
      color: white;
    }
    td {
      background-color: #f5f3e6; /* Soft beige background for cells */
    }
    .action-buttons a {
      padding: 6px 12px;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      margin: 0 5px;
      transition: background-color 0.3s ease;
    }
    .edit-btn {
      background-color: #8c5e3c; /* Modern medium brown */
    }
    .edit-btn:hover {
      background-color: #734b2f;
    }
    .delete-btn {
      background-color: #d33;
    }
    .delete-btn:hover {
      background-color: #a02b1f;
    }
    .add-btn {
      background-color: #9f7e6e; /* Matching color for add button */
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 6px;
      margin-top: 20px;
      display: block;
      width: 200px;
      text-align: center;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    .add-btn:hover {
      background-color: #734b2f;
    }
    .action-buttons {
      display: flex;
      justify-content: center;
    }
    .action-buttons a + a {
      margin-left: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Daftar Mahasiswa</h2>

  <a href="tambah.php" class="add-btn">Tambah Data Mahasiswa</a>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>NPM</th>
          <th>Nama</th>
          <th>Program Studi</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include "koneksi.php";
        $query = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa");
        while ($row = mysqli_fetch_assoc($query)) {
          echo "<tr>
                  <td>{$row['npm']}</td>
                  <td>{$row['nama']}</td>
                  <td>{$row['prodi']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['alamat']}</td>
                  <td class='action-buttons'>
                    <a href='edit.php?npm={$row['npm']}' class='edit-btn'>Edit</a>
                    <a href='hapus.php?npm={$row['npm']}' class='delete-btn' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
