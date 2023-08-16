<?php 
  session_start();
  if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
  }
  ?>
<?php
include '../../koneksi.php';
$id_material   = $_GET['id_material'];
$id_supp = $_GET['id_supp'];

$query = "DELETE from material where id_material='$id_material'";
mysqli_query($conn, $query);
header("location:../lihatmaterial.php?id_supp=$id_supp");
