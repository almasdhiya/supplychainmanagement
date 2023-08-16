<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs3 = $_GET['id_prs3'];


$query = mysqli_query($conn, "DELETE from proses3 where proses3.id_prs3 = '$id_prs3'");
header('location:../stampingproses.php');
?>