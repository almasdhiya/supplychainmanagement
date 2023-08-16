<meta http-equiv="refresh" content="1800; url=login.php">
<?php
require_once("fpdf/fpdf.php");
require_once('../koneksi.php');

class myPDF extends FPDF
{
  function myCell($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 25) {
      $txt = str_split($t, 25);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LRB', 0, 'C', 0);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LRB', 0, 'C', 0);
    }
  }
  function mylov($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 5) {
      $txt = str_split($t, 5);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LTR', 1, 'C', 0);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTR', 1, 'C', 0);
    }
  }
  function myaw($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 5) {
      $txt = str_split($t, 5);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LR', 1, 'C', 1);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LR', 1, 'C', 0);
    }
  }
  function myoi($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 25) {
      $txt = str_split($t, 25);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LTRB', 0, 'C', 0);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTRB', 0, 'C', 0);
    }
  }
}
$pdf = new myPDF('l', 'mm', 'A4');
ob_end_clean();
ob_start();
$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(5);
$pdf->SetTopMargin(5);
// membuat halaman baru
$pdf->AddPage();

$pdf->SetFont('Times', '', '14');
$pdf->Cell(20, 23, '', 1, 0, 'C');
$pdf->image('dist/img/gandingrbg.png', 5, 7, 20, 20);

$pdf->Cell(85, 23, '', 1, 0, 'L');
$pdf->Cell(0.1, 0, '', 0, 1, 'C');

$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(105, 30, '', 0, 0, 'C');
$pdf->Cell(107, 23, 'PURCHASE ORDER', 1, 0, 'C');
$pdf->Cell(6, 0.2, '', 0, 1, 'C');

$pdf->SetFont('Times', '', '8');
$pdf->Cell(212, 25, '', 0, 0, 'L');
$pdf->Cell(75, 5.8, 'Nomor                                                        FR-GT-PUR-01-003', 1, 0, 'L');
$pdf->Cell(6, 1.5, '', 0, 1, 'L');

$pdf->Cell(20, 25, '', 0, 0, 'C');
$pdf->Cell(10, 4, 'PT Ganding Toolsindo', 0, 1, 'L');
$pdf->Cell(6, 0.2, '', 0, 1, 'C');
$posupp = $_POST['posupp'];
$hai = mysqli_query($conn, "SELECT distinct * FROM po_supplier where no_po_supp = '$posupp' limit 1");
while ($k = mysqli_fetch_array($hai)) {
  $pdf->Cell(212, 0.1, '', 0, 0, 'C');
  $pdf->Cell(75, 5.8, 'Revisi ke                                                                                    ' . $k['revisi'], 1, 0, 'L');
  $pdf->Cell(6, 0.2, '', 0, 1, 'C');


$pdf->Cell(20, 15, '', 0, 0, 'C');
$pdf->Cell(120, 4, 'Jl. Raya serang - Cibarusah No.17, Sukasari, Serang Baru 17330', 0, 1, 'L');
$pdf->Cell(6, 1.5, '', 0, 1, 'C');

$pdf->Cell(212, 0.1, '', 0, 0, 'C');
$pdf->Cell(75, 5.8, 'Berlaku Tanggal                                                        ' .date('d/m/Y'), 1, 0, 'L');
$pdf->Cell(6, 1.6, '', 0, 1, 'C');
}
// $pdf->Cell(250, 0.1, '', 0, 0, 'C');
// $pdf->Cell(75, 5.8, date('d/m/Y'), 0, 0, 'L');
// $pdf->Cell(6, 0.7, '', 0, 1, 'C');

$pdf->Cell(20, 0.1, '', 0, 0, 'C');
$pdf->Cell(120, 4, 'Jl. Kruing II Multi Niaga III No.7, kawasan Industri Delta Silicon', 0, 1, 'L');
$pdf->Cell(6, 0.1, '', 0, 0, 'C');

$pdf->Cell(206, 0.1, '', 0, 0, 'C');
$pdf->Cell(75, 5.8, 'Halaman                                                                                 ' . $pdf->PageNo() . '/' . $pdf->PageNo(), 1, 0, 'L');
$pdf->Cell(6, 1, '', 0, 1, 'C');

$pdf->Cell(20, 25, '', 0, 0, 'C');
$pdf->Cell(120, 3, 'Lippo Cikarang, Bekasi 17550', 0, 1, 'L');
$pdf->Cell(120, 5, '', 0, 1, 'L');

$pdf->SetFont('Times', '', '8');
$pdf->Cell(80, 5, 'SUPPLIER/VENDOR', 1, 0, 'C');
$pdf->Cell(5, 0, '', 0, 0, 'C');

