<?php 
include 'connection.php';
$lokasi = strtoupper(trim($_POST['lokasi']));

if ($_POST['lokasi'] == null) {

    $response = ['status' => 'error', 'message' => 'Silakan Isi Form yang Kosong!'];
    echo json_encode($response);
    exit;
}

if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['lokasi'])) {
    $response = ['status' => 'error', 'message' => 'Lokasi tidak boleh berisi karakter spesial!'];
    echo json_encode($response);
    exit;
}


$sql_validasi_lokasi = "SELECT lokasi FROM masterlokasi WHERE lokasi = '$lokasi'";
$result_validasi_lokasi = mysqli_query($conn, $sql_validasi_lokasi);
$row_validasi_lokasi = mysqli_fetch_assoc($result_validasi_lokasi);
if ($row_validasi_lokasi != null) {
    $response = ['status' => 'error', 'message' => 'Lokasi Sudah Ada!'];
    echo json_encode($response);
    exit;
}


//insert data ke tabel master lokasi
$sql_lokasi = "INSERT INTO masterlokasi (lokasi) VALUES ('$lokasi')";
$query_lokasi = mysqli_query($conn, $sql_lokasi);

if($query_lokasi){
    $response = ['status' => 'success', 'message' => 'Data berhasil ditambahkan!'];
    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'message' => 'Gagal menambahkan data lokasi!'];
    echo json_encode($response);
}

?>