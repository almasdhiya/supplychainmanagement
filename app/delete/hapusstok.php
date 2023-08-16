<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_stok = $_GET['id_stok'];


$query = mysqli_query($conn, "DELETE FROM stok WHERE id_stok='$id_stok'");
header('location:../stok.php');
?>