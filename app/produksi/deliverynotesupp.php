<meta http-equiv="refresh" content="1800; url=login.php">
<?php 
  session_start();
if($_SESSION['role']==""){
  header("location:index.php?pesan=gagal");
}
  ?>
<?php
include('header.php');
include('sidebar.php');
include('../koneksi.php');

if (isset($_POST['cetak'])) {
    $supp = $_POST['supp'];
    $surjal = $_POST['surjal'];

    $data = mysqli_query(
        $conn,
        "SELECT supplier.id_supp, material_recipt.surjal, po_supplier.*, pieces.*
        FROM material_recipt INNER JOIN po_supplier on po_supplier.id_po_supp = material_recipt.id_po_supp 
        INNER JOIN supplier on supplier.id_supp = po_supplier.id_supp 
        inner join pieces on pieces.surjal = material_recipt.surjal WHERE supplier.id_supp = '$supp' 
        and po_supplier.no_po_supp = '$surjal'"
    )  or die(mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            </section>
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col card-header">
                                <h1 class="card-title font-weight-bold"><i class="fas fa-truck mr-2"></i>Laporan Surat Jalan Supplier</h1>
                                <br>
                                <br>
                                <div class="card-body">
                                <form action="exportdelivnotesupp.php" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="nama supplier">Nama Supplier</label>
                                                <select class="form-control" id="supp" name="supp">
                                                    <option value="" hidden>- Pilih Supplier -</option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supp ASC") or die(mysqli_error($conn));
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <option value="<?php echo $data['id_supp'] ?>"><?php echo $data['nama_supp'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="nama_part">No Surat Jalan</label>
                                                <select class="form-control" id="surjal" name="surjal" required>
                                                    <option> - Pilih Supplier Terlebih Dahulu - </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <button type="cetak" name="cetak" class="btn btn-md btn-success">Cetak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php include('footer.php') ?>
    <script>
        $('#supp').on('change', function() {
            var supp = $(this).val();
            $.ajax({
                url: 'ambilexportdelivnotesupp.php',
                type: "POST",
                data: {
                    supp: supp
                },
                success: function(data) {
                    $("#surjal").html(data);
                },
                error: function() {
                    alert("Gagal Mengambil Data");
                }
            })
        })
    </script>
</body>

</html>