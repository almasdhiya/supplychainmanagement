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

$id = $_GET['id_cust'];

if (isset($_POST['tambah'])) {
    $nama_part      = $_POST['nama_part'];
    $kode_part      = $_POST['kode_part'];
    $berat_jenis    = $_POST['berat_jenis'];
    // $pcs_sheet      = $_POST['pcs_sheet'];
    $spek_material  = $_POST['spek_material'];
    $ketebalan      = $_POST['ketebalan'];
    $lebar          = $_POST['lebar'];
    $panjang        = $_POST['panjang'];
    // $unit_material  = $_POST['unit_material'];
    $diameter       = $_POST['diameter'];
    $fileName       = $_FILES['gambar']['name'];
    // $sisi           = $_POST['sisi'];

    // foreach ($_POST['materialspot'] as $value) {
    // }


    // Simpan di Folder Gambar
    move_uploaded_file($_FILES['gambar']['tmp_name'], "gambar/" . $_FILES['gambar']['name']);
    // echo $nama_part;
    if ($berat_jenis > 0 && $pcs_sheet > 0 && $ketebalan > 0 && $panjang > 0 && $lebar > 0) {
        // $kg_sheet = ($ketebalan) * ($lebar) * ($panjang) * ($berat_jenis) / (1000000);
        // $angka_format = number_format($kg_sheet, 2);
        // $kg_pcs = ($kg_sheet / $pcs_sheet);
        // $format = number_format($kg_pcs, 2);
        // $kg_lembar = ($ketebalan) * (1219) * (2438) * ($berat_jenis) / (1000000);
        // $ganti = number_format($kg_lembar, 2);
        // $sheet_lembar = (2438 / $lebar);
        // $yaa = number_format($sheet_lembar, 2);
        // $pcs_lembar = ($pcs_sheet * $sheet_lembar);
        // $oi = number_format($pcs_lembar, 2);
        $query = mysqli_query($conn, "INSERT INTO part (id_part,id_cust,nama_part,kode_part,berat_jenis,
        spek_material,ketebalan,lebar,panjang,diameter,gambar) 
        VALUES('','$id','$nama_part','$kode_part','$berat_jenis','$spek_material','$ketebalan','$lebar',
        '$panjang','$diameter','$fileName')");
            echo '<script>
            swal.fire({
                text: " Data Produk berhasil di input!",
                icon: "success",
                button: "Close!",
            });
            </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO part (id_part,id_cust,nama_part,kode_part,berat_jenis,
        spek_material,ketebalan,lebar,panjang,kg_sheet,kg_pcs,kg_lembar,sheet_lembar,
        pcs_lembar,diameter,gambar) 
        VALUES('','$id','$nama_part','$kode_part','0','','0','0',
        '0','0','0','0','0','0','0','$fileName')");
            echo '<script>
            swal.fire({
                text: " Data Produk berhasil di input!",
                icon: "success",
                button: "Close!",
            });
            </script>';
    }
};


