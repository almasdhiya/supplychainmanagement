<meta http-equiv="refresh" content="1800; url=login.php">
<script src="jquery-3.3.1.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
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

if (isset($_POST['tambah'])) {
    $posupp = $_POST['posupp'];
    $id_material = $_POST['id_material'];
    $id_supp = $_POST['id_supp'];
    $surjal = $_POST['surjal'];
    $status1 = 'Belum Digunakan';
    $qty_dikirim = $_POST['qty_dikirim'];
    $query = mysqli_query($conn, "SELECT qty_order_supp FROM po_supplier where id_po_supp='$posupp'");
    while ($row = mysqli_fetch_array($query)) {
        $qty_order_supp = $row['qty_order_supp'];
        if ($qty_dikirim > $qty_order_supp) {
            echo '<script>
        swal.fire({
          text: "JUMLAH YANG ANDA INPUTKAN LEBIH DARI JUMLAH ORDER",
          icon: "warning",
          button: "Close!",
        });
    </script>';
        } else {
            $select = mysqli_query($conn, "SELECT satuan from po_supplier where id_po_supp ='$posupp'");
            while ($row = mysqli_fetch_array($select)) {
                $satuan = $row['satuan'];
                if ($satuan == 'Lembar') {
                    $query1 = mysqli_query($conn, "INSERT INTO material_recipt (id_mtl,id_material,id_supp,id_po_supp,surjal,qty_dikirim,status1) VALUES ('','$id_material','$id_supp','$posupp','$surjal','$qty_dikirim','$status1')");
                    $ya = mysqli_query($conn, "UPDATE po_supplier set sisa_pengiriman = sisa_pengiriman - '$qty_dikirim' where id_po_supp ='$posupp'");
                    $update = mysqli_query($conn, "UPDATE po_supplier set statusss = 'Selesai' WHERE sisa_pengiriman = '0' and id_po_supp ='$posupp'");
                    echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Warehose RM Lembar!",
                icon: "success",
                button: "Close!",
                });
                </script>';
                } else if ($satuan == 'Pieces') {
                    $query1 = mysqli_query($conn, "INSERT INTO pieces (id_pieces,id_material,id_supp,id_po_supp,surjal,qty_pieces) VALUES ('','$id_material','$id_supp','$posupp','$surjal','$qty_dikirim')");
                    $ya = mysqli_query($conn, "UPDATE po_supplier set sisa_pengiriman = sisa_pengiriman - '$qty_dikirim' where id_po_supp ='$posupp'");
                    $update = mysqli_query($conn, "UPDATE po_supplier set statusss = 'Selesai' WHERE sisa_pengiriman = '0' and id_po_supp ='$posupp'");
                    echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Warehose RM Pieces!",
                icon: "success",
                button: "Close!",
                });
                </script>';
                } else if ($satuan == 'Coil') {
                    $query1 = mysqli_query($conn, "INSERT INTO coil (id_coil,id_material,id_supp,id_po_supp,surjal,qty_coil) VALUES ('','$id_material','$id_supp','$posupp','$surjal','$qty_dikirim')");
                    $ya = mysqli_query($conn, "UPDATE po_supplier set sisa_pengiriman = sisa_pengiriman - '$qty_dikirim' where id_po_supp ='$posupp'");
                    $update = mysqli_query($conn, "UPDATE po_supplier set statusss = 'Selesai' WHERE sisa_pengiriman = '0' and id_po_supp ='$posupp'");
                    echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Warehose RM Coil!",
                icon: "success",
                button: "Close!",
                });
                </script>';
                } else if ($satuan == 'Tube') {
                    $query1 = mysqli_query($conn, "INSERT INTO tube (id_tube,id_material, id_supp,id_po_supp,surjal,qty_tube) VALUES ('','$id_material','$id_supp','$posupp','$surjal','$qty_dikirim')");
                    $ya = mysqli_query($conn, "UPDATE po_supplier set sisa_pengiriman = sisa_pengiriman - '$qty_dikirim' where id_po_supp ='$posupp'");
                    $update = mysqli_query($conn, "UPDATE po_supplier set statusss = 'Selesai' WHERE sisa_pengiriman = '0' and id_po_supp ='$posupp'");
                    echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Warehose RM Tube!",
                icon: "success",
                button: "Close!",
                });
                </script>';
                }
            }
        }
    }
}
// if (isset($_GET['tambah'])) {
//     $query = mysqli_query(
//         $conn,
//         "INSERT INTO `material_recipt`(`id_mtl`, `id_supp`, `id_po_supp`, `surjal`) VALUES ('','2','46','100')"
//         // "select * from customer"
//     );
//     if ($query) {
//         echo "berhasil";
//     } else {

//         return $query;
//     }
// }
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-truck-loading mr-2"></i>Material Recipt</h1>
                                <br>
                                <br>
                                <form method="post">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="nama customer">Nama Supplier</label>
                                                <select class="form-control" id="supp" name="supp">
                                                    <option value="" hidden>- Pilih Supplier -</option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT distinct * FROM supplier ORDER BY nama_supp ASC") or die(mysqli_error($conn));
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <option value="<?php echo $data['id_supp'] ?>"><?php echo $data['nama_supp'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label for="nama_part">No PO Supplier</label>
                                                <select class="form-control" id="posupp" name="posupp" required>
                                                    <option value=""> - Pilih Supplier Terlebih Dahulu - </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="matrecipt">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form=group">

                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label></label>
                                                <button type="tambah" name="tambah" class="btn btn-md btn-success">Simpan</button>
                                            </div>
                                        </div>
                                    </div> -->
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
                url: 'ambildatamatrecipt.php',
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

        $('#posupp').on('change', function() {
            var posupp = $('#posupp').val();
            $.ajax({
                url: 'ambildatamatrecipt.php',
                type: "POST",
                data: {
                    posupp: posupp
                },
                success: function(data) {
                    $("#matrecipt").html(data);
                },
                error: function() {
                    alert("Gagal Mengambil Data");
                }
            })
        })
    </script>

</body>

</html>