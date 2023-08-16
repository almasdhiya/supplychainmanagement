<meta http-equiv="refresh" content="1800; url=login.php">
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

$id_supp = $_GET['id_supp'];

if (isset($_POST['tambah'])) {
    $nama_material   = $_POST['nama_material'];
    $kode_material   = $_POST['kode_material'];
    $berat_jenis    = $_POST['berat_jenis'];
    $spek_material  = $_POST['spek_material'];
    $ketebalan      = $_POST['ketebalan'];
    $lebar          = $_POST['lebar'];
    $panjang        = $_POST['panjang'];
    // if ($berat_jenis > 0 && $ketebalan > 0 && $panjang > 0 && $lebar > 0) {

    //     @$pcs_sheet = ($ketebalan) * ($lebar) * ($panjang) * ($berat_jenis) / (1000000);
    //     $angka_format = number_format($pcs_sheet, 2);

    $query = mysqli_query($conn, "INSERT INTO material (id_material,id_supp,nama_material,kode_material,berat_jenis,
        spek_material,ketebalan,lebar,panjang) 
        VALUES('','$id_supp','$nama_material','$kode_material','$berat_jenis','$spek_material',
        '$ketebalan','$lebar','$panjang')");
         echo '<script>
         swal.fire({
             text: " Data Material berhasil di input!",
             icon: "success",
             button: "Close!",
         });
         </script>';
    // } else {
    //     $query = mysqli_query($conn, "INSERT INTO material (id_material,id_supp,nama_material,kode_material,berat_jenis,
    //         spek_material,ketebalan,lebar,panjang,pcs_sheet) 
    //         VALUES('','$id_supp','$nama_material','$kode_material','0','',
    //         '0','0','0','0')");
    // }
}




if (isset($_POST['edit'])) {
    $id_material = $_POST['id_material'];
    $nama_material    = $_POST['nama_material'];
    $kode_material     = $_POST['kode_material'];
    $berat_jenis    = $_POST['berat_jenis'];
    // $pcs_sheet      = $_POST['pcs_sheet'];
    $spek_material  = $_POST['spek_material'];
    $ketebalan      = $_POST['ketebalan'];
    $lebar          = $_POST['lebar'];
    $panjang        = $_POST['panjang'];
    @$pcs_sheet = ($ketebalan) * ($lebar) * ($panjang) * ($berat_jenis) / (1000000);
    $angka_format = number_format($pcs_sheet, 2);

    $query = "UPDATE material SET nama_material = '$nama_material',kode_material='$kode_material',berat_jenis='$berat_jenis',
    pcs_sheet='$angka_format',spek_material='$spek_material',ketebalan='$ketebalan',lebar='$lebar',panjang='$panjang'
    WHERE id_material = '$id_material'";
    $qr = mysqli_query($conn, $query);
};

?>