if (isset($_POST['edit'])) {
    $id_part        = $_POST['id_part'];
    $nama_part      = $_POST['nama_part'];
    $kode_part      = $_POST['kode_part'];
    $berat_jenis    = $_POST['berat_jenis'];
    // $pcs_sheet      = $_POST['pcs_sheet'];
    $spek_material  = $_POST['spek_material'];
    $ketebalan      = $_POST['ketebalan'];
    $lebar          = $_POST['lebar'];
    $panjang        = $_POST['panjang'];
    // $kg_sheet       = ($ketebalan) * ($lebar) * ($panjang) * ($berat_jenis) / (1000000);
    // $angka_format   = number_format($kg_sheet, 2);
    // $kg_pcs         = ($kg_sheet / $pcs_sheet);
    // $format         = number_format($kg_pcs, 2);
    // $kg_lembar      = ($ketebalan) * (1219) * (2438) * ($berat_jenis) / (1000000);
    // $ganti          = number_format($kg_lembar, 2);
    // $sheet_lembar   = (2438 / $lebar);
    // $yaa            = number_format($sheet_lembar, 2);
    // $pcs_lembar     = ($pcs_sheet * $sheet_lembar);
    // $oi             = number_format($sheet_lembar, 2);
    // $proses = $_POST['proses'];
    // $spot = $_POST['spot'];
    // $unit_material  = $_POST['unit_material'];
    $diameter       = $_POST['diameter'];
    $fileName       = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "gambar/" . $_FILES['gambar']['name']);

    $query = "UPDATE part SET nama_part = '$nama_part',kode_part='$kode_part',berat_jenis='$berat_jenis',
    spek_material='$spek_material',ketebalan='$ketebalan',lebar='$lebar',panjang='$panjang',diameter='$diameter',gambar='$fileName'
    WHERE id_part = '$id_part'";
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-users-cog mr-2"></i>Data Produk</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-addpart" disabled>
                                    <i class="fas fa-plus mr-2"></i>Input Produk
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
                                        $data = mysqli_query($conn, "SELECT * FROM part, customer 
                                        WHERE part.id_cust = customer.id_cust AND part.id_cust = '$id'");
                                        while ($row = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row['nama_cust']; ?></td>
                                                <td><?php echo $row['nama_part']; ?></td>
                                                <td><?php echo $row['kode_part']; ?></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-<?php echo $row['id_part']; ?>"><i class="fas fa-info-circle"></i></button>
                                                </td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit-<?php echo $row['id_part']; ?>"  disabled><i class="fas fa-edit"></i></button>
                                                    <button type="button" disabled><i class="fas fa-trash"></i></button>
                                                </td>
                                                <!-- <td align="center">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalbom-<?php echo $row['id_part']; ?>"><i class="fas fa-plus"></i></button>
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modaldetailbom-<?php echo $row['id_part']; ?>"><i class="fas fa-info-circle"></i></button>
                                                </td> -->
                                            </tr>
                                            <div class="modal fade" id="modal-<?php echo $row['id_part']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <label for="nama_part">Nama Produk</label>
                                                                            <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="nama_cust">Nama Customer</label>
                                                                            <input type="text" class="form-control" id="nama_cust" name="nama_cust" value="<?php echo $row['nama_cust']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="kode_part">Kode Produk</label>
                                                                            <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="berat_jenis">Berat Jenis</label>
                                                                            <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="<?php echo $row['berat_jenis']; ?>" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">Pieces/Sheet</label>
                                                                            <input type="text" class="form-control" id="pcs_sheet" name="pcs_sheet" value="<?php echo $row['pcs_sheet']; ?>" readonly>
                                                                        </div> -->
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
                                                                    <div class="row">
                                                                        

                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">KG/Sheet</label>
                                                                            <input type="text" class="form-control" id="kg_sheet" name="kg_sheet" value="<?php echo number_format($row['kg_sheet'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_pcs">KG/Pieces</label>
                                                                            <input type="text" class="form-control" id="kg_pcs" name="kg_pcs" value="<?php echo number_format($row['kg_pcs'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Kg/Lembar</label>
                                                                            <input type="text" class="form-control" id="kg_lembar" name="kg_lembar" value="<?php echo number_format($row['kg_lembar'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Sheet/Lembar</label>
                                                                            <input type="text" class="form-control" id="sheet_lembar" name="sheet_lembar" value="<?php echo number_format($row['sheet_lembar'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Pieces/Lembar</label>
                                                                            <input type="text" class="form-control" id="pcs_lembar" name="pcs_lembar" value="<?php echo number_format($row['pcs_lembar'], 2); ?>" readonly>
                                                                        </div> -->
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="proses">Proses</label>
                                                                            <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="spot">Spot</label>
                                                                            <input type="text" class="form-control" id="spot" name="spot" value="<?php echo $row['spot']; ?>" readonly>
                                                                        </div> -->
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="unit_material">Unit Material</label>
                                                                            <input type="text" class="form-control" id="unit_material" name="unit_material" value="<?php echo $row['unit_material']; ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="diameter">Diameter</label>
                                                                            <input type="text" class="form-control" id="diameter" name="diameter" value="<?php echo $row['diameter']; ?>" readonly>
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <br>
                                                                            <label for="diameter">Material Spot</label>
                                                                            <input type="text" class="form-control" id="" name="" value="<?php echo $row['materialspot']; ?>" readonly>
                                                                        </div> -->
                                                                        <br>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <br>
                                                                            <br>
                                                                            <div class="card border-dark mb-3">
                                                                                <div class="card-header bg-info"><i class="fas fa-image mr-2"></i>Foto Produk</div>
                                                                                <div class="card-body img">
                                                                                    <br>
                                                                                    <img src="gambar/<?php echo $row['gambar']; ?>" class="form-control" id="gambar" name="gambar" readonly style="width: 200px; height: 170px">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="modalEdit-<?php echo $row['id_part']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h4 class="modal-title"><i class="fa fa-edit mr-2"></i>Edit Produk</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label for="nama_part">Nama Produk</label>
                                                                            <input type="text" value="<?php echo $row['id_part']; ?>" name="id_part" hidden>
                                                                            <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="kode_part">Kode Produk</label>
                                                                            <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="berat_jenis">Berat Jenis</label>
                                                                            <input type="text" class="form-control" id="berat_jenis" name="berat_jenis" value="<?php echo $row['berat_jenis']; ?>">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            
                                                                            <label for="spek_material">Spesifikasi Material</label>
                                                                            <input type="text" class="form-control" id="spek_material" name="spek_material" value="<?php echo $row['spek_material']; ?>">
                                                                        </div>
                                                                        <!-- <div class="col-3">
                                                                            <label for="pcs_sheet">Pieces/Sheet</label>
                                                                            <input type="text" class="form-control" id="pcs_sheet" name="pcs_sheet" value="<?php echo $row['pcs_sheet']; ?>">
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="row">
                                                                        
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
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="diameter">Diameter</label>
                                                                            <input type="text" class="form-control" id="diameter" name="diameter" value="<?php echo $row['diameter']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <!-- <div class="row">
                                                                        <div class="col-4">
                                                                            <label for="proses">Proses</label>
                                                                            <select class="form-control" id="proses" name="proses">
                                                                                <option value="" hidden>- Pilih Proses -</option>
                                                                                <option value="1" <?php if ($row['proses'] == '1') echo 'selected' ?>>1 Proses</option>
                                                                                <option value="2" <?php if ($row['proses'] == '2') echo 'selected' ?>>2 Proses</option>
                                                                                <option value="3" <?php if ($row['proses'] == '3') echo 'selected' ?>>3 Proses</option>
                                                                                <option value="4" <?php if ($row['proses'] == '4') echo 'selected' ?>>4 Proses</option>
                                                                                <option value="5" <?php if ($row['proses'] == '5') echo 'selected' ?>>5 Proses</option>
                                                                                <option value="6" <?php if ($row['proses'] == '6') echo 'selected' ?>>6 Proses</option>
                                                                                <option value="7" <?php if ($row['proses'] == '7') echo 'selected' ?>>7 Proses</option>
                                                                                <option value="8" <?php if ($row['proses'] == '8') echo 'selected' ?>>8 Proses</option>
                                                                                <option value="9" <?php if ($row['proses'] == '9') echo 'selected' ?>>9 Proses</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label for="spot">Spot</label>
                                                                            <select class="form-control" id="spot" name="spot">
                                                                                <option value="" hidden>- Pilih Spot -</option>
                                                                                <option value="1" <?php if ($row['spot'] == '1') echo 'selected' ?>>1 Spot</option>
                                                                                <option value="2" <?php if ($row['spot'] == '2') echo 'selected' ?>>2 Spot</option>
                                                                                <option value="3" <?php if ($row['spot'] == '3') echo 'selected' ?>>3 Spot</option>
                                                                                <option value="4" <?php if ($row['spot'] == '4') echo 'selected' ?>>4 Spot</option>
                                                                                <option value="Nonspot" <?php if ($row['spot'] == 'Nonspot') echo 'selected' ?>>Non Spot</option>
                                                                            </select>
                                                                        </div> -->
                                                                    <!-- <div class="row">
                                                                        <br>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="pcs_sheet">KG/Sheet</label>
                                                                            <input type="text" class="form-control" id="kg_sheet" name="kg_sheet" value="<?php echo number_format($row['kg_sheet'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_pcs">KG/Pieces</label>
                                                                            <input type="text" class="form-control" id="kg_pcs" name="kg_pcs" value="<?php echo number_format($row['kg_pcs'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Kg/Lembar</label>
                                                                            <input type="text" class="form-control" id="kg_lembar" name="kg_lembar" value="<?php echo number_format($row['kg_lembar'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Sheet/Lembar</label>
                                                                            <input type="text" class="form-control" id="sheet_lembar" name="sheet_lembar" value="<?php echo number_format($row['sheet_lembar'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <br>
                                                                            <label for="kg_lembar">Pieces/Lembar</label>
                                                                            <input type="text" class="form-control" id="pcs_lembar" name="pcs_lembar" value="<?php echo number_format($row['pcs_lembar'], 2); ?>" readonly>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <br>
                                                                            <label for="unit_material">Unit Material</label>
                                                                            <select class="form-control" id="unit_material" name="unit_material">
                                                                                <option value="" hidden>- Pilih Material -</option>
                                                                                <option value="Lembar" <?php if ($row['unit_material'] == 'Lembar') echo 'selected' ?>>Lembar</option>
                                                                                <option value="Sheet" <?php if ($row['unit_material'] == 'Sheet') echo 'selected' ?>>Sheet</option>
                                                                                <option value="Coil" <?php if ($row['unit_material'] == 'Coil') echo 'selected' ?>>Coil</option>
                                                                                <option value="Pieces" <?php if ($row['unit_material'] == 'Pieces') echo 'selected' ?>>Pieces</option>
                                                                                <option value="Tube" <?php if ($row['unit_material'] == 'Tube') echo 'selected' ?>>Tube</option>
                                                                            </select>
                                                                        </div> -->
                                                                        

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <br>
                                                                            <div class="card border-dark mb-3" style="max-width: 250rem;">
                                                                                <div class="card-header bg-info"><i class="fas fa-image mr-2"></i>Foto Produk</div>
                                                                                <div class="card-body img">
                                                                                    <img src="gambar/<?php echo $row['gambar'] ?>" width="150px" height="120px" /></br>
                                                                                    <input name="gambar" type="file" class="form-control">
                                                                                </div>
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
                                                <label for="nama_part">Nama Produk</label>
                                                <input type="text" autocomplete="off" class="form-control" id="nama_part" name="nama_part" required>
                                            </div>
                                            <div class="col-3">
                                                <label for="kode_part">Kode Produk</label>
                                                <input type="text" autocomplete="off" class="form-control" id="kode_part" name="kode_part" required>
                                            </div>
                                            <div class="col-3">
                                                <label for="berat_jenis">Berat Jenis</label>
                                                <input type="text" autocomplete="off" class="form-control" id="berat_jenis" name="berat_jenis">
                                            </div>
                                            <div class="col-3">
                                                <label for="spek_material">Spesifikasi Produk</label>
                                                <input type="text" autocomplete="off" class="form-control" id="spek_material" name="spek_material">
                                            </div>
                                            <!-- <div class="col-3">
                                                <label for="pcs_sheet">Pieces/Sheet</label>
                                                <input type="text" autocomplete="off" class="form-control" id="pcs_sheet" name="pcs_sheet">
                                            </div> -->
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
                                            <div class="col-3">
                                                <label for="diameter">Diameter</label>
                                                <input type="text" autocomplete="off" class="form-control" id="diameter" name="diameter">
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-3">
                                                <label for="proses">Proses</label>
                                                <select class="form-control" id="prosess" name="prosess" required>
                                                    <option value="" hidden>- Pilih Proses -</option>
                                                    <option value="1">1 Proses</option>
                                                    <option value="2">2 Proses</option>
                                                    <option value="3">3 Proses</option>
                                                    <option value="4">4 Proses</option>
                                                    <option value="5">5 Proses</option>
                                                    <option value="6">6 Proses</option>
                                                    <option value="7">7 Proses</option>
                                                    <option value="8">8 Proses</option>
                                                    <option value="9">9 Proses</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="spot">Spot</label>
                                                <select class="form-control" id="spott" name="spott" required>
                                                    <option value="" hidden>- Pilih Spot -</option>
                                                    <option value="1">1 Spot</option>
                                                    <option value="2">2 Spot</option>
                                                    <option value="3">3 Spot</option>
                                                    <option value="4">4 Spot</option>
                                                    <option value="Nonspot">Non Spot</option>
                                                </select>
                                            </div> -->
                                        <br>
                                        <div class="row">
                                            <!-- <div class="col-3">
                                                <label for="unit_material">Unit Material</label>
                                                <select class="form-control" id="unit_material" name="unit_material" required>
                                                    <option value="" hidden>- Pilih Material -</option>
                                                    <option value="Lembar">Lembar</option>
                                                    <option value="Sheet">Sheet</option>
                                                    <option value="Coil">Coil</option>
                                                    <option value="Pieces">Pieces</option>
                                                    <option value="Tube">Tube</option>
                                                </select>
                                            </div> -->
                                            
                                            <div class="col-4">
                                                <label for="gambar">Foto Produk</label>
                                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <div class="checkbox-group required">
                                                    <label for="spot">Material Spot</label>
                                                    <p>
                                                        <input type="checkbox" name="materialspot[]" value="Ya" class="mr-2">Ya</label>
                                                        &nbsp; &nbsp;
                                                        <input type="checkbox" name="materialspot[]" value="Tidak" class="mr-2">Tidak</label>
                                                    </p>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-3">
                                                <label for="kode_part">Qty spot untuk 1 produk</label>
                                                <input type="text" autocomplete="off" class="form-control" id="sisi" name="sisi">
                                            </div> -->
                                            <div class="form-group col-md-3">
                                                <div class="form-row proses">

                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <div class="form-row spot">

                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        

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
        function hapuspart(part_id, id_cust) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapuspart.php?id_part=" + part_id + "&&id_cust=" + id_cust)
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