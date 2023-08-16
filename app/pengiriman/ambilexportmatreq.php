<?php
include "../koneksi.php";

$supp = $_POST['supp'];

$sql = mysqli_query($conn, "SELECT distinct supplier.id_supp, po_supplier.no_po_supp from po_supplier
inner join supplier on supplier.id_supp = po_supplier.id_supp where po_supplier.id_supp ='$supp'");
echo '<option hidden>- No PO Supplier - </option>';
while ($data = mysqli_fetch_array($sql)) {
    echo '<option value="' . $data['no_po_supp'] . '">' . $data['no_po_supp'] . '</option>';
    
}
