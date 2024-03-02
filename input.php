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
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->


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
            <form id="form-input">
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
                    <input type="" class="form-control date-form" id="txtDate" runat="server" name="tgl_Input" placeholder="dd-mm-yyyy">
                </div>
                <div class="mb-3">
                    <label for="saldo" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="saldo" name="saldo_transaksi" value="<?php echo $saldo ?>">
                </div>
                <div class="col mt-5px">
                    <button type="submit" class="btn btn-primary" id="submit" onclick="return confirm('Posting Data?')">Posting</button>
                    <a href="index.php" class="btn btn-primary">Exit</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- get nama barang -->
    <script type="text/javascript">
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

    <!-- date d-m-y -->
    <script type="text/javascript">
        $(function() {
            $("#txtDate").datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>


    <!-- insert form ajax-->
    <script>
        $(document).ready(function() {
            $('#submit').click(function(e) {
                e.preventDefault();

                var program = $('#program').val();
                var lokasi = $('#lokasi').val();
                var kodeBarang = $('#kodeBarang').val();
                var tgl_Input = $('#txtDate').val();
                var saldo = $('#saldo').val();

                $.ajax({
                    type: 'POST',
                    url: "process-input.php",
                    data: $('#form-input').serialize(),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status === 'error') {
                            alert('Error: ' + response.message);
                        } else {
                            window.location.href = 'index.php';
                            alert('Data berhasil disimpan! Kembali ke halaman utama.');
                        }
                    }
                });
            });
        });
    </script>

</html>