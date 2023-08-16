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

if (isset($_POST['buat'])) {
    $supp = $_POST['supp'];
    $bulan = date($_POST['bulan']);
    $posupp = $_POST['posupp'];
    $rencana_pertama = $_POST['rencana_pertama'];
    $rencana_kedua = $_POST['rencana_kedua'];

    $data = mysqli_query($conn,"SELECT po_supplier.*, material.*, supplier.*
        FROM po_supplier
        JOIN material ON po_supplier.id_material = material.id_material
        JOIN supplier ON po_supplier.id_supp = supplier.id_supp WHERE supplier.nama_supp = '$supp' tgl_po like '$bulan%' and po_supplier.no_po_supp = '$posupp'"
    );
    
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-truck mr-2"></i>Material Request</h1>
                                <br>
                                <br>
                                <form action="exportmaterialreq.php" target="_blank" method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <br>
                                                <label for="nama customer">Nama Supplier</label>
                                                <select class="form-control" id="supp" name="supp">
                                                    <option value="" hidden>- Pilih Supplier -</option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM supplier") or die(mysqli_error($conn));
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <option value="<?php echo $data['id_supp'] ?>"><?php echo $data['nama_supp'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group col-2">
                                                <label for="">Tanggal PO</label>
                                                <input type="date" id="bulan" name="bulan" class="form-control">
                                            </div> -->
                                            <div class="col-2">
                                                <br>
                                                <label for="nama_part">No PO Supplier</label>
                                                <select class="form-control" id="posupp" name="posupp" required>
                                                    <option> - Pilih Supplier Terlebih Dahulu - </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Rencana Pengiriman Pertama</label>
                                                <input type="date" id="rencana_pertama" name="rencana_pertama" class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Rencana Pengiriman Kedua</label>
                                                <input type="date" id="rencana_kedua" name="rencana_kedua" class="form-control">
                                            </div>
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT id_po_supp FROM po_supplier") or die(mysqli_error($conn));
                                            while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                                <input type="text" class="form-control" id="id_po_supp" name="id_po_supp" value="<?php echo $data['id_po_supp']; ?>" hidden>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label></label>
                                                <button name="buat" class="btn btn-md btn-success" disabled><i class="fa fa-file mr-2"></i>Buat Material Request</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                url: 'ambilexportmatreq.php',
                type: "POST",
                data: {
                    supp: supp
                },
                success: function(data) {
                    $("#posupp").html(data);
                },
                error: function() {
                    alert("Gagal Mengambil Data");
                }
            })
        })
    </script>
</body>

</html>