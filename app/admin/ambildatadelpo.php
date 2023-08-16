<?php
include "../koneksi.php";

$cust = $_POST['cust'];

$sql = mysqli_query($conn, "SELECT distinct po_customer.no_po, po_customer.id_po, part.nama_part, customer.id_cust FROM po_customer 
inner join customer on customer.id_cust = po_customer.id_cust 
inner join part on part.id_part = po_customer.id_part where po_customer.id_cust='$cust' and statuss='Sedang Diproses'");
echo '<option>- No PO Customer - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['id_po'] . '">' . $data['no_po'] . '-' .$data['nama_part'] . '</option>';
}
