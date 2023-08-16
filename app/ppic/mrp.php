<script src="jquery-3.3.1.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<meta http-equiv="refresh" content="1800; url=login.php">
<?php
session_start();
if ($_SESSION['role'] == "") {
    header("location:../logout.php");
}
?>
<?php
include('header.php');
include('sidebar.php');
include('../koneksi.php');
// if(isset($_POST['cetak'])){
//     $rencana_pertama = date($_POST['rencana_pertama']);
//     // $qty_rencana1 = date($_POST['qty_rencana1']);
//     $rencana_kedua = date($_POST['rencana_kedua']);
//     // $qty_rencana2 = date($_POST['qty_rencana2']);
//     $forecast1 = date($_POST['forecast1']);
//     // $qty_forecast1 = date($_POST['qty_forecast1']);
//     $forecast2 = date($_POST['forecast2']);
//     // $qty_forecast2 = date($_POST['qty_forecast2']);
//     $forecast3 = date($_POST['forecast3']);
//     $cust = date($_POST['nama_cust']);
//     $bulan = date($_POST['bulan']);
//     // $qty_forecast3 = date($_POST['qty_forecast3']);

//     $query = mysqli_query($conn, "UPDATE po_customer SET rencana_pertama='$rencana_pertama',
//     rencana_kedua='$rencana_kedua',
//     forecast1='$forecast1',forecast2='$forecast2',
//     forecast3='$forecast3'");
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-tools mr-2"></i>Material Requirement Planning</h1>
                                <br>
                                <br>
                                <div class="form-group text-right">
                                    <form method="post">
                                        <div class="row">
                                            <!-- <div class="col-3">
                                                <br>
                                                <label for="nama customer">Nama Customer</label>
                                                <select class="form-control" name="nickname">
                                                    <option value="" hidden>- Pilih Customer -</option>
                                                    <?php
                                                    $sql = mysqli_query($conn, "SELECT * FROM customer ORDER BY nickname ASC") or die(mysqli_error($conn));
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                    ?>
                                                        <option value="<?php echo $data['nickname'] ?>"><?php echo $data['nickname'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <br>
                                                <label for="">Pilih Periode Bulan</label>
                                                <input type="month" id="bulan" name="bulan" class="form-control">
                                            </div>
                                            <div class="col-md-1">
                                                <br>
                                                <br>
                                                <label></label>
                                                <button type="submit" name="tampil" class="btn btn-md btn-primary">Tampilkan</button>
                                            </div> -->
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="table-responsive">
                                <div class="card-body">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit">CETAK MRP</button>
                                    <br>
                                    <br>
                                    <table id="example3" class="table table-bordered table-striped" id="">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="text-align:center; width:1%;">No</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">PO Bulan</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">CUST</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">Nama Produk</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">Kode Produk</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">SPEC</th>
                                                <th rowspan="2" scope="col" style="text-align:center;">T (mm)</th>
                                                <th rowspan="2" scope="col" style="text-align:center;">W (mm) </th>
                                                <th rowspan="2" scope="col" style="text-align:center;">L (mm)</th>
                                                <th rowspan="2" scope="col" style="text-align:center;">Unit</th>
                                                <th rowspan="2" scope="col" style="text-align:center; width:1%;">BJ</th>
                                                <th rowspan="2" scope="col" style="text-align:center;">QTY PO </th>
                                                <th colspan="4" scope="col" style="text-align:center;">QTY ORDER</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="text-align:center;">Pieces</th>
                                                <!-- <th scope="col" style="text-align:center;">KG</th> -->
                                                <th scope="col" style="text-align:center;">Sheet</th>
                                                <th scope="col" style="text-align:center;">Lembar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('../koneksi.php');
                                            $no = 1;
                                            // if (isset($_POST['tampil'])) {
                                            //     $cust = $_POST['nickname'];
                                            //     $bln = date($_POST['bulan']);

                                            //     $data = mysqli_query(
                                            //         $conn,
                                            //         "SELECT po_customer.*, customer.nickname, part.id_part, part.nama_part, part.kode_part, part.spek_material, part.berat_jenis, part.panjang, part.lebar, part.ketebalan, part.pcs_lembar, part.pcs_sheet, part.kg_sheet, part.kg_pcs, part.sheet_lembar, part.unit_material, part.kg_lembar
                                            //         FROM po_customer
                                            //         JOIN part ON po_customer.id_part = part.id_part
                                            //         JOIN customer ON po_customer.id_cust = customer.id_cust WHERE customer.nickname = '$cust' and tanggal_po like '$bln%' and statuss ='Sedang Diproses'"
                                            //     );
                                            // } 
                                            if (isset($_POST['cetak'])) {
                                                $nick = $_POST['nama_cust'];
                                                $bln = date($_POST['bulan']);
                                                $rencana_pertama = date($_POST['rencana_pertama']);
                                                // $qty_rencana1 = date($_POST['qty_rencana1']);
                                                $rencana_kedua = date($_POST['rencana_kedua']);
                                                // $qty_rencana2 = date($_POST['qty_rencana2']);
                                                $forecast1 = date($_POST['forecast1']);
                                                // $qty_forecast1 = date($_POST['qty_forecast1']);
                                                $forecast2 = date($_POST['forecast2']);
                                                // $qty_forecast2 = date($_POST['qty_forecast2']);
                                                $forecast3 = date($_POST['forecast3']);
                                                // $qty_forecast3 = date($_POST['qty_forecast3']);
                                            } else {
                                                // SELECT SUM(qty_fg) AS value_sum, fg.id_fg, fg.qty_fg, po_customer.id_po, customer.nama_cust, part.nama_part, part.kode_part     
                                                //                                     FROM fg inner join po_customer on po_customer.id_po = fg.id_po
                                                //                                     inner join customer on customer.id_cust = fg.id_cust
                                                //                                     inner join part on part.id_part = fg.id_part 
                                                //                                      Group by fg.id_po;

                                                $data = mysqli_query($conn, "SELECT po_customer.* , customer.nickname, 
                                                part.*
                                                FROM po_customer
                                                JOIN part ON po_customer.id_part = part.id_part
                                                JOIN customer ON po_customer.id_cust = customer.id_cust
                                                where statuss ='Sedang Diproses'");
                                            }
                                            while ($row = mysqli_fetch_array($data)) {
                                            ?>

                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?= date('M-Y', strtotime($row['tanggal_po'])) ?></td>
                                                    <td><?php echo $row['nickname']; ?></td>
                                                    <td><?php echo $row['nama_part']; ?></td>
                                                    <td><?php echo $row['kode_part']; ?></td>
                                                    <td><?php echo $row['spek_material']; ?></td>
                                                    <td><?php echo $row['ketebalan']; ?></td>
                                                    <td><?php echo $row['lebar']; ?></td>
                                                    <td><?php echo $row['panjang']; ?></td>
                                                    <td><?php echo $row['unit_mat']; ?></td>
                                                    <td><?php echo $row['berat_jenis']; ?></td>
                                                    <td><?php
                                                        if ($row['sisi'] > 0) {
                                                            echo '0';
                                                        } else {
                                                            echo $row['qty_po'];
                                                        }
                                                        ?></td>
                                                    <td><?php
                                                        if ($row['sisi'] > 0) {
                                                            echo number_format(($row['qty_po'] * $row['sisi']));
                                                        } else {
                                                            echo (($row['qty_po']));
                                                            // echo number_format(($row['qty_order'] + (0.03 * $row['qty_order'] - $row['stok'])));
                                                        }
                                                        ?></td>
                                                    <!-- <td><?php
                                                                if ($row['sisi'] > 0) {
                                                                    if ($row['qty_order'] > 0 && $row['pcs_sheet'] > 0) {
                                                                        echo number_format((($row['qty_order'] * $row['sisi'] * $row['pcs_sheet'])), 0);
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                } else {
                                                                    if ($row['qty_order'] > 0 && $row['pcs_sheet'] > 0) {
                                                                        echo number_format((($row['qty_order'] * $row['pcs_sheet'])), 0);
                                                                    } else {
                                                                        echo '0';
                                                                    }
                                                                    // echo number_format(($row['qty_order'] * $row['kg_pcs'] + (0.03 * $row['qty_order'] * $row['kg_pcs'] - $row['stok'])), 0);
                                                                } ?></td> -->
                                                    <td><?php
                                                        if ($row['sisi'] > 0) {

                                                                echo '0';
                                                            
                                                        } else {
                                                                echo number_format(((2438 / $row['lebar'])), 0);
                                                                // echo number_format(($row['qty_order'] / $row['pcs_sheet'] + (0.03 * $row['qty_order'] / $row['pcs_sheet'] - $row['stok'])), 0);

                                                        
                    
                                                        } ?></td>
                                                    <td><?php
                                                        if ($row['sisi'] > 0) {

                                                            echo '0';
                                                        } else {
                                                            echo number_format((($row['panjang'] * $row['lebar'] * $row['qty_po']) / (1219 * 2438)), 0);
                                                            // echo number_format(($row['qty_order'] / $row['pcs_lembar'] + (0.03 * $row['qty_order'] / $row['pcs_lembar'] - $row['stok'])), 0);
                                                        }

                                                        ?>
                                                    </td>
                                                    <!-- #panjang pieces * lebar pieces * qty_order customer = ...
                                                    ... / (panjang * lebar material) -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak MRP</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="exportmrp.php" target="_blank" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <br>
                                                        <label for="nama customer">Nama Customer</label>
                                                        <select class="form-control" name="nama_cust" required>
                                                            <option value="" hidden>- Pilih Customer -</option>
                                                            <?php
                                                            $sql = mysqli_query($conn, "SELECT nama_cust FROM customer") or die(mysqli_error($conn));
                                                            while ($data = mysqli_fetch_array($sql)) {
                                                            ?>
                                                                <option value="<?php echo $data['nama_cust'] ?>"><?php echo $data['nama_cust'] ?></option>

                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <br>
                                                        <label for="">Pilih Periode Bulan</label>
                                                        <input type="month" id="bulan" name="bulan" class="form-control" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Rencana Pertama</label>
                                                        <input type="date" class="form-control" id="rencana_pertama" name="rencana_pertama" required>
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <label for="pcs_sheet">Jumlah Pengiriman Rencana Pertama</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="qty_rencana1" name="qty_rencana1" placeholder='Wajib Diisi' required>
                                                    </div> -->
                                                    <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Rencana Kedua</label>
                                                        <input type="date" class="form-control" id="rencana_kedua" name="rencana_kedua">
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <label for="pcs_sheet">Jumlah Pengiriman Rencana Kedua</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="qty_rencana2" name="qty_rencana2" placeholder='Tidak Wajib Diisi'>
                                                    </div> -->
                                                    <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Forecasting 1</label>
                                                        <input type="month" class="form-control" id="forecast1" name="forecast1">
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Jumlah Forecasting 1</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="qty_forecast1" name="qty_forecast1">
                                                    </div> -->
                                                    <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Forecasting 2</label>
                                                        <input type="month" class="form-control" id="forecast2" name="forecast2">
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Jumlah Forecasting 2</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="qty_forecast2" name="qty_forecast2">
                                                    </div> -->
                                                    <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Forecasting 3</label>
                                                        <input type="month" class="form-control" id="forecast3" name="forecast3">
                                                    </div>
                                                    <!-- <div class="col-3">
                                                        <br>
                                                        <label for="pcs_sheet">Jumlah Forecasting 3</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="qty_forecast3" name="qty_forecast3">
                                                    </div> -->
                                                    <!-- <div class="form-group col-md-3">
                                                    <label for="">Rencana Pengiriman Pertama</label>
                                                    <input type="date" id="rencana_pertama" name="rencana_pertama" class="form-control" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Rencana Pengiriman Kedua</label>
                                                    <input type="date" id="rencana_kedua" name="rencana_kedua" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Forecasting 1</label>
                                                    <input type="month" id="forecast1" name="forecast1" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Forecasting 2</label>
                                                    <input type="month" id="forecast2" name="forecast2" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="">Forecasting 3</label>
                                                    <input type="month" id="forecast3" name="forecast3" class="form-control">
                                                </div> -->
                                                </div>
                                                <div class="modal-footer justify-content-left">
                                                    <button type="submit" name="cetak" class="btn btn-md btn-warning">CETAK MRP</button>
                                                    <!-- <button type="submit" class="btn btn-primary" name="edit">Update</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.content -->
        </div>
    </div>
    </div>
    </div>
    </div>



    <?php include('footer.php'); ?>
    <script>
        $(document).ready(function() {

            $('#example3').DataTable({});
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust()
                    .responsive.recalc();
            });
        });
    </script>
</body>

</html>