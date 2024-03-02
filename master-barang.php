<?php
include 'connection.php';
$kodeBarang = strtoupper(trim($_POST['kodeBarang']));
$namaBarang = strtoupper(trim($_POST['namaBarang']));

if ($_POST['kodeBarang'] == null || $_POST['namaBarang'] == null) {
    $response = ['status' => 'error', 'message' => 'Kode Barang atau Nama Barang Tidak Boleh Kosong!'];
    echo json_encode($response);
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
    $response = ['status' => 'error', 'message' => 'Kode Barang dan Nama Barang Sudah Ada!'];
    echo json_encode($response);
    exit;
}

//insert data ke tabel master barang
$sql_barang = "INSERT INTO masterbarang (kodeBarang, namaBarang) VALUES ('$kodeBarang', '$namaBarang')";
$query_barang = mysqli_query($conn, $sql_barang);

if ($query_barang) {
    $response = ['status' => 'success', 'message' => 'Data berhasil ditambahkan!'];
    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'message' => 'Gagal menambahkan data barang!'];
    echo json_encode($response);
}
