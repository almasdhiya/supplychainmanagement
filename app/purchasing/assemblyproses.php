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

// if (isset($_POST['tutut'])) {
//     $cust = $_POST['cust'];
//     $part = $_POST['part'];
//     $nama_welding = $_POST['nama_welding'];
//     $qty_welding = $_POST['qty_welding'];

//     $query1 = mysqli_query($conn, "INSERT INTO welding (id_welding, id_part, id_cust, nama_welding, qty_welding) VALUES ('','$part','$cust','$nama_welding','$qty_welding')");
// }

// if (isset($_POST['rei'])) {
//     $id_welding = $_POST['o'];
//     $qty_weldfg = $_POST['qty_weldfg'];

//     $query = mysqli_query($conn, "SELECT part.nama_part, part.kode_part, customer.nama_cust FROM welding 
//     inner join part on part.id_part = welding.id_part inner join customer on customer.id_cust = welding.id_cust WHERE
//     nama_welding ='$id_welding'");
//     while ($row = mysqli_fetch_array($query)) {
//         $hasil = $row['nama_part'];
//         $hasil1 = $row['kode_part'];
//         $hasil2 = $row['nama_cust'];
//         $query1 = mysqli_query($conn, "INSERT INTO weldingfg (id_weldfg, qty_weldfg, nama_part, kode_part, nama_cust, nama_welding) VALUES ('','$qty_weldfg','$hasil','$hasil1','$hasil2','$id_welding')");
//     }
// }

// if (isset($_POST['ditdit'])) {
//     $id_welding = $_POST['id_welding'];
//     $qty_welding = $_POST['qty_welding'];

//     $query1 = mysqli_query($conn, "UPDATE welding SET qty_welding='$qty_welding' WHERE id_welding='$id_welding'");
// }

