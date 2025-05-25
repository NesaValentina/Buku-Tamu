<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Tamu</h2>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama atau instansi" value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
            <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $cari = isset($_GET['cari']) ? "%{$_GET['cari']}%" : "%";
            $stmt = $conn->prepare("SELECT * FROM buku_tamu WHERE nama LIKE ? OR instansi LIKE ? ORDER BY id DESC");
            $stmt->bind_param("ss", $cari, $cari);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['instansi']) ?></td>
                <td><?= htmlspecialchars($row['tujuan']) ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['waktu'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>