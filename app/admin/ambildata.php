<?php
include "../koneksi.php";

$cust = $_POST['cust'];

$sql = mysqli_query($conn, "SELECT * FROM part where id_cust='$cust'");
echo '<option hidden>- Pilih Part - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['id_part'] . '">' . $data['nama_part'] . '</option>';
}
