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


if (isset($_POST['convert'])) {
    $id_po_supp = $_POST['id_po_supp'];
    $id_material = $_POST['id_material'];
    $id_supp = $_POST['id_supp'];
    $id_mtl = $_POST['id_mtl'];
    $qty_sheet = $_POST['qty_sheet'];
    $surjal = $_POST['surjal'];

    $query3 = mysqli_query($conn, "SELECT id_material FROM shearing_material where id_material = '$id_material'");
    $check = mysqli_num_rows($query3);

    if ($check == 1) {

        $update = mysqli_query($conn, "UPDATE shearing_material SET qty_sheet = qty_sheet + '$qty_sheet'
        WHERE id_material ='$id_material'");
        $update = mysqli_query($conn, "UPDATE po_supplier SET satuan1 = 'Sheet' WHERE id_mtl ='$id_mtl'");
        $update = mysqli_query($conn, "UPDATE material_recipt SET status1 = 'Sudah Digunakan' WHERE id_mtl ='$id_mtl'");
        echo '<script>
         swal.fire({
             text: "Berhasil di Konversi!",
             icon: "success",
             button: "Close!",
         });
         </script>';
         
    } else {

        $query1 = mysqli_query($conn, "INSERT INTO shearing_material (id_mat, id_mtl,id_material,id_supp, id_po_supp,qty_sheet, surjal) VALUES ('','$id_mtl','$id_material','$id_supp','$id_po_supp','$qty_sheet','$surjal')");
        $update = mysqli_query($conn, "UPDATE po_supplier SET satuan1 = 'Sheet' WHERE id_mtl ='$id_mtl'");
        $update = mysqli_query($conn, "UPDATE material_recipt SET status1 = 'Sudah Digunakan' WHERE id_mtl ='$id_mtl'");
        echo '<script>
            swal.fire({
                text: "Berhasil di Konversi!",
                icon: "success",
                button: "Close!",
            });
            </script>';
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-truck mr-2"></i>Data Material</h1>
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
                                                                            <a class="nav-item nav-link active" data-toggle="tab" href="#del" aria-selected="true">Lembar</a>
                                                                            <a class="nav-item nav-link" data-toggle="tab" href="#rek" aria-selected="false">Sheet</a>
                                                                            <a class="nav-item nav-link" data-toggle="tab" href="#kp" aria-selected="false">Pieces</a>
                                                                        </div>
                                                                    </nav>
                                                                    <br>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="del" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <table id="example3" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center">Nama Supplier</th>
                                                                                        <th class="text-center">Kode Material</th>
                                                                                        <th class="text-center">Material</th>
                                                                                        <th class="text-center">Spek Material</th>
                                                                                        <th class="text-center" width="50px">Jumlah Stok</th>
                                                                                        <th class="text-center" width="100px">Convert</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    include('../koneksi.php');
                                                                                    $no = 1;
                                                                                    $data = mysqli_query($conn, "SELECT material_recipt.*, material.*, supplier.*, po_supplier.* FROM material_recipt
                                                                                    inner join material on material.id_material = material_recipt.id_material
                                                                                    inner join supplier on supplier.id_supp = material_recipt.id_supp
                                                                                    inner join po_supplier on po_supplier.id_po_supp = material_recipt.id_po_supp
                                                                                    where po_supplier.satuan = 'Lembar';
                                                                                    ");

                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>

                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_supp']; ?></td>
                                                                                            <td><?php echo $row['kode_material']; ?></td>
                                                                                            <td><?php echo $row['nama_material']; ?></td>
                                                                                            <td><?php echo $row['spek_material']; ?></td>
                                                                                            <td><?php echo $row['qty_dikirim']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <!-- <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalconvert-<?php echo $row['id_po_supp'] ?>"><i class="fas fa-save"></i></button> -->
                                                                                                    <?php if ($row['status1'] ==  'Sudah Digunakan') { ?>
                                                                                                        <input type="button" class="btn btn-sm btn-success" value="Convert to Sheet" data-toggle="modal" data-target="#modalconvert-<?php echo $row['id_mtl'] ?>" disabled>
                                                                                                    <?php } else { ?>
                                                                                                        <input type="button" class="btn btn-sm btn-success" value="Convert to Sheet" data-toggle="modal" data-target="#modalconvert<?php echo $row['id_mtl'] ?>" button type="button">
                                                                                                    <?php } ?>

                                                                                                </center>
                                                                                            </td>

                                                                                        </tr>
                                                                                        <div class="modal fade" id="modalconvert<?php echo $row['id_mtl'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="fas fa-dice-two mr-2"></i>Convert to sheet</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form method="post" action="">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="row">
                                                                                                                <div class="col-3">
                                                                                                                    <label for="kode_part">Kode Material</label>
                                                                                                                    <input type="text" class="form-control" id="id_po_supp" name="id_po_supp" value="<?php echo $row['id_po_supp']; ?>" hidden>
                                                                                                                    <input type="text" class="form-control" id="id_material" name="id_material" value="<?php echo $row['id_material']; ?>" hidden>
                                                                                                                    <input type="text" class="form-control" id="id_mtl" name="id_mtl" value="<?php echo $row['id_mtl']; ?>" hidden>
                                                                                                                    <input type="text" class="form-control" id="surjal" name="surjal" value="<?php echo $row['surjal']; ?>" hidden>
                                                                                                                    <input type="text" class="form-control" id="id_supp" name="id_supp" value="<?php echo $row['id_supp']; ?>" hidden>
                                                                                                                    <input type="text" class="form-control" id="kode_material" name="kode_material" value="<?php echo $row['kode_material']; ?>" readonly>
                                                                                                                </div>
                                                                                                                <div class="col-3">
                                                                                                                    <label for="qty_sheet">Quantity Sheet</label>
                                                                                                                    <input type="text" autocomplete="off" class="form-control" id="qty_sheet" name="qty_sheet" required>
                                                                                                                    <input type="text" autocomplete="off" class="form-control" id="status1" name="status1" hidden>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="modal-footer justify-content-left">
                                                                                                            <button type="submit" class="btn btn-primary" name="convert">Convert</button>
                                                                                                            <button type="reset" class="btn btn-warning">Reset</button>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>

                                                                                                <!-- /.modal-dialog -->
                                                                                            </div>
                                                                                        </div>

                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="rek" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <table id="example4" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center">Nama Supplier</th>
                                                                                        <th class="text-center">Kode Material</th>
                                                                                        <th class="text-center">Material</th>
                                                                                        <th class="text-center">Spek Material</th>
                                                                                        <th class="text-center" width="50px">Jumlah Stok</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    include('../koneksi.php');
                                                                                    $no = 1;
                                                                                    $data = mysqli_query($conn, "SELECT shearing_material.*, material.*, supplier.*, po_supplier.* FROM shearing_material
                                                                                    inner join material on material.id_material = shearing_material.id_material
                                                                                    inner join supplier on supplier.id_supp = shearing_material.id_supp
                                                                                    inner join po_supplier on po_supplier.id_po_supp = shearing_material.id_po_supp;
                                                                                    ");
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_supp']; ?></td>
                                                                                            <td><?php echo $row['kode_material']; ?></td>
                                                                                            <td><?php echo $row['nama_material']; ?></td>
                                                                                            <td><?php echo $row['spek_material']; ?></td>
                                                                                            <td><?php echo $row['qty_sheet']; ?></td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="kp" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <table id="example5" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center">Nama Supplier</th>
                                                                                        <th class="text-center">Kode Material</th>
                                                                                        <th class="text-center">Material</th>
                                                                                        <th class="text-center">Spek Material</th>
                                                                                        <th class="text-center" width="50px">Jumlah Stok</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    include('../koneksi.php');
                                                                                    $no = 1;
                                                                                    $data = mysqli_query($conn, "SELECT pieces.*, material.*, supplier.*, po_supplier.* FROM pieces
                                                                                    inner join material on material.id_material = pieces.id_material
                                                                                    inner join supplier on supplier.id_supp = pieces.id_supp
                                                                                    inner join po_supplier on po_supplier.id_po_supp = pieces.id_po_supp;
                                                                                    ");
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_supp']; ?></td>
                                                                                            <td><?php echo $row['kode_material']; ?></td>
                                                                                            <td><?php echo $row['nama_material']; ?></td>
                                                                                            <td><?php echo $row['spek_material']; ?></td>
                                                                                            <td><?php echo $row['qty_pieces']; ?></td>
                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
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

<?php include("footer.php") ?>
<script>
    $(document).ready(function() {

        $('#example3').DataTable({});
        $('#example4').DataTable({});
        $('#example5').DataTable({});

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });


    // $(document).ready(function() {
    //     $('.modalconvert').click(function() {
    //         var userid = $(this).data('id');
    //         alert(userid);
    //     });
    // });


    // $(userid).attr("disabled", true);
    //        localStorage.setItem('disabled', [userid]);
    //     $('button[type=submit]').one('submit', function() {
    //      $(this).attr('disabled','disabled');
    //  });

    //     $('.huu').click(function(){
    //         var ItemID=$(this).attr('data-target');
    //     $('#modalconvert').on('hide.bs.modal', function () {
    //     $('#modalconvert').find('form')[0].reset();
    // })
    //     })

    //     $(document).ready(function() {
    //     var isshow = localStorage.getItem('isshow');
    //     if (isshow === null) {
    //         localStorage.setItem('isshow', 1);
    //         // Show popup here
    //         $('.modalconvert').modal('show');
    //     } else {
    //       alert('nothing');
    //     }
    // });

    // const button = document.querySelector('button[name="huu"]');

    // button.addEventListener('click', function() {
    //     localStorage.setItem('showModal', true);
    //     localStorage.getItem('showModal');

    // });
</script>