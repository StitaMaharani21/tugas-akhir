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

<body>
    <div class="card mx-auto mt-5">
        <div class="card-header">
            Maintenance Stok
        </div>
        <div class="card-body">
            <form action="process-input.php" method="POST">
                <div class="mb-3">
                    <label for="program" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" aria-label="Default select example" id="program" name="program">
                        <option value="">Pilih Jenis Transaksi</option>
                        <?php
                        $sqlprog = "SELECT * FROM masterprogram";
                        $qprog = mysqli_query($conn, $sqlprog);
                        while ($rowprog = mysqli_fetch_assoc($qprog)) {
                        ?>
                            <option value="<?php echo $rowprog['Id']; ?>"><?php echo $rowprog['program']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bukti" class="form-label">Bukti</label>
                    <input type="text" class="form-control" id="bukti" name="bukti" readonly value="">

                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-select" aria-label="Default select example" id="lokasi" name="lokasi">
                        <option value="">Pilih Lokasi</option>
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
                        <option value="">Pilih Kode Barang</option>
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
                    <label for="" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="namaBarang" name="namaBarang" readonly value="">
                </div>
                <div class="mb-3">
                    <label for="tanggalInput" class="form-label">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggalInput" name="tgl_Input" value="<?php echo date('Y-m-d') ?>">
                </div>
                <div class="mb-3">
                    <label for="saldo" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="saldo" name="saldo_transaksi" value="<?php echo $saldo ?>">
                </div>
                <div class="col mt-5px">
                    <button type="submit" class="btn btn-primary">Posting</button>
                    <a href="index.php" class="btn btn-primary">Exit</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
    document.getElementById('program').addEventListener('change', function() {
        var program = document.getElementById('program').value;
        var bukti = document.getElementById('bukti');
        if (program == 1) {
            bukti.value = <?php
                            $sql = "SELECT * FROM transaksihistory WHERE bukti LIKE 'TAMBAH%' ORDER BY bukti DESC";
                            $q = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($q) == 0) {
                                echo '"TAMBAH01"';
                            } else {
                                $row = mysqli_fetch_assoc($q);
                                $jumlah = substr($row['bukti'], 6);
                                // jika kurang lebih dari 9 maka bukti akan diisi dengan KURANG
                                if ($jumlah > 8) {
                                    echo '"TAMBAH' . ($jumlah + 1) . '"';
                                } else {
                                    echo '"TAMBAH0' . ($jumlah + 1) . '"';
                                }
                            }
                            ?>;
        } else {
            bukti.value = <?php
                            // hanya mencari yang ada kata kurang
                            $sql = "SELECT * FROM transaksihistory WHERE bukti LIKE 'KURANG%' ORDER BY bukti DESC";
                            // hitung berapa jumlah bukti yang berisi awalan KURANG
                            $q = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($q) == 0) {
                                echo '"KURANG01"';
                            } else {
                                $row = mysqli_fetch_assoc($q);
                                $jumlah = substr($row['bukti'], 6);
                                // jika kurang lebih dari 9 maka bukti akan diisi dengan KURANG
                                if ($jumlah > 8) {
                                    echo '"KURANG' . ($jumlah + 1) . '"';
                                } else {
                                    echo '"KURANG0' . ($jumlah + 1) . '"';
                                }
                            }

                            ?>;
        }
    });

    document.getElementById('kodeBarang').addEventListener('change', function() {
        var kodeBarang = document.getElementById('kodeBarang').value;
        var namaBarang = document.getElementById('namaBarang');
        <?php
        $sql = "SELECT * FROM masterbarang";
        $q = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($q)) {
        ?>
            if (kodeBarang == <?php echo $row['Id']; ?>) {
                namaBarang.value = "<?php echo $row['namaBarang']; ?>";
            }
        <?php } ?>
    });
</script>

</html>