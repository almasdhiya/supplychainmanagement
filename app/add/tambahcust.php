<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$nama_cust = $_GET['nama_cust'];
$nickname = $_GET['nickname'];
$alamat_cust = $_GET['alamat_cust'];
$kontak_cust = $_GET['kontak_cust'];
if ($id_cust != "" && $nama_cust != "" && $nickname != "" && $alamat_cust != "" && $kontak_cust != "") {
$query = mysqli_query($conn, "INSERT INTO customer(id_cust,nama_cust,nickname,alamat_cust,kontak_cust) VALUES ('','$nama_cust','$nickname','$alamat_cust','$kontak_cust')");
header('location:../datacustomer.php');
}
