<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_po_supp = $_GET['id_po_supp'];
$no_po_supp = $_GET['no_po_supp'];


$query = mysqli_query($conn, "DELETE FROM po_supplier WHERE id_po_supp='$id_po_supp'");
header('location:../posupplier.php');
?>