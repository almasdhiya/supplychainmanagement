<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_spot4 = $_GET['id_spot4'];


$query = mysqli_query($conn, "DELETE from spot4 where spot4.id_spot4 = '$id_spot4'");
header('location:../assemblyproses.php');
?>