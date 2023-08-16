<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php 
include('../../koneksi.php');
$id_sub = $_GET['id_sub'];


$query = mysqli_query($conn, "DELETE FROM delivery_subcont WHERE id_sub='$id_sub'");
header('location:../subcont.php');
?>