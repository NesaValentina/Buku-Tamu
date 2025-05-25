<?php
include 'koneksi.php';

$nama     = $_POST['nama'];
$instansi = $_POST['instansi'];
$tujuan   = $_POST['tujuan'];
$tanggal  = date("Y-m-d");
$waktu    = date("H:i:s");

$stmt = $conn->prepare("INSERT INTO buku_tamu (nama, instansi, tujuan, tanggal, waktu) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nama, $instansi, $tujuan, $tanggal, $waktu);

if ($stmt->execute()) {
    echo "<script>alert('Data berhasil disimpan!');window.location='daftar.php';</script>";
} else {
    echo "Gagal menyimpan data: " . $conn->error;
}
$stmt->close();
$conn->close();
?>