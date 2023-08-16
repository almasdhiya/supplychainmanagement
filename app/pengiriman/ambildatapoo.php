<?php
include "../koneksi.php";

$mn = $_POST['mn'];

$sql = mysqli_query($conn, "SELECT id_po, no_po FROM po_customer where id_cust='$mn' and statuss='Sedang Diproses'");
echo '<option>- No PO Customer - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['id_po'] . '">' . $data['no_po'] . '</option>';
}
