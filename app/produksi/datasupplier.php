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

if (isset($_POST['tambah'])) {
    $nama_supp = $_POST['nama_supp'];
    $alamat_supp = $_POST['alamat_supp'];
    $kontak_supp = $_POST['kontak_supp'];

    if ($nama_supp != "" && $alamat_supp != "" && $kontak_supp != "" || $kontak_supp == "") {
        $query = mysqli_query($conn, "INSERT INTO supplier(id_supp,nama_supp,alamat_supp,kontak_supp) VALUES ('','$nama_supp','$alamat_supp','$kontak_supp')");
        echo '<script>
        swal.fire({
            text: " Data Supplier berhasil di input!",
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
    $id_supp = $_POST['id_supp'];
    $nama_supp = $_POST['nama_supp'];
    $alamat_supp = $_POST['alamat_supp'];
    $kontak_supp = $_POST['kontak_supp'];

    $query = "UPDATE supplier SET nama_supp = '$nama_supp', alamat_supp = '$alamat_supp', kontak_supp = '$kontak_supp' WHERE id_supp = '$id_supp'";
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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-users-cog mr-2"></i>Data Supplier</h1>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-lg" disabled>
                                    <i class="fas fa-plus mr-2"></i> Supplier
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama supplier</th>
                                            <th class="text-center">Alamat supplier</th>
                                            <th class="text-center" width="100px">Kontak supplier</th>
                                            <th class="text-center" width="100px">Material</th>
                                            <th class="text-center" width="100px"> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include "../koneksi.php";
                                        $no = 1;
                                        $data = mysqli_query($conn, "SELECT * FROM supplier");
                                        while ($supp = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $supp['nama_supp']; ?></td>
                                                <td><?php echo $supp['alamat_supp']; ?></td>
                                                <td><?php echo $supp['kontak_supp']; ?></td>
                                                <td>
                                                        <center>
                                                            <a class="btn btn-sm btn-dark" href="lihatmaterial.php?id_supp=<?php echo $supp['id_supp']; ?>" id="lihatmaterial"><i class="fas fa-wrench mr-2"></i>Material</a>
                                                        </center>
                                                    </td>
                                                <td>
                                                    <center>
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-<?php echo $supp['id_supp']; ?>" disabled><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger" disabled><i class="fas fa-trash"></i></button>
                                                    </center>
                                                </td>
                                            </tr>
                                            <!-- MODAL EDIT supp -->
                                            <div class="modal fade" id="modal-<?php echo $supp['id_supp']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title" id="modalEdit">Edit Data supplier</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post" action="">
                                                            <div class="modal-body" id="detailedit">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Nama supplier</label>
                                                                        <input type="text" value="<?php echo $supp['id_supp']; ?>" name="id_supp" hidden>
                                                                        <input type="text" class="form-control" id="nama_supp" placeholder="Masukkan Nama supplier" name="nama_supp" value="<?php echo $supp['nama_supp']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Alamat supplier</label>
                                                                        <input type="text" class="form-control" id="alamat_supp" placeholder="Masukkan Alamat supplier" name="alamat_supp" value="<?php echo $supp['alamat_supp']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Kontak supplier</label>
                                                                        <input type="text" class="form-control" id="kontak_supp" placeholder="Masukkan Kontak supplier" name="kontak_supp" value="<?php echo $supp['kontak_supp']; ?>">
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
                <!-- /.container-fluid -->
                <div class="modal fade" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title"><i class="fa fa-user-plus mr-2"></i>Tambah supplier</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama supplier</label>
                                        <input type="text" autocomplete="off" class="form-control" id="nama_supp" name="nama_supp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Alamat supplier</label>
                                        <input type="text" autocomplete="off" class="form-control" id="alamat_supp" name="alamat_supp" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kontak supplier</label>
                                        <input type="text" autocomplete="off" class="form-control" id="kontak_supp"  name="kontak_supp" required>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-left">
                                    <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
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
        function hapussupp(supp_id) {
            Swal.fire({
                title: 'Yakin Ingin Menghapus Data Ini?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = ("delete/hapussupp.php?id_supp=" + supp_id)
                }
            })
        }
    </script>
</body>

</html>