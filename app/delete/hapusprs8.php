<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs8 = $_GET['id_prs8'];


$query = mysqli_query($conn, "DELETE from proses8 where proses8.id_prs8 = '$id_prs8'");
header('location:../stampingproses.php');
?>