<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs2 = $_GET['id_prs2'];


$query = mysqli_query($conn, "DELETE from proses2 where proses2.id_prs2 = '$id_prs2'");
header('location:../stampingproses.php');
?>