$pdf->Cell(50, 5, 'SHIP TO', 1, 0, 'C');
$pdf->Cell(15, 0, '', 0, 0, 'C');

$pdf->Cell(30, 5, 'SUPPLIER', 1, 0, 'C');
$pdf->Cell(15, 0, '', 0, 0, 'C');
$pdf->Cell(17, 0, '', 0, 0, 'C');

$pdf->SetFont('Times', '', '8');
$pdf->Cell(70, 5, 'PT GANDING TOOLSINDO', 1, 1, 'C');
$pdf->Cell(15, 0, '', 0, 1, 'C');
$supp = $_POST['supp'];
// $pdf->SetFont('Times', '', '8');
$hai = mysqli_query($conn, "SELECT alamat_supp,kontak_supp,nama_supp FROM supplier where id_supp = '$supp'");
while ($p = mysqli_fetch_array($hai)) {
  $pdf->SetFont('Times', '', '8');
  // $fontSize = 8;
  // $tempFontSize = $fontSize;

  // $cellWidth = 70;
  // while ($pdf->GetStringWidth($_POST['supp']) > $cellWidth) {
  //   $pdf->SetFontSize($tempFontSize -= 0.1);
  // }
  // $pdf->Row(array($data,$company[$point],$jobDetails[$point],$reasons[$point]));
  // $pdf->Ln(0);
  // $pdf->SetX(10);
  $pdf->MultiCell(80, 5, $p['nama_supp']
    . '
' . $p['alamat_supp'] . '
' . $p['kontak_supp'], 'LRTB', 'L', false);
  // $pdf->SetFont('Times', '', '8');
  // $pdf->MultiCell(70, 10, $p['alamat_supp'], 'LRB', 'L',false);
  $pdf->Cell(75, 30, '', 0, 0, 'C');
}
$pdf->Ln(0);
$pdf->SetX(90);
// $pdf->SetY(90);
$pdf->SetFont('Times', 'B', '8');
$pdf->MultiCell(50, -20, 'PT GANDING TOOLSINDO', 'LRTB', 'C');
$pdf->Cell(150, -100, '', 0, 0, 'C');

$pdf->SetFont('Times', '', '8');
$pdf->Cell(30, 5, 'APPROVED', 1, 0, 'C');
$pdf->Cell(32, -10, '', 0, 0, 'C');

$pdf->Cell(23.5, 5, 'Issued', 1, 0, 'C');
$pdf->Cell(23.5, 5, 'Checked', 1, 0, 'C');
$pdf->Cell(23, 5, 'Approved', 1, 1, 'C');


$pdf->Cell(150, 10, '', 0, 0, 'C');
$pdf->Cell(30, 30, '', 1, 0, 'C');
$pdf->Cell(32, 30, '', 0, 0, 'C');


$pdf->Cell(23.5, 30, '', 1, 0, 'C');
$pdf->Cell(23.5, 30, '', 1, 0, 'C');
$pdf->Cell(23, 30, '', 1, 1, 'C');
$pdf->Cell(150, 30, '', 0, 0, 'C');

$pdf->Cell(30, 5, '', 1, 0, 'C');

$pdf->Cell(32, 5, '', 0, 0, 'C');


$pdf->Cell(23.5, 5, '', 1, 0, 'C');
$pdf->Cell(23.5, 5, '', 1, 0, 'C');
$pdf->Cell(23, 5, '', 1, 1, 'C');

$pdf->SetFont('Times', '', '10');
$cell = 'No Po           :';
$pdf->Cell($pdf->GetStringWidth($cell), -30, $cell, 0, 'R');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(5, 30, $_POST['posupp'], 0, 1, 'L');
$pdf->Line(5, 64, 100 - 20, 64);

$pdf->SetFont('Times', '', '10');
$cell = 'No Urut        : 1';
$pdf->Cell($pdf->GetStringWidth($cell), -20, $cell, 0, 'R');
$pdf->Line(5, 69, 100 - 20, 69);

$supp = $_POST['supp'];
$no_po_supp = $_POST['posupp'];
$hai = mysqli_query($conn, "SELECT tgl_po FROM po_supplier where no_po_supp = '$posupp' ");
while ($p = mysqli_fetch_array($hai)) {
$pdf->SetFont('Times', '', '10');
$cell = 'Tanggal        :';
$pdf->Cell($pdf->GetStringWidth($cell), 30, $cell, 0, 'R');
$pdf->Cell(20, 10, '', 0, 0, 'C');
$pdf->Cell(10, -30, $p['tgl_po'], 0, 1, 'L');
$pdf->Line(5, 74, 100 - 20, 74);
}

$pdf->SetFont('Times', '', '10');
$cell = 'Project          :';
$pdf->Cell($pdf->GetStringWidth($cell), 40, $cell, 0, 'R');
$pdf->Cell(20, 10, '', 0, 0, 'C');
$pdf->Cell(10, -40, 'Reguler Kebutuhan Prod', 0, 1, 'L');
$pdf->Cell(56, 10, '', 0, 0, 'C');
$pdf->Cell(10, 40, date('M Y'), 0, 1, 'L');
$pdf->Line(5, 79, 100 - 20, 79);


$pdf->SetFont('Times', '', '10');
$cell = 'No Form Pengajuan       :';
$pdf->Cell($pdf->GetStringWidth($cell), -30, $cell, 0, 'R');
$pdf->Cell(38, 10, '', 0, 0, 'C');
$pdf->Cell(10, 30, '47/GT/PPIC/V/', 0, 1, 'L');
$pdf->Cell(60, 10, '', 0, 0, 'C');
$pdf->Cell(10, -30, date('Y'), 0, 1, 'L');

// $pdf->SetFont('Times', '', '10');
// $pdf->Cell(80, 5, 'Nomor PO                 :', 1, 0, 'L');
// $pdf->Cell(30, 0, '', 0, 1, 'C');

// $pdf->Cell(40, 5, '', 0, 0, 'C');
// $pdf->Cell(10, 5, $_POST['posupp'], 0, 1, 'L');

// $pdf->SetFont('Times', '', '10');
// $pdf->Cell(80, 5, 'Tanggal PO               :', 1, 0, 'L');
// $pdf->Cell(20, 0, '', 0, 1, 'C');

// $pdf->Cell(40, 5, '', 0, 0, 'C');
// $pdf->Cell(10, 5, date('d/m/Y', strtotime($_POST['bulan'])), 0, 1, 'L');

// $pdf->SetFont('Times', '', '10');
// $pdf->Cell(80, 5, 'No Form Pengajuan  :', 1, 0, 'L');
// $pdf->Cell(20, 0, '', 0, 1, 'C');

// $pdf->Cell(40, 5, '', 0, 0, 'C');
// $pdf->Cell(10, 5, '47/GT/PPIC/V/', 0, 0, 'L');

// $pdf->Cell(12, 5, '', 0, 0, 'C');
// $pdf->Cell(10, 5, date('Y'), 0, 1, 'L');

$pdf->Cell(17, 18, '', 0, 1, 'C');

$pdf->SetFont('Times', 'B', '10');
$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 5;
while ($pdf->GetStringWidth('No') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'No', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 37;
while ($pdf->GetStringWidth('Part Code') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'Part Code', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'Part Name', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$pdf->Cell(20, 10, 'SPEC', 1, 0, 'C');

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 12;
while ($pdf->GetStringWidth('T(mm)') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'T(mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'W(mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'L(mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'UM', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'BJ', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

// $fontSize = 8;
// $tempFontSize = $fontSize;

// $cellWidth = 15;
// while ($pdf->GetStringWidth('UM') > $cellWidth) {
//   $pdf->SetFontSize($tempFontSize -= 0.1);
// }
// $pdf->Cell(15, 10, 'Pieces/Sheet', 1, 0, 'C');
// $tempFontSize = $fontSize;
// $pdf->SetFontSize($fontSize);

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 30;
while ($pdf->GetStringWidth('qty') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 5, 'Qty Order', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 23;
while ($pdf->GetStringWidth('price') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
// $posupp = $_POST['posupp'];
// $hai = mysqli_query($conn, "SELECT distinct hitung FROM po_supplier where no_po_supp = '$posupp' limit 1");
// while ($k = mysqli_fetch_array($hai)) {
  $pdf->Cell($cellWidth, 10, 'Price', 1, 0, 'C');
// }
$pdf->Cell($cellWidth, 10, 'Amount (IDR)', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$pdf->Cell(28, 5, 'Due Date', 1, 0, 'C');
$pdf->Cell(6, 5, '', 0, 1, 'C');

$pdf->Cell(15, 5, '', 0, 0, 'C');
$pdf->Cell(15, 5, '', 0, 0, 'C');
$pdf->Cell(18, 5, '', 0, 0, 'C');
$pdf->Cell(5 , 5, '', 0, 0, 'C');
$pdf->Cell(25, 5, '', 0, 0, 'C');
$pdf->Cell(81, 5, '', 0, 0, 'C');

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 15;
while ($pdf->GetStringWidth('UM') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 5, 'Pcs', 1, 0, 'C');
// $pdf->Cell($cellWidth, 5, 'Kg', 1, 0, 'C');
$pdf->Cell($cellWidth, 5, 'Lbr', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);
$pdf->Cell(23, 5, '', 0, 0, 'C');
// $pdf->Cell(15, 5, '', 0, 0, 'C');
$pdf->Cell(23, 5, '', 0, 0, 'C');
$pdf->Cell(14, 5, date('d-M', strtotime($_POST['rencana_pertama'])), 1, 0, 'C');
$pdf->Cell(14, 5, date('d-M', strtotime($_POST['rencana_kedua'])), 1, 1, 'C');


$no = 1;
$supp = $_POST['supp'];
$posupp = $_POST['posupp'];
$rencana_pertama = $_POST['rencana_pertama'];
$rencana_kedua = $_POST['rencana_kedua'];
$id_po_supp = $_POST['id_po_supp'];

$pdf->SetFont('Times', '', '8');
$fontSize = "8";
$tempFontSize = $fontSize;

$update = mysqli_query($conn, "UPDATE po_supplier set rencana_pertama = '$rencana_pertama', rencana_kedua = '$rencana_kedua' where no_po_supp = '$posupp'");
$data = mysqli_query(
  $conn,
  "SELECT po_supplier.*, supplier.id_supp,supplier.nama_supp,supplier.alamat_supp, material.*
    FROM `po_supplier` inner join supplier on supplier.id_supp = po_supplier.id_supp inner join material
    on material.id_material = po_supplier.id_material
    where supplier.id_supp='$supp' and po_supplier.no_po_supp = '$posupp'"
)  or die(mysqli_error($conn));

while ($row = mysqli_fetch_array($data)) {
  $id = $no;
  $pdf->SetFont('Times', '', '8');
  $total += $row['total'];

  $cellWidth = 5;
  while ($pdf->GetStringWidth($id) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $id, 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 37;
  while ($pdf->GetStringWidth($row['kode_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['kode_material'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 37;
  while ($pdf->GetStringWidth($row['nama_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['nama_material'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 20;
  while ($pdf->GetStringWidth($row['spek_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['spek_material'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['ketebalan']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['ketebalan'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['lebar']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['lebar'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['panjang']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['panjang'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['satuan']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['satuan'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['berat_jenis']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['berat_jenis'], 1, 0, "C");

  // $tempFontSize = $fontSize;
  // $pdf->SetFontSize($fontSize);

  // $cellWidth = 15;
  // while ($pdf->GetStringWidth($row['pcs_sheet']) > $cellWidth) {
  //   $pdf->setFontSize($tempFontSize -= 0.1);
  // };

  // $pdf->Cell($cellWidth, 5, $row['pcs_sheet'], 1, 0, "C");

  if($row ['satuan'] == 'Lembar'){

    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);
    
    $cellWidth = 15;
    while ($pdf->GetStringWidth('') > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };
    
    $pdf->Cell($cellWidth, 5, '', 1, 0, "C");

    // $tempFontSize = $fontSize;
    // $pdf->SetFontSize($fontSize);
  
    // $cellWidth = 10;
    // while ($pdf->GetStringWidth(number_format(($row['qty_order_supp'] * $row['pcs_sheet']))) > $cellWidth) {
    //   $pdf->setFontSize($tempFontSize -= 0.1);
    // };
  
    // $pdf->Cell($cellWidth, 5, number_format(($row['qty_order_supp'] * $row['pcs_sheet'])), 1, 0, "C");


    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);
  
    $cellWidth = 15;
    while ($pdf->GetStringWidth(($row['qty_order_supp'])) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };
  
    $pdf->Cell($cellWidth, 5, number_format($row['qty_order_supp']), 1, 0, "C");

  } else if ($row['satuan'] == 'Pieces') {
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);
  
  $cellWidth = 15;
  while ($pdf->GetStringWidth($row['qty_order_supp']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };
  
  $pdf->Cell($cellWidth, 5, ($row['qty_order_supp']), 1, 0, "C");

  // $tempFontSize = $fontSize;
  // $pdf->SetFontSize($fontSize);

  // $cellWidth = 10;
  // while ($pdf->GetStringWidth('') > $cellWidth) {
  //   $pdf->setFontSize($tempFontSize -= 0.1);
  // };

  // $pdf->Cell($cellWidth, 5, (''), 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 15;
  while ($pdf->GetStringWidth('') > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, (''), 1, 0, "C");
  }

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 23;
  while ($pdf->GetStringWidth(number_format($row['harga'], 0, ',', '.')) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, number_format($row['harga'], 0, ',', '.'), 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 23;
  while ($pdf->GetStringWidth(number_format($row['total'], 0, ',', '.')) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, number_format($row['total'], 0, ',', '.'), 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);


  $cellWidth = 14;
  while ($pdf->GetStringWidth($row['qty_order_supp']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_order_supp'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 14;
  while ($pdf->GetStringWidth($row['qty_rencana2']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_rencana2'], 1, 1, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);
  $no++;


}  
// $supp = $_POST['supp'];
// $posupp = $_POST['posupp'];

// $kunci = mysqli_query($conn, "SELECT po_supplier.*, supplier.id_supp,supplier.nama_supp,supplier.alamat_supp, part.*
// FROM `po_supplier` inner join supplier on supplier.id_supp = po_supplier.id_supp inner join part 
// on part.id_part = po_supplier.id_part
// where supplier.id_supp='$supp' and po_supplier.no_po_supp = '$posupp'");
//  while ($row = mysqli_fetch_array($kunci)) {
//   $id_po = $row['id_po'];
//   $qty_ng = $row['qty_ng'];
//  }
$pdf->Cell(5, 5, '', 1, 0, 'L');
$pdf->Cell(37, 5, '', 1, 0, 'L');
$pdf->Cell(37, 5, '', 1, 0, 'L');
$pdf->Cell(20, 5, '', 1, 0, 'L');
$pdf->Cell(12, 5, '', 1, 0, 'L');
$pdf->Cell(12, 5, '', 1, 0, 'L');
$pdf->Cell(12, 5, '', 1, 0, 'L');
$pdf->Cell(12, 5, '', 1, 0, 'L');
$pdf->Cell(12, 5, '', 1, 0, 'L');
// $pdf->Cell(15, 5, '', 1, 0, 'L');
$pdf->Cell(15, 5, '', 1, 0, 'L');
// $pdf->Cell(10, 5, '', 1, 0, 'L');
// $pdf->Cell(10, 5, '', 1, 0, 'L');
$pdf->Cell(15, 5, '', 1, 0, 'L');
$pdf->Cell(23, 5, '', 1, 0, 'L');
$pdf->Cell(23, 5, '', 1, 0, 'L');
$pdf->Cell(14, 5, '', 1, 0, 'L');
$pdf->Cell(14, 5, '', 1, 1, 'L');

$w = 189;
$h = 25;
$x = $pdf->GetX();
$pdf->myCell($w, $h,$x,'');


// $pdf->Cell(214, 25, '', 1, 0, 'C');
$pdf->Cell(23, 5, 'Total', 1, 0, 'L');
$pdf->Cell(23, 5, number_format($total , 0) ,1, 0, 'C');

$w = 28;
$h = 5;
$x = $pdf->GetX();
$pdf->mylov($w, $h,$x, '');


$pdf->Cell(189, 5, '', 0, 0, 'C');
$pdf->Cell(23, 5, 'Disc 0%', 1, 0);
$pdf->Cell(23, 5, '', 1, 0, 'C');

$w = 28;
$h = 5;
$x = $pdf->GetX();
$pdf->myaw($w, $h,$x, '');

$pdf->Cell(189, 5, '', 0, 0, 'C');
$pdf->Cell(23, 5, 'Sub Total', 1, 0);
$pdf->Cell(23, 5, number_format($total , 0), 1, 0, 'C');

$w = 28;
$h = 5;
$x = $pdf->GetX();
$pdf->myaw($w, $h,$x, '');

$pdf->Cell(189, 5, '', 0, 0, 'C');
$pdf->Cell(23, 5, 'Ppn 11%', 1, 0);
$pdf->Cell(23, 5, number_format($total * 0.11 ,0), 1, 0, 'C');

$w = 28;
$h = 5;
$x = $pdf->GetX();
$pdf->myaw($w, $h,$x, '');

$pdf->Cell(189, 5, '', 0, 0, 'C');
$pdf->Cell(23, 5, 'Total Amount', 1, 0);
$pdf->Cell(23, 5, number_format($total + ($total * 0.11), 0), 1, 0, 'C');

$w = 28;
$h = 5;
$x = $pdf->GetX();
$pdf->myCell($w, $h,$x, '');

ob_end_clean();
$pdf->Output('MaterialRequest.pdf', 'I');
