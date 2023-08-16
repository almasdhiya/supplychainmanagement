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

if (isset($_POST['simpan'])) {
    $nama_cust = $_POST['nama_cust'];
    $nickname = $_POST['nickname'];
    $alamat_cust = $_POST['alamat_cust'];
    $kontak_cust = $_POST['kontak_cust'];

    if ($nama_cust != "" && $nickname != "" && $alamat_cust != "" && $kontak_cust != "" || $kontak_cust == "") {
        $query = mysqli_query($conn, "INSERT INTO customer (id_cust,nama_cust,nickname,alamat_cust,kontak_cust) VALUES ('','$nama_cust','$nickname','$alamat_cust','$kontak_cust')");
        echo '<script>
        swal.fire({
            text: " Data Customer berhasil di input!",
            icon: "success",
            button: "Close!",
        });
        </script>';
    } else {
        echo '<script>
            swal.fire({
                text: "Isi data terlebih dahulu!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
    }
}
if (isset($_POST['submit'])) {
    $id_cust = $_POST['id_cust'];
    $nama_cust = $_POST['nama_cust'];
    $nickname = $_POST['nickname'];
    $alamat_cust = $_POST['alamat_cust'];
    $kontak_cust = $_POST['kontak_cust'];

    $query = "UPDATE customer SET nama_cust = '$nama_cust', nickname = '$nickname', alamat_cust = '$alamat_cust', kontak_cust = '$kontak_cust' WHERE id_cust = '$id_cust'";
    $qr = mysqli_query($conn, $query);
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
                            <div class="col card-header text-right">
                                <h1 class="card-title font-weight-bold"><i class="fas fa-users-cog mr-2"></i>Data customer</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg" disabled>
                                    <i class="fas fa-plus mr-2"></i> Customer
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="table-responsive">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama customer</th>
                                                <th class="text-center">Nickname</th>
                                                <th class="text-center">Alamat customer</th>
                                                <th class="text-center" width="100px">Kontak customer</th>
                                                <th class="text-center" width="100px">Produk</th>
                                                <th class="text-center" width="100px"> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php include "../koneksi.php";
                                            $no = 1;
                                            $data = mysqli_query($conn, "SELECT * FROM customer");
                                            while ($cust = mysqli_fetch_array($data)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $cust['nama_cust']; ?></td>
                                                    <td><?php echo $cust['nickname']; ?></td>
                                                    <td><?php echo $cust['alamat_cust']; ?></td>
                                                    <td><?php echo $cust['kontak_cust']; ?></td>
                                                    <td>
                                                        <center>
                                                            <a class="btn btn-sm btn-dark" href="lihatpart.php?id_cust=<?php echo $cust['id_cust']; ?>" id="lihatpart"><i class="fas fa-wrench mr-2"></i>Produk</a>
                                                            <!-- <a class="btn btn-sm btn-primary" href="parttambahan.php?id_cust=<?php echo $cust['id_cust']; ?>" id="parttambahan"><i class="fas fa-wrench mr-2"></i>additional</a> -->
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-<?php echo $cust['id_cust']; ?>" disabled><i class="fas fa-edit"></i></button>
                                                            <button type="button"class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <!-- MODAL EDIT cust -->
                                                <div class="modal fade" id="modal-<?php echo $cust['id_cust']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-warning">
                                                                <h5 class="modal-title" id="modalEdit"><i class="fa fa-edit mr-2"></i>Edit Data customer</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="post" action="">
                                                                <div class="modal-body" id="detailedit">
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Nama customer</label>
                                                                            <input type="text" value="<?php echo $cust['id_cust']; ?>" name="id_cust" hidden>
                                                                            <input type="text" class="form-control" id="nama_cust" placeholder="Masukkan Nama custlier" name="nama_cust" value="<?php echo $cust['nama_cust']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Nickname</label>
                                                                            <input type="text" value="<?php echo $cust['nickname']; ?>" name="nickname" hidden>
                                                                            <input type="text" class="form-control" id="nama_cust" placeholder="" name="nickname" value="<?php echo $cust['nickname']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputPassword1">Alamat customer</label>
                                                                            <input type="text" class="form-control" id="alamat_cust" placeholder="Masukkan Alamat custlier" name="alamat_cust" value="<?php echo $cust['alamat_cust']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputPassword1">Kontak customer</label>
                                                                            <input type="text" class="form-control" id="kontak_cust" placeholder="Masukkan Kontak custlier" name="kontak_cust" value="<?php echo $cust['kontak_cust']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-left">
                                                                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- MODAL TAMBAH CUST-->
                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title"><i class="fa fa-user-plus mr-2"></i>Tambah customer</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama customer</label>
                                            <input type="text" autocomplete="off" class="form-control" id="nama_cust" name="nama_cust" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nickname</label>
                                            <input type="text" autocomplete="off" class="form-control" id="nickname" name="nickname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Alamat customer</label>
                                            <input type="text" autocomplete="off" class="form-control" id="alamat_cust" name="alamat_cust" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Kontak customer</label>
                                            <input type="text" autocomplete="off" class="form-control" id="kontak_cust" name="kontak_cust">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-left">
                                        <button type="submit" class="btn btn-primary" name="simpan" id="simpan">Simpan</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- /.content -->
            </div>

        </div>
    </div>
    </div>
    <?php include('footer.php') ?>
    <script>
        function hapuscust(cust_id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapuscust.php?id_cust=" + cust_id)
                }
            })
        }
    </script>
</body>

</html>