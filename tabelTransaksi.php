<?php
include 'connection.php';
$sql = "SELECT * FROM transaksi
                    INNER JOIN tabelstokbarang ON transaksi.Id_Stok = tabelstokbarang.id
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    INNER JOIN masterprogram ON transaksi.Id_Program = masterprogram.Id
                    INNER JOIN masteruser ON transaksi.Id_User = masteruser.Id
                    ORDER BY jam_Input,tgl_Input  ASC, bukti DESC
                    ";
$query = mysqli_query($conn, $sql);
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
<?php }
?>