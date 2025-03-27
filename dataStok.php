<?php
include 'connection.php';


$lokasi = "";
$kodeBarang = "";


if (isset($_POST['lokasi']) && isset($_POST['kodeBarang'])) {
    $lokasi = $_POST['lokasi'];
    $kodeBarang = $_POST['kodeBarang'];
    $sql = "SELECT * FROM tabelstokbarang 
                                INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                                INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id 
                                ";

    if ($lokasi && $kodeBarang) {
        $sql .= "WHERE lokasi LIKE '%$lokasi%' AND kodeBarang LIKE '%$kodeBarang%'";
    } elseif ($lokasi && $kodeBarang == '') {
        $sql .= "WHERE lokasi LIKE '%$lokasi%'";
    } elseif ($kodeBarang && $lokasi == '') {
        $sql .= "WHERE kodeBarang LIKE '%$kodeBarang%'";
    } else {
?>
        <tr>
            <td colspan='7'>Silakan Lengkapi Form</td>
        </tr>
    <?php
        exit;
    }

    $sql .= "ORDER BY kodeBarang, tglMasuk ASC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td scope="row"><?php echo $row['lokasi']; ?></td>
            <td scope="row"><?php echo $row['kodeBarang']; ?></td>
            <td scope="row"><?php echo $row['namaBarang']; ?></td>
            <td scope="row"><?php echo $row['saldo']; ?></td>
            <td scope="row"><?php echo $row['tglMasuk']; ?></td>
        </tr>
<?php
    }
}

?>