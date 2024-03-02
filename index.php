<?php
include 'connection.php';

$restore = (isset($_POST['restore'])) ? isset($_POST['restore']) : "no";


if (isset($_POST['restore']) && $_POST['restore'] == "yes") {
    // echo $_POST['restore'];

    $sql_delete = "DELETE FROM transaksi";
    mysqli_query($conn, $sql_delete);

    $sqlRestore = "INSERT INTO transaksi (Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi)
            SELECT Id_Stok, Id_Program, Id_User, tgl_Input, jam_Input, bukti, saldo_transaksi FROM history";
    mysqli_query($conn, $sqlRestore);
}

$sqlTransaksi = "SELECT COUNT(*) as count FROM transaksi";
$resultTransaksi = mysqli_query($conn, $sqlTransaksi);
$rowTransaksi = mysqli_fetch_assoc($resultTransaksi);

$sqlHistory = "SELECT COUNT(*) as count FROM history";
$resultHistory = mysqli_query($conn, $sqlHistory);
$rowHistory = mysqli_fetch_assoc($resultHistory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->


    <link type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
</head>

<style>

</style>

<body>

    <h1 class="text-center mt-5">PROGRAM STOK BARANG</h1>

    <div class="card mx-auto mt-5 text-bg-secondary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="ms-2">Transaksi Histori</h5>
                </div>
                <div class="col">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="input.php">
                            <button class="btn btn-outline-light" type="button">Maintenance Stock</button>
                        </a>
                        <a href="search-transaksi.php">
                            <button class="btn btn-outline-light" type="button">Search Transaction</button>
                        </a>
                        <form action="index.php" method="post">
                            <button class="btn btn-outline-light" type="submit" name="restore" value="yes" <?php
                                                                                                            if ($rowTransaksi['count'] == $rowHistory['count']) {
                                                                                                                echo "disabled";
                                                                                                            }
                                                                                                            ?>>Restore</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- untuk display table transaksi -->
    <div class="card mx-auto mt-2">
        <div class="card">
            <div class="container">
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
                <tbody id="tabel_transaksi">

                </tbody>
            </table>
        </div>
    </div>


    <!-- untuk display table stok barang -->

    <div class="card mx-auto mt-5 text-bg-secondary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="ms-2">Stok Barang</h5>
                </div>
                <div class="col">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="search-stock.php">
                            <button class="btn btn-outline-light" type="button">Search Stock</button>
                        </a>
                    </div>
                </div>
            </div>
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
                <tbody id="tabel_stok">
                </tbody>
            </table>
        </div>
    </div>


    <!-- judul master master -->
    <div class="card mx-auto mt-5 text-bg-secondary">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="ms-2">Master Tabel</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- untuk master lokasi -->
    <div class="card mx-auto mt-2">
        <div class="card-header">
            <h5>Master Lokasi</h5>
            <form id="form-lokasi">
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Masukan Lokasi" id="lokasi" name="lokasi">
                    </div>
                    <div class="col">
                        <button type="submit" id="submit-lokasi" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Lokasi</th>
                    </tr>
                </thead>
                <tbody id="tabel_lokasi">

                </tbody>
            </table>
        </div>
    </div>


    <!-- untuk master barang -->
    <div class="card mx-auto mt-2">
        <div class="card-header">
            <h5>Master Barang</h5>
            <form id="form-barang">
                <div class="row g-3">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Masukan Kode Barang" id="kodeBarang" name="kodeBarang">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Masukan Nama Barang" id="namaBarang" name="namaBarang">
                    </div>
                    <div class="col">
                        <button type="submit" id="submit-barang" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                    </tr>
                </thead>
                <tbody id="tabel_barang">

                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        tabel_transaksi();
        tabel_stok();
        tabel_lokasi();
        tabel_barang();
    });

    function tabel_transaksi() {
        $.ajax({
            url: 'tabelTransaksi.php',
            type: 'GET',
            success: function(data) {
                $('#tabel_transaksi').html(data);
            }
        });
    }

    function tabel_stok() {
        $.ajax({
            url: 'tabelStok.php',
            type: 'GET',
            success: function(data) {
                $('#tabel_stok').html(data);
            }
        });
    }

    function tabel_lokasi() {
        $.ajax({
            url: 'tabelLokasi.php',
            type: 'GET',
            success: function(data) {
                $('#tabel_lokasi').html(data);
            }
        });
    }

    function tabel_barang() {
        $.ajax({
            url: 'tabelBarang.php',
            type: 'GET',
            success: function(data) {
                $('#tabel_barang').html(data);
            }
        });
    }

    $(document).ready(function() {
        $('#submit-lokasi').click(function(e) {
            e.preventDefault();

            var lokasi = $('#lokasi').val();
            $.ajax({
                type: 'POST',
                url: "master-lokasi.php",
                data: $('#form-lokasi').serialize(),
                success: function(response) {
                    response = JSON.parse(response);
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    if (response.status === 'error') {
                        errorItem = response.error;
                        // loop for each error to display on each form input
                        $.each(errorItem, function(i, item) {
                            // console.log(i, item);
                            $('#' + i).addClass('is-invalid');
                            $('#' + i).after('<div class="invalid-feedback">' + item + '</div>');
                        });
                        alert('Error: ' + response.message);
                    } else {
                        alert('Success: ' + response.message);
                        window.location.reload();
                    }
                }
            });
        });
    });


    $(document).ready(function() {
        $('#submit-barang').click(function(e) {
            e.preventDefault();

            var kodeBarang = $('#kodeBarang').val();
            var namaBarang = $('#namaBarang').val();

            $.ajax({
                type: 'POST',
                url: "master-barang.php",
                data: $('#form-barang').serialize(),
                success: function(response) {
                    response = JSON.parse(response);
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    if (response.status === 'error') {
                        errorItem = response.error;
                        // loop for each error to display on each form input
                        $.each(errorItem, function(i, item) {
                            console.log(i, item);
                            $('#' + i).addClass('is-invalid');
                            $('#' + i).after('<div class="invalid-feedback">' + item + '</div>');
                        });
                        alert('Error: ' + response.message);
                    } else {
                        alert('Success: ' + response.message);
                        window.location.reload();
                    }
                }
            });
        });
    });
</script>


</html>