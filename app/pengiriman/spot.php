<?php include("../koneksi.php"); ?>
<?php $id_cust = $_GET['id_cust'];
$nomor = 1;
$np = 1;
$num = 1;
$menghitung = 1;
$hitung = 1;
$menghitung2 = 1;
$hitung2 = 1;  ?>

<?php

for ($i = 0; $i < $id_cust; $i++) { ?>
    <?php $for = 'spott' . $menghitung++;
    $for2 = 'spott' . $menghitung2++; ?>
    <label for="<?= $for; ?>">Nama Spot <?= $nomor++; ?></label>
    <?php $nm = 'spott' . $num++; ?>
    <input type="text" autocomplete="off" class="form-control" name="<?= $nm; ?>" id="<?= $for2; ?>" placeholder="Contoh : Bending ">
    <?php $for1 = 'qtyspott' . $hitung++;
    $for4 = 'qtyspott' . $hitung2++;  ?>
    <label for1="<?= $for1; ?>">Qty Spot untuk 1 Part</label>
    <?php $nm1 = 'qtyspott' . $np++; ?>
    <input type="text" autocomplete="off" class="form-control" name="<?= $nm1; ?>" id="<?= $for5; ?>">
<?php } ?>