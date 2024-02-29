<?php 
include 'connection.php';
$kodeBarang = strtoupper(trim($_POST['kodeBarang']));
$namaBarang = strtoupper(trim($_POST['namaBarang']));

if ($_POST['kodeBarang'] == null || $_POST['namaBarang'] == null) {

    echo "<script>alert('Silakan Isi Form yang Kosong!'); window.location.href='index.php';</script>";
    exit;
}

// if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['lokasi'])) {
//     echo "<script>alert('Lokasi tidak boleh berisi karakter spesial!'); window.location.href='input.php';</script>";
//     exit;
// }

$sql_validasi_barang = "SELECT kodeBarang, namaBarang FROM masterbarang WHERE kodeBarang = '$kodeBarang' AND namaBarang = '$namaBarang' ";
$result_validasi_barang = mysqli_query($conn, $sql_validasi_barang);
$row_validasi_barang = mysqli_fetch_assoc($result_validasi_barang);
if ($row_validasi_barang != null) {
    echo "<script>alert('Kode dan nama barang sudah ada!'); window.location.href='index.php';</script>";
    exit;
}

//insert data ke tabel master barang
$sql_barang = "INSERT INTO masterbarang (kodeBarang, namaBarang) VALUES ('$kodeBarang', '$namaBarang')";
$query_barang = mysqli_query($conn, $sql_barang);

if($query_barang){
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal menambahkan data barang!'); window.location.href='index.php';</script>";
}

?>