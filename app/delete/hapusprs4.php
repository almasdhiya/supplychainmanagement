<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs4 = $_GET['id_prs4'];


$query = mysqli_query($conn, "DELETE from proses4 where proses4.id_prs4 = '$id_prs4'");
header('location:../stampingproses.php');
?>