<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_spot3 = $_GET['id_spot3'];


$query = mysqli_query($conn, "DELETE from spot3  where spot3.id_spot3 = '$id_spot3'");
header('location:../assemblyproses.php');
?>