<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_prs1 = $_GET['id_prs1'];


$query = mysqli_query($conn, "DELETE from proses1 
where proses1.id_prs1 = '$id_prs1'");
header('location:../stampingproses.php');
?>