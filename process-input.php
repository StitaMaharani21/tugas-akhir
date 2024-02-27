<?php
include 'connection.php';

$program = $_POST['program'];
$bukti = $_POST['bukti'];
$lokasi = $_POST['lokasi'];
$kodeBarang = $_POST['kodeBarang'];
$namaBarang = $_POST['namaBarang'];
$tgl_Input = $_POST['tgl_Input'];
date_default_timezone_set('Asia/Jakarta');
$jamInput = date('H:i:s');
$saldo_transaksi = $_POST['saldo_transaksi'];
$user = 1;

$sql_validasi = "SELECT tglMasuk FROM tabelstokbarang WHERE Id_lokasi = '$lokasi' AND Id_Barang = '$kodeBarang' ORDER BY tglMasuk DESC LIMIT 1";
$result_validasi = mysqli_query($conn, $sql_validasi);
$row_validasi = mysqli_fetch_assoc($result_validasi);
$tanggal_masuk = $row_validasi['tglMasuk'];

if ($tgl_Input < $tanggal_masuk) {
    echo "<script>alert('Tanggal transaksi tidak boleh lebih kecil dari tanggal masuk terakhir.'); window.location.href='index.php';</script>";
    exit;
}

$var = substr($bukti, 0, 6);
$int = substr($bukti, 6);

if ($var == "TAMBAH") {
    $sql_stokbarang = "INSERT INTO tabelstokbarang (Id_lokasi, Id_Barang, tglMasuk, saldo) VALUES ('$lokasi', '$kodeBarang', '$tgl_Input', '$saldo_transaksi')";
    $query_stokbarang = mysqli_query($conn, $sql_stokbarang);

    if ($query_stokbarang) {
        $insertId = mysqli_insert_id($conn);
        $sql_transaksihistory = "INSERT INTO transaksihistory (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
        $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);

        if ($query_transaksihistory) {
            echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data transaksihistory!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal menambahkan data tabelstokbarang!'); window.location.href='index.php';</script>";
    }
} else if ($var == "KURANG") {

    $sql_stokbarang = "SELECT Id, saldo FROM tabelstokbarang WHERE Id_lokasi = '$lokasi' AND Id_Barang = '$kodeBarang' AND saldo > 0 ORDER BY tglMasuk ASC";
    $query = mysqli_query($conn, $sql_stokbarang);
    // echo "<pre>" . print_r(mysqli_query($conn, $sql_stokbarang)) . "</pre>";
    //untuk mendapatkan list barang

    
    
    while ($row = mysqli_fetch_assoc($query)) {
        $saldo_stok = $row['saldo'];
        $id_stok = $row['Id'];

        // if($saldo_transaksi < $saldo_stok) {
        //     $total_transaksi = $saldo_transaksi;
        // } else {
        //     $total_transaksi = $saldo_stok;
        // }
        
        $total_transaksi = min($saldo_transaksi, $saldo_stok);
        
        $saldo_transaksi -= $total_transaksi;
        $saldo_stok -= $total_transaksi;

        

        $sql_update = "UPDATE tabelstokbarang SET saldo = '$saldo_stok' WHERE Id = '$id_stok'";
        $query_update = mysqli_query($conn, $sql_update);

        if ($query_update) {
            echo "<script>alert('Data berhasil ditambahkan ke tabel transaksi!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data ke tabel transaksi!'); window.location.href='index.php';</script>";
        }

        $sql_transaksihistory = "INSERT INTO transaksihistory (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$id_stok', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '-$total_transaksi')";
        $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);

        if ($query_update) {
            echo "<script>alert('Data berhasil ditambahkan ke tabel transaksi!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data ke tabel transaksi!'); window.location.href='index.php';</script>";
        }

        // if($saldo_stok < $saldo_transaksi){
        //     echo "<script>alert('stok barang kurang!'); window.location.href='index.php';</script>";
        //     exit;
        // }

        if ($saldo_transaksi == 0) {
            break;
        }


    }

    //Buat Transaksi
    // $sisa_transaksi = 0;
    // foreach($stokBarang as $stok){
    //     if($stok['saldo'] <= $saldo_transaksi){
    //         $sisa_transaksi =  $saldo_transaksi - $stok['saldo'];
    //     }elseif($saldo_transaksi < $stok['saldo']){
    //         $sisa_stok = $stok['saldo'] - $saldo_transaksi;
            
    //     }
    //     $sql_transaksihistory = "INSERT INTO transaksihistory (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) 
    //     VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
    //     $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);

    // }





    // $sql_transaksihistory = "INSERT INTO transaksihistory (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
    // $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);


    // if ($query_stokbarang) {
    //     $insertId = mysqli_insert_id($conn);
    //     $sql_transaksihistory = "INSERT INTO transaksihistory (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
    //     $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);

    //     if ($query_transaksihistory) {
    //         echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    //     } else {
    //         echo "<script>alert('Gagal menambahkan data transaksihistory!'); window.location.href='index.php';</script>";
    //     }
    // } else {
    //     echo "<script>alert('Gagal menambahkan data tabelstokbarang!'); window.location.href='index.php';</script>";
    // }
}

mysqli_close($conn);


?>
