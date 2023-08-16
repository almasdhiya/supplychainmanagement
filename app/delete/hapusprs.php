<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs = $_GET['id_prs'];


$query = mysqli_query($conn, "DELETE from proses 
where id_prs = '$id_prs'");
header('location:../stampingproses.php');
?>