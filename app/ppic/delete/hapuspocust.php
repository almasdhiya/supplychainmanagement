<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$id_po = $_GET['id_po'];


$query = mysqli_query($conn, "DELETE FROM po_customer WHERE id_po='$id_po'");
header('location:../pocustomer.php');
?>