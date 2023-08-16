<meta http-equiv="refresh" content="1800; url=login.php">
<?php 
  session_start();
if($_SESSION['role']==""){
  header("location:index.php?pesan=gagal");
}
  ?>
<?php
require_once("fpdf/fpdf.php");
require_once('../koneksi.php');

$pdf = new FPDF('l','mm','A4');
ob_end_clean();
ob_start();
// membuat halaman baru
$pdf -> AddPage();
$pdf -> SetFont('Times','B','10');
// judul
$pdf->Cell(15,10,'',0,0,'L');
$pdf->Cell(100,20,'PT Ganding Toolsindo',0,2,'L');

$pdf -> SetFont('Times','','12');
$pdf->Cell(260,10,'Rekap Spot 2',0,2,'C');
$pdf -> image('dist/img/gandingrbg.png',10,13,15,15 );

$pdf -> SetFont('Times','','10');
$pdf->Cell(230,10,'Periode Bulan :',0,0,'R');
$pdf->Cell(20,10,date('d-M-Y', strtotime($_POST['bulan'])),0,1,'R');

$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(17, 10, 'CUST', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(40, 10, 'Kode Produk', 1, 0, 'C');
$pdf->Cell(35, 10, 'Nama Spot', 1, 0, 'C');
$pdf->Cell(30, 10, 'WIP', 1, 0, 'C');
$pdf->Cell(30, 10, 'Quantity Not Good', 1, 0, 'C');
$pdf->Cell(30, 10, 'Keterangan', 1, 0, 'C');
$pdf->Cell(31, 10, 'Tanggal Dikerjakan', 1, 1, 'C');

$no = 1;
$bulan = $_POST['bulan'];

$data = mysqli_query($conn, "SELECT spot2.*, customer.nickname, part.nama_part, part.kode_part FROM spot2 inner join
customer on customer.id_cust = spot2.id_cust
inner join part on part.id_part = spot2.id_part WHERE spot2.tgl = '$bulan'");
while ($row = mysqli_fetch_array($data)) {
$pdf -> SetFont('Times','','10');
$pdf->Cell(10,10,$no++,1,0,'C');
$pdf->Cell(17,10,$row['nickname'],1,0,'C');
$pdf->Cell(50,10,$row['nama_part'],1,0,'C');
$pdf->Cell(17,10,$row['kode_part'],1,0,'C');
$pdf->Cell(30,10,$row['nama_spot'],1,0,'C');
$pdf->Cell(40,10,$row['qty_outt'],1,0,'C');
$pdf->Cell(45,10,$row['qty_ngg'],1,0,'C');
$pdf->Cell(30,10,$row['keterangan'],1,0,'C');
$pdf->Cell(40,10,$row['tgl'],1,1,'C');



}
ob_end_clean();
$pdf->Output('Spot 2-' . $_POST['bulan'] . '.pdf', 'I');
