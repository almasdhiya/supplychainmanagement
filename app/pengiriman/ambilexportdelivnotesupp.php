<?php
include "../koneksi.php";

$supp = $_POST['supp'];

$sql = mysqli_query($conn, "SELECT distinct supplier.id_supp, material_recipt.surjal
FROM material_recipt
INNER JOIN supplier on supplier.id_supp = material_recipt.id_supp where supplier.id_supp='$supp'");
echo '<option>- No PO Supplier - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['surjal'] . '">' . $data['surjal'] . '</option>';
}
