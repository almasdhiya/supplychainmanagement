<?php
include "../koneksi.php";

$p = $_POST['p'];

$sql = mysqli_query($conn, "SELECT distinct nosurjal FROM deliveryfg where id_cust='$p'");
echo '<option>- Pilih No Surat Jalan - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['nosurjal'] . '">' . $data['nosurjal'] . '</option>';
}
