<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_supp = $_GET['id_supp'];


$query = mysqli_query($conn, "DELETE FROM supplier WHERE id_supp='$id_supp'");
header('location:../datasupplier.php');
?>