<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_cust = $_GET['id_cust'];


$query = mysqli_query($conn, "DELETE FROM customer WHERE id_cust='$id_cust'");
header('location:../datacustomer.php');
?>