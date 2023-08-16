<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_spot1 = $_GET['id_spot1'];


$query = mysqli_query($conn, "DELETE from spot1 where spot1.id_spot1 = '$id_spot1'");
header('location:../assemblyproses.php');
?>