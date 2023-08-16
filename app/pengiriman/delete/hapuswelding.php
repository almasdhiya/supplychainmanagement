<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$id_welding = $_GET['id_welding'];


$query = mysqli_query($conn, "DELETE FROM welding WHERE id_welding='$id_welding'");
header('location:../assemblyproses.php');
?>