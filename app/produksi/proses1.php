<?php include("../koneksi.php"); ?>
<?php $id_cust = $_GET['id_cust'];
$nomor = 1;
$num = 1;
$menghitung = 1;
$menghitung2 = 1;  ?>

        <?php for ($i = 0; $i < $id_cust; $i++) { ?>
            <?php $for = 'prosess' . $menghitung++;
            $for2 = 'prosess' . $menghitung2++;  ?>
            <label for="<?= $for; ?>">Nama Proses <?= $nomor++; ?></label>
            <?php $nm = 'prosess' . $num++; ?>
            <input type="text" autocomplete="off" class="form-control" name="<?= $nm; ?>" id="<?= $for2; ?>" placeholder="Contoh : Bending ">
<?php } ?>