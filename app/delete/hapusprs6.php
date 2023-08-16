<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs6 = $_GET['id_prs6'];


$query = mysqli_query($conn, "DELETE from proses6 where proses6.id_prs6 = '$id_prs6'");
header('location:../stampingproses.php');
?>