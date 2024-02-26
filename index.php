<?php
include 'connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<style>

</style>

<body>
    <!-- <div class="">
        <h1 class="center">Stok Barang</h1>
        <ul>
            <li> <a href="input.php">Maintenance Stok </a></li>
            <li><a href="#">Stock Items </a></li>
        </ul>
    </div> -->

    <h2 class="text-center mt-5">Program Master Karyawan</h2>


    <div class="card mx-auto mt-5 text-bg-secondary">
        <div class="card-body">
            <h5 class="ms-2">Transaction History</h5>
        </div>
    </div>

    <div class="card mx-auto mt-2">
        <div class="card">
            <div class="container">
                <a href="input.php">
                    <button type="button" class="btn btn-primary mb-2 mt-2">Maintenance Stok</button>
                </a>
                <!-- <form action="/search" method="get" class=" form-label search-form">
                    <input type="search" name="" placeholder="Search...">
                    <button type="submit" class="btn btn-primary ms-2">Search</button>
                </form> -->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Bukti</th>
                        <th scope="col">Tanggal Input</th>
                        <th scope="col">Jam Input</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Program</th>
                        <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM transaksihistory
                    INNER JOIN tabelstokbarang ON transaksihistory.Id_Stok = tabelstokbarang.id
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    INNER JOIN masterprogram ON transaksihistory.Id_Program = masterprogram.Id
                    INNER JOIN masteruser ON transaksihistory.Id_User = masteruser.Id
                    ORDER BY kodeBarang, jam_Input,tgl_Input  ASC, bukti DESC
                    ";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        // pisahkan struktur bukti dari yang TAMBAH01 menjadi TAMBAH 01 di variabel yang baru
                        $var = substr($row['bukti'], 0, 6);
                        $int = substr($row['bukti'], 6);

                        if ($var == "TAMBAH") {

                        } else if ($var == "KURANG") {
                            continue;
                        }
                    ?>
                        <tr>
                            <td scope="row"><?php echo $row['bukti']; ?></td>
                            <td scope="row"><?php echo $row['tgl_Input']; ?></td>
                            <td scope="row"><?php echo $row['jam_Input']; ?></td>
                            <td scope="row"><?php echo $row['lokasi']; ?></td>
                            <td scope="row"><?php echo $row['kodeBarang']; ?></td>
                            <td scope="row"><?php echo $row['tglMasuk']; ?></td>
                            <td scope="row"><?php echo $row['saldo_transaksi']; ?></td>
                            <td scope="row"><?php echo $row['program']; ?></td>
                            <td scope="row"><?php echo $row['User']; ?></td>
                        </tr>
                    <?php }
                    ?>

                    <?php
                    $sql = "SELECT * FROM transaksihistory
                    INNER JOIN tabelstokbarang ON transaksihistory.Id_Stok = tabelstokbarang.id
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    INNER JOIN masterprogram ON transaksihistory.Id_Program = masterprogram.Id
                    INNER JOIN masteruser ON transaksihistory.Id_User = masteruser.Id
                    ORDER BY kodeBarang, jam_Input,tgl_Input  ASC, bukti DESC
                    ";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        // pisahkan struktur bukti dari yang TAMBAH01 menjadi TAMBAH 01 di variabel yang baru
                        $var = substr($row['bukti'], 0, 6);
                        $int = substr($row['bukti'], 6);

                        if ($var == "TAMBAH") {
                            continue;
                        } else if ($var == "KURANG") {

                        }
                    ?>
                        <tr>
                            <td scope="row"><?php echo $row['bukti']; ?></td>
                            <td scope="row"><?php echo $row['tgl_Input']; ?></td>
                            <td scope="row"><?php echo $row['jam_Input']; ?></td>
                            <td scope="row"><?php echo $row['lokasi']; ?></td>
                            <td scope="row"><?php echo $row['kodeBarang']; ?></td>
                            <td scope="row"><?php echo $row['tglMasuk']; ?></td>
                            <td scope="row"><?php echo $row['saldo_transaksi']; ?></td>
                            <td scope="row"><?php echo $row['program']; ?></td>
                            <td scope="row"><?php echo $row['User']; ?></td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- untuk display table stok barang -->

    <div class="card mx-auto mt-5 text-bg-secondary">
        <div class="card-body">
            <h5 class="ms-2">Item Stock</h5>
        </div>
    </div>

    <div class="card mx-auto mt-2">
        <div class="card">
            <div class="container">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tabelstokbarang 
                    INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                    INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                    ORDER BY kodeBarang, tglMasuk ASC
                    ";

                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $row['lokasi']; ?></td>
                            <td scope="row"><?php echo $row['kodeBarang']; ?></td>
                            <td scope="row"><?php echo $row['namaBarang']; ?></td>
                            <td scope="row"><?php echo $row['saldo']; ?></td>
                            <td scope="row"><?php echo $row['tglMasuk']; ?></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>