<?php
include 'connection.php';
$program = $_POST['program'];
$bukti = $_POST['bukti'];
$lokasi = $_POST['lokasi'];
$kodeBarang = $_POST['kodeBarang'];
$namaBarang = $_POST['namaBarang'];
$convert = DateTime::createFromFormat('d-m-Y', $_POST['tgl_Input']);
$tgl_Input = $convert->format('Y-m-d');
$saldo_transaksi = $_POST['saldo_transaksi'];


if ($_POST['program'] == null || $_POST['bukti'] == null || $_POST['lokasi'] == null || $_POST['kodeBarang'] == null || $_POST['namaBarang'] == null || $_POST['tgl_Input'] == null || $_POST['saldo_transaksi'] == null) {

    echo "<script>alert('Silakan Isi Form yang Kosong!'); window.location.href='input.php';</script>";
    exit;
}

if (!preg_match('/^[0-9]+$/', $_POST['saldo_transaksi'])) {
    echo "<script>alert('Saldo Transaksi tidak boleh berisi karakter spesial!'); window.location.href='input.php';</script>";
    exit;
}

date_default_timezone_set('Asia/Jakarta');
$jamInput = date('H:i:s');
$user = 1;

$sql_validasi_bukti = "SELECT bukti FROM transaksi WHERE bukti = '$bukti'";
$result_validasi_bukti = mysqli_query($conn, $sql_validasi_bukti);
$row_validasi_bukti = mysqli_fetch_assoc($result_validasi_bukti);
if ($row_validasi_bukti != null) {
    echo "<script>alert('Bukti sudah ada!'); window.location.href='index.php';</script>";
    exit;
}

$sql_validasi = "SELECT tglMasuk FROM tabelstokbarang WHERE Id_lokasi = '$lokasi' AND Id_Barang = '$kodeBarang' ORDER BY tglMasuk DESC LIMIT 1";
$result_validasi = mysqli_query($conn, $sql_validasi);
$row_validasi = mysqli_fetch_assoc($result_validasi);
if ($row_validasi != null) {
    $tanggal_masuk = $row_validasi['tglMasuk'];
    // $tgl_Input = date('Y-m-d', strtotime($tgl_Input));
    if ($tgl_Input < $tanggal_masuk) {
        echo "<script>alert('Tanggal transaksi tidak boleh lebih kecil dari tanggal masuk terakhir.{$tgl_Input}'); window.location.href='index.php';</script>";
        exit;
    }
}

$var = substr($bukti, 0, 6);
$int = substr($bukti, 6);

