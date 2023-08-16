<?php
include "../koneksi.php";
if (isset($_POST['supp'])) {
    $supp = $_POST['supp'];

    $sql = mysqli_query($conn, "SELECT distinct po_supplier.no_po_supp, 
    supplier.nama_supp, po_supplier.id_po_supp,material.* FROM po_supplier 
    inner join supplier on supplier.id_supp = po_supplier.id_supp
    inner join material on material.id_material = po_supplier.id_material where supplier.id_supp='$supp' and statusss = 'Sedang Diproses'");
    echo '<option hidden>- No PO Supplier - </option>';
    while ($data = mysqli_fetch_array($sql)) {
        echo '<option value="' . $data['id_po_supp'] . '">' . $data['no_po_supp']. '-'. $data['nama_material']. '</option>';
    }
}

if (isset($_POST['posupp'])) {
    $posupp = $_POST['posupp'];

    $sql = mysqli_query($conn, "SELECT po_supplier.*, material.*, supplier.* FROM po_supplier
    inner join material on material.id_material = po_supplier.id_material
    inner join supplier on supplier.id_supp = po_supplier.id_supp where po_supplier.id_po_supp='$posupp' and statusss ='Sedang Diproses'");
    $row = mysqli_fetch_array($sql);



?>
    <form action="" method="POST">
        <div class="form-group">
            <div class="form-group">
                <br>
                <b><a>Material Yang Sudah Datang :</a></b>
            </div>
        </div>
        <table class="table-table-borderless">
            <tbody>
                <tr>
                    <td width="100%"> Spesifikasi Material </td>
                    <td>:&nbsp;<?php echo $row['spek_material'] ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="100%">Quantity Order Supplier</td>
                    <td>:&nbsp;<?php echo $row['qty_order_supp'] ?>&nbsp;<?php echo $row['satuan'] ?></td>
                    <td></td>
                <tr>
                <tr>
                    <td width="100%">Sisa Pengiriman</td>
                    <td>:&nbsp;<?php echo $row['sisa_pengiriman'] ?>&nbsp;<?php echo $row['satuan'] ?></td>
                    <td></td>
                <tr>
                <tr>
                    <td>
                        <label>Quantity Pengiriman</label>
                        <input type="text" autocomplete="off" class="form-control" id="qty_dikirim" name="qty_dikirim" required>
                    </td>
                <tr>
                <tr>
                    <td>
                        <label for="pcs_sheet">No Jalan Supplier</label>
                        <input type="text" autocomplete="off" class="form-control" id="id_material" name="id_material" value='<?php echo $row['id_material'] ?>' hidden>
                        <input type="text" autocomplete="off" class="form-control" id="id_supp" name="id_supp" value='<?php echo $row['id_supp'] ?>' hidden>
                        <input type="text" autocomplete="off" class="form-control" id="qty_order_supp" name="qty_order_supp" value="<?php echo $row['qty_order_supp'] ?>" hidden>
                        <input type="text" autocomplete="off" class="form-control" id="surjal" name="surjal" required>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-md-2">
            <label></label>
            <button type="tambah" name="tambah" class="btn btn-md btn-success">Simpan</button>
        </div>
    </form>
<?php } ?>