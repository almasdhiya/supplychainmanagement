<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');

$data = $_GET['id_prs1'];



$query = mysqli_query($conn, "INSERT INTO fg (id_fg, id_cust, id_po, id_part, qty_fg) 
VALUES ('','$data[id_cust]','$data[id_po]','$data[id_part]','$data[qty_fg]')");
header('location:../stampingproses.php');
?>