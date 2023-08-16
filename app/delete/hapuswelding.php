<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_welding = $_GET['id_welding'];


$query = mysqli_query($conn, "DELETE FROM welding WHERE id_welding='$id_welding'");
header('location:../assemblyproses.php');
?>