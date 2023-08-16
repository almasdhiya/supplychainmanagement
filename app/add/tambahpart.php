<?php 
  session_start();
  if( !isset($_SESSION['login'])){
    header("location: login.php");
    exit;
  }
  ?>
<?php 
include('../koneksi.php');
$id_part = $_POST['id_part'];
$nama_part = $_POST['nama_part'];
$kode_part = $_POST['kode_part'];
$berat_jenis = $_POST['berat_jenis'];
$pcs_sheet = $_POST['pcs_sheet'];
$spek_material = $_POST['spek_material'];
$ketebalan = $_POST['ketebalan'];
$lebar = $_POST['lebar'];
$panjang = $_POST['panjang'];
$proses = $_POST['proses'];
$spot = $_POST['spot'];
$unit_material = $_POST['unit_material'];
$diameter = $_POST['diameter'];
$kategori = $_POST['kategori'];
$gambar = $_FILES['gambar']['name'];

// lokasi gambar
$file_tmp = $_FILES['gambar']['tmp_name'];
move_uploaded_file($file_tmp,'../gambar/'.$gambar);
$query = mysqli_query($conn, "INSERT INTO part(id_part,nama_part,kode_part,berat_jenis,pcs_sheet,spek_material,
ketebalan,lebar,panjang,proses,spot,unit_material,diameter,kategori,gambar) VALUES 
('','$nama_part','$kode_part','$berat_jenis','$pcs_sheet','$spek_material','$ketebalan','$lebar','$panjang',
'$proses','$spot','$unit_material','$diameter','$kategori,'$gambar')");
header('location:../lihatpart.php');
?>