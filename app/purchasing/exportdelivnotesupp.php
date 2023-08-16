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
$pdf->Cell(260, 10, 'Laporan Surat Jalan Supplier', 0, 1, 'C');
$pdf->image('dist/img/gandingrbg.png', 10, 13, 15, 15);

$pdf->SetFont('Times', '', '10');
$pdf->Cell(25, 5, 'Nama Supplier :', 0, 0, 'L');
$pdf->Cell(60, 5, $_POST['supp'], 0, 1, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(25, 5, 'No Surat Jalan :', 0, 0, 'L');
$pdf->Cell(60, 5, $_POST['surjal'], 0, 1, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(250, 10, 'Dicetak Tanggal :', 0, 0, 'R');
$pdf->Cell(30, 10, date('d/m/Y'), 0, 1, 'R');


$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(40, 6, 'No Surat Jalan', 1, 0, 'C');
$pdf->Cell(70, 6, 'Material', 1, 0, 'C');
$pdf->Cell(20, 6, 'Quantity', 1, 0, 'C');
$pdf->Cell(35, 6, 'No PO Supplier', 1, 0, 'C');
$pdf->Cell(30, 6, 'Satuan', 1, 0, 'C');
$pdf->Cell(40, 6, 'Rencana Pertama', 1, 0, 'C');
$pdf->Cell(40, 6, 'Rencana Kedua', 1, 1, 'C');
$no = 1;
$supp = $_POST['supp'];
$surjal = $_POST['surjal'];
$pdf->SetFont('Times', '', '8');
$fontSize = "8";
$tempFontSize = $fontSize;
$data = mysqli_query(
  $conn,
  "SELECT supplier.id_supp, material_recipt.*, pieces.*, po_supplier.no_po_supp,
  po_supplier.satuan, po_supplier.rencana_pertama, po_supplier.rencana_kedua,material.nama_material
  FROM material_recipt INNER JOIN po_supplier on po_supplier.id_po_supp = material_recipt.id_po_supp 
  INNER JOIN supplier on supplier.id_supp = material_recipt.id_supp 
  inner join pieces on pieces.id_supp = material_recipt.id_supp
  INNER JOIN material on material.id_material = material_recipt.id_material
   where supplier.id_supp='$supp' and material_recipt.surjal = '$surjal' and pieces.surjal = '$surjal';"
)  or die(mysqli_error($conn));

while ($row = mysqli_fetch_array($data)) {

  $id = $no;

  $cellWidth = 10;
  while ($pdf->GetStringWidth($id) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $id, 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $pdf->Cell(40, 5, $row['surjal'], 1, 0, 'C');

  $cellWidth = 70;
  while ($pdf->GetStringWidth($row['nama_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  $pdf->Cell($cellWidth, 5, $row['nama_material'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $pdf->Cell(20, 5, $row['qty_dikirim'], 1, 0, 'C');
  $pdf->Cell(35, 5, $row['no_po_supp'], 1, 0, 'C');
  $pdf->Cell(30, 5, $row['satuan'], 1, 0, 'C');
  $pdf->Cell(40, 5, $row['rencana_pertama'], 1, 0, 'C');
  $pdf->Cell(40, 5, $row['rencana_kedua'], 1, 1, 'C');
  $no++;
}

ob_end_clean();
$pdf->Output('SuratJalanSupplier-' . $_POST['surjal'] . '.pdf', 'I');

?>