<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_sub = $_GET['id_sub'];


$query = mysqli_query($conn, "DELETE FROM delivery_subcont WHERE id_sub='$id_sub'");
header('location:../subcont.php');
?>