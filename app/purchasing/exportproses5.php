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
$pdf->Cell(260,10,'Rekap Proses 5',0,2,'C');
$pdf -> image('dist/img/gandingrbg.png',10,13,15,15 );

$pdf -> SetFont('Times','','10');
$pdf->Cell(230,10,'',0,0,'R');
$pdf->Cell(20,10,'',0,1,'R');


$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(5, 6, 'No', 1, 0, 'C');
$pdf->Cell(17, 6, 'CUST', 1, 0, 'C');
$pdf->Cell(60, 6, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(44, 6, 'Kode Produk', 1, 0, 'C');
$pdf->Cell(31, 6, 'Nama Proses', 1, 0, 'C');
$pdf->Cell(15, 6, 'WIP', 1, 0, 'C');
$pdf->Cell(30, 6, 'Quantity Not Good', 1, 0, 'C');
$pdf->Cell(45, 6, 'Keterangan', 1, 0, 'C');
$pdf->Cell(31, 6, 'Tanggal Dikerjakan', 1, 1, 'C');

$no = 1;
$bulan = $_POST['loh'];
$pdf->SetFont('Times', '', '8');
$fontSize = "8";
$tempFontSize = $fontSize;
$data = mysqli_query($conn, "SELECT proses5.*, customer.nickname, part.nama_part, part.kode_part FROM proses5 inner join
customer on customer.id_cust = proses5.id_cust 
inner join part on part.id_part = proses5.id_part WHERE proses5.tgl = '$bulan'");
while ($row = mysqli_fetch_array($data)) {

  $id = $no;
  $cellWidth = 5;
  while ($pdf->GetStringWidth($id) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $id, 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 17;
  while ($pdf->GetStringWidth($row['nickname']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['nickname'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 60;
  while ($pdf->GetStringWidth($row['nama_part']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['nama_part'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 44;
  while ($pdf->GetStringWidth($row['kode_part']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['kode_part'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 31;
  while ($pdf->GetStringWidth($row['nama_proses']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['nama_proses'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 15;
  while ($pdf->GetStringWidth($row['qty_outtttt']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['qty_outtttt'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 30;
  while ($pdf->GetStringWidth($row['qty_nggggg']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['qty_nggggg'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 45;
  while ($pdf->GetStringWidth($row['keterangan']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['keterangan'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 31;
  while ($pdf->GetStringWidth($row['tgl']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['tgl'], 1, 1, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);
  $no++;

}
ob_end_clean();
$pdf->Output('Proses 5-' . $_POST['bulan'] . '.pdf', 'I');
