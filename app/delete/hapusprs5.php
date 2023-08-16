<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs5 = $_GET['id_prs5'];


$query = mysqli_query($conn, "DELETE from proses5 where proses5.id_prs5 = '$id_prs5'");
header('location:../stampingproses.php');
?>