<?php
include "../koneksi.php";

$supp = $_POST['supp'];

$sql = mysqli_query($conn, "SELECT * FROM po_supplier where id_supp='$supp'");
echo '<option>- No PO Supplier - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['id_po_supp'] . '">' . $data['no_po_supp'] . '</option>';
}