if (isset($_POST['oo'])) {
    $id_spot1 = $_POST['id_spot1'];
    $qty_aktual = $_POST['qty_aktual'];
    $tgl = $_POST['tgl'];
    $qty_ng = $_POST['qty_ng'];
    $keterangan = $_POST['keterangan'];
    $id_cust = $_POST['id_cust'];
    $id_prs = $_POST['id_prs'];
    $id_part = $_POST['id_part'];
    $id_material = $_POST['id_material'];

    print_r ($id_material);
   
    // if($qty_aktual > $qty_spot){
    //     echo '<script>
    //     swal.fire({
    //         text: "Anda memasukan quantity aktual melebihi quantity spot!",
    //         icon: "warning",
    //         button: "Close!",
    //     });
    //     </script>';
    // } else {
    $query = mysqli_query($conn, "UPDATE spot1 SET qty_aktual = '$qty_aktual' - '$qty_ng',
    id_material = '$id_material', qty_ng='$qty_ng', tgl='$tgl', keterangan='$keterangan', qty_spot = qty_spot - '$qty_aktual'
    WHERE id_spot1='$id_spot1'");

    // $select = mysqli_query($conn, "SELECT qty_spott1 FROM spot1 where id_spot1 = '$id_spot1'");
    // while ($row = mysqli_fetch_array($select)) {
    //     $qty_spot1 = $row['qty_spott1'];
    $selec = mysqli_query($conn, "SELECT spot1.*, pieces.qty_pieces from spot1 inner join  
    pieces on pieces.id_material = spot1.id_material where spot1.id_spot1 = '$id_spot1'");
    while ($row = mysqli_fetch_array($selec)) {
        $qty_spot1 = $row['qty_spott1'];
        // print_r ($qty_aktual);
        // exit();
        $jaja = mysqli_query($conn, "UPDATE pieces inner join spot1 on spot1.id_material = pieces.id_material set pieces.qty_pieces =  qty_pieces - ('$qty_spot1' * '$qty_aktual') where 
        spot1.id_spot1 = '$id_spot1'");
    }
    }
// }
// }


if (isset($_POST['pp'])) {
    $id_spot2 = $_POST['id_spot2'];
    // $qty_outt = $_POST['qty_outt'];
    $id_part = $_POST['id_part'];
    $tgl = $_POST['tgl'];
    $qty_ngg = $_POST['qty_ng'];
    $keterangan = $_POST['keterangan'];
    $cust = $_POST['id_cust'];
    $nama_part = $_POST['nama_part'];
    $id_material = $_POST['id_material'];

    $selec = mysqli_query($conn, "SELECT qty_spott2, qty_outt from spot2 where id_spot2 = '$id_spot2'");
    while ($row = mysqli_fetch_array($selec)) {
        $qty_spot = $row['qty_spott2'];
        $qty_outt = $row['qty_outt'];
    // if($qty_aktual > $qty_spot){
    //     echo '<script>
    //     swal.fire({
    //         text: "Anda memasukan quantity aktual melebihi quantity spot!",
    //         icon: "warning",
    //         button: "Close!",
    //     });
    //     </script>';
    // } else {
    $query = mysqli_query($conn, "UPDATE spot2 SET id_material = '$id_material', qty_ngg='$qty_ngg',tgl='$tgl', keterangan='$keterangan'
    WHERE id_spot2='$id_spot2'");
    // $select = mysqli_query($conn, "SELECT qty_spott2 FROM spot2 where id_spot2 = '$id_spot2'");
    // while ($row = mysqli_fetch_array($select)) {
    //     $qty_spot = $row['qty_spott2'];
        $jaja = mysqli_query($conn, "UPDATE pieces inner join spot2 on spot2.id_material = pieces.id_material set pieces.qty_pieces =  qty_pieces - ('$qty_spot' * '$qty_outt') where 
        spot2.id_spot2 = '$id_spot2'");
    }
    }
// }
// }

if (isset($_POST['repair1'])) {
    $id_spot1 = $_POST['id_spot1'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_aktual,qty_ng from spot1 where id_spot1 = '$id_spot1'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_aktual = $row['qty_aktual'];
        $qty_ng = $row['qty_ng'];
        if ($qty_repair <= $qty_ng) {
            $query2 = mysqli_query($conn, "UPDATE spot1 SET qty_aktual = '$qty_aktual' + '$qty_repair', qty_ng = '$qty_ng'-'$qty_repair' WHERE id_spot1 = '$id_spot1'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair2'])) {
    $id_spot2 = $_POST['id_spot2'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outt,qty_ngg from spot2 where id_spot2 = '$id_spot2'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outt = $row['qty_outt'];
        $qty_ngg = $row['qty_ngg'];
        if ($qty_repair <= $qty_ngg) {
            $query2 = mysqli_query($conn, "UPDATE spot2 SET qty_outt = '$qty_outt' + '$qty_repair', qty_ngg = '$qty_ngg'-'$qty_repair' WHERE id_spot2 = '$id_spot2'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}


if (isset($_POST['oe'])) {
    $id_part = $_POST['id_part'];
    $id_spot1 = $_POST['id_spot1'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_aktual from spot1 where id_spot1='$id_spot1'");
        while ($row = mysqli_fetch_array($query7)) {
            $qty_aktual = $row['qty_aktual'];
            if ($spot == 1 && $qty_aktual >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_po = '$id_po') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_po = '$id_po';");
                $update = mysqli_query($conn, "UPDATE spot1 SET qty_aktual = '$qty_aktual' - '$qty_fg', kondisi ='Sudah Digunakan' where id_spot1='$id_spot1'");
                echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Data Finish Good!",
                icon: "success",
                button: "Close!",
                });
                </script>';
            } else if ($qty_fg > $qty_aktual) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($spot > 1 && $qty_aktual >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE spot2 set qty_outt = qty_outt + '$qty_fg' where id_prs ='$id_prs'");
                        $update = mysqli_query($conn, "UPDATE spot1 SET qty_aktual = '$qty_aktual' - '$qty_fg', kondisi ='Sudah Digunakan' where id_spot1='$id_spot1'");
                    } else {
                        $update = mysqli_query($conn, "UPDATE spot2 set qty_outt = '$qty_fg' where id_prs ='$id_prs'");
                        $update = mysqli_query($conn, "UPDATE spot1 SET qty_aktual = '$qty_aktual' - '$qty_fg', kondisi ='Sudah Digunakan'  where id_spot1='$id_spot1'");
                    }
                    echo '<script>
                    swal.fire({
                    text: "Produk berhasil masuk ke Spot Selanjutnya!",
                    icon: "success",
                    button: "Close!",
                    });
                    </script>';
                }
            }
        }
    }
}

if (isset($_POST['oe2'])) {
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outt from spot2 where id_spot2='$id_spot2'");
        while ($row = mysqli_fetch_array($query7)) {
            $qty_outt = $row['qty_outt'];
            if ($spot == 2 && $qty_outt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_po = '$id_po') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_po = '$id_po';");
                $update = mysqli_query($conn, "UPDATE spot2 SET qty_outt = '$qty_outt' - '$qty_fg', kondisi ='Sudah Digunakan' where id_spot2='$id_spot2'");
                echo '<script>
                swal.fire({
                text: "Produk berhasil masuk ke Data Finish Good!",
                icon: "success",
                button: "Close!",
                });
                </script>';
            } else if ($qty_fg > $qty_outt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($spot > 2 && $qty_outt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE spot2 SET qty_outt = '$qty_outt'  - '$qty_fg', kondisi ='Sudah Digunakan' where id_spot2='$id_spot2'");
                    } else {
                        $update = mysqli_query($conn, "UPDATE spot2 SET qty_outt = '$qty_outt' - '$qty_fg' , kondisi ='Sudah Digunakan' where id_spot2='$id_spot2'");
                    }
                    echo '<script>
                    swal.fire({
                    text: "Produk berhasil masuk ke Spot Selanjutnya!",
                    icon: "success",
                    button: "Close!",
                    });
                    </script>';
                }
            }
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-crop-alt mr-2"></i>Assembly Proses</h1>
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
                                                                    <!-- <nav class="nav">
                                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                            <a class="nav-item nav-link active" id="nav-spot1-tab" data-toggle="tab" href="#spot1" role="tab" aria-controls="nav-home" aria-selected="true">Spot 1</a>
                                                                            <a class="nav-item nav-link" id="nav-spot2-tab" data-toggle="tab" href="#spot2" role="tab" aria-controls="nav-contact" aria-selected="false">Spot 2</a>
                                                                        </div>
                                                                    </nav> -->
                                                                    <br>
                                                                    <!-- <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="spot1" role="tabpanel" aria-labelledby="nav-home-tab"> -->
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak" disabled><i class="fas fa-print mr-2"></i>CETAK LAPORAN SPOT</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example3" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center" width="5%">No</th>
                                                                                        <th class="text-center" width="25%">Nama | Kode Produk</th>
                                                                                        <th class="text-center" width="10%">Nama Spot</th>
                                                                                        <!-- <th class="text-center" width="10%">Material Spot</th> -->
                                                                                        <th class="text-center" width="10%">Quantity Spot Welding </th>
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center" width="10%">Tanggal Dikerjakan</th>
                                                                                        <th class="text-center" width="30%">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['q'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT spot1.*, customer.id_cust,customer.nama_cust, part.nama_part,part.kode_part,proses.proses,part.id_part,
                                                                                        proses.spot
                                                                                        FROM spot1 inner JOIN customer on customer.id_cust = spot1.id_cust 
                                                                                        inner JOIN part on part.id_part = spot1.id_part 
                                                                                        inner join proses on proses.id_prs = spot1.id_prs WHERE spot1.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT spot1.*, customer.id_cust,customer.nama_cust, part.nama_part,part.kode_part,proses.proses,part.id_part,
                                                                                        proses.spot
                                                                                        FROM spot1 inner JOIN customer on customer.id_cust = spot1.id_cust 
                                                                                        inner JOIN part on part.id_part = spot1.id_part
                                                                                        inner join proses on proses.id_prs = spot1.id_prs;");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_spot']; ?></td>
                                                                                            <!-- <td><?php echo $row['id_material']; ?></td> -->
                                                                                            <td><?php echo $row['qty_spot']; ?></td>
                                                                                            <td><?php echo $row['qty_aktual']; ?></td>
                                                                                            <td><?php echo $row['qty_ng']; ?>
                                                                                                <p><button type="button" class="btn btn-sm  btn-dark" data-toggle="modal" data-target="#modalng1-<?php echo $row['id_spot1'] ?>" disabled><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalspot1-<?php echo $row['id_spot1'] ?>" disabled><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv1-<?php echo $row['id_spot1'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv1-<?php echo $row['id_spot1'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                    <!-- <a onclick="hapus1(<?php echo $row['id_spot1']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>

                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng1-<?php echo $row['id_spot1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_spot1" name="id_spot1" value="<?php echo $row['id_spot1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Scrap</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_scrap" name="qty_scrap">
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair1" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv1-<?php echo $row['id_spot1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-4">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_spot1" name="id_spot1" value="<?php echo $row['id_spot1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-4">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-4">
                                                                                                                        <label for="nama customer">Material Spot</label>
                                                                                                                        <input type="text" class="form-control" id="matspot" name="matspot" value="<?php echo $row['id_material']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-4">
                                                                                                                        <label for="nama customer">Quantity Spot untuk 1 Part</label>
                                                                                                                        <input type="text" class="form-control" id="qty_spott1" name="qty_spott1" value="<?php echo $row['qty_spott1']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalspot1-<?php echo $row['id_spot1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="fa fa-truck mr-2"></i>Input Quantity</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_spot1" name="id_spot1" value="<?php echo $row['id_spot1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Aktual</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" required>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" autocomplete="off" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama_cust">Pilih Material Spot</label>
                                                                                                                        <select class="form-control" id="id_material" name="id_material" required>
                                                                                                                            <option hidden> - Pilih Material Spot - </option>
                                                                                                                            <?php
                                                                                                                            $select = mysqli_query($conn, "SELECT * from material");
                                                                                                                            while ($row = mysqli_fetch_array($select)) {
                                                                                                                            ?>
                                                                                                                                <option value="<?php echo $row['id_material'] ?>" | <?php echo $row['nama_material'] ?>>  <?php echo $row['nama_material'] ?> | <?php echo $row['kode_material'] ?></option>
                                                                                                                            <?php } ?>
                                                                                                                        </select>
                                                                                                                    </div>

                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_ng" name="qty_ng">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oo" class="btn btn-md btn-success">SIMPAN</button>
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
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Laporan Spot 1</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportspot1.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="q" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        <!-- </div>
                                                                        

                                                                    </div> -->
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
                                <script>
                                    // $('#cust').on('change', function() {
                                    //     var cust = $(this).val();
                                    //     $.ajax({
                                    //         url: 'ambildatawelding.php',
                                    //         type: "POST",
                                    //         data: {
                                    //             cust: cust
                                    //         },
                                    //         success: function(data) {
                                    //             $("#part").html(data);
                                    //         },
                                    //         error: function() {
                                    //             alert("Gagal Mengambil Data");
                                    //         }
                                    //     })
                                    // })

                                    $(document).ready(function() {

                                        $('#example3').DataTable({});

                                        $('#example4').DataTable({});

                                        $('#example5').DataTable({});

                                        $('#example6').DataTable({});

                                        $('#example7').DataTable({});

                                        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                                            $($.fn.dataTable.tables(true)).DataTable()
                                                .columns.adjust()
                                                .responsive.recalc();
                                        });
                                    });


                                    $('#welding').on('change', function() {
                                        var welding = $('#welding').val();
                                        $.ajax({
                                            url: 'ambildatawelding.php',
                                            type: "POST",
                                            data: {
                                                welding: welding
                                            },
                                            success: function(data) {
                                                $("#hasil").html(data);
                                            },
                                            error: function() {
                                                alert("Gagal Mengambil Data");
                                            }
                                        })
                                    })

                                    function hapus1(spot1_id) {
                                        Swal.fire({
                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                            text: "Data tidak dapat dikembalikan!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: 'red',
                                            confirmButtonText: 'Hapus'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location = ("delete/hapusspot1.php?id_spot1=" + spot1_id)
                                            }
                                        })
                                    }

                                    function hapus2(spot2_id) {
                                        Swal.fire({
                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                            text: "Data tidak dapat dikembalikan!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: 'red',
                                            confirmButtonText: 'Hapus'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                window.location = ("delete/hapusspot2.php?id_spot2=" + spot2_id)
                                            }
                                        })
                                    }

                                    // $(document).ready(function() {
                                    //     $(".add-more").click(function() {
                                    //         var html = $(".copy").html();
                                    //         $(".after-add-more").after(html);
                                    //     });

                                    //     // saat tombol remove dklik control group akan dihapus 
                                    //     $("body").on("click", ".remove", function() {
                                    //         $(this).parents(".control-group").remove();
                                    //     });
                                    // });
                                </script>
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