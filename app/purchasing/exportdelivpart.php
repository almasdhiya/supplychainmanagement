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



$pdf = new FPDF('l', 'mm', 'A4');
ob_end_clean();
ob_start();
// membuat halaman baru
$pdf->AddPage();
$pdf->SetFont('Times', 'B', '10');
// judul
$pdf->Cell(15, 20, '', 0, 0, 'L');
$pdf->Cell(100, 20, 'PT Ganding Toolsindo', 0, 2, 'L');

$pdf->SetFont('Times', '', '12');
$pdf->Cell(260, 10, 'Laporan Surat Jalan Delivery Finish Good', 0, 1, 'C');
$pdf->image('dist/img/gandingrbg.png', 10, 13, 15, 15);

$pdf->SetFont('Times', '', '10');
$pdf->Cell(28, 10, 'No Surat Jalan :', 0, 0, 'L');
$pdf->Cell(210, 10, $_POST['q'], 0, 1, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(250, 10, 'Dicetak Tanggal :', 0, 0, 'R');
$pdf->Cell(20, 10, date('d/m/Y'), 0, 1, 'R');


$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(80, 6, 'Nama Customer', 1, 0, 'C');
$pdf->Cell(80, 6, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(60, 6, 'Quantity Delivery', 1, 0, 'C');
$pdf->Cell(40, 6, 'Tanggal Delivery', 1, 1, 'C');

$no = 1;
$q = $_POST['q'];
$pdf->SetFont('Times', '', '8');
$fontSize = "8";
$tempFontSize = $fontSize;
$data = mysqli_query($conn, "SELECT customer.nama_cust, deliveryfg.*, part.nama_part
from deliveryfg INNER JOIN customer on customer.id_cust = deliveryfg.id_cust
           inner join part on part.id_part = deliveryfg.id_part where deliveryfg.nosurjal = '$q'");
while ($row = mysqli_fetch_array($data)) {

  $id = $no;

  $cellWidth = 10;
  while ($pdf->GetStringWidth($id) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $id, 1, 0, "C");
  
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 80;
  while ($pdf->GetStringWidth($row['nama_cust']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['nama_cust'], 1,0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

    $cellWidth = 80;
  while ($pdf->GetStringWidth($row['nama_part']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['nama_part'], 1,0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $pdf->Cell(60, 5, $row['qty_delivfg'], 1, 0, 'C');
  $pdf->Cell(40, 5, $row['tgl_delivfg'], 1, 1, 'C');
  $no++;
}

ob_end_clean();
$pdf->Output();

