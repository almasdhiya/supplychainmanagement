<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$id_supp = $_GET['id_supp'];


$query = mysqli_query($conn, "DELETE FROM supplier WHERE id_supp='$id_supp'");
header('location:../datasupplier.php');
?>