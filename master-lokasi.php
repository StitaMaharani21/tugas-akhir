<?php 
include 'connection.php';
$lokasi = strtoupper(trim($_POST['lokasi']));

if ($_POST['lokasi'] == null) {

    echo "<script>alert('Silakan Isi Form yang Kosong!'); window.location.href='index.php';</script>";
    exit;
}

if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['lokasi'])) {
    echo "<script>alert('Lokasi tidak boleh berisi karakter spesial!'); window.location.href='input.php';</script>";
    exit;
}


$sql_validasi_lokasi = "SELECT lokasi FROM masterlokasi WHERE lokasi = '$lokasi'";
$result_validasi_lokasi = mysqli_query($conn, $sql_validasi_lokasi);
$row_validasi_lokasi = mysqli_fetch_assoc($result_validasi_lokasi);
if ($row_validasi_lokasi != null) {
    echo "<script>alert('Lokasi sudah ada!'); window.location.href='index.php';</script>";
    exit;
}


//insert data ke tabel master lokasi
$sql_lokasi = "INSERT INTO masterlokasi (lokasi) VALUES ('$lokasi')";
$query_lokasi = mysqli_query($conn, $sql_lokasi);

if($query_lokasi){
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan data lokasi!'); window.location.href='index.php';</script>";
}

?>