if ($var == "TAMBAH") {
    $sql_stokbarang = "SELECT * FROM tabelstokbarang WHERE Id_lokasi = '$lokasi' AND Id_Barang = '$kodeBarang' AND tglMasuk = '$tgl_Input' ORDER BY tglMasuk ASC";
    $query_stokbarang = mysqli_query($conn, $sql_stokbarang);

    if (mysqli_num_rows($query_stokbarang) == 0) {
        $sql_stokbarang = "INSERT INTO tabelstokbarang (Id_lokasi, Id_Barang, tglMasuk, saldo) VALUES ('$lokasi', '$kodeBarang', '$tgl_Input', '$saldo_transaksi')";
        $query_stokbarang = mysqli_query($conn, $sql_stokbarang);

        if ($query_stokbarang) {
            $lastId = mysqli_insert_id($conn);
        } else {
            echo "<script>alert('Gagal menambahkan data tabelstokbarang!'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        $row_stokbarang = mysqli_fetch_assoc($query_stokbarang);
        $sql_stokbarang = "UPDATE tabelstokbarang SET saldo = saldo + $saldo_transaksi WHERE Id = " . $row_stokbarang['Id'];
        $query_stokbarang = mysqli_query($conn, $sql_stokbarang);

        if ($query_stokbarang) {
            $lastId = $row_stokbarang['Id'];
        } else {
            echo "<script>alert('Gagal menambahkan data tabelstokbarang!'); window.location.href='index.php';</script>";
            exit;
        }
    }

    // if ($query_stokbarang && $query_update) {
    //     $lastId = $query_stokbarang['Id'];
    // } elseif ($query_stokbarang) {
    //     $lastId = mysqli_insert_id($conn);
    // }

    // if ($query_stokbarang && $query_update) {
    //     $lastId = $query_stokbarang['Id'];
    // } elseif ($query_stokbarang) {
    //     $lastId = mysqli_insert_id($conn);
    // }

    //langsung insert ke transaksi history
    $sql_transaksihistory = "INSERT INTO transaksi (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$lastId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
    $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);

    //backup data untuk transakasi
    $sql_history = "INSERT INTO history (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$lastId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '$saldo_transaksi')";
    $query_history = mysqli_query($conn, $sql_history);

    if ($query_transaksihistory && $query_history) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data transaksihistory!'); window.location.href='index.php';</script>";
    }
} else if ($var == "KURANG") {
    $sql_stokbarang = "SELECT * FROM tabelstokbarang WHERE saldo > 0 AND Id_lokasi = '$lokasi' AND Id_Barang = '$kodeBarang' ORDER BY tglMasuk ASC";
    $query_stokbarang = mysqli_query($conn, $sql_stokbarang);
    //menghitung stok saat ini dari tabelstokbarang berdasarkan array
    $stokbarang = array();
    $total_stokbarang = 0;
    while ($row = mysqli_fetch_assoc($query_stokbarang)) {
        $stokbarang[] = $row;
        $total_stokbarang += $row['saldo'];
        //beurutan array nya sesuai tgl masuk
        //misanya list barangnya apa
        //{saldo ; 10}
        //{saldo}
    }
    $i = 0;
    //saldo 100
    //saldo 50
    if ($saldo_transaksi > $total_stokbarang) {
        echo "<script>alert('Stok Barang Tidak Cukup!'); window.location.href='index.php';</script>";
        mysqli_rollback($conn);
        exit;
    }

    while ($saldo_transaksi > 0) {
        if ($stokbarang[$i]['saldo'] >= $saldo_transaksi) {
            //mengurangi stok barang berdasarkan index
            //mengurangi stok barang berdasarkan index
            //untuk mengetahui id yang mana
            $sql_stokbarang = "UPDATE tabelstokbarang SET saldo = saldo - $saldo_transaksi WHERE Id = " . $stokbarang[$i]['Id'];
            $query_stokbarang = mysqli_query($conn, $sql_stokbarang);
            $insertId = $stokbarang[$i]['Id'];
            //insert data ke transaksi
            $sql_transaksihistory = "INSERT INTO transaksi (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '-$saldo_transaksi')";
            $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);
            //insert ke history(backup table)
            $sql_history = "INSERT INTO history (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '-$saldo_transaksi')";
            $query_history = mysqli_query($conn, $sql_history);
            $saldo_transaksi = 0;
        } else {
            //$saldo = saldo transakasi
            $saldo_transaksi -= $stokbarang[$i]['saldo'];
            $sql_stokbarang = "UPDATE tabelstokbarang SET saldo = 0 WHERE Id = " . $stokbarang[$i]['Id'];
            $query_stokbarang = mysqli_query($conn, $sql_stokbarang);
            $insertId = $stokbarang[$i]['Id'];
            //insert data ke transaksi tabel
            $sql_transaksihistory = "INSERT INTO transaksi (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '-{$stokbarang[$i]['saldo']}')";
            $query_transaksihistory = mysqli_query($conn, $sql_transaksihistory);
            //insert ke history(backup table)
            $sql_history = "INSERT INTO history (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi) VALUES ('$insertId', '$program', '$user', '$tgl_Input', '$jamInput', '$bukti', '-{$stokbarang[$i]['saldo']}')";
            $query_history = mysqli_query($conn, $sql_history);
            $i++;
        }
    }

    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
}

mysqli_close($conn);
