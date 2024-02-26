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
    <!-- untuk mencari stock barang  -->
<div class="card mx-auto mt-5">
        <div class="card-header">
            Maintenance Stok
        </div>
        <div class="card-body">
            <form action="" method="POST">
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
                <div class="col mt-5px">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- menampilkan hasil searching stock barang -->

    <div class="card mx-auto mt-2">
        <div class="card">
            <div class="container">
                <!-- <a href="search-stock.php">
                    <button type="button" class="btn btn-primary mb-2 mt-2">Search Data</button>
                </a> -->
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