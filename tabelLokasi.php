<?php
include 'connection.php';
$sql = "SELECT * FROM masterlokasi";
$query = mysqli_query($conn, $sql);
$i = 1;
while ($row = mysqli_fetch_assoc($query)) {

?>
    <tr>
        <td scope="row"><?php echo $i++ ?></td>
        <td scope="row"><?php echo $row['lokasi']; ?></td>
    </tr>
<?php }
?>