<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php
include '../koneksi.php';
$id_part   = $_GET['id_part'];
$cust = $_GET['id_cust'];

$query = "DELETE from part where id_part='$id_part'";
mysqli_query($conn, $query);
header("location:../lihatpart.php?id_cust=$cust");
