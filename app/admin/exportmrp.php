<meta http-equiv="refresh" content="1800; url=login.php">
<?php
session_start();
if ($_SESSION['role'] == "") {
  header("location:index.php?pesan=gagal");
}
?>
<?php require_once("fpdf/fpdf.php");
require_once('../koneksi.php');


class myPDF extends FPDF
{
  function myCell($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 100) {
      $txt = str_split($t, 100);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LTRB', 0, 1, 'C', 1);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTRB', 0, 'C', 0);
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
      $this->Cell($w, $h, '', 'LTRB', 0, 1, 'C', 1);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTRB', 0, 'C', 0);
    }
  }
  function myku($w, $h, $x, $t)
  {
    $height = $h / 3;
    $first = $height + 2;
    $second = $height + $height + $height + 3;
    $len = strlen($t);
    if ($len > 10) {
      $txt = str_split($t, 10);
      $this->SetX($x);
      $this->Cell($w, $first, $txt[0], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $second, $txt[1], '', '', '');
      $this->SetX($x);
      $this->Cell($w, $h, '', 'LTRB', 0, 1, 'C', 1);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTRB', 0, 'C', 0);
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
      $this->Cell($w, $h, '', 'LTRB', 0, 1, 'C', 1);
    } else {
      $this->SetX($x);
      $this->Cell($w, $h, $t, 'LTRB', 1, 'C', 0);
    }
  }
}
$pdf = new myPDF('l', 'mm', 'A4');
ob_end_clean();
ob_start();
// membuat halaman baru
$pdf->AddPage();
$pdf->SetFont('Times', 'B', '10');
// judul
$pdf->Cell(15, 20, '', 0, 0, 'L');
$pdf->Cell(100, 20, 'PT Ganding Toolsindo', 0, 1, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(260, 3, 'FORM PENGAJUAN PEMBELIAN MATERIAL', 0, 1, 'C');
$pdf->Cell(260, 10, $_POST['nama_cust'], 0, 2, 'C');
$pdf->image('dist/img/gandingrbg.png', 10, 13, 15, 15);

$pdf->SetFont('Times', '', '10');
$pdf->Cell(14, 5, 'Kepada :', 0, 0, 'L');
$pdf->Cell(165, 5, 'Purchasing', 0, 1, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(33, 5, 'Tanggal Permintaan :', 0, 0, 'L');
$pdf->Cell(147, 5, date('d/m/Y'), 0, 0, 'L');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(40, 5, 'FM-GT-PPIC-03-003', 1, 0, 'C');
$pdf->Cell(60, 5, '58/GTPPIC/VII', 1, 0, 'C');
$pdf->Cell(30, 5, '', 0, 1, 'R');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(10, 5, 'Hal :', 0, 0, 'L');
$pdf->Cell(35, 5, 'PO KEB MATL PROD', 0, 0, 'L');
$pdf->Cell(135, 5, date('M-Y', strtotime($_POST['bulan'])), 0, 0, 'L');

$pdf->Cell(40, 5, 'Dibuat', 1, 0, 'C');
$pdf->Cell(30, 5, 'Diketahui', 1, 0, 'C');
$pdf->Cell(30, 5, 'Disetujui', 1, 1, 'C');

$cust = $_POST['nama_cust'];
$bln = date($_POST['bulan']);
$hai = mysqli_query($conn, "SELECT customer.nama_cust, po_customer.tanggalterima_po, po_customer.revisi
 FROM po_customer inner join customer on customer.id_cust = po_customer.id_cust where customer.nama_cust = '$cust' 
 and po_customer.tanggalterima_po LIKE '$bln%' and statuss= 'Sedang Diproses' limit 1");
while ($k = mysqli_fetch_array($hai)) {
  $pdf->SetFont('Times', '', '10');
  $pdf->Cell(10, 5, 'Revisi :   ' . $k['revisi'], 0, 0, 'L');
}
$pdf->Cell(170, 5, '', 0, 0, 'L');

$pdf->Cell(40, 25, '', 1, 0, 'C');
$pdf->Cell(30, 25, '', 1, 0, 'C');
$pdf->Cell(30, 25, '', 1, 1, 'C');

$pdf->SetFont('Times', '', '10');
$pdf->Cell(35, 10, 'Dicetak Tanggal :', 0, 0, 'L');
$pdf->Cell(30, 10, date('d/m/Y'), 0, 1, 'L');

$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(5, 10, 'No', 1, 0, 'C');
$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 13;
while ($pdf->GetStringWidth('Po Bulan') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'PO Bulan', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 40;
while ($pdf->GetStringWidth('UM') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'Nama Produk', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'Kode Produk', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);

$pdf->Cell(17, 10, 'SPEC', 1, 0, 'C');

$fontSize = 8;
$tempFontSize = $fontSize;

$cellWidth = 10;
while ($pdf->GetStringWidth('Po Bulan') > $cellWidth) {
  $pdf->SetFontSize($tempFontSize -= 0.1);
}
$pdf->Cell($cellWidth, 10, 'T (mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'W (mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'L (mm)', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'Unit', 1, 0, 'C');
$pdf->Cell($cellWidth, 10, 'BJ', 1, 0, 'C');
$tempFontSize = $fontSize;
$pdf->SetFontSize($fontSize);
$pdf->Cell(15, 10, 'Qty PO', 1, 0, 'C');
$pdf->Cell(36, 5, 'Qty Order', 1, 0, 'C');
$pdf->Cell(30, 5, 'Due Date', 1, 0, 'C');
$pdf->Cell(36, 5, 'Forecasting', 1, 0, 'C');
$pdf->Cell(6, 5, '', 0, 1, 'C');

$pdf->Cell(15, 5, '', 0, 0, 'C');
$pdf->Cell(15, 5, '', 0, 0, 'C');
$pdf->Cell(18, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(20, 5, '', 0, 0, 'C');
$pdf->Cell(52, 5, '', 0, 0, 'C');
$pdf->Cell(12, 5, 'Pcs', 1, 0, 'C');
// $pdf->Cell(9, 5, 'Kg', 1, 0, 'C');
$pdf->Cell(12, 5, 'Sht', 1, 0, 'C');
$pdf->Cell(12, 5, 'Lbr', 1, 0, 'C');

// $cust = $_POST['nama_cust'];
// $bln = date($_POST['bulan']);

// $data = mysqli_query($conn, "SELECT po_customer.*, customer.nickname, customer.nama_cust,part.*
//     FROM po_customer
//     JOIN part ON po_customer.id_part = part.id_part
//     JOIN customer ON po_customer.id_cust = customer.id_cust WHERE customer.nama_cust = '$cust' and tanggalterima_po like '$bln%'")  or die(mysqli_error($conn));

// while ($row = mysqli_fetch_array($data)) {
$pdf->Cell(15, 5, date('d-M', strtotime($_POST['rencana_pertama'])), 1, 0, 'C');
$pdf->Cell(15, 5, date('d-M', strtotime($_POST['rencana_kedua'])), 1, 0, 'C');
$pdf->Cell(12, 5, date('M', strtotime($_POST['forecast1'])), 1, 0, 'C');
$pdf->Cell(12, 5, date('M', strtotime($_POST['forecast2'])), 1, 0, 'C');
$pdf->Cell(12, 5, date('M', strtotime($_POST['forecast3'])), 1, 1, 'C');
// }
$no = 1;
$cust = $_POST['nama_cust'];
$bln = date($_POST['bulan']);

$pdf->SetFont('Times', '', '8');
$fontSize = "8";
$tempFontSize = $fontSize;
$data = mysqli_query($conn, "SELECT po_customer.*, customer.nickname, customer.nama_cust,part.*
    FROM po_customer
    JOIN part ON po_customer.id_part = part.id_part
    JOIN customer ON po_customer.id_cust = customer.id_cust WHERE customer.nama_cust = '$cust' and tanggal_po like '$bln%'")  or die(mysqli_error($conn));

while ($row = mysqli_fetch_assoc($data)) {

  $id = $no;
  $cellWidth = 5;
  while ($pdf->GetStringWidth($id) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };


  $pdf->Cell($cellWidth, 5, $id, 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 13;
  while ($pdf->GetStringWidth(date('M-Y', strtotime($row['tanggalterima_po']))) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, date('M-Y', strtotime($row['tanggalterima_po'])), 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 40;
  while ($pdf->GetStringWidth($row['nama_part']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['nama_part'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 40;
  while ($pdf->GetStringWidth($row['kode_part']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['kode_part'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 17;
  while ($pdf->GetStringWidth($row['spek_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['spek_material'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 10;
  while ($pdf->GetStringWidth($row['ketebalan']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['ketebalan'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 10;
  while ($pdf->GetStringWidth($row['lebar']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['lebar'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 10;
  while ($pdf->GetStringWidth($row['panjang']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['panjang'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 10;
  while ($pdf->GetStringWidth($row['unit_material']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['unit_material'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 10;
  while ($pdf->GetStringWidth($row['berat_jenis']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['berat_jenis'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);


  $cellWidth = 15;
  while ($pdf->GetStringWidth($row['qty_po']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_po'], 1, 0, "C");

  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  if ($row['sisi'] > 0) {
    $cellWidth = 12;
    while ($pdf->GetStringWidth($row['qty_po'] * $row['sisi']) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, ($row['qty_po'] * $row['sisi']), 1, 0, "C");

    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);
  } else {

    $cellWidth = 12;
    while ($pdf->GetStringWidth($row['qty_po']) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, ($row['qty_po']), 1, 0, "C");
  }

  if ($row['sisi'] > 0) {

    $cellWidth = 12;
    while ($pdf->GetStringWidth(('0'), 0) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, number_format('0'), 1, 0, "C");
  } else {
    $cellWidth = 12;
    while ($pdf->GetStringWidth((number_format((2438 / $row['lebar']))), 0) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, number_format((2438 / $row['lebar']), 0), 1, 0, "C");

    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);
  }

  if ($row['sisi'] > 0) {

    $cellWidth = 12;
    while ($pdf->GetStringWidth('0') > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, ('0'), 1, 0, "C");

    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);

  } else {
    $cellWidth = 12;
    while ($pdf->GetStringWidth((number_format(($row['panjang'] * $row['lebar'] * $row['qty_po']) / (1219 * 2438))), 0) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };
      $pdf->Cell($cellWidth, 5, number_format((($row['panjang'] * $row['lebar'] * $row['qty_po']) / (1219 * 2438)), 0), 1, 0, "C");
      
      $tempFontSize = $fontSize;
      $pdf->SetFontSize($fontSize);
    };


  $cellWidth = 15;
    while ($pdf->GetStringWidth($row['qty_po']) > $cellWidth) {
      $pdf->setFontSize($tempFontSize -= 0.1);
    };

    $pdf->Cell($cellWidth, 5, number_format(($row['qty_po'])), 1, 0, "C");

    $tempFontSize = $fontSize;
    $pdf->SetFontSize($fontSize);

  // if ($row['unit_mat'] == 'Lembar') {
  //   if ($row['qty_order'] > 0 && $row['pcs_lembar'] > 0) {
  //     $cellWidth = 15;
  //     while ($pdf->GetStringWidth((number_format(($row['qty_order'] / $row['pcs_lembar']) - $row['stok'])), 0)  > $cellWidth) {
  //       $pdf->setFontSize($tempFontSize -= 0.1);
  //     };

  //     $pdf->Cell($cellWidth, 5, number_format(($row['qty_order'] / $row['pcs_lembar']) - $row['stok']), 1, 0, "C");
  //     $tempFontSize = $fontSize;
  //     $pdf->SetFontSize($fontSize);
  //   } else {
  //     $cellWidth = 15;
  //     $pdf->Cell($cellWidth, 5, '0', 1, 0, "C");
  //   }
  // } else if ($row['unit_mat'] == 'Pieces') {
  //   $cellWidth = 15;
  //   while ($pdf->GetStringWidth(number_format($row['qty_order'] + (0.03 * $row['qty_order']))) > $cellWidth) {
  //     $pdf->setFontSize($tempFontSize -= 0.1);
  //   };

  //   $pdf->Cell($cellWidth, 5,  number_format($row['qty_order'] + (0.03 * $row['qty_order']), 0), 1, 0, "C");
  //   $tempFontSize = $fontSize;
  //   $pdf->SetFontSize($fontSize);
  // } else if ($row['unit_mat'] == 'Kg') {
  //   $cellWidth = 15;
  //   while ($pdf->GetStringWidth(number_format(($row['qty_order'] * $row['kg_pcs'] + (0.03 * $row['qty_order'] * $row['kg_pcs'])), 0)) > $cellWidth) {
  //     $pdf->setFontSize($tempFontSize -= 0.1);
  //   };

  //   $pdf->Cell($cellWidth, 5,  number_format(($row['qty_order'] * $row['kg_pcs'] + (0.03 * $row['qty_order'] * $row['kg_pcs'])), 0), 1, 0, "C");
  //   $tempFontSize = $fontSize;
  //   $pdf->SetFontSize($fontSize);
  // } else if ($row['unit_mat'] == 'Sheet') {
  //   if ($row['qty_order'] > 0 && $row['pcs_sheet'] > 0) {
  //     $cellWidth = 15;
  //     while ($pdf->GetStringWidth(number_format(($row['qty_order'] / $row['pcs_sheet'] + (0.03 * $row['qty_order'] / $row['pcs_sheet'])), 0)) > $cellWidth) {
  //       $pdf->setFontSize($tempFontSize -= 0.1);
  //     };

  //     $pdf->Cell($cellWidth, 5, number_format(($row['qty_order'] / $row['pcs_sheet'] + (0.03 * $row['qty_order'] / $row['pcs_sheet'])), 0), 1, 0, "C");
  //     $tempFontSize = $fontSize;
  //     $pdf->SetFontSize($fontSize);
  //   } else {
  //     $cellWidth = 15;

  //     $pdf->Cell($cellWidth, 5, '0', 1, 0, "C");
  //   }
  // }

  // $w = 15;
  // $h = 5;
  // $x = $pdf->GetX();
  // $pdf->mylov($w, $h, $x, $row['qty_rencana1']);

  $cellWidth = 15;
  while ($pdf->GetStringWidth($row['qty_rencana2']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_rencana2'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['qty_forecast1']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_forecast1'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['qty_forecast2']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_forecast2'], 1, 0, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);

  $cellWidth = 12;
  while ($pdf->GetStringWidth($row['qty_forecast3']) > $cellWidth) {
    $pdf->setFontSize($tempFontSize -= 0.1);
  };

  $pdf->Cell($cellWidth, 5, $row['qty_forecast3'], 1, 1, "C");
  $tempFontSize = $fontSize;
  $pdf->SetFontSize($fontSize);
  $no++;
}


ob_end_clean();
$pdf->Output('MRP-' . $_POST['nama_cust'] . '.pdf', 'I');
?>