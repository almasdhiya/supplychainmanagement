<?php
include "../koneksi.php";

$supp = $_POST['supp'];

$sql = mysqli_query($conn, "SELECT * FROM material where id_supp='$supp'");
echo '<option>- Pilih Material - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['id_material'] . '">' . $data['nama_material'], $data['kode_material'] . '</option>';
}
