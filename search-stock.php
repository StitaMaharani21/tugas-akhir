<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <link type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
    </script>
</head>

<body>
    <!-- Form to search stock barang -->
    <div class="card mx-auto mt-5">
        <div class="card-header">
            Maintenance Stok
        </div>
        <div class="card-body">
            <form id="form-search">
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
                <div class="col mt-5px">
                    <button type="submit" class="btn btn-primary" id="cari" name="cari">Search</button>
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Displaying search results -->
    <div class="card mx-auto mt-2">
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
                <tbody id="datastok">

                </tbody>
            </table>
        </div>
    </div>

   
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datastok').load("dataStok.php");
        $("#cari").click(function(e) {
            e.preventDefault();
            var lokasi = $('#lokasi').val();
            var kodeBarang = $('#kodeBarang').val();
            $.ajax({
                type: 'POST',
                url: "dataStok.php",
                data: $('#form-search').serialize(),
                success: function(data) {
                    $('#datastok').html(data);
                }
            });
        });
    });
</script>

</html>