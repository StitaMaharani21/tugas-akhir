<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>searching data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card mx-auto mt-5">
        <div class="card-header">
            Maintenance Stok
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="bukti" class="form-label">Bukti</label>
                    <select class="form-select" aria-label="Default select example" id="bukti" name="bukti">
                        <?php
                        $sqlbukti = "SELECT * FROM transaksihistory
                        INNER JOIN tabelstokbarang ON transaksihistory.Id_Stok = tabelstokbarang.id
                        INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                        INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                        INNER JOIN masterprogram ON transaksihistory.Id_Program = masterprogram.Id
                        INNER JOIN masteruser ON transaksihistory.Id_User = masteruser.Id";
                        $qbukti = mysqli_query($conn, $sqlbukti);
                        while ($rowbukti = mysqli_fetch_assoc($qbukti)) {
                        ?>
                            <option value="<?php echo $rowbukti['Id']; ?>"><?php echo $rowbukti['bukti']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-select" aria-label="Default select example" id="lokasi" name="lokasi">
                        <?php
                        $sqlloc = "SELECT * FROM masterlokasi";
                        $qloc = mysqli_query($conn, $sqlloc);
                        while ($rowloc = mysqli_fetch_assoc($qloc)) {
                        ?>
                            <option value="<?php echo $rowloc['Id']; ?>"><?php echo $rowloc['lokasi']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kodeBarang" class="form-label">Kode Barang</label>
                    <select class="form-select" aria-label="Default select example" id="kodeBarang" name="kodeBarang">
                        <?php
                        $sqlItem = "SELECT * FROM masterbarang";
                        $qItem = mysqli_query($conn, $sqlItem);
                        while ($rowItem = mysqli_fetch_assoc($qItem)) {
                        ?>
                            <option value="<?php echo $rowItem['Id']; ?>"><?php echo $rowItem['kodeBarang']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggalInput" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggalInput" name="tgl_Input" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="col mt-5px">
                    <button type="" class="btn btn-primary">Search</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </div>
            </form>
        </div>
    </div>


<!-- menampilkan data transaksi history -->
    <div class="card mx-auto mt-2">
        <div class="card">
            <div class="container">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>