<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Form Buku Tamu Digital</h2>
    <div class="card p-4 shadow-sm">
        <form action="simpan.php" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="instansi" class="form-label">Instansi</label>
                <input type="text" name="instansi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan Kedatangan</label>
                <textarea name="tujuan" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <a href="daftar.php" class="btn btn-secondary mt-3">Lihat Daftar Tamu</a>
    </div>
</div>
</body>
</html>