<!DOCTYPE html>
<html>
<style>

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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-users-cog mr-2"></i>Data Material</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-addpart">
                                    <i class="fas fa-plus mr-2"></i>Input Material
                                </button>
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-addparttambah">
                                    <i class="fas fa-plus mr-2"></i>Input Material Tambahan
                                </button> -->
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Kode Produk</th>
                                            <th class="text-center" width="10%">Detail Produk</th>
                                            <th class="text-center" width="10%">Action</th>
                                            <!-- <th class="text-center" width="10%">BOM</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = mysqli_query($conn, "SELECT supplier.*, material.* from material INNER JOIN supplier on supplier.id_supp = material.id_supp where material.id_supp = '$id_supp';");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nama_supp']; ?></td>
                                                <td><?php echo $row['nama_material']; ?></td>
                                                <td><?php echo $row['kode_material']; ?></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-<?php echo $row['id_material']; ?>"><i class="fas fa-info-circle"></i></button>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit-<?php echo $row['id_material']; ?>"><i class="fas fa-edit"></i></button>
                                                    <a onclick="hapusmaterial(<?php echo $row['id_material']; ?>,<?php echo $row['id_supp']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                                <!-- <td align="center">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalbom-<?php echo $row['id_part']; ?>"><i class="fas fa-plus"></i></button>
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modaldetailbom-<?php echo $row['id_part']; ?>"><i class="fas fa-info-circle"></i></button>
                                                </td> -->
                                            </tr>
                                            <div class="modal fade" id="modal-<?php echo $row['id_material']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">
                                                            <h4 class="modal-title"><i class="fa fa-wrench mr-2"></i>Detail Produk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label for="nama_part">Nama Material</label>
                                                                            <input type="text" class="form-control" id="nama_part" name="nama_material" value="<?php echo $row['nama_material']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="nama_cust">Nama Supplier</label>
                                                                            <input type="text" class="form-control" id="nama_cust" name="nama_supplier" value="<?php echo $row['nama_supp']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="kode_part">Kode Material</label>
                                                                            <input type="text" class="form-control" id="kode_part" name="kode_material" value="<?php echo $row['kode_material']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="berat_jenis">Berat Jenis</label>
                                                                            <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="<?php echo $row['berat_jenis']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">

                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="spek_material">Spesifikasi Material</label>
                                                                            <input type="text" class="form-control" id="spek_material" name="spek_material" value="<?php echo $row['spek_material']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="ketebalan">Ketebalan</label>
                                                                            <input type="text" class="form-control" id="ketebalan" name="ketebalan" value="<?php echo $row['ketebalan']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Lebar</label>
                                                                            <input type="text" class="form-control" id="lebar" name="lebar" value="<?php echo $row['lebar']; ?>" readonly>
                                                                        </div>

                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Panjang</label>
                                                                            <input type="text" class="form-control" id="panjang" name="panjang" value="<?php echo $row['panjang']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalEdit-<?php echo $row['id_material']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Material</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post" enctype="">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                    <div class="col-3">
                                                                            <label for="nama_part">Nama Supplier</label>
                                                                            <input type="text" class="form-control" id="nama_material" name="nama_supplier" value="<?php echo $row['nama_supp']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="nama_part">Nama Material</label>
                                                                            <input type="text" value="<?php echo $row['id_material']; ?>" name="id_material" hidden>
                                                                            <input type="text" class="form-control" id="nama_material" name="nama_material" value="<?php echo $row['nama_material']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="kode_part">Kode Material</label>
                                                                            <input type="text" class="form-control" id="kode_material" name="kode_material" value="<?php echo $row['kode_material']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="berat_jenis">Berat Jenis</label>
                                                                            <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="<?php echo $row['berat_jenis']; ?>">
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <label for="pcs_sheet">Pieces/Sheet</label>
                                                                            <input type="text" class="form-control" id="pcs_sheet" name="pcs_sheet" value="<?php echo $row['pcs_sheet']; ?>" readonly>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="spek_material">Spesifikasi Material</label>
                                                                            <input type="text" class="form-control" id="spek_material" name="spek_material" value="<?php echo $row['spek_material']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="ketebalan">Ketebalan</label>
                                                                            <input type="text" class="form-control" id="ketebalan" name="ketebalan" value="<?php echo $row['ketebalan']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="lebar">Lebar</label>
                                                                            <input type="text" class="form-control" id="lebar" name="lebar" value="<?php echo $row['lebar']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="panjang">Panjang</label>
                                                                            <input type="text" class="form-control" id="panjang" name="panjang" value="<?php echo $row['panjang']; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer justify-content-left">
                                                                        <button type="submit" class="btn btn-primary" name="edit">Update</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-addpart">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title"><i class="fa fa-user-plus mr-2"></i>Tambah produk</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="nama_part">Nama Material</label>
                                                <input type="text" autocomplete="off" class="form-control" id="nama_material" name="nama_material" required>
                                            </div>
                                            <div class="col-3">
                                                <label for="kode_part">Kode Material</label>
                                                <input type="text" autocomplete="off" class="form-control" id="kode_material" name="kode_material" required>
                                            </div>
                                            <div class="col-3">
                                                <label for="berat_jenis">Berat Jenis</label>
                                                <input type="text" autocomplete="off" class="form-control" id="berat_jenis" name="berat_jenis">
                                            </div>
                                            <div class="col-3">
                                                <label for="spek_material">Spesifikasi Material</label>
                                                <input type="text" autocomplete="off" class="form-control" id="spek_material" name="spek_material">
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="ketebalan">Ketebalan</label>
                                                <input type="text" autocomplete="off" class="form-control" id="ketebalan" name="ketebalan">
                                            </div>
                                            <div class="col-3">
                                                <label for="lebar">Lebar</label>
                                                <input type="text" autocomplete="off" class="form-control" id="lebar" name="lebar">
                                            </div>
                                            <div class="col-3">
                                                <label for="panjang">Panjang</label>
                                                <input type="text" autocomplete="off" class="form-control" id="panjang" name="panjang">
                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-left">
                                            <button class="btn btn-primary" name="tambah">Submit</button>
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
    </div>
    <?php include('footer.php') ?>
    <script>
        function hapusmaterial(material_id, id_supp) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapusmaterial.php?id_material=" + material_id + "&&id_supp=" + id_supp)
                }
            })
        }

        // $('prosess').change(function() {
        //     const num = $(this).val()
        //     let html = '';

        //     $('input[type="text"]').remove();

        //     for (i = 0; i < num; i++) {
        //         html += '<input type="text" name="proses.i">'
        //     }

        //     $('prosess').append(html)

        // })

        $(document).ready(function() {
            $('#prosess').change(function() {
                //Use $option (with the "$") to see that the variable is a jQuery object
                var $option = $(this).find('option:selected');
                //Added with the EDIT
                var data = $option.val(); //to get content of "value" attrib
                console.log(data)
                $('.proses').load("proses1.php?id_cust=" + data);
            });
        });

        $(document).ready(function() {
            $('#spott').change(function() {
                //Use $option (with the "$") to see that the variable is a jQuery object
                var $option = $(this).find('option:selected');
                //Added with the EDIT
                var data = $option.val(); //to get content of "value" attrib
                console.log(data)
                $('.spot').load("spot.php?id_cust=" + data);
            });
        });
    </script>
    <!-- <script>
        $(document).on('change', '#prosess', function() {
            var proses = $('#prosess').val();

            var proses1 = $(this).find('#proses1').val();

            if (proses1 !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'proses1.php',
                    data: {
                        proses: proses
                    },
                    success: function(data) {
                        $("#proses1").html(data);
                    }
                });
            }
        })

        $(document).on('change', '#prosess', function() {
            var proses = $('#prosess').val();

            var proses2 = $(this).find('#proses2').val();

            if (proses2 !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'proses1.php',
                    data: {
                        proses: proses
                    },
                    success: function(data) {
                        $("#proses2").html(data);
                    }
                });
            }
        })
    </script> -->


</body>

</html>