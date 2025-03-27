<?php
include 'connection.php';
$sql = "SELECT * FROM tabelstokbarang 
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    WHERE saldo > 0
                    ORDER BY tglMasuk, tabelstokbarang.Id ASC
                    ";

$query = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td scope="row"><?php echo $row['lokasi']; ?></td>
        <td scope="row"><?php echo $row['kodeBarang']; ?></td>
        <td scope="row"><?php echo $row['namaBarang']; ?></td>
        <td scope="row"><?php echo number_format($row['saldo']) ."<br>"; ?></td>
        <td scope="row"><?php echo date('d-m-Y', strtotime($row['tglMasuk'])); ?></td>
    </tr>
<?php }
?>
