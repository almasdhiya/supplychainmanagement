<meta http-equiv="refresh" content="1800; url=login.php">
<script src="jquery-3.3.1.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<?php
session_start();
if ($_SESSION['role'] == "") {
    header("location:index.php?pesan=gagal");
}
?>
<?php
include('header.php');
include('sidebar.php');
include('../koneksi.php');

if (isset($_POST['kk'])) {
    $id_cust = $_POST['cust'];
    $id_part = $_POST['part'];
    $id_po = $_POST['id_po'];
    $qty_delivfg = $_POST['qty_delivfg'];
    $nosurjal = $_POST['nosurjal'];
    $tgl_delivfg = $_POST['tgl_delivfg'];

    $query = mysqli_query($conn, "SELECT total_qty from fg where id_part = '$id_part' and total_qty != '0'");
    while ($row = mysqli_fetch_array($query)) {
        $hasil = $row['total_qty'];
        // print_r($hasil + 2);
        // exit();
        if ($hasil == 0) {
            echo '<script>
            swal.fire({
              text: "Data Finish Good untuk PO ini sudah habis!",
              icon: "warning",
              button: "Close!",
            });
        </script>';
        } else if ($qty_delivfg > $hasil) {
            echo '<script>
            swal.fire({
             text: "Quantity delivery lebih dari Stok FG!",
                              icon: "warning",
                              button: "Close!",
                            });
                        </script>';
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO deliveryfg (id_delivfg, id_cust, id_part, id_po, qty_delivfg, nosurjal, tgl_delivfg) VALUES ('','$id_cust','$id_part','$id_po','$qty_delivfg','$nosurjal','$tgl_delivfg')");
            $query2 = mysqli_query($conn, "UPDATE fg SET total_qty = '$hasil' - '$qty_delivfg' WHERE id_part = '$id_part' and total_qty != '0'");
            echo '<script>
                swal.fire({
                  text: "Produk Berhasil Dikirim!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
        }
    }
}
?>

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
                            <div class="col card-header text-right">
                                <h1 class="card-title font-weight-bold"><i class="fas fa-truck mr-2"></i>Delivery</h1>
                            </div>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="col">

                                            <div class="white_shd full margin_bottom_30">
                                                <div class="full graph_head">
                                                    <div class="heading1 margin">

                                                    </div>
                                                </div>
                                                <div class="full inner_elements">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="tab_style1">
                                                                <div class="tabbar padding_infor">
                                                                    <nav class="nav">
                                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                            <a class="nav-item nav-link active" data-toggle="tab" href="#del" aria-selected="true">Delivery Finish Good</a>
                                                                            <a class="nav-item nav-link" data-toggle="tab" href="#rek" aria-selected="false">Laporan Surat Jalan Delivery Finish Good</a>
                                                                        </div>
                                                                    </nav>
                                                                    <br>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="del" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <b><i class="fas fa-check-square mr-2"></i>DELIVERY FINISH GOOD</b>
                                                                            <div class="card-body">
                                                                                <form method="post" action="">
                                                                                    <div class="form-group">
                                                                                        <div class="row">
                                                                                            <div class="col-4">
                                                                                                <label for="nama customer">Nama Customer</label>
                                                                                                <select class="form-control" id="cust" name="cust">
                                                                                                    <option value="" hidden>- Pilih Customer -</option>
                                                                                                    <?php
                                                                                                    $sql = mysqli_query($conn, "SELECT * FROM customer") or die(mysqli_error($conn));
                                                                                                    while ($data = mysqli_fetch_array($sql)) {
                                                                                                    ?>
                                                                                                        <option value="<?php echo $data['id_cust'] ?>"><?php echo $data['nama_cust'] ?></option>

                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-4">
                                                                                                <label for="nama_part">Nama Produk</label>
                                                                                                <select class="form-control" id="part" name="part" required>
                                                                                                    <option> - Pilih Customer Terlebih Dahulu - </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-4">
                                                                                                <label for="nama customer">No PO Customer</label>
                                                                                                <select class="form-control" id="id_po" name="id_po" required>
                                                                                                    <option> - Pilih Customer Dahulu - </option>

                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                        <div class="row">
                                                                                            <div class="col-2">
                                                                                                <label for="qty_sheet">Quantity Delivery</label>
                                                                                                <input type="text" autocomplete="off" class="form-control" id="qty_delivfg" name="qty_delivfg" required>
                                                                                            </div>
                                                                                            <div class="col-2">
                                                                                                <label for="qty_sheet">Tanggal Delivery</label>
                                                                                                <input type="date" autocomplete="off" class="form-control" id="tgl_delivfg" name="tgl_delivfg" required>
                                                                                            </div>
                                                                                            <div class="col-3">
                                                                                                <label for="qty_sheet">No Surat Jalan</label>
                                                                                                <input type="text" autocomplete="off" class="form-control" id="nosurjal" name="nosurjal" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="row">
                                                                                            <div class="col-3">
                                                                                                <label></label>
                                                                                                <button type="submit" name="kk" class="btn btn-md btn-success"> Submit Delivery </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="rek" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak"><i class="fas fa-print mr-2"></i>CETAK</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example3" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center">Nama Customer</th>
                                                                                        <th class="text-center">Nama Produk</th>
                                                                                        <th class="text-center">No Purchase Order</th>
                                                                                        <th class="text-center">Quantity PO Customer</th>
                                                                                        <th class="text-center">Quantity Delivery</th>
                                                                                        <th class="text-center">Tanggal Delivery</th>
                                                                                        <th class="text-center">Nomor Surat Jalan</th>
                                                                                        <!-- <th class="text-center">Aksi</th> -->
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    include('../koneksi.php');
                                                                                    $no = 1;
                                                                                    $data = mysqli_query($conn, "SELECT deliveryfg.*,customer.nama_cust, po_customer.no_po,po_customer.qty_po, part.nama_part
                                                                                    FROM deliveryfg inner join customer on customer.id_cust = deliveryfg.id_cust 
                                                                                    INNER join po_customer on po_customer.id_po = deliveryfg.id_po
                                                                                    inner join part on part.id_part = deliveryfg.id_part;
                                                                                    ");

                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>

                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_cust']; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?></td>
                                                                                            <td><?php echo $row['no_po']; ?></td>
                                                                                            <td><?php echo $row['qty_po']; ?></td>
                                                                                            <td><?php echo $row['qty_delivfg']; ?></td>
                                                                                            <td><?php echo $row['tgl_delivfg']; ?></td>
                                                                                            <td><?php echo $row['nosurjal']; ?></td>
                                                                                            <!-- <td>
                                                                                                <center>
                                                                                                    <a onclick="hapusdeliv(<?php echo $row['id_delivfg']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                                                                </center>
                                                                                            </td> -->
                                                                                        </tr>

                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK SURJAL-->
                                                                        <div class="modal fade" id="modalcetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Laporan Surat Jalan Delivery Finish Good</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportdelivpart.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-4">
                                                                                                        <label for="nama customer">Nama Customer</label>
                                                                                                        <select class="form-control" id="p" name="p">
                                                                                                            <option value="" hidden>- Pilih Customer -</option>
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT id_cust, nama_cust FROM customer") or die(mysqli_error($conn));
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                            ?>
                                                                                                                <option value="<?php echo $data['id_cust'] ?>"><?php echo $data['nama_cust'] ?></option>

                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">No Surat Jalan</label>
                                                                                                        <select class="form-control" id="q" name="q">
                                                                                                            <option value="" hidden>- Pilih Customer Dahulu -</option>

                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit"  name="cetak"  class="btn btn-md btn-warning">CETAK</button>
                                                                                                    <!-- <a href= '' target='_blank' type="submit" name="cetak" class="btn btn-md btn-warning">CETAK</a> -->
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php include('footer.php') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    $(document).ready(function() {

        $('#example3').DataTable({});

        $('#example4').DataTable({});

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });

    function hapusdeliv(delivfg_id) {
        Swal.fire({
            title: 'Yakin Ingin Menghapus Data Ini?',
            text: "Data tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = ("delete/hapusdeliv.php?id_delivfg=" + delivfg_id)
            }
        })
    }

    function hapus(sub_id) {
        Swal.fire({
            title: 'Yakin Ingin Menghapus Data Ini?',
            text: "Data tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = ("delete/hapusdeliverysub.php?id_sub=" + sub_id)
            }
        })
    }
</script>
<script>
    $('#cust').on('change', function() {
        var cust = $(this).val();
        $.ajax({
            url: 'ambildatadeliv.php',
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

    $('#cust').on('change', function() {
        var cust = $(this).val();
        $.ajax({
            url: 'ambildatadelpo.php',
            type: "POST",
            data: {
                cust: cust
            },
            success: function(data) {
                $("#id_po").html(data);
            },
            error: function() {
                alert("Gagal Mengambil Data");
            }
        })
    })

    $('#p').on('change', function() {
        var p = $(this).val();
        $.ajax({
            url: 'ambildatadelivery.php',
            type: "POST",
            data: {
                p: p
            },
            success: function(data) {
                $("#q").html(data);
            },
            error: function() {
                alert("Gagal Mengambil Data");
            }
        })
    })





    // $('#nav-tab a').click(function(e) {
    //     e.preventDefault();
    //     $(this).tab('show');
    // });

    // // store the currently selected tab in the hash value
    // $("div.nav-tabs > a ").on("shown.bs.tab", function(e) {
    //     var id = $(e.target).attr("href").substr(1);
    //     window.location.hash = id;
    // });

    // // on load of the page: switch to the currently selected tab
    // var hash = window.location.hash;
    // $('#nav-tab a[href="' + hash + '"]').tab('show');
</script>


</script>