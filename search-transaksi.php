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

    <link type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
</head>

<body>
    <div class="card mx-auto mt-5">
        <div class="card-header">
            Maintenance Stok
        </div>
        <div class="card-body">
            <form id="form-search">
                <div class="mb-3">
                    <label for="bukti" class="form-label">Bukti</label>
                    <select class="form-select" aria-label="Default select example" id="bukti" name="bukti">
                        <option value="" selected>Select Bukti</option>
                        <?php
                        $sqlbukti = "SELECT * FROM transaksi
                        INNER JOIN tabelstokbarang ON transaksi.Id_Stok = tabelstokbarang.id
                        INNER JOIN masterlokasi ON tabelstokbarang.Id_lokasi = masterlokasi.Id
                        INNER JOIN masterbarang ON tabelstokbarang.Id_Barang = masterbarang.Id
                        INNER JOIN masterprogram ON transaksi.Id_Program = masterprogram.Id
                        INNER JOIN masteruser ON transaksi.Id_User = masteruser.Id";
                        $qbukti = mysqli_query($conn, $sqlbukti);
                        while ($rowbukti = mysqli_fetch_assoc($qbukti)) {
                        ?>
                            <option value="<?php echo $rowbukti['bukti']; ?>"><?php echo $rowbukti['bukti']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-select" aria-label="Default select example" id="lokasi" name="lokasi">
                        <option value="" selected>Select Location</option>
                        <?php
                        $sqlloc = "SELECT * FROM masterlokasi";
                        $qloc = mysqli_query($conn, $sqlloc);
                        while ($rowloc = mysqli_fetch_assoc($qloc)) {
                        ?>
                            <option value="<?php echo $rowloc['lokasi']; ?>"><?php echo $rowloc['lokasi']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kodeBarang" class="form-label">Kode Barang</label>
                    <select class="form-select" aria-label="Default select example" id="kodeBarang" name="kodeBarang">
                        <option value="" selected>Select Kode Barang</option>
                        <?php
                        $sqlItem = "SELECT * FROM masterbarang";
                        $qItem = mysqli_query($conn, $sqlItem);
                        while ($rowItem = mysqli_fetch_assoc($qItem)) {
                        ?>
                            <option value="<?php echo $rowItem['kodeBarang']; ?>"><?php echo $rowItem['kodeBarang']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggalInput" class="form-label">Tanggal Transaksi</label>
                    <input type="" class="form-control date-form" id="tgl_Input" runat="server" name="tgl_Input">
                </div>
                <div class="col mt-5px">
                    <button type="submit" class="btn btn-primary" id="cari" name="cari">Search</button>
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
                <tbody id="data_Transaksi">



                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(function() {
        $("#tgl_Input").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#data_Transaksi').load("dataTransaksi.php");
        $("#cari").click(function(e) {
            e.preventDefault();
            var bukti = $('#bukti').val();
            var lokasi = $('#lokasi').val();
            var kodeBarang = $('#kodeBarang').val();
            var tgl_Input = $('#tgl_Input').val();
            $.ajax({
                type: 'POST',
                url: "dataTransaksi.php",
                data: $('#form-search').serialize(),
                success: function(data) {
                    $('#data_Transaksi').html(data);
                }
            });
        });
    });
</script>

</html>