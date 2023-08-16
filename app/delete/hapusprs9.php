<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs9 = $_GET['id_prs9'];


$query = mysqli_query($conn, "DELETE from proses9 where proses9.id_prs9 = '$id_prs9'");
header('location:../stampingproses.php');
?>