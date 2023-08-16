<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_spot2 = $_GET['id_spot2'];


$query = mysqli_query($conn, "DELETE from spot2 where spot2.id_spot2 = '$id_spot2'");
header('location:../assemblyproses.php');
?>