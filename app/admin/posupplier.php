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

if (isset($_POST['submit'])) {
    $material = $_POST['material'];
    $id_supp = $_POST['supp'];
    $tgl_po = $_POST['tgl_po'];
    $no_po_supp = $_POST['no_po_supp'];
    $qty_order_supp = $_POST['qty_order_supp'];
    $satuan = $_POST['satuan'];
    $satuan1 = $_POST['satuan'];
    $sisa_pengiriman = $_POST['qty_order_supp'];
    $harga = $_POST['harga'];
    // $hitung = $_POST['hitung'];

    $status = 'Sedang Diproses';


        // $select = mysqli_query($conn, "SELECT pcs_sheet FROM material where id_material ='$material'");
        // while ($row = mysqli_fetch_array($select)) {
        //     $pcs_sheet = $row['pcs_sheet'];
            if ($satuan == 'Lembar') {
                $query1 = mysqli_query($conn, "INSERT INTO po_supplier (id_po_supp,id_material,
            id_supp,tgl_po,no_po_supp,qty_order_supp,satuan,harga,statusss,sisa_pengiriman,satuan1,total) VALUES
            ('','$material','$id_supp','$tgl_po','$no_po_supp','$qty_order_supp','$satuan','$harga','$status','$sisa_pengiriman','$satuan1','$harga' * '$qty_order_supp')");
            } else if ($satuan == 'Pieces') {
                $query1 = mysqli_query($conn, "INSERT INTO po_supplier (id_po_supp,id_material,
            id_supp,tgl_po,no_po_supp,qty_order_supp,satuan,harga,statusss,sisa_pengiriman,satuan1,total) VALUES
            ('','$material','$id_supp','$tgl_po','$no_po_supp','$qty_order_supp','$satuan','$harga','$status','$sisa_pengiriman','$satuan1','$harga' * '$qty_order_supp')");
            } 
            $qry = mysqli_query($conn, "CREATE EVENT myevent2
            ON SCHEDULE EVERY 1 SECOND
            DO
              UPDATE po_supplier SET statusss = 'Selesai' WHERE tgl_po <= NOW();");
            echo '<script>
            swal.fire({
                text: "Purchase Order Supplier berhasil di input!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        }

// }

// $no = 0;
if (isset($_POST['edit'])) {
    $id_po_supp         = $_POST['id_po_supp'];
    $tgl_po             = $_POST['tgl_po'];
    $no_po_supp         = $_POST['no_po_supp'];
    $qty_order_supp     = $_POST['qty_order_supp'];
    $satuan             = $_POST['satuan'];
    $rencana_pertama    = $_POST['rencana_pertama'];
    // $qty_rencana1       = $_POST['qty_rencana1'];
    // $rencana_kedua      = $_POST['rencana_kedua'];
    // $qty_rencana2       = $_POST['qty_rencana2'];
    $harga              = $_POST['harga'];
    $revisi             = $_POST['revisi'];
    $hitung             = $_POST['hitung'];
    // $hitung = 1;


    $query = "UPDATE po_supplier SET tgl_po = '$tgl_po', no_po_supp='$no_po_supp',qty_order_supp='$qty_order_supp',
    satuan='$satuan',rencana_pertama='$rencana_pertama',harga='$harga',revisi='$revisi',hitung='$hitung'
    WHERE id_po_supp = '$id_po_supp'";
    $qr = mysqli_query($conn, $query);
}

if (isset($_POST['hapus'])) {
    $id_po_supp = $_POST['id_po_supp'];


    $query = "DELETE * FROM po_supplier WHERE id_po_supp='$id_po_supp'";
    $qr = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>
<style>
    body,
    a {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        text-decoration: none;
    }


    a.panel-group_btn {
        color: #888;
        display: block;
    }

    a.like-btn {
        color: #888;
        font-size: 14px;
    }


    span.clicked {
        color: green;
        font-weight: bold;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header"></section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col card-header text-right">
                                <h1 class="card-title font-weight-bold"><i class="fas fa-parachute-box mr-2"></i>Data PO Supplier</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-addpo">
                                    <i class="fas fa-plus mr-2"></i> PO Supplier
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center">Nama Supplier</th>
                                            <th class="text-center" width="15%">No PO Supplier</th>
                                            <th class="text-center" width="15%">Nama Produk</th>
                                            <th class="text-center" width="15%">Quantity Order Supplier</th>
                                            <th class="text-center" width="10%">Detail PO</th>
                                            <th class="text-center" width="10%">Action</th>
                                            <th class="text-center" width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = "SELECT po_supplier.*,supplier.* , material.*
                                        FROM po_supplier INNER JOIN material on po_supplier.id_material = material.id_material 
                                        JOIN supplier on po_supplier.id_supp = supplier.id_supp ORDER BY id_po_supp ASC";
                                        $sql = mysqli_query($conn, $data) or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nama_supp']; ?></td>
                                                <td><?php echo $row['no_po_supp']; ?></td>
                                                <td><?php echo $row['nama_material']; ?></td>
                                                <td><?php echo $row['qty_order_supp']; ?></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalposupp-<?php echo $row['id_po_supp']; ?>">Detail PO</button>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditposupp-<?php echo $row['id_po_supp']; ?>"><i class="fas fa-edit"></i></button>
                                                    <a onclick="hapusposupp(<?php echo $row['id_po_supp']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <td align="center">
                                                    <?php echo $row['statusss']; ?>
                                                    <!-- <a class="panel-group_btn" href="#">
                                                        <span id="<?php echo $row['id_po_supp'] ?>" class="like-btn">
                                                            SUCCESS
                                                        </span>
                                                    </a> -->

                                                    <!-- <button class="btn px-3 py-1 enc-btn" id="diproses" class="Button change" >PROCCESED</button> -->
                                                    <!-- <button id="diproses" value="Diproses" class="Button change">PROCCESED</button> -->
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modalposupp-<?php echo $row['id_po_supp']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h4 class="modal-title"><i class="fa fa-wrench mr-2"></i>Detail PO Supplier</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label for="nama_supp">Nama Supplier</label>
                                                                            <input type="text" href='exportmaterialreq.php?id_po_supp=<?php echo $row['id_po_supp']; ?>' value="<?php echo $row['id_po_supp']; ?>" name="id_po_supp" hidden>
                                                                            <input type="text" class="form-control" id="nama_supp" name="nama_supp" value="<?php echo $row['nama_supp']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <label for="nama_part">Nama Material</label>
                                                                            <input type="text" class="form-control" id="nama_material" name="nama_material" value="<?php echo $row['nama_material']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="berat_jenis">No PO Supplier</label>
                                                                            <input type="text" class="form-control" id="no_po_supp" name="no_po_supp" value="<?php echo $row['no_po_supp']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <br>
                                                                            <label for="lebar">Quantity Order Supplier</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['qty_order_supp']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <br>
                                                                            <label for="pcs_sheet">Tanggal PO</label>
                                                                            <input type="text" class="form-control" id="tgl_po" name="tgl_po" value="<?php echo $row['tgl_po']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Unit Material</label>
                                                                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $row['satuan']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Harga/KG(IDR)</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['harga']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Unit Material x Harga</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['hitung']; ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Rencana Pengiriman</label>
                                                                            <input type="text" class="form-control" id="rencana_pertama" name="rencana_pertama" value="<?php echo $row['rencana_pertama']; ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Belum Dikirim</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['sisa_pengiriman'];  ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Revisi</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['revisi'];  ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Rencana Kedua</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['rencana_kedua']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="panjang">Jumlah Pengirimanan Rencana Kedua</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['qty_rencana2'];  ?>" readonly>
                                                                        </div> -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                            </div>
                            <div class="modal fade" id="modalEditposupp-<?php echo $row['id_po_supp']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit PO Supplier</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <label for="kode_part">Nama Supplier</label>
                                                            <input type="text" href='exportmaterialreq.php?id_po_supp=<?php echo $row['id_po_supp']; ?>' value="<?php echo $row['id_po_supp']; ?>" name="id_po_supp" hidden>
                                                            <input type="text" class="form-control" id="nama_supp" name="nama_supp" value="<?php echo $row['nama_supp']; ?>" readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="kode_part">Nama Material</label>
                                                            <input type="text" class="form-control" id="nama_material" name="nama_material" value="<?php echo $row['nama_material']; ?>" readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="berat_jenis">No PO Supplier</label>
                                                            <input type="text" class="form-control" id="no_po_supp" name="no_po_supp" value="<?php echo $row['no_po_supp']; ?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <br>
                                                            <label for="berat_jenis">Quantity Order Supplier</label>
                                                            <input type="text" class="form-control" id="qty_order_supp" name="qty_order_supp" value="<?php echo $row['qty_order_supp']; ?>">
                                                        </div>
                                                        <div class="col-2">
                                                            <br>
                                                            <label for="pcs_sheet">Tanggal PO</label>
                                                            <input type="text" class="form-control" id="tgl_po" name="tgl_po" value="<?php echo $row['tgl_po']; ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="lebar">Unit Material</label>
                                                            <select class="form-control" id="satuan" name="satuan">
                                                                <option value="" hidden>- Pilih Material -</option>
                                                                <option value="Lembar" <?php if ($row['satuan'] == 'Lembar') echo 'selected' ?>>Lembar</option>
                                                                <!-- <option value="Sheet" <?php if ($row['satuan'] == 'Sheet') echo 'selected' ?>>Sheet</option> -->
                                                                <!-- <option value="Coil" <?php if ($row['satuan'] == 'Coil') echo 'selected' ?>>Coil</option> -->
                                                                <option value="Pieces" <?php if ($row['satuan'] == 'Pieces') echo 'selected' ?>>Pieces</option>
                                                                <!-- <option value="Tube" <?php if ($row['satuan'] == 'Tube') echo 'selected' ?>>Tube</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Harga/KG(IDR)</label>
                                                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="lebar">Unit Material x Harga</label>
                                                            <select class="form-control" id="hitung" name="hitung">
                                                                <option value="" hidden>- Pilih Material -</option>
                                                                <option value="Kg" <?php if ($row['hitung'] == 'Kg') echo 'selected' ?>>Kg</option>
                                                                <option value="Sht" <?php if ($row['hitung'] == 'Sht') echo 'selected' ?>>Sheet</option>
                                                                <option value="Lbr" <?php if ($row['hitung'] == 'Lbr') echo 'selected' ?>>Lembar</option>
                                                                <option value="Pcs" <?php if ($row['hitung'] == 'Pcs') echo 'selected' ?>>Pieces</option>

                                                            </select>
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Rencana Pengiriman</label>
                                                            <input type="date" class="form-control" id="rencana_pertama" name="rencana_pertama" value="<?php echo $row['rencana_pertama']; ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Revisi</label>
                                                            <input type="text" class="form-control" id="revisi" name="revisi" value="<?php echo $row['revisi']; ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Rencana Kedua</label>
                                                            <input type="date" class="form-control" id="rencana_kedua" name="rencana_kedua" value="<?php echo $row['rencana_kedua']; ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Kedua</label>
                                                            <input type="text" class="form-control" id="qty_rencana2" name="qty_rencana2" value="<?php echo $row['qty_rencana2']; ?>">
                                                        </div> -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-left">
                                                <button type="submit" class="btn btn-primary" name="edit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                                            // $no++;
                                        }
                        ?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-addpo">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title"><i class="fa fa-cart-plus mr-2"></i>Tambah PO Supplier</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="tambahposupp" action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        
                                        <div class="col-3">
                                            <label for="nama_supp">Nama Supplier</label>
                                            <select class="form-control" id="supp" name="supp" required>
                                                <option hidden> - Pilih Supplier - </option>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama_supp ASC") or die(mysqli_error($conn));
                                                while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $data['id_supp'] ?>"><?php echo $data['nama_supp'] ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="nama_part">Nama Material</label>
                                            <select class="form-control" id="material" name="material" required>
                                                <option> - Pilih Supplier Terlebih Dahulu - </option>
                                            </select>
                                        </div>
                                       
                                        <div class="col-3">
                                            <label for="pcs_sheet">Nomor PO Supplier</label>
                                            <input type="text" autocomplete="off" class="form-control" id="no_po_supp" name="no_po_supp" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="pcs_sheet">Tanggal PO</label>
                                            <input type="date" class="form-control" id="tgl_po" name="tgl_po" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="pcs_sheet">Quantity Order ke Supplier</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_order_supp" name="qty_order_supp" required>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <label for="satuan">Unit Material</label>
                                            <select class="form-control" id="satuan" name="satuan" required>
                                                <option value="" hidden>- Pilih Material -</option>
                                                <option value="Lembar">Lembar</option>
                                                <!-- <option value="Sheet">Sheet</option> -->
                                                <!-- <option value="Coil">Coil</option> -->
                                                <option value="Pieces">Pieces</option>
                                                <!-- <option value="Tube">Tube</option> -->
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Harga (IDR)</label>
                                            <input type="text" autocomplete="off" class="form-control" id="harga" name="harga" required>
                                        </div>
                                        <!-- <div class="col-md-3">
                                            <br>
                                            <label for="proses">Unit Material x Harga</label>
                                            <select class="form-control" id="hitung" name="hitung" required>
                                                <option value="" hidden>- Pilih untuk dikalikan-</option>
                                                <option value="Pcs">Pieces</option>
                                                <option value="Kg">Kg</option>
                                                <option value="Sht">Sheet</option>
                                                <option value="Lbr">Lembar</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Rencana Pengiriman</label>
                                            <input type="date" class="form-control" id="rencana_pertama" name="rencana_pertama" required>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Jumlah Pengiriman</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_rencana1" name="qty_rencana1" placeholder='Wajib Diisi' required>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Rencana Kedua</label>
                                            <input type="date" class="form-control" id="rencana_kedua" name="rencana_kedua">
                                        </div>
                                        <div class="col-3">
                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Kedua</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_rencana2" name="qty_rencana2" placeholder='Tidak Wajib Diisi'>
                                        </div> -->
                                    </div>
                                    <br>
                                    <div class="modal-footer justify-content-left">
                                        <button class="btn btn-primary" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include('footer.php') ?>
    <script>
        $(".like-btn").click(function() {

            $(this).toggleClass('clicked');
            event.preventDefault();

        });



        $(".panel-group_btn span").click(function() {
            var btnStorage = $(this).attr("id");

            if ($(this).hasClass("clicked")) {
                localStorage.setItem(btnStorage, 'true');
            } else {
                localStorage.removeItem(btnStorage, 'true');
            }

        });


        $(".panel-group_btn span").each(function() {
            var mainlocalStorage = $(this).attr("id");

            if (localStorage.getItem(mainlocalStorage) == 'true') {
                $(this).addClass("clicked");
            } else {
                $(this).removeClass("clicked");
            }

        });

        function hapusposupp(posupp_id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapusposupp.php?id_po_supp=" + posupp_id)
                }
            })
        }
    </script>
    <script>
        $('#supp').on('change', function() {
            var supp = $(this).val();
            $.ajax({
                url: 'ambildatasupp.php',
                type: "POST",
                data: {
                    supp: supp
                },
                success: function(data) {
                    $("#material").html(data);
                },
                error: function() {
                    alert("Gagal Mengambil Data");
                }
            })
        })
    </script>
</body>

</html>