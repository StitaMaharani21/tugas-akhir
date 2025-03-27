<?php
include 'connection.php';


$lokasi = "";
$kodeBarang = "";
$bukti = "";
$tgl_Input = "";

if (isset($_POST['lokasi']) && isset($_POST['kodeBarang']) && isset($_POST['bukti']) && isset($_POST['tgl_Input'])) {
    $lokasi = $_POST['lokasi'];
    $kodeBarang = $_POST['kodeBarang'];
    $bukti = $_POST['bukti'];
    if ($_POST['tgl_Input'] != null) {
        $convert = DateTime::createFromFormat('d-m-Y', $_POST['tgl_Input']);
        $tgl_Input = $convert->format('Y-m-d');
    }



    $sql = "SELECT * FROM transaksi
                    INNER JOIN tabelstokbarang ON transaksi.Id_Stok = tabelstokbarang.id
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    INNER JOIN masterprogram ON transaksi.Id_Program = masterprogram.Id
                    INNER JOIN masteruser ON transaksi.Id_User = masteruser.Id
                    
                    ";

    if ($bukti && $kodeBarang && $lokasi && $tgl_Input) {
        $sql .= "WHERE lokasi LIKE '%$lokasi%' AND kodeBarang LIKE '%$kodeBarang%' AND bukti LIKE '%$bukti%' AND tgl_Input = '{$tgl_Input}' ";
    } elseif ($bukti == '' && $kodeBarang == '' && $lokasi == '' && $tgl_Input) {
        $sql .= "WHERE tgl_Input = '{$tgl_Input}' ";
    } elseif ($bukti == '' && $kodeBarang == '' && $lokasi && $tgl_Input == '') {
        $sql .= "WHERE lokasi LIKE '%$lokasi%'";
    } elseif ($bukti == '' && $kodeBarang && $lokasi == '' && $tgl_Input == '') {
        $sql .= "WHERE kodeBarang LIKE '%$kodeBarang%'";
    } elseif ($bukti && $kodeBarang == '' && $lokasi == '' && $tgl_Input == '') {
        $sql .= "WHERE bukti LIKE '%$bukti%'";
    } else {
    ?>
        <tr>
            <td colspan='7'>Silakan Lengkapi Form</td>
        </tr>
    <?php
    exit;
    }


    $sql .= "ORDER BY jam_Input,tgl_Input  ASC, bukti DESC";


    $query = mysqli_query($conn, $sql);
    $jumlah_data = mysqli_num_rows($query);
    if($jumlah_data > 0){
        while ($row = mysqli_fetch_assoc($query)) {

            ?>
                <tr>
                    <td scope="row"><?php echo $row['bukti']; ?></td>
                    <td scope="row"><?php echo date('d-m-Y', strtotime($row['tgl_Input'])); ?></td>
                    <td scope="row"><?php echo $row['jam_Input']; ?></td>
                    <td scope="row"><?php echo $row['lokasi']; ?></td>
                    <td scope="row"><?php echo $row['kodeBarang']; ?></td>
                    <td scope="row"><?php echo date('d-m-Y', strtotime($row['tglMasuk'])); ?></td>
                    <td scope="row"><?php echo $row['saldo_transaksi']; ?></td>
                    <td scope="row"><?php echo $row['program']; ?></td>
                    <td scope="row"><?php echo $row['User']; ?></td>
                </tr>
        <?php
            }
    }else{
        ?>
        <tr>
            <td colspan='7'>Tidak Ada Data</td>
        </tr>
    <?php
    }
}
?>