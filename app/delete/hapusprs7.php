<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs7 = $_GET['id_prs7'];


$query = mysqli_query($conn, "DELETE from proses7 where proses7.id_prs7 = '$id_prs7'");
header('location:../stampingproses.php');
?>