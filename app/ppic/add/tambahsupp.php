<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$nama_supp = $_GET['nama_supp'];
$alamat_supp = $_GET['alamat_supp'];
$kontak_supp = $_GET['kontak_supp'];

$query = mysqli_query($conn, "INSERT INTO supplier(id_supp,nama_supp,alamat_supp,kontak_supp) VALUES ('','$nama_supp','$alamat_supp','$kontak_supp')");
header('location:../datasupplier.php');
?>