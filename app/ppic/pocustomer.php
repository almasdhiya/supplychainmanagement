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

// $cust = $_POST['id_cust'];
// $part = $_POST['id_part'];

if (isset($_POST['submit'])) {
    $id_cust            = $_POST['cust'];
    $id_part            = $_POST['part'];
    $no_po              = $_POST['no_po'];
    $tanggal_po         = $_POST['tanggal_po'];
    $tanggalterima_po   = $_POST['tanggalterima_po'];
    // $qty_order          = $_POST['qty_order'];
    $qty_po             = $_POST['qty_po'];
    // $pengiriman_pertama = $_POST['pengiriman_pertama'];
    // $pengiriman_kedua   = ($pengiriman_pertama - $qty_order);
    // $rencana_pertama    = $_POST['rencana_pertama'];
    // $rencana_kedua      = $_POST['rencana_kedua'];
    // $qty_rencana1       = $_POST['qty_rencana1'];
    // $qty_rencana2       = $_POST['qty_rencana2'];
    // $forecast1          = $_POST['forecast1'];
    $qty_forecast1      = $_POST['qty_forecast1'];
    // $forecast2          = $_POST['forecast2'];
    $qty_forecast2      = $_POST['qty_forecast2'];
    // $forecast3          = $_POST['forecast3'];
    $qty_forecast3      = $_POST['qty_forecast3'];
    $unit_mat          = $_POST['satuan'];
    $sisi1               = $_POST['sisi1'];
    // $persen            = $_POST['persen'];
    // $stok         = $_POST['stok'];

    // $dateStart = date('d-m-Y');
    // if ($dateStart < $_POST['tanggal_po']) {
    if (
        $no_po != "" && $tanggal_po != "" && $tanggalterima_po != "" &&  $qty_po != "" && $qty_forecast1 != "" || $qty_forecast1 == "" &&  $qty_forecast2 != "" || $qty_forecast2 == ""
        &&  $qty_forecast3 != "" || $qty_forecast3 == "" &&  $unit_mat != "" && $sisi1 = "" || $sisi1 != ""  && $persen != ""
    ) {
        $status = "Sedang Diproses";
        $query = mysqli_query($conn, "INSERT INTO po_customer 
    (id_po,id_cust,id_part, no_po, tanggal_po, tanggalterima_po, qty_po,
     qty_forecast1,qty_forecast2,qty_forecast3,unit_mat,statuss,sisi) 
     VALUES('','$id_cust','$id_part','$no_po','$tanggal_po','$tanggalterima_po','$qty_po',
     '$qty_forecast1','$qty_forecast2','$qty_forecast3','$unit_mat','$status','$sisi1')");

        // $query = mysqli_query($conn, "SELECT total_qty_part from fg where id_part = '$id_part' and total_qty_part != '0' ");
        // while ($row = mysqli_fetch_array($query)) {
        //     $hasil = $row['total_qty_part'];
        //     $update = mysqli_query($conn, "UPDATE po_customer SET stok = '$hasil' WHERE id_part ='$id_part' and statuss='Sedang Diproses'");
        // }
        $qry = mysqli_query($conn, "CREATE EVENT myevent
        ON SCHEDULE EVERY 1 SECOND
        DO
          UPDATE po_customer SET statuss = 'Selesai' WHERE tanggal_po <= NOW();");
        echo '<script>
           swal.fire({
               text: "Purchase Order Customer berhasil di input!",
               icon: "success",
               button: "Close!",
           });
           </script>';
    } else {
        echo '<script>
        swal.fire({
            text: "Coba Periksa Lagi!",
            icon: "warning",
            button: "Close!",
        });
        </script>';
    }
};
if (isset($_POST['edit'])) {
    $id_po = $_POST['id_po'];
    $no_po = $_POST['no_po'];
    // $qty_order = $_POST['qty_order'];
    $qty_po = $_POST['qty_po'];
    $tanggal_po = $_POST['tanggal_po'];
    $tanggalterima_po = $_POST['tanggalterima_po'];
    // $rencana_pertama = $_POST['rencana_pertama'];
    // $rencana_kedua = $_POST['rencana_kedua'];
    // $qty_rencana1 = $_POST['qty_rencana1'];
    // $qty_rencana2 = $_POST['qty_rencana2'];
    // $forecast1 = $_POST['forecast1'];
    $qty_forecast1 = $_POST['qty_forecast1'];
    // $forecast2 = $_POST['forecast2'];
    $qty_forecast2 = $_POST['qty_forecast2'];
    // $forecast3 = $_POST['forecast3'];
    $qty_forecast3 = $_POST['qty_forecast3'];
    $unit_mat          = $_POST['satuan'];
    $revisi          = $_POST['revisi'];
    // $persen          = $_POST['persen'];
    // $stok          = $_POST['stok'];

    $query = "UPDATE po_customer SET no_po = '$no_po',qty_po = '$qty_po',tanggal_po='$tanggal_po',
    tanggalterima_po='$tanggalterima_po'
    ,qty_forecast1='$qty_forecast1',qty_forecast2='$qty_forecast2',qty_forecast3='$qty_forecast3',
    unit_mat = '$unit_mat',revisi = '$revisi'
    WHERE id_po = '$id_po'";
    $qr = mysqli_query($conn, $query);
    // $query2 = mysqli_query($conn, "UPDATE item_table SET (click_counter = click_counter+1) WHERE item_id = ?");
    //     $sql = mysqli_query($conn, "SELECT hitung FROM po_customer");
    //     if ($sql->num_rows > 0) {
    //         while ($row = $sql->fetch_assoc()) {
    //             $klik = $row["hitung"];
    //         }
    //     }
    //     $klik = $klik + 1;
    //     $query = "UPDATE po_customer SET hitung='$klik'";
    // }
}

if (isset($_POST['hapus'])) {
    $id_po = $_POST['id_po'];
    $no_po = $_POST['no_po'];
    // $qty_order = $_POST['qty_order'];
    $tanggal_po = $_POST['tanggal_po'];
    $tanggalterima_po = $_POST['tanggalterima_po'];


    $query = "DELETE * FROM po_customer WHERE id_po='$id_po'";
    $qr = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>
<style>
    #sisiwoy {
        display: none;
    }

    /* .Button {
        font-family: Calibri, sans-serif;
        font-size: 13px;
        font-weight: bold;
        width: 90px;
        height: 30px;
        background: red;
        color: white
    }

    .selected {
        color: white;
        background: green
    }

    .enc-btn {
        font-family: Calibri, sans-serif;
        background-color: #02bc15;
        border: none;
        border-radius: .5rem;
        font-size: 12px;
        color: white;
    } */
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-cart-arrow-down mr-2"></i>MRP</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-addpo">
                                    <i class="fas fa-plus mr-2"></i> Tambah MRP
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Nomor PO</th>
                                            <th class="text-center" width="10%">Tanggal Jatuh Tempo</th>
                                            <th class="text-center" width="10%">Detail PO</th>
                                            <th class="text-center" width="10%">Action</th>
                                            <th class="text-center" width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = "SELECT po_customer.*, part.nama_part, part.kode_part, customer.nama_cust
                                        FROM po_customer
                                        JOIN part ON po_customer.id_part = part.id_part
                                        JOIN customer ON po_customer.id_cust = customer.id_cust
                                        WHERE part.id_cust=customer.id_cust AND po_customer.id_part=part.id_part";

                                        $sql = mysqli_query($conn, $data) or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row['nama_cust']; ?></td>
                                                <td><?php echo $row['nama_part']; ?></td>
                                                <td><?php echo $row['no_po']; ?></td>
                                                <td><?php echo $row['tanggal_po']; ?></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalpo-<?php echo $row['id_po']; ?>">Detail MRP</button>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditpo-<?php echo $row['id_po']; ?>"><i class="fas fa-edit"></i></button>
                                                    <a onclick="hapuspocust(<?php echo $row['id_po']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <td align="center">

                                                    <?php echo $row['statuss']; ?>
                                                    <!-- <a href="status.php?u_id='.$row['user_id'].'&active=1">Active</a>
                                                    <a href="status.php?u_id='.$row['user_id'].'&unactive=0">un-Active</a> -->
                                                    <!-- <a class="panel-group_btn" href="#">
                                                        <span id="<?php echo $row['id_po'] ?>" class="like-btn" onclick="woi">
                                                            SUCCESS
                                                        </span>
                                                    </a> -->
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modalpo-<?php echo $row['id_po']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h4 class="modal-title"><i class="fa fa-wrench mr-2"></i>Detail MRP</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label for="nama_cust">Nama Customer</label>
                                                                            <input type="text" class="form-control" id="nama_cust" name="nama_cust" value="<?php echo $row['nama_cust']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-5">
                                                                            <label for="nama_part">Nama Produk</label>
                                                                            <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="nama_cust">Kode Part</label>
                                                                            <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="berat_jenis">Nomor PO </label>
                                                                            <input type="text" class="form-control" id="no_po" name="no_po" value="<?php echo $row['no_po']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Date Promised</label>
                                                                            <input type="text" class="form-control" id="tanggal_po" name="tanggal_po" value="<?php echo $row['tanggal_po']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="ketebalan">Date Order</label>
                                                                            <input type="text" class="form-control" id="tanggalterima_po" name="tanggalterima_po" value="<?php echo $row['tanggalterima_po']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Quantity PO</label>
                                                                            <input type="text" class="form-control" id="qty_po" name="qty_po" value="<?php echo $row['qty_po']; ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Quantity Order</label>
                                                                            <input type="text" class="form-control" id="qty_order" name="qty_order" value="<?php echo $row['qty_order']; ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Unit Material</label>
                                                                            <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $row['unit_mat']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Revisi</label>
                                                                            <input type="text" class="form-control" id="qty_order" name="revisi" value="<?php echo $row['revisi']; ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Stok</label>
                                                                            <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Sudah dikirim</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['delivery_cust1'];  ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Belum dikirim</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['delivery_cust2'];  ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Rencana Pertama</label>
                                                                            <input type="text" class="form-control" id="rencana_pertama" name="rencana_pertama" value="<?php echo $row['rencana_pertama']; ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <label for="panjang">Jumlah Pengirimanan Rencana Pertama</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['qty_rencana1'];  ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Rencana Kedua</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['rencana_kedua']; ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <label for="panjang">Jumlah Pengirimanan Rencana Kedua</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['qty_rencana2'];  ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Forecasting 1</label>
                                                                            <input type="month" class="form-control" value="<?php echo $row['forecast1'];  ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Jumlah Forecasting 1</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['qty_forecast1'];  ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Forecasting 2</label>
                                                                            <input type="month" class="form-control" value="<?php echo $row['forecast2'];  ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Jumlah Forecasting 2</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['qty_forecast2'];  ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Forecasting 3</label>
                                                                            <input type="month" class="form-control" value="<?php echo $row['forecast3'];  ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Jumlah Forecasting 3</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['qty_forecast3'];  ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Persenan</label>
                                                                            <input type="text" class="form-control" value="<?php echo $row['persen'];  ?>" readonly>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                            </div>

                            <div class="modal fade" id="modalEditpo-<?php echo $row['id_po']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                            <h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit MRP</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="nama_part">Nama Customer</label>
                                                            <input type="text" value="<?php echo $row['id_po']; ?>" name="id_po" hidden>
                                                            <input type="text" class="form-control" id="nama_cust" name="nama_cust" value="<?php echo $row['nama_cust']; ?>" readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="kode_part">Nama Produk</label>
                                                            <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="kode_part">Kode Part</label>
                                                            <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="berat_jenis">Nomor PO</label>
                                                            <input type="text" class="form-control" id="no_po" name="no_po" value="<?php echo $row['no_po']; ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="pcs_sheet">Date Promised</label>
                                                            <input type="date" class="form-control" id="tanggal_po" name="tanggal_po" value="<?php echo $row['tanggal_po']; ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="spek_material">Date Order</label>
                                                            <input type="date" class="form-control" id="tanggalterima_po" name="tanggalterima_po" value="<?php echo $row['tanggalterima_po']; ?>">
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="ketebalan">Quantity PO</label>
                                                            <input type="text" class="form-control" id="qty_po" name="qty_po" value="<?php echo $row['qty_po']; ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <label for="ketebalan">Quantity Order</label>
                                                            <input type="text" class="form-control" id="qty_order" name="qty_order" value="<?php echo $row['qty_order']; ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="ketebalan">Revisi</label>
                                                            <input type="text" class="form-control" id="revisi" name="revisi" value="<?php echo $row['revisi']; ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="ketebalan">Stok</label>
                                                            <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="lebar">Unit Material</label>
                                                            <select class="form-control" id="satuan" name="satuan">
                                                                <option value="" hidden>- Pilih Material -</option>
                                                                <option value="Lembar" <?php if ($row['unit_mat'] == 'Lembar') echo 'selected' ?>>Lembar</option>
                                                                <!-- <option value="Sheet" <?php if ($row['unit_mat'] == 'Sheet') echo 'selected' ?>>Sheet</option>
                                                                <option value="Kg" <?php if ($row['unit_mat'] == 'Kg') echo 'selected' ?>>Kg</option> -->
                                                                <option value="Pieces" <?php if ($row['unit_mat'] == 'Pieces') echo 'selected' ?>>Pieces</option>
                                                            </select>
                                                        </div>
                                                        <!-- <div class="col-4">
                                                            <label for="lebar">Jumlah Pengiriman Pertama</label>
                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['delivery_cust1']; ?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="lebar">Jumlah Pengiriman Kedua</label>
                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['delivery_cust2']; ?>" readonly>
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Rencana Pertama</label>
                                                            <input type="date" class="form-control" id="rencana_pertama" name="rencana_pertama" value="<?php echo $row['rencana_pertama']; ?>">
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Pertama</label>
                                                            <input type="text" class="form-control" id="qty_rencana1" name="qty_rencana1" value="<?php echo $row['qty_rencana1']; ?>">
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Rencana Kedua</label>
                                                            <input type="date" class="form-control" id="rencana_kedua" name="rencana_kedua" value="<?php echo $row['rencana_kedua']; ?>">
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Kedua</label>
                                                            <input type="text" class="form-control" id="qty_rencana2" name="qty_rencana2" value="<?php echo $row['qty_rencana2']; ?>">
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Forecasting 1</label>
                                                            <input type="month" class="form-control" id="forecast1" name="forecast1" value="<?php echo $row['forecast1'];  ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Jumlah Forecasting 1</label>
                                                            <input type="text" class="form-control" id="qty_forecast1" name="qty_forecast1" value="<?php echo $row['qty_forecast1'];  ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Forecasting 2</label>
                                                            <input type="month" class="form-control" id="forecast2" name="forecast2" value="<?php echo $row['forecast2'];  ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Jumlah Forecasting 2</label>
                                                            <input type="text" class="form-control" id="qty_forecast2" name="qty_forecast2" value="<?php echo $row['qty_forecast2'];  ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Forecasting 3</label>
                                                            <input type="month" class="form-control" id="forecast3" name="forecast3" value="<?php echo $row['forecast3'];  ?>">
                                                        </div> -->
                                                        <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Jumlah Forecasting 3</label>
                                                            <input type="text" class="form-control" id="qty_forecast3" name="qty_forecast3" value="<?php echo $row['qty_forecast3'];  ?>">
                                                        </div>
                                                        <!-- <div class="col-3">
                                                            <br>
                                                            <label for="pcs_sheet">Persenan</label>
                                                            <input type="text" class="form-control" id="persen" name="persen" value="<?php echo $row['persen'];  ?>">
                                                        </div> -->
                                                        <!-- <div class="col-3">
                                                            <input type="text" class="form-control" id="hitung" name="hitung" value="<?php echo $_SESSION['i']++ ?>">
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-left">
                                                <button type="submit" class="btn btn-primary" name="edit" id="edit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                                            $no++;
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
                            <h4 class="modal-title"><i class="fa fa-cart-plus mr-2"></i>Tambah MRP</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="nama_cust">Nama Customer</label>
                                            <input type="text" class="form-control" id="id_stok" name="id_stok" hidden>
                                            <select class="form-control" id="cust" name="cust" required>
                                                <option> - Pilih Customer - </option>
                                                <?php
                                                $sql = mysqli_query($conn, "SELECT * FROM customer ORDER BY id_cust ASC") or die(mysqli_error($conn));
                                                while ($data = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo $data['id_cust'] ?>"><?php echo $data['nama_cust'] ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="nama_part">Nama Produk</label>
                                            <select class="form-control" id="part" name="part" required>
                                                <option> - Pilih Customer Terlebih Dahulu - </option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="berat_jenis">Nomor PO</label>
                                            <input type="text" autocomplete="off" class="form-control" id="no_po" name="no_po" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="pcs_sheet">Quantity PO</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_po" name="qty_po" required>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Date Promised</label>
                                            <input type="date" class="form-control" id="tanggal_po" name="tanggal_po" required>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Date Order</label>
                                            <input type="date" class="form-control" id="tanggalterima_po" name="tanggalterima_po" required>
                                        </div>
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Quantity Order</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_order" name="qty_order" required>
                                                </div> -->
                                        <div class="col-3">
                                            <br>
                                            <label for="satuan">Unit Material</label>
                                            <select class="form-control" id="satuan" name="satuan" required>
                                                <option value="" hidden>- Pilih Material -</option>
                                                <option value="Lembar">Lembar</option>
                                                <!-- <option value="Sheet">Sheet</option>
                                                <option value="Kg">Kg</option> -->
                                                <option value="Pieces">Pieces</option>
                                                <!-- <option value="Tube">Tube</option> -->
                                            </select>
                                        </div>
                                        
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Stok</label>
                                            <input type="text" autocomplete="off" class="form-control" id="stok" name="stok" required>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Rencana Pertama</label>
                                            <input type="date" class="form-control" id="rencana_pertama" name="rencana_pertama" required>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Pertama</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_rencana1" name="qty_rencana1" placeholder='Wajib Diisi' required>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Rencana Kedua</label>
                                            <input type="date" class="form-control" id="rencana_kedua" name="rencana_kedua">
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <label for="pcs_sheet">Jumlah Pengiriman Rencana Kedua</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_rencana2" name="qty_rencana2" placeholder='Tidak Wajib Diisi'>
                                        </div> -->
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Forecasting 1</label>
                                            <input type="month" class="form-control" id="forecast1" name="forecast1">
                                        </div> -->
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Jumlah Forecasting 1</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_forecast1" name="qty_forecast1">
                                        </div>
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Forecasting 2</label>
                                            <input type="month" class="form-control" id="forecast2" name="forecast2">
                                        </div> -->
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Jumlah Forecasting 2</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_forecast2" name="qty_forecast2">
                                        </div>
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Forecasting 3</label>
                                            <input type="month" class="form-control" id="forecast3" name="forecast3">
                                        </div> -->
                                        <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Jumlah Forecasting 3</label>
                                            <input type="text" autocomplete="off" class="form-control" id="qty_forecast3" name="qty_forecast3">
                                        </div>
                                        <!-- <div class="col-3">
                                            <br>
                                            <label for="pcs_sheet">Persenan</label>
                                            <input type="text" autocomplete="off" class="form-control" id="persen" name="persen" required>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <br>
                                            <div class="checkbox-group required">
                                                <input type="checkbox" id="sisi" name="spot[]" value="Ya" class="mr-2">Spot</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div id="sisiwoy">
                                                <label for="exampleInputEmail1">Quantity Spot Untuk 1 Part</label>
                                                <input type="text" autocomplete="off" class="form-control" id="sisi1" name="sisi1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="modal-footer justify-content-left">
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
        $(document).on('click', '.status_checks', function() {

            var status = ($(this).hasClass("btn-success")) ? '1' : '0';
            var msg = (status == '0') ? 'Deactivate' : 'Activate';
            if (confirm("Are you sure to " + msg)) {
                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo 'index.php/Dashboard/update_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        "id": id,
                        "status": status
                    },
                    success: function(data) {
                        // if you want reload the page
                        location.reload();
                        //if you want without reload
                        if (status == '1') {
                            current_element.removeClass('btn-success');
                            current_element.addClass('btn-danger');
                            current_element.html('Deactivate');
                        } else {
                            current_element.removeClass('btn-danger');
                            current_element.addClass('btn-success');
                            current_element.html('Activate');
                        }
                    }
                });
            }
        });

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



        $('#sisi').on('change', function() {

            if (this.value == 'Ya') {
                $('#sisiwoy').show();
            } else {
                $('#sisiwoy').hide();
            }
        });

        // let btnDsn = document.querySelector(".like-btn");
        //     localStorage.setItem('Name', 'SUCCESS');
        //     let name = localStorage.getItem('Name');

        //     (function() {
        //         btnDsn.onclick = function() {
        //             btnDsn.textContent = name;
        //         };
        //     })();
        // const btn = document.getElementById('btn');

        // btn.innerHTML = 'Opened';

        // // Change button text on click
        // btn.addEventListener('click', function handleClick() {
        //     const initialText = 'Opened';

        //     btn.innerHTML = `Closed`;
        // });

        // // change color 
        // btn.addEventListener('click', function onClick() {
        //     btn.style.backgroundColor = '#ff3030';
        //     btn.style.color = 'white';
        // });

        // $(document).ready(function() {
        //     if (localStorage.getItem('isCliked')) {
        //         $('#diproses').css('background-color', 'red');
        //         var btnStorage = $(this).attr("id");
        //     }
        //     $('#diproses').on('click', function() {
        //         $('#diproses').css('background-color', 'green');
        //         // set the value upon clicking
        //         localStorage.setItem('isCliked', true)
        //     });

        //     let btnDsn = document.querySelector("#diproses");
        //     localStorage.setItem('Name', 'SUCCESS');
        //     let name = localStorage.getItem('Name');

        //     (function() {
        //         btnDsn.onclick = function() {
        //             btnDsn.textContent = name;
        //         };
        //     })();
        // });

        // $("button.change").click(function() {
        //     $(this).toggleClass("selected");
        // });

        // function change() // no ';' here
        // {
        //     var elem = document.getElementById("diproses");
        //     if (elem.value == "Diproses") elem.value = "Selesai";
        //     else elem.value = "Diproses";
        // }

        function hapuspocust(pocust_id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapuspocust.php?id_po=" + pocust_id)
                }
            })
        }
    </script>
    <script>
        $('#cust').on('change', function() {
            var cust = $(this).val();
            $.ajax({
                url: 'ambildata.php',
                type: "POST",
                data: {
                    cust: cust
                },
                success: function(data) {
                    $("#part").html(data);
                },
                error: function() {
                    alert("Gagal Mengambil Data");
                }
            })
        })

        //         function generator(){
        //     /*your code here...*/    
        //     var element = document.createElement("button");
        //     element.setAttribute("id", "result");
        //     element.appendChild(document.createTextNode(name));
        //     document.getElementById("placeholder").appendChild(element);
        //     /*the ajax code here*/
        //     var url='hitungedit.php';
        //     $.get(url,function(data){
        //         $('#edit').html(data+' Word combinations have been generated so far.');
        //     });
        //  }
    </script>



</body>

</html>