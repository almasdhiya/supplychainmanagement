<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$id_delivfg = $_GET['id_delivfg'];


$query = mysqli_query($conn, "DELETE from deliveryfg
where id_delivfg = '$id_delivfg'");
header('location:../delivery.php');
?>