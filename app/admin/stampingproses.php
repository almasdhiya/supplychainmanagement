<script src="jquery-3.3.1.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<meta http-equiv="refresh" content="1800; url=login.php">
<?php
session_start();
if ($_SESSION['role'] == "") {
    header("location:index.php?pesan=gagal");
}
?>
<?php
include('header.php');
include('sidebar.php');
include('../koneksi.php');


if (isset($_POST['oui'])) {
    $id_cust = $_POST['cust'];
    $id_part = $_POST['part'];
    $id_material = $_POST['id_material'];
    $id_po = $_POST['no_po'];
    $spott = $_POST['spott'];
    $prosess = $_POST['prosess'];


    $wip = mysqli_query($conn, "SELECT qty_po FROM po_customer where id_po = '$id_po'");
    $hasil = mysqli_fetch_assoc($wip);

    $query1 = mysqli_query($conn, "INSERT INTO proses (id_prs,id_cust,id_material,id_part,id_po,proses,spot)
     VALUES (LAST_INSERT_ID(),'$id_cust','$id_material','$id_part','$id_po','$prosess','$spott')");
    $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
    $id_prs = mysqli_fetch_assoc($oo);

    if ($prosess == 1) {
        $proses1 = $_POST['prosess1'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID()");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        // print_r($po['id_po']);
        if (@$id_po != @$po['id_po']) {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "' ) ");
        } else {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
        }
    } elseif ($prosess == 2) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "' ) ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "' )");
        }
    } elseif ($prosess == 3) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $proses3 = $_POST['prosess3'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "') ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $hasil['qty_po'] . "')");
        }
    } elseif ($prosess == 4) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $proses3 = $_POST['prosess3'];
        $proses4 = $_POST['prosess4'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $pilihwip['wip'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "') ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $hasil['qty_po'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $hasil['qty_po'] . "')");
        }
    } elseif ($prosess == 5) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $proses3 = $_POST['prosess3'];
        $proses4 = $_POST['prosess4'];
        $proses5 = $_POST['prosess5'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $pilihwip['wip'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $pilihwip['wip'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "') ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $hasil['qty_po'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $hasil['qty_po'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $hasil['qty_po'] . "')");
        }
    } elseif ($prosess == 6) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $proses3 = $_POST['prosess3'];
        $proses4 = $_POST['prosess4'];
        $proses5 = $_POST['prosess5'];
        $proses6 = $_POST['prosess6'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $pilihwip['wip'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $pilihwip['wip'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $pilihwip['wip'] . "')");
            $query6 = mysqli_query($conn, "INSERT INTO proses6 (id_prs6,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses6','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "') ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $hasil['qty_po'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $hasil['qty_po'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $hasil['qty_po'] . "')");
            $query6 = mysqli_query($conn, "INSERT INTO proses6 (id_prs6,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses6','" . $hasil['qty_po'] . "')");
        }
    } elseif ($prosess == 7) {
        $proses1 = $_POST['prosess1'];
        $proses2 = $_POST['prosess2'];
        $proses3 = $_POST['prosess3'];
        $proses4 = $_POST['prosess4'];
        $proses5 = $_POST['prosess5'];
        $proses6 = $_POST['prosess6'];
        $proses7 = $_POST['prosess7'];
        $oo = mysqli_query($conn, "SELECT id_prs FROM proses WHERE id_prs = LAST_INSERT_ID();");
        $id_prs = mysqli_fetch_assoc($oo);
        @$select = mysqli_query($conn, "SELECT id_po FROM proses1 where id_po = '$id_po'");
        @$po = mysqli_fetch_assoc($select);
        if (@$id_po != @$po['id_po']) {
            $pilih = mysqli_query($conn, "SELECT wip FROM proses1 where id_po='$id_po'");
            $pilihwip = mysqli_fetch_assoc($pilih);
            $wip = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $pilihwip['wip'] . "')");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $pilihwip['wip'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $pilihwip['wip'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $pilihwip['wip'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $pilihwip['wip'] . "')");
            $query6 = mysqli_query($conn, "INSERT INTO proses6 (id_prs6,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses6','" . $pilihwip['wip'] . "')");
            $query7 = mysqli_query($conn, "INSERT INTO proses7 (id_prs7,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses7','" . $pilihwip['wip'] . "')");
        } else {
            $query1 = mysqli_query($conn, "INSERT INTO proses1 (id_prs1,id_prs,id_cust,id_material,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_material','$id_part','$id_po','$proses1','" . $hasil['qty_po'] . "') ");
            $query2 = mysqli_query($conn, "INSERT INTO proses2 (id_prs2,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses2','" . $hasil['qty_po'] . "')");
            $query3 = mysqli_query($conn, "INSERT INTO proses3 (id_prs3,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses3','" . $hasil['qty_po'] . "')");
            $query4 = mysqli_query($conn, "INSERT INTO proses4 (id_prs4,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses4','" . $hasil['qty_po'] . "')");
            $query5 = mysqli_query($conn, "INSERT INTO proses5 (id_prs5,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses5','" . $hasil['qty_po'] . "')");
            $query6 = mysqli_query($conn, "INSERT INTO proses6 (id_prs6,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses6','" . $hasil['qty_po'] . "')");
            $query7 = mysqli_query($conn, "INSERT INTO proses7 (id_prs7,id_prs,id_cust,id_part,id_po,nama_proses,wip) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$proses7','" . $hasil['qty_po'] . "')");
        }
    }
    if ($spott == 1) {
        $spot1 = $_POST['spott1'];
        $qtyspott1 = $_POST['qtyspott1'];
        $query1 = mysqli_query($conn, "INSERT into spot1 (id_spot1,id_prs,id_cust,id_part,id_po,nama_spot,qty_spott1) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$spot1','$qtyspott1')");
    }
    // } elseif ($spott == 2) {
    //     $spot1 = $_POST['spott1'];
    //     $spot2 = $_POST['spott2'];
    //     $qtyspott1 = $_POST['qtyspott1'];
    //     $qtyspott2 = $_POST['qtyspott2'];
    //     $query1 = mysqli_query($conn, "INSERT into spot1 (id_spot1,id_prs,id_cust,id_part,id_po,nama_spot,qty_spott1) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$spot1','$qtyspott1')");
    //     $query2 = mysqli_query($conn, "INSERT into spot2 (id_spot2,id_prs,id_cust,id_part,id_po,nama_spot,qty_spott2) VALUES ('','" . $id_prs['id_prs'] . "','$id_cust','$id_part','$id_po','$spot2','$qtyspott2')");
    // }
}


if (isset($_POST['simpan'])) {
    $id_prs1 = $_POST['id_prs1'];
    $qty_aktual = $_POST['qty_aktual'];
    $cust = $_POST['id_cust'];
    $qty_ng = $_POST['qty_ng'];
    $tgl = $_POST['tgl'];
    $id_part = $_POST['id_part'];
    $id_material = $_POST['id_material'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $keterangan = $_POST['keterangan'];

    $quantity = mysqli_query($conn, "SELECT proses1.*, shearing_material.qty_sheet FROM `proses1` inner join shearing_material on shearing_material.id_material = proses1.id_material where proses1.id_prs1 = '$id_prs1';");
    while ($row = mysqli_fetch_array($quantity)) {
        $hasil = $row['qty_sheet'];
        $wip = $row['wip'];
        if ($wip == 0) {
            echo '<script>
        swal.fire({
          text: "STOCK WIP UNTUK PO INI SUDAH KOSONG!",
          icon: "warning",
          button: "Close!",
        });
    </script>';
        } else if ($hasil == 0) {
            echo '<script>
        swal.fire({
          text: "MATERIAL UNTUK PART INI SUDAH HABIS!",
          icon: "warning",
          button: "Close!",
        });
    </script>';
        } else if ($qty_aktual > $wip) {
            echo '<script>
                    swal.fire({
                      text: "Anda menginput quantity melebihi order PO Customer!",
                      icon: "warning",
                      button: "Close!",
                    });
                </script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses1 set qty_aktual = '$qty_aktual' - '$qty_ng', qty_ng = '$qty_ng', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs1 = '$id_prs1'");
            $kurs = mysqli_query($conn, "UPDATE proses1 SET wip = $wip - '$qty_aktual' WHERE id_po = '$id_po' and id_part ='$id_part'");

            $hasil = $row['qty_sheet'];
            print_r($qty_aktual);
            // exit();
            $query4 = mysqli_query($conn, "UPDATE shearing_material inner join proses1 on proses1.id_material = shearing_material.id_material SET shearing_material.qty_sheet = '$hasil' - '$qty_aktual' 
                    WHERE proses1.id_prs1 = '$id_prs1'");
        }
    }
}
// }
// }
// } else if ($unit == 'Tube') {
//     $query3 = mysqli_query($conn, "SELECT qty_tube FROM tube where id_po = '$id_po' and id_part ='$id_part'");
//     while ($row = mysqli_fetch_array($query3)) {
//         $hasil = $row['qty_tube'];
//         $hi = mysqli_query($conn, "SELECT wip from proses1 where id_po = '$id_po' and id_part ='$id_part'");
//         while ($row = mysqli_fetch_array($hi)) {
//             $wip = $row['wip'];
//             if ($wip == 0) {
//                 echo '<script>
//         swal.fire({
//           text: "STOCK WIP UNTUK PO INI SUDAH KOSONG!",
//           icon: "warning",
//           button: "Close!",
//         });
//     </script>';
//             } else if ($hasil == 0) {
//                 echo '<script>
//         swal.fire({
//           text: "MATERIAL UNTUK PART INI SUDAH HABIS!",
//           icon: "warning",
//           button: "Close!",
//         });
//     </script>';
//             } else {
//                 $query = mysqli_query($conn, "UPDATE proses1 set qty_aktual = '$qty_aktual' - '$qty_ng', qty_ng = '$qty_ng', 
// tgl = '$tgl', keterangan = '$keterangan' where id_prs1 = '$id_prs1'");
//                 $kurs = mysqli_query($conn, "UPDATE proses1 SET wip = $wip - '$qty_aktual' WHERE id_po = '$id_po'");
//                 $query3 = mysqli_query($conn, "SELECT qty_tube FROM tube where id_po = '$id_po' and id_part='$id_part'");
//                 while ($row = mysqli_fetch_array($query3)) {
//                     $hasil = $row['qty_tube'];
//                     $query4 = mysqli_query($conn, "UPDATE tube SET qty_tube='$hasil' - '$qty_aktual' 
// WHERE id_po ='$id_po' and id_part='$id_part'");
//                 }
//             }
//         }
//     }
// } else if ($unit == 'Coil') {
//     $query3 = mysqli_query($conn, "SELECT qty_coil FROM coil where id_po = '$id_po' and id_part ='$id_part'");
//     while ($row = mysqli_fetch_array($query3)) {
//         $hasil = $row['qty_coil'];
//         $hi = mysqli_query($conn, "SELECT wip from proses1 where id_po = '$id_po' and id_part ='$id_part'");
//         while ($row = mysqli_fetch_array($hi)) {
//             $wip = $row['wip'];
//             if ($wip == 0) {
//                 echo '<script>
//         swal.fire({
//           text: "STOCK WIP UNTUK PO INI SUDAH KOSONG!",
//           icon: "warning",
//           button: "Close!",
//         });
//     </script>';
//             } else if ($hasil == 0) {
//                 echo '<script>
//         swal.fire({
//           text: "MATERIAL UNTUK PART INI SUDAH HABIS!",
//           icon: "warning",
//           button: "Close!",
//         });
//     </script>';
//             } else {
//                 $query = mysqli_query($conn, "UPDATE proses1 set qty_aktual = '$qty_aktual' - '$qty_ng', qty_ng = '$qty_ng', 
// tgl = '$tgl', keterangan = '$keterangan' where id_prs1 = '$id_prs1'");
//                 $kurs = mysqli_query($conn, "UPDATE proses1 SET wip = $wip - '$qty_aktual' WHERE id_po = '$id_po'");
//                 $query3 = mysqli_query($conn, "SELECT qty_coil FROM coil where id_po = '$id_po' and id_part='$id_part'");
//                 while ($row = mysqli_fetch_array($query3)) {
//                     $hasil = $row['qty_coil'];
//                     $query4 = mysqli_query($conn, "UPDATE coil SET qty_coil='$hasil' - '$qty_aktual' 
// WHERE id_po ='$id_po' and id_part='$id_part'");
//                 }
//             }
//         }
//     }
// }

// $query7 = mysqli_query($conn, "SELECT proses,spot,welding from proses where id_prs = '$id_prs'");
// while ($row = mysqli_fetch_array($query7)) {
//     $proses = $row['proses'];
//     $spot = $row['spot'];
//     $welding = $row['welding'];

//     if ($proses == 1 && $spot == 'Nonspot' && $welding == 'Tidak') {
//         $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_prs,id_po,id_cust, id_part, qty_fg) VALUES('','$id_prs','$id_po','$cust','$id_part','$qty_aktual'-'$qty_ng')");
//     } else {
//         $input = mysqli_query($conn, "INSERT INTO convertpcs (id_pcs, id_po,id_prs,id_cust, id_part, qty_pieces) VALUES('','$id_po','$id_prs','$cust','$id_part','$qty_aktual'-'$qty_ng')");
//     }
// }
// $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
// while ($row = mysqli_fetch_array($query8)) {
//     $qty = $row['qty_pieces'];
//     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
//     WHERE id_prs ='$id_prs'");
//     $weld = mysqli_query($conn, "UPDATE welding SET qty_pieces = '$qty'
//     WHERE id_part ='$id_part'");
// }

if (isset($_POST['edit'])) {
    $id_prs2 = $_POST['id_prs2'];
    // $qty_aktual = $_POST['qty_aktual'];
    $cust = $_POST['id_cust'];
    $tgl = $_POST['tgl'];
    $qty_ngg = $_POST['qty_ngg'];
    $id_part = $_POST['id_part'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $keterangan = $_POST['keterangan'];

    $qty = mysqli_query($conn, "SELECT * from proses2 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outt = $row['qty_outt'];
        $wip = $row['wip'];
        if ($qty_ngg > $qty_outt) {
            echo '<script>
                swal.fire({
                  text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
                  icon: "warning",
                  button: "Close!",
                });
            </script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt - '$qty_ngg', qty_ngg = '$qty_ngg', 
        tgl = '$tgl', keterangan = '$keterangan' where id_prs2 = '$id_prs2'");
        //    $kurs = mysqli_query($conn, "UPDATE proses2 SET wip = $wip - '$qty_outt' WHERE id_po = '$id_po' and id_part ='$id_part'");

        }
    }
}


if (isset($_POST['update'])) {
    $id_prs3 = $_POST['id_prs3'];
    // $qty_outtt = $_POST['qty_outtt'];
    $tgl = $_POST['tgl'];
    $qty_nggg = $_POST['qty_nggg'];
    $id_part = $_POST['id_part'];
    $keterangan = $_POST['keterangan'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $cust = $_POST['id_cust'];

    $qty = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outtt = $row['qty_outtt'];
        if ($qty_nggg > $qty_outtt) {
            echo '<script>
    swal.fire({
      text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
      icon: "warning",
      button: "Close!",
    });
</script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses3 set qty_outtt = qty_outtt - '$qty_nggg', qty_nggg = '$qty_nggg', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs3 = '$id_prs3'");
        }
    }
}

if (isset($_POST['hi'])) {
    $id_prs4 = $_POST['id_prs4'];
    // $qty_outttt = $_POST['qty_outttt'];
    $tgl = $_POST['tgl'];
    $qty_ngggg = $_POST['qty_ngggg'];
    $id_part = $_POST['id_part'];
    $keterangan = $_POST['keterangan'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $cust = $_POST['id_cust'];


    $qty = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outttt = $row['qty_outttt'];
        if ($qty_ngggg > $qty_outttt) {
            echo '<script>
    swal.fire({
      text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
      icon: "warning",
      button: "Close!",
    });
</script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses4 set qty_outttt = qty_outttt - '$qty_ngggg', qty_ngggg = '$qty_ngggg', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs4 = '$id_prs4'");
        }
    }
}

if (isset($_POST['yoi'])) {
    $id_prs5 = $_POST['id_prs5'];
    // $qty_outtttt = $_POST['qty_outtttt'];
    $qty_nggggg = $_POST['qty_nggggg'];
    $tgl = $_POST['tgl'];
    $id_part = $_POST['id_part'];
    $keterangan = $_POST['keterangan'];
    $id_po = $_POST['id_po'];
    $cust = $_POST['id_cust'];
    $id_prs = $_POST['id_prs'];


    $qty = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outtttt = $row['qty_outtttt'];
        if ($qty_nggggg > $qty_outtttt) {
            echo '<script>
    swal.fire({
      text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
      icon: "warning",
      button: "Close!",
    });
</script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses5 set qty_outtttt = qty_outtttt - '$qty_nggggg', qty_nggggg = '$qty_nggggg', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs5 = '$id_prs5'");
        }
    }
}

if (isset($_POST['almaz'])) {
    $id_prs6 = $_POST['id_prs6'];
    // $qty_outttttt = $_POST['qty_outttttt'];
    $qty_ngggggg = $_POST['qty_ngggggg'];
    $tgl = $_POST['tgl'];
    $id_part = $_POST['id_part'];
    $keterangan = $_POST['keterangan'];
    $id_po = $_POST['id_po'];
    $cust = $_POST['id_cust'];
    $id_prs = $_POST['id_prs'];

    $qty = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outttttt = $row['qty_outttttt'];
        if ($qty_ngggggg > $qty_outttttt) {
            echo '<script>
    swal.fire({
      text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
      icon: "warning",
      button: "Close!",
    });
</script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses6 set qty_outttttt = qty_outttttt - '$qty_ngggggg', qty_ngggggg = '$qty_ngggggg', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs6 = '$id_prs6'");
        }
    }
}

if (isset($_POST['apa'])) {
    $id_prs7 = $_POST['id_prs7'];
    // $qty_outtttttt = $_POST['qty_outtttttt'];
    $qty_nggggggg = $_POST['qty_nggggggg'];
    $tgl = $_POST['tgl'];
    $id_part = $_POST['id_part'];
    $keterangan = $_POST['keterangan'];
    $id_po = $_POST['id_po'];
    $cust = $_POST['id_cust'];
    $id_prs = $_POST['id_prs'];

    $qty = mysqli_query($conn, "SELECT qty_outtttttt from proses7 where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($qty)) {
        $qty_outtttttt = $row['qty_outtttttt'];
        if ($qty_nggggggg > $qty_outtttttt) {
            echo '<script>
    swal.fire({
      text: "Quantity not good yang anda input melebih jumlah quantity WIP!",
      icon: "warning",
      button: "Close!",
    });
</script>';
        } else {
            $query = mysqli_query($conn, "UPDATE proses7 set qty_outtttttt = qty_outtttttt - '$qty_nggggggg', qty_nggggggg = '$qty_nggggggg', 
tgl = '$tgl', keterangan = '$keterangan' where id_prs7 = '$id_prs7'");
        }
    }
}

if (isset($_POST['repair'])) {
    $id_prs1 = $_POST['id_prs1'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_aktual,qty_ng from proses1 where id_prs1 = '$id_prs1'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_aktual = $row['qty_aktual'];
        $qty_ng = $row['qty_ng'];
        if ($qty_repair <= $qty_ng) {
            $query2 = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$qty_aktual' + '$qty_repair', qty_ng = '$qty_ng'-'$qty_repair' WHERE id_prs1 = '$id_prs1'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair2'])) {
    $id_prs2 = $_POST['id_prs2'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outt,qty_ngg from proses2 where id_prs2 = '$id_prs2'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outt = $row['qty_outt'];
        $qty_ngg = $row['qty_ngg'];
        if ($qty_repair <= $qty_ngg) {
            $query2 = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$qty_outt' + '$qty_repair', qty_ngg = '$qty_ngg'-'$qty_repair' WHERE id_prs2 = '$id_prs2'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair3'])) {
    $id_prs3 = $_POST['id_prs3'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outtt,qty_nggg from proses3 where id_prs3 = '$id_prs3'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outtt = $row['qty_outtt'];
        $qty_nggg = $row['qty_nggg'];
        if ($qty_repair <= $qty_nggg) {
            $query2 = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$qty_outtt' + '$qty_repair', qty_nggg = '$qty_nggg'-'$qty_repair' WHERE id_prs3 = '$id_prs3'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair4'])) {
    $id_prs4 = $_POST['id_prs4'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outttt,qty_ngggg from proses4 where id_prs4 = '$id_prs4'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outttt = $row['qty_outttt'];
        $qty_ngggg = $row['qty_ngggg'];
        if ($qty_repair <= $qty_ngggg) {
            $query2 = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$qty_outttt' + '$qty_repair', qty_ngggg = '$qty_ngggg'-'$qty_repair' WHERE id_prs4 = '$id_prs4'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair5'])) {
    $id_prs5 = $_POST['id_prs5'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outtttt,qty_nggggg from proses5 where id_prs5 = '$id_prs5'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outtttt = $row['qty_outtttt'];
        $qty_nggggg = $row['qty_nggggg'];
        if ($qty_repair <= $qty_nggggg) {
            $query2 = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$qty_outtttt' + '$qty_repair', qty_nggggg = '$qty_nggggg'-'$qty_repair' WHERE id_prs5 = '$id_prs5'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair6'])) {
    $id_prs6 = $_POST['id_prs6'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outttttt,qty_ngggggg from proses6 where id_prs6 = '$id_prs6'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outttttt = $row['qty_outttttt'];
        $qty_ngggggg = $row['qty_ngggggg'];
        if ($qty_repair <= $qty_ngggggg) {
            $query2 = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$qty_outttttt' + '$qty_repair', qty_ngggggg = '$qty_ngggggg'-'$qty_repair' WHERE id_prs6 = '$id_prs6'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}

if (isset($_POST['repair7'])) {
    $id_prs7 = $_POST['id_prs7'];
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $qty_repair = $_POST['qty_repair'];

    $select = mysqli_query($conn, "SELECT qty_outtttttt,qty_nggggggg from proses7 where id_prs7 = '$id_prs7'");
    while ($row = mysqli_fetch_array($select)) {
        $qty_outtttttt = $row['qty_outtttttt'];
        $qty_nggggggg = $row['qty_nggggggg'];
        if ($qty_repair <= $qty_nggggggg) {
            $query2 = mysqli_query($conn, "UPDATE proses7 SET qty_outtttttt = '$qty_outtttttt' + '$qty_repair', qty_nggggggg = '$qty_nggggggg'-'$qty_repair' WHERE id_prs7 = '$id_prs7'");
            echo '<script>
            swal.fire({
                text: "Berhasil di Repair!",
                icon: "success",
                button: "Close!",
            });
            </script>';
        } else {
            echo '<script>
            swal.fire({
                text: "Quantity yang anda input melebih jumlah produk yang harus di repair!",
                icon: "warning",
                button: "Close!",
            });
            </script>';
        }
    }
}


if (isset($_POST['oe'])) {
    $id_part = $_POST['id_part'];
    $id_prs1 = $_POST['id_prs1'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_aktual from proses1 where id_prs1='$id_prs1'");
        while ($row = mysqli_fetch_array($query7)) {
            $aktual = $row['qty_aktual'];
            if ($proses == 1 && $spot == 'Nonspot' && $aktual >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part'");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$aktual' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs1='$id_prs1'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $aktual) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 1 && $spot != 'Nonspot' && $aktual >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_aktual from proses1 where id_prs1='$id_prs1'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $aktual = $row['qty_aktual'];
                            $update = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$aktual' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs1='$id_prs1'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Assembly Proses!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_aktual from proses1 where id_prs1='$id_prs1'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $aktual = $row['qty_aktual'];
                            $update = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$aktual' - '$qty_fg', kondisi = 'Sudah Digunakan'  where id_prs1='$id_prs1'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Assembly Proses!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    }
                }
            } else if ($proses != 1 && $spot != 'Nonspot' || $spot == 'Nonspot' && $aktual >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_aktual from proses1 where id_prs1='$id_prs1'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $aktual = $row['qty_aktual'];
                            $update = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$aktual' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs1='$id_prs1'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_aktual from proses1 where id_prs1='$id_prs1'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $aktual = $row['qty_aktual'];
                            $update = mysqli_query($conn, "UPDATE proses1 SET qty_aktual = '$aktual' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs1='$id_prs1'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
    // $weld = mysqli_query($conn, "UPDATE welding SET qty_pieces = '$qty'
    // WHERE id_part ='$id_part'");
}

if (isset($_POST['oe2'])) {
    $id_part = $_POST['id_part'];
    $id_prs2 = $_POST['id_prs2'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outt from proses2 where id_prs2='$id_prs2'");
        while ($row = mysqli_fetch_array($query7)) {
            $outt = $row['qty_outt'];
            if ($proses == 2 && $spot == 'Nonspot' && $outt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$outt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs2='$id_prs2'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 2 && $spot != 'Nonspot' && $outt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outt from proses2 where id_prs2='$id_prs2'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outt = $row['qty_outt'];
                            $update = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$outt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs2='$id_prs2'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outt from proses2 where id_prs2='$id_prs2'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outt = $row['qty_outt'];
                            $update = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$outt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs2='$id_prs2'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            } else if ($proses > 2 && $spot != 'Nonspot' || $spot == 'Nonspot' && $outt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses3 set qty_outtt = qty_outtt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outt from proses2 where id_prs2='$id_prs2'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outt = $row['qty_outt'];
                            $update = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$outt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs2='$id_prs2'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses3 set qty_outtt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outt from proses2 where id_prs2='$id_prs2'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outt = $row['qty_outt'];
                            $update = mysqli_query($conn, "UPDATE proses2 SET qty_outt = '$outt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs2='$id_prs2'");
                        }
                        echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
}


if (isset($_POST['oe3'])) {
    $id_part = $_POST['id_part'];
    $id_prs3 = $_POST['id_prs3'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs3='$id_prs3'");
        while ($row = mysqli_fetch_array($query7)) {
            $outtt = $row['qty_outtt'];
            if ($proses == 3 && $spot == 'Nonspot' && $outtt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$outtt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs3='$id_prs3'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outtt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 3 && $spot != 'Nonspot' && $outtt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs3='$id_prs3'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtt = $row['qty_outtt'];
                            $update = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$outtt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs3='$id_prs3'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs3='$id_prs3'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtt = $row['qty_outtt'];
                            $update = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$outtt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs3='$id_prs3'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            } else if ($proses > 3 && $spot != 'Nonspot' || $spot == 'Nonspot' && $outtt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses4 set qty_outttt = qty_outttt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs3='$id_prs3'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtt = $row['qty_outtt'];
                            $update = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$outtt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs3='$id_prs3'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses4 set qty_outttt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtt from proses3 where id_prs3='$id_prs3'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtt = $row['qty_outtt'];
                            $update = mysqli_query($conn, "UPDATE proses3 SET qty_outtt = '$outtt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs3='$id_prs3'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
}

if (isset($_POST['oe4'])) {
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $id_prs4 = $_POST['id_prs4'];
    $qty_fg = $_POST['qty_fg'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs4='$id_prs4'");
        while ($row = mysqli_fetch_array($query7)) {
            $outttt = $row['qty_outttt'];
            if ($proses == 4 && $spot == 'Nonspot' && $outttt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$outttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs4='$id_prs4'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outttt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 4 && $spot != 'Nonspot' && $outttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs4='$id_prs4'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttt = $row['qty_outttt'];
                            $update = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$outttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs4='$id_prs4'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs4='$id_prs4'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttt = $row['qty_outttt'];
                            $update = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$outttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs4='$id_prs4'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            } else if ($proses > 4 && $spot != 'Nonspot' || $spot == 'Nonspot' && $outttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses5 set qty_outtttt = qty_outtttt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs4='$id_prs4'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttt = $row['qty_outttt'];
                            $update = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$outttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs4='$id_prs4'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses5 set qty_outtttt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttt from proses4 where id_prs4='$id_prs4'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttt = $row['qty_outttt'];
                            $update = mysqli_query($conn, "UPDATE proses4 SET qty_outttt = '$outttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs4='$id_prs4'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
}

if (isset($_POST['oe5'])) {
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];
    $id_prs5 = $_POST['id_prs5'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs5='$id_prs5'");
        while ($row = mysqli_fetch_array($query7)) {
            $outtt = $row['qty_outtttt'];
            if ($proses == 5 && $spot == 'Nonspot' && $outtttt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$outtttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs5='$id_prs5'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outtt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 5 && $spot != 'Nonspot' && $outtttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs5='$id_prs5'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttt = $row['qty_outtttt'];
                            $update = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$outtttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs5='$id_prs5'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs5='$id_prs5'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttt = $row['qty_outtttt'];
                            $update = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$outtttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs5='$id_prs5'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            } else if ($proses > 5 && $spot != 'Nonspot' || $spot == 'Nonspot' && $outtttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses6 set qty_outttttt = qty_outttttt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs5='$id_prs5'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttt = $row['qty_outtttt'];
                            $update = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$outtttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs5='$id_prs5'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses6 set qty_outttttt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttt from proses5 where id_prs5='$id_prs5'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttt = $row['qty_outtttt'];
                            $update = mysqli_query($conn, "UPDATE proses5 SET qty_outtttt = '$outtttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs5='$id_prs5'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
}

if (isset($_POST['oe6'])) {
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];
    $id_prs6 = $_POST['id_prs6'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs6='$id_prs6'");
        while ($row = mysqli_fetch_array($query7)) {
            $outttttt = $row['qty_outttttt'];
            if ($proses == 6 && $spot == 'Nonspot'  && $outttttt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$outttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs6='$id_prs6'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outttttt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 6 && $spot != 'Nonspot' && $outttttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs6='$id_prs6'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttttt = $row['qty_outttttt'];
                            $update = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$outttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs6='$id_prs6'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs6='$id_prs6'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttttt = $row['qty_outttttt'];
                            $update = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$outttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs6='$id_prs6'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            } else if ($proses > 6 && $spot != 'Nonspot' || $spot == 'Nonspot' && $outttttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        $update = mysqli_query($conn, "UPDATE proses7 set qty_outtttttt = qty_outtttttt + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs6='$id_prs6'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttttt = $row['qty_outttttt'];
                            $update = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$outttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs6='$id_prs6'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    } else {
                        $update = mysqli_query($conn, "UPDATE proses7 set qty_outtttttt = '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outttttt from proses6 where id_prs6='$id_prs6'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outttttt = $row['qty_outttttt'];
                            $update = mysqli_query($conn, "UPDATE proses6 SET qty_outttttt = '$outttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs6='$id_prs6'");
                            echo '<script>
                        swal.fire({
                          text: "Produk berhasil masuk ke Proses Selanjutnya!",
                          icon: "success",
                          button: "Close!",
                        });
                    </script>';
                        }
                    }
                }
            }
        }
    }
    // $query8 = mysqli_query($conn, "SELECT qty_pieces from convertpcs where id_prs = '$id_prs'");
    // while ($row = mysqli_fetch_array($query8)) {
    //     $qty = $row['qty_pieces'];
    //     $spot = mysqli_query($conn, "UPDATE spot1 SET qty_spot='$qty' 
    //     WHERE id_prs ='$id_prs'");
    // }
}

if (isset($_POST['oe7'])) {
    $id_part = $_POST['id_part'];
    $id_cust = $_POST['id_cust'];
    $id_po = $_POST['id_po'];
    $id_prs = $_POST['id_prs'];
    $qty_fg = $_POST['qty_fg'];
    $id_prs7 = $_POST['id_prs7'];

    $query7 = mysqli_query($conn, "SELECT proses,spot from proses where id_prs = '$id_prs'");
    while ($row = mysqli_fetch_array($query7)) {
        $proses = $row['proses'];
        $spot = $row['spot'];
        $query7 = mysqli_query($conn, "SELECT qty_outtttttt from proses7 where id_prs7='$id_prs7'");
        while ($row = mysqli_fetch_array($query7)) {
            $outtttttt = $row['qty_outtttttt'];
            if ($proses == 7 && $spot == 'Nonspot' && $outtttttt >= $qty_fg) {
                $input = mysqli_query($conn, "INSERT INTO fg (id_fg, id_po,id_cust, id_part, qty_fg) VALUES('','$id_po','$id_cust','$id_part','$qty_fg')");
                $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_fg FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
            set fgg.total_qty = grp.value_fg
            where fgg.id_part = '$id_part';");
                //     $ganti = mysqli_query($conn, "UPDATE fg as fgg JOIN (SELECT id_fg, SUM(qty_fg) as value_part FROM fg where id_part = '$id_part') as grp on grp.id_fg = fgg.id_fg 
                // set fgg.total_qty_part = grp.value_part
                // where fgg.id_part = '$id_part';");
                $update = mysqli_query($conn, "UPDATE proses7 SET qty_outtttttt = '$outtttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs7='$id_prs7'");
                echo '<script>
                swal.fire({
                  text: "Produk berhasil masuk ke Data Finish Good!",
                  icon: "success",
                  button: "Close!",
                });
            </script>';
            } else if ($qty_fg > $outtttttt) {
                echo '<script>
                swal.fire({
                text: "JUMLAH YANG DIINPUT MELEBIHI WIP!",
                icon: "warning",
                button: "Close!",
                });
                </script>';
            } else if ($proses == 7 && $spot != 'Nonspot' && $outtttttt >= $qty_fg) {
                $select = mysqli_query($conn, "SELECT id_prs FROM proses where id_prs ='$id_prs'");
                while ($row = mysqli_fetch_array($select)) {
                    $idd_prs = $row['id_prs'];
                    if ($id_prs == $idd_prs) {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = '$qty_fg'");
                        $tambah = mysqli_query($conn, "UPDATE spot1 set qty_spot = qty_spot + '$qty_fg' where id_prs ='$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttttt from proses7 where id_prs7='$id_prs7'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttttt = $row['qty_outtttttt'];
                            $update = mysqli_query($conn, "UPDATE proses7 SET qty_outtttttt = '$outtttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs7='$id_prs7'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    } else {
                        // $update = mysqli_query($conn, "UPDATE proses2 set qty_outt = qty_outt + '$qty_fg'");
                        $input = mysqli_query($conn, "UPDATE spot1 set qty_spot = '$qty_fg' where id_prs = '$id_prs'");
                        $query7 = mysqli_query($conn, "SELECT qty_outtttttt from proses7 where id_prs7='$id_prs7'");
                        while ($row = mysqli_fetch_array($query7)) {
                            $outtttttt = $row['qty_outtttttt'];
                            $update = mysqli_query($conn, "UPDATE proses7 SET qty_outtttttt = '$outtttttt' - '$qty_fg', kondisi = 'Sudah Digunakan' where id_prs7='$id_prs7'");
                            echo '<script>
                            swal.fire({
                              text: "Produk berhasil masuk ke assembly proses!",
                              icon: "success",
                              button: "Close!",
                            });
                        </script>';
                        }
                    }
                }
            }
        }
    }
}




?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            </section>
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col card-header text-right">
                                <h1 class="card-title font-weight-bold"><i class="fas fa-wave-square mr-2"></i>Stamping Proses</h1>
                            </div>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="col">

                                            <div class="white_shd full margin_bottom_30">
                                                <div class="full graph_head">
                                                    <div class="heading1 margin">

                                                    </div>
                                                </div>
                                                <div class="full inner_elements">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="tab_style1">
                                                                <div class="tabbar padding_infor">
                                                                    <nav class="nav">
                                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                            <a class="nav-item nav-link active" id="nav-proses1-tab" data-toggle="tab" href="#proses1" role="tab" aria-controls="nav-home" aria-selected="true">Proses 1</a>
                                                                            <a class="nav-item nav-link" id="nav-proses2-tab" data-toggle="tab" href="#proses2" role="tab" aria-controls="nav-contact" aria-selected="false">Proses 2</a>
                                                                            <a class="nav-item nav-link" id="nav-proses3-tab" data-toggle="tab" href="#proses3" role="tab" aria-controls="nav-assy" aria-selected="false">Proses 3</a>
                                                                            <a class="nav-item nav-link" id="nav-proses4-tab" data-toggle="tab" href="#proses4" role="tab" aria-controls="nav-schedule" aria-selected="false">Proses 4</a>
                                                                            <a class="nav-item nav-link" id="nav-proses5-tab" data-toggle="tab" href="#proses5" role="tab" aria-controls="nav-wip" aria-selected="false">Proses 5</a>
                                                                            <a class="nav-item nav-link" id="nav-proses6-tab" data-toggle="tab" href="#proses6" role="tab" aria-controls="nav-wip" aria-selected="false">Proses 6</a>
                                                                            <a class="nav-item nav-link" id="nav-proses7-tab" data-toggle="tab" href="#proses7" role="tab" aria-controls="nav-wip" aria-selected="false">Proses 7</a>
                                                                        </div>
                                                                    </nav>
                                                                    <br>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                        <div class="tab-pane fade show active" id="proses1" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <div class="text-right">
                                                                                <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaltambah"><i class="fas fa-plus mr-2"></i>Tambah Proses Produksi</button></p>
                                                                            </div>
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak"><i class="fas fa-print mr-2"></i>CETAK LAPORAN PROSES 1</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example3" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center" width="5%">No</th>
                                                                                        <th class="text-center" width="30%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <th class="text-center">PO Customer</th>
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center" width="10%">Tanggal Dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['ioh'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses1.*, customer.id_cust, part.nama_part,part.kode_part,part.id_part
                                                                                        po_customer.qty_po, po_customer.id_po,proses.*, material.*
                                                                                        FROM proses1 inner join customer on customer.id_cust = proses1.id_cust 
                                                                                        inner join part on part.id_part = proses1.id_part
                                                                                        inner join po_customer on po_customer.id_po = proses1.id_po 
                                                                                        inner join proses on proses.id_prs = proses1.id_prs
                                                                                        inner join material on material.id_material = proses1.id_material WHERE proses1.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses1.*,  part.nama_part,part.kode_part,
                                                                                        customer.id_cust, po_customer.qty_po,po_customer.id_po, part.id_part,proses.*,material.*
                                                                                    FROM proses1 inner join customer on customer.id_cust = proses1.id_cust
                                                                                    inner join part on part.id_part = proses1.id_part
                                                                                    inner join po_customer on po_customer.id_po = proses1.id_po
                                                                                    inner join proses on proses.id_prs = proses1.id_prs
                                                                                    inner join material on material.id_material = proses1.id_material");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <td><?php echo $row['wip']; ?></td>
                                                                                            <td><?php echo $row['qty_aktual']; ?></td>
                                                                                            <td><?php echo $row['qty_ng']; ?>
                                                                                                <p> <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalng-<?php echo $row['id_prs1'] ?>"><i class="fas fa-external-link-alt"></i></button>
                                                                                                </p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <pre><button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalprs1-<?php echo $row['id_prs1'] ?>"><i class="far fa-plus-square"></i></button></pre>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv1-<?php echo $row['id_prs1'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv1-<?php echo $row['id_prs1'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>

                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs1-<?php echo $row['id_prs1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Hasil Produksi</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs1" name="id_prs1" value="<?php echo $row['id_prs1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_material" name="id_material" value="<?php echo $row['id_material']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Selesai</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" required>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_pieces" name="qty_pieces" hidden>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_ng" name="qty_ng">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="simpan" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng-<?php echo $row['id_prs1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs1" name="id_prs1" value="<?php echo $row['id_prs1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>

                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv1-<?php echo $row['id_prs1'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs1" name="id_prs1" value="<?php echo $row['id_prs1']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 1</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses1.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="ioh" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- MODAL Tambah Proses-->
                                                                        <div class="modal fade" id="modaltambah">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-success">
                                                                                        <h4 class="modal-title"><i class="fas fa-draw-polygon mr-2"></i>Input Produk Yang Ingin Dikerjakan</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama_cust">Nama Customer</label>
                                                                                                        <select class="form-control" id="cust" name="cust" required>
                                                                                                            <option hidden> - Pilih Customer - </option>
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT id_cust, nama_cust FROM customer") or die(mysqli_error($conn));
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                            ?>
                                                                                                                <option value="<?php echo $data['id_cust'] ?>"><?php echo $data['nama_cust'] ?></option>

                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama_part">Nama Produk</label>
                                                                                                        <select class="form-control" id="part" name="part" required>
                                                                                                            <option> - Pilih Customer Terlebih Dahulu - </option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama_part">No PO Customer</label>
                                                                                                        <select class="form-control" id="no_po" name="no_po" required>
                                                                                                            <option hidden> - Pilih No PO Customer - </option>
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT po_customer.no_po, part.nama_part, po_customer.statuss,po_customer.id_po FROM po_customer 
                                                                                                            inner join part on part.id_part = po_customer.id_part where statuss ='Sedang Diproses'") or die(mysqli_error($conn));
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                            ?>
                                                                                                                <option value="<?php echo $data['id_po'] ?>"><?php echo $data['no_po'] ?> | <?php echo $data['nama_part'] ?></option>

                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama_cust">Kode Material</label>
                                                                                                        <select class="form-control" id="id_material" name="id_material" required>
                                                                                                            <option hidden> - Pilih Customer - </option>
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT shearing_material.*, material.* from shearing_material
                                                                                                            inner join material on material.id_material = shearing_material.id_material") or die(mysqli_error($conn));
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                            ?>
                                                                                                                <option value="<?php echo $data['id_material'] ?>"><?php echo $data['kode_material'] ?></option>

                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-3">
                                                                                                        <label for="proses">Proses</label>
                                                                                                        <select class="form-control" id="prosess" name="prosess" required>
                                                                                                            <option value="" hidden>- Pilih Proses -</option>
                                                                                                            <option value="1">1 Proses</option>
                                                                                                            <option value="2">2 Proses</option>
                                                                                                            <option value="3">3 Proses</option>
                                                                                                            <option value="4">4 Proses</option>
                                                                                                            <option value="5">5 Proses</option>
                                                                                                            <option value="6">6 Proses</option>
                                                                                                            <option value="7">7 Proses</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-md-3">
                                                                                                        <label for="spot">Spot</label>
                                                                                                        <select class="form-control" id="spott" name="spott" required>
                                                                                                            <option value="" hidden>- Pilih Spot -</option>
                                                                                                            <option value="1">Spot</option>
                                                                                                            <!-- <option value="2">2 Spot</option> -->
                                                                                                            <option value="Nonspot">Non Spot</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <!-- <div class="col-md-3">
                                                                                                        <div class="checkbox-group required">
                                                                                                            <label for="spot">Assy Welding</label>
                                                                                                            <p>
                                                                                                                <input type="checkbox" name="assyweld[]" value="Ya" class="mr-2">Ya</label>
                                                                                                                &nbsp; &nbsp;
                                                                                                                <input type="checkbox" name="assyweld[]" value="Tidak" class="mr-2">Tidak</label>
                                                                                                            </p>
                                                                                                        </div>
                                                                                                    </div> -->
                                                                                                </div>
                                                                                                <div class="row">
                                                                                                    <div class="form-group col-md-3">
                                                                                                        <div class="form-row proses">

                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group col-md-3">
                                                                                                        <div class="form-row spot">

                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group col-md-3">
                                                                                                        <div class="form-row qtyspot">

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="oui" id="oui" class="btn btn-md btn-success">Simpan</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses2" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak2"><i class="fas fa-print mr-2"></i>CETAK PROSES 2</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example4" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['p'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses2.*, customer.id_cust,part.nama_part,part.id_part
                                                                                        part.kode_part,po_customer.qty_po,po_customer.id_po,proses.*
                                                                                        FROM proses2 inner join customer on customer.id_cust = proses2.id_cust 
                                                                                        inner join part on part.id_part = proses2.id_part 
                                                                                        inner join po_customer on po_customer.id_po = proses2.id_po 
                                                                                        inner join proses on proses.id_prs = proses2.id_prs WHERE proses2.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses2.*, part.nama_part, part.kode_part,
                                                                                        po_customer.qty_po, po_customer.id_po, part.id_part,proses.* FROM proses2
                                                                                        inner join part on part.id_part = proses2.id_part
                                                                                        inner join po_customer on po_customer.id_po = proses2.id_po
                                                                                        inner join proses on proses.id_prs = proses2.id_prs");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outt']; ?></td>
                                                                                            <td><?php echo $row['qty_ngg']; ?>
                                                                                                <p><button type="button" class="btn btn-sm  btn-dark" data-toggle="modal" data-target="#modalng2-<?php echo $row['id_prs2'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>

                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modalprs2-<?php echo $row['id_prs2'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv2-<?php echo $row['id_prs2'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv2-<?php echo $row['id_prs2'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs2-<?php echo $row['id_prs2'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs2" name="id_prs2" value="<?php echo $row['id_prs2']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Keluar</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_outt" name="qty_outt" required>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" autocomplete="off" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Selesai</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_outt" name="qty_outt" required>
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_ngg" name="qty_ngg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="two" type="submit" name="edit" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng2-<?php echo $row['id_prs2'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs2" name="id_prs2" value="<?php echo $row['id_prs2']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Scrap</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_scrap" name="qty_scrap">
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair2" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv2-<?php echo $row['id_prs2'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs2" name="id_prs2" value="<?php echo $row['id_prs2']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe2" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 2</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses2.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="p" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses3" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak3"><i class="fas fa-print mr-2"></i>CETAK PROSES 3</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example5" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['y'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses3.*, customer.id_cust, part.nama_part, part.kode_part
                                                                                        ,po_customer.qty_po,part.id_part, po_customer.id_po,proses.*
                                                                                        FROM proses3 inner join customer on customer.id_cust = proses3.id_cust
                                                                                        inner join part on part.id_part = proses3.id_part 
                                                                                        inner join proses on proses.id_prs = proses3.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses3.id_po WHERE proses3.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses3.*, part.nama_part, part.kode_part,
                                                                                        po_customer.qty_po,po_customer.id_po, part.id_part,proses.*
                                                                                        from proses3 inner join part on part.id_part = proses3.id_part
                                                                                        inner join proses on proses.id_prs = proses3.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses3.id_po ");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outtt']; ?></td>
                                                                                            <td><?php echo $row['qty_nggg']; ?>
                                                                                                <p><button type="button" class="btn btn-sm  btn-dark" data-toggle="modal" data-target="#modalng3-<?php echo $row['id_prs3'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalprs3-<?php echo $row['id_prs3'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv3-<?php echo $row['id_prs3'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv3-<?php echo $row['id_prs3'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs3-<?php echo $row['id_prs3'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs3" name="id_prs3" value="<?php echo $row['id_prs3']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_nggg" name="qty_nggg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="three" type="submit" name="update" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng3-<?php echo $row['id_prs3'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs3" name="id_prs3" value="<?php echo $row['id_prs3']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair3" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv3-<?php echo $row['id_prs3'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs3" name="id_prs3" value="<?php echo $row['id_prs3']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe3" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 3</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses3.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="y" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses4" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak4"><i class="fas fa-print mr-2"></i>CETAK PROSES 4</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example6" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['o'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses4.*, customer.id_cust, part.nama_part, part.kode_part,part.id_part,
                                                                                        po_customer.qty_po,po_customer.id_po,proses.*
                                                                                        FROM proses4 inner join customer on customer.id_cust = proses4.id_cust
                                                                                        inner join part on part.id_part = proses4.id_part
                                                                                        inner join proses on proses.id_prs = proses4.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses4.id_po  WHERE proses4.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses4.*, part.nama_part, part.kode_part,po_customer.qty_po
                                                                                        ,po_customer.id_po, part.id_part,proses.* from proses4
                                                                                        inner join part on part.id_part = proses4.id_part
                                                                                        inner join proses on proses.id_prs = proses4.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses4.id_po ");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outttt']; ?></td>
                                                                                            <td><?php echo $row['qty_ngggg']; ?>
                                                                                                <p> <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalng4-<?php echo $row['id_prs4'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalprs4-<?php echo $row['id_prs4'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv4-<?php echo $row['id_prs4'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv4-<?php echo $row['id_prs4'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs4-<?php echo $row['id_prs4'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs4" name="id_prs4" value="<?php echo $row['id_prs4']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Keluar</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_outttt" name="qty_outttt" required>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_ngggg" name="qty_ngggg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="four" type="submit" name="hi" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng4-<?php echo $row['id_prs4'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs4" name="id_prs4" value="<?php echo $row['id_prs4']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Scrap</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_scrap" name="qty_scrap">
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair4" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv4-<?php echo $row['id_prs4'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs4" name="id_prs4" value="<?php echo $row['id_prs4']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Part</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe4" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 4</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses4.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="o" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses5" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak5"><i class="fas fa-print mr-2"></i>CETAK PROSES 5</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example7" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['e'])) {
                                                                                        $bulan = $_POST['loh'];

                                                                                        $data = mysqli_query($conn, "SELECT proses5.*, customer.id_cust, part.nama_part, part.kode_part,part.id_part,
                                                                                        po_customer.qty_po,po_customer.id_po,proses.*
                                                                                        FROM proses5 inner join customer on customer.id_cust = proses5.id_cust
                                                                                        inner join part on part.id_part = proses5.id_part
                                                                                        inner join proses on proses.id_prs = proses5.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses5.id_po  WHERE proses5.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses5.*, part.nama_part, part.kode_part,
                                                                                        po_customer.qty_po,po_customer.id_po, part.id_part,proses.*
                                                                                        FROM proses5
                                                                                        inner join part on part.id_part = proses5.id_part
                                                                                        inner join proses on proses.id_prs = proses5.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses5.id_po ");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outtttt']; ?></td>
                                                                                            <td><?php echo $row['qty_nggggg']; ?>
                                                                                                <p> <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalng5-<?php echo $row['id_prs5'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalprs5-<?php echo $row['id_prs5'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv5-<?php echo $row['id_prs5'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv5-<?php echo $row['id_prs5'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs5-<?php echo $row['id_prs5'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs5" name="id_prs5" value="<?php echo $row['id_prs5']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Keluar</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_outtttt" name="qty_outtttt" required>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_nggggg" name="qty_nggggg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="five" type="submit" name="yoi" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng5-<?php echo $row['id_prs5'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs5" name="id_prs5" value="<?php echo $row['id_prs5']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Scrap</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_scrap" name="qty_scrap">
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair5" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv5-<?php echo $row['id_prs5'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs5" name="id_prs5" value="<?php echo $row['id_prs5']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe5" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 5</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses5.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="loh" name="loh" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="e" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses6" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak6"><i class="fas fa-print mr-2"></i>CETAK PROSES 6</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example8" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['m'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses6.*, customer.id_cust, part.nama_part, part.kode_part,part.id_part
                                                                                         po_customer.qty_po,po_customer.id_po,proses.*
                                                                                        FROM proses6 inner join customer on customer.id_cust = proses6.id_cust 
                                                                                        inner join part on part.id_part = proses6.id_part
                                                                                        inner join proses on proses.id_prs = proses6.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses6.id_po  WHERE proses6.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses6.*, part.nama_part, part.kode_part,
                                                                                         po_customer.qty_po,po_customer.id_po, part.id_part,proses.* FROM proses6
                                                                                         inner join part on part.id_part = proses6.id_part 
                                                                                         inner join proses on proses.id_prs = proses6.id_prs
                                                                                         inner join po_customer on po_customer.id_po = proses6.id_po ");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outttttt']; ?></td>
                                                                                            <td><?php echo $row['qty_ngggggg']; ?>
                                                                                                <p> <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalng6-<?php echo $row['id_prs6'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalprs6-<?php echo $row['id_prs6'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv6-<?php echo $row['id_prs6'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv6-<?php echo $row['id_prs6'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs6-<?php echo $row['id_prs6'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs6" name="id_prs6" value="<?php echo $row['id_prs6']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Keluar</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_outttttt" name="qty_outttttt" required>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_ngggggg" name="qty_ngggggg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="six" type="submit" name="almaz" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng6-<?php echo $row['id_prs6'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs6" name="id_prs6" value="<?php echo $row['id_prs6']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Scrap</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_scrap" name="qty_scrap">
                                                                                                                    </div> -->
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair6" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv6-<?php echo $row['id_prs6'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs6" name="id_prs6" value="<?php echo $row['id_prs6']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe6" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 6</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses6.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="m" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane fade show" id="proses7" role="tabpanel" aria-labelledby="nav-home-tab">
                                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak7"><i class="fas fa-print mr-2"></i>CETAK PROSES 7</button>
                                                                            <br>
                                                                            <br>
                                                                            <table id="example9" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="20%">Nama | Kode Produk</th>
                                                                                        <th class="text-center">Nama Proses</th>
                                                                                        <!-- <th class="text-center" width="10%">PO Customer</th> -->
                                                                                        <th class="text-center" width="10%">WIP</th>
                                                                                        <th class="text-center" width="10%">Quantity Not Good</th>
                                                                                        <th class="text-center">Tanggal dikerjakan</th>
                                                                                        <th class="text-center">Aksi</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    if (isset($_POST['n'])) {
                                                                                        $bulan = $_POST['bulan'];

                                                                                        $data = mysqli_query($conn, "SELECT proses7.*, customer.id_cust, part.nama_part, part.kode_part,
                                                                                         po_customer.qty_po,part.id_part,po_customer.id_po,proses.*
                                                                                        FROM proses7 inner join customer on customer.id_cust = proses7.id_cust 
                                                                                        inner join part on part.id_part = proses7.id_part 
                                                                                        inner join proses on proses.id_prs = proses7.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses7.id_po WHERE proses7.tgl = '$bulan'");
                                                                                    } else {
                                                                                        $data = mysqli_query($conn, "SELECT proses7.*,part.nama_part, part.kode_part, part.id_part,po_customer.qty_po
                                                                                        ,po_customer.id_po,proses.* FROM proses7
                                                                                        inner join part on part.id_part = proses7.id_part
                                                                                        inner join proses on proses.id_prs = proses7.id_prs
                                                                                        inner join po_customer on po_customer.id_po = proses7.id_po");
                                                                                    }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['nama_proses']; ?></td>
                                                                                            <!-- <td><?php echo $row['wip']; ?></td> -->
                                                                                            <td><?php echo $row['qty_outtttttt']; ?></td>
                                                                                            <td><?php echo $row['qty_nggggggg']; ?>
                                                                                                <p><button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalng7-<?php echo $row['id_prs7'] ?>"><i class="fas fa-external-link-alt"></i></button></p>
                                                                                            </td>
                                                                                            <td><?php echo $row['tgl']; ?></td>
                                                                                            <td>
                                                                                                <center>
                                                                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalprs7-<?php echo $row['id_prs7'] ?>"><i class="far fa-plus-square"></i></button>
                                                                                                    <?php if ($row['kondisi'] ==  'Sudah Digunakan') { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv7-<?php echo $row['id_prs7'] ?>" disabled><i class="fas fa-save"></i></button>
                                                                                                    <?php } else { ?>
                                                                                                        <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalsv7-<?php echo $row['id_prs7'] ?>"><i class="fas fa-save"></i></button>
                                                                                                    <?php } ?>
                                                                                                </center>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- MODAL Input Quantity-->
                                                                                        <div class="modal fade" id="modalprs7-<?php echo $row['id_prs7'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-success">
                                                                                                        <h4 class="modal-title"><i class="far fa-plus-square mr-2"></i>Input Tanggal dan Quantity Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs7" name="id_prs7" value="<?php echo $row['id_prs7']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="date" class="form-control" id="tgl" name="tgl" required>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <br>
                                                                                                                    <label for="ng">
                                                                                                                        Jika ada barang Not Good silahkan isi form dibawah:
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_nggggggg" name="qty_nggggggg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Keterangan Not Good</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="keterangan" name="keterangan">
                                                                                                                    </div>
                                                                                                                </div>


                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="seven" type="submit" name="apa" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal ng -->
                                                                                        <div class="modal fade" id="modalng7-<?php echo $row['id_prs7'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-warning">
                                                                                                        <h4 class="modal-title"><i class="fas fa-not-equal mr-2"></i>Product Not Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-5">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs7" name="id_prs7" value="<?php echo $row['id_prs7']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity Repair</label>
                                                                                                                        <!-- <input type="text" autocomplete="off" class="form-control" id="qty_aktual" name="qty_aktual" hidden> -->
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_repair" name="qty_repair">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button id="one" type="submit" name="repair7" class="btn btn-md btn-success">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--modal FG -->
                                                                                        <div class="modal fade" class="buatfg1" id="modalsv7-<?php echo $row['id_prs7'] ?>">
                                                                                            <div class="modal-dialog modal-lg">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header bg-primary">
                                                                                                        <h4 class="modal-title"><i class="fas fa-check-double mr-2"></i>Buat Finish Good</h4>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">&times;</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <form action="" id="fg1" method="post">
                                                                                                        <div class="modal-body">
                                                                                                            <div class="form-group">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Nama Produk</label>
                                                                                                                        <input type="text" class="form-control" id="id_prs7" name="id_prs7" value="<?php echo $row['id_prs7']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_part" name="id_part" value="<?php echo $row['id_part']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_cust" name="id_cust" value="<?php echo $row['id_cust']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_po" name="id_po" value="<?php echo $row['id_po']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="id_prs" name="id_prs" value="<?php echo $row['id_prs']; ?>" hidden>
                                                                                                                        <input type="text" class="form-control" id="nama_part" name="nama_part" value="<?php echo $row['nama_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-6">
                                                                                                                        <label for="nama customer">Kode Produk</label>
                                                                                                                        <input type="text" class="form-control" id="kode_part" name="kode_part" value="<?php echo $row['kode_part']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-1">
                                                                                                                        <label for="nama customer">Proses</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['proses']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <div class="col-2">
                                                                                                                        <label for="nama customer">Spot</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['spot']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                    <!-- <div class="col-2">
                                                                                                                        <label for="nama customer">Welding</label>
                                                                                                                        <input type="text" class="form-control" id="proses" name="proses" value="<?php echo $row['welding']; ?>" readonly>
                                                                                                                    </div> -->
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Quantity dihasilkan</label>
                                                                                                                        <input type="text" autocomplete="off" class="form-control" id="qty_fg" name="qty_fg">
                                                                                                                    </div>
                                                                                                                    <div class="col-3">
                                                                                                                        <label for="nama customer">Tanggal Dikerjakan</label>
                                                                                                                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo $row['tgl']; ?>" readonly>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <br>

                                                                                                                <br>
                                                                                                                <div class="modal-footer justify-content-left">
                                                                                                                    <button type="submit" name="oe7" class="btn btn-md btn-primary">SIMPAN</button>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK PROSES1-->
                                                                        <div class="modal fade" id="modalcetak7" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Proses 7</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportproses7.php" target="_blank" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">Periode Bulan</label>
                                                                                                        <input type="date" id="bulan" name="bulan" class="form-control">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="n" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php include('footer.php') ?>
                                                <script>
                                                    $('#cust').on('change', function() {
                                                        var cust = $(this).val();
                                                        $.ajax({
                                                            url: 'ambildata.php',
                                                            type: "POST",
                                                            data: {
                                                                cust: cust
                                                            },
                                                            success: function(data) {
                                                                $("#part").html(data);
                                                            },
                                                            error: function() {
                                                                alert("Gagal Mengambil Data");
                                                            }
                                                        })
                                                    })

                                                    $(document).ready(function() {
                                                        $('#prosess').change(function() {
                                                            //Use $option (with the "$") to see that the variable is a jQuery object
                                                            var $option = $(this).find('option:selected');
                                                            //Added with the EDIT
                                                            var data = $option.val(); //to get content of "value" attrib
                                                            console.log(data)
                                                            $('.proses').load("proses1.php?id_cust=" + data);
                                                        });
                                                    });

                                                    $(document).ready(function() {
                                                        $('#spott').change(function() {
                                                            //Use $option (with the "$") to see that the variable is a jQuery object
                                                            var $option = $(this).find('option:selected');
                                                            //Added with the EDIT
                                                            var data = $option.val(); //to get content of "value" attrib
                                                            console.log(data)
                                                            $('.spot').load("spot.php?id_cust=" + data);
                                                        });
                                                    });

                                                    // $(document).ready(function() {
                                                    //     $('#oui').click(function() {
                                                    //         checked = $("input[type=checkbox]:checked").length;

                                                    //         if (!checked) {
                                                    //             alert("Checkbox Assy Welding harus dipilih!!");
                                                    //             return false;
                                                    //         }

                                                    //     });
                                                    // });

                                                    // $('#cust').on('change', function() {
                                                    //     var cust = $(this).val();
                                                    //     $.ajax({
                                                    //         url: 'ambildatadelpo.php',
                                                    //         type: "POST",
                                                    //         data: {
                                                    //             cust: cust
                                                    //         },
                                                    //         success: function(data) {
                                                    //             $("#no_po").html(data);
                                                    //         },
                                                    //         error: function() {
                                                    //             alert("Gagal Mengambil Data");
                                                    //         }
                                                    //     })
                                                    // })
                                                    $(document).ready(function() {

                                                        $('#example3').DataTable({});

                                                        $('#example4').DataTable({});

                                                        $('#example5').DataTable({});

                                                        $('#example6').DataTable({});

                                                        $('#example7').DataTable({});

                                                        $('#example8').DataTable({});

                                                        $('#example9').DataTable({});

                                                        $('#example10').DataTable({});

                                                        $('#example11').DataTable({});

                                                        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                                                            $($.fn.dataTable.tables(true)).DataTable()
                                                                .columns.adjust()
                                                                .responsive.recalc();
                                                        });
                                                    });



                                                    // $(document).on("click", ".fg1", function(e) {
                                                    //     var po = $(this).attr("data-po");
                                                    //     var part = $(this).attr("data-part");
                                                    //     var cust = $(this).attr("data-cust");
                                                    //     var qty = $(this).attr("data-qty");
                                                    //     $("#id_po").val(po);
                                                    //     $("#id_part").val(part);
                                                    //     $("#id_cust").val(cust);
                                                    //     $("#qty_fg").val(qty);
                                                    // });
                                                    // $(document).on("click", "#konfirm", function(e) {
                                                    //     var data = $("#fg1").serialize();
                                                    //     $.ajax({
                                                    //         data: data,
                                                    //         type: "post",
                                                    //         url: "add/buatfg1.php",
                                                    //         success: function(dataResult) {
                                                    //             var dataResult = JSON.parse(dataResult);
                                                    //             if (dataResult.statusCode == 200) {
                                                    //                 $(".buatfg1").modal("hide");
                                                    //                 swal("Good job!", "Data Updated Successfully!", "success");
                                                    //                 setTimeout(2000);
                                                    //                 location.reload();
                                                    //             } else if (dataResult.statusCode == 201) {
                                                    //                 swal("Error!", "Could'not be Updated !", "Warnings");
                                                    //                 setTimeout(2000);
                                                    //             }
                                                    //         },
                                                    //     });
                                                    // });

                                                    // $(document).on("click", ".buat-Fg-1", function(e) {
                                                    //     var data = $(".buatfg1").serialize();
                                                    //     $.ajax({
                                                    //         data: data,
                                                    //         type: "post",
                                                    //         url: "add/buatfg1.php",
                                                    //         success: function(dataResult) {
                                                    //             var dataResult = JSON.parse(dataResult);
                                                    //             if (dataResult.statusCode == 200) {
                                                    //                 $("#addEmployeeModal").modal("hide");
                                                    //                 swal("Good job!", "Data Saved !", "success");
                                                    //                 setTimeout(200000);
                                                    //                 location.reload();
                                                    //             } else if (dataResult.statusCode == 201) {
                                                    //                 //alert(dataResult);
                                                    //                 swal("Error!", "Could'not be saved !", "warnings");
                                                    //                 setTimeout(2000);
                                                    //             }
                                                    //         },
                                                    //     });
                                                    // });

                                                    // function buatfg1(prs1_id) {

                                                    //     var data = [
                                                    //         id_po = $(this).attr("id_po"),
                                                    //         id_part = $(this).attr("id_part"),
                                                    //         id_cust = $(this).attr("id_cust"),
                                                    //         qty_fg = $(this).attr("qty_fg")
                                                    //     ]

                                                    //     Swal.fire({
                                                    //         title: 'Apakah data sudah benar?',
                                                    //         showDenyButton: true,
                                                    //         showCancelButton: true,
                                                    //         confirmButtonText: 'Save',
                                                    //         denyButtonText: `Don't save`,
                                                    //     }).then((result) => {
                                                    //         /* Read more about isConfirmed, isDenied below */
                                                    //         if (result.isConfirmed) {
                                                    //             Swal.fire('Saved!', '', 'success')
                                                    //             window.location = ("add/buatfg1.php?id_prs1=" + data)
                                                    //         } else if (result.isDenied) {
                                                    //             Swal.fire('Changes are not saved', '', 'info')
                                                    //         }
                                                    //     })
                                                    // };

                                                    // function buatfg1(prs1_id) {

                                                    //     var data = [
                                                    //         id_po = $(this).attr("id_po"),
                                                    //         id_part = $(this).attr("id_part"),
                                                    //         id_cust = $(this).attr("id_cust"),
                                                    //         qty_fg = $(this).attr("qty_fg")
                                                    //     ]

                                                    //     Swal.fire({
                                                    //         title: 'Apakah data sudah benar?',
                                                    //         showDenyButton: true,
                                                    //         showCancelButton: true,
                                                    //         confirmButtonText: 'Save',
                                                    //         denyButtonText: `Don't save`,
                                                    //     }).then((result) => {
                                                    //         /* Read more about isConfirmed, isDenied below */
                                                    //         if (result.isConfirmed) {
                                                    //             Swal.fire('Saved!', '', 'success')
                                                    //             window.location = ("add/buatfg1.php?id_prs1=" + data)
                                                    //         } else if (result.isDenied) {
                                                    //             Swal.fire('Changes are not saved', '', 'info')
                                                    //         }
                                                    //     })
                                                    // };

                                                    // $(".buat-Fg-1").click(function() {
                                                    //     var data = $("#fg1").serialize();

                                                    //     $.ajax({
                                                    //         id: id,
                                                    //         type: "post",
                                                    //         url: "add/buatfg1.php",
                                                    //         success: function(dataResult) {
                                                    //             var dataResult = JSON.parse(dataResult);
                                                    //             if (dataResult.statusCode == 200) {
                                                    //                 $(".buatfg1").modal("hide");
                                                    //                 swal("Good job!", "Data Saved !", "success");
                                                    //                 setTimeout(200000);
                                                    //                 location.reload();
                                                    //             } else if (dataResult.statusCode == 201) {
                                                    //                 //alert(dataResult);
                                                    //                 swal("Error!", "Could'not be saved !", "warnings");
                                                    //                 setTimeout(2000);
                                                    //             }
                                                    //         },
                                                    //     });
                                                    // })
                                                    // var id_po = $("#id_po").val();
                                                    // var id_part = $("#id_part").val();
                                                    // var id_cust = $("#id_cust").val();
                                                    // var qty_fg = $("#qty_fg").val();
                                                    // swal.fire({
                                                    //     title: "Are you sure?",
                                                    //     text: "You will not be able to recover this imaginary file!",
                                                    //     type: "warning",
                                                    //     showCancelButton: true,
                                                    //     confirmButtonColor: '#DD6B55',
                                                    //     confirmButtonText: 'Yes, I am sure!',
                                                    //     cancelButtonText: "No, cancel it!"
                                                    // }).then(
                                                    //     function() {
                                                    //         $query = mysqli_query($conn, "INSERT INTO fg (id_fg, id_cust, id_po, id_part, qty_fg) VALUES ('','$id_cust','$id_po','$id_part','$qty_fg')")
                                                    //     },
                                                    //     function() {
                                                    //         return false;
                                                    //     });
                                                    // var id_po = $("#id_po").val();
                                                    // var id_part = $("#id_part").val();
                                                    // var id_cust = $("#id_cust").val();
                                                    // var qty_fg = $("#qty_fg").val();
                                                    // var tgl = $("#tgl").val();

                                                    // if (id_po == '' || id_part == '' || id_cust == '' || qty_fg == '') {
                                                    //     Swal({
                                                    //         title: 'Kolom ada yang kosong!!',
                                                    //         text: "Silahkan Periksa Kembali",
                                                    //         icon: "warning",
                                                    //         button: "OK"
                                                    //     })
                                                    // }

                                                    //    $.ajax({
                                                    //         url: "add/buatfg1.php",
                                                    //         type: "POST",
                                                    //         data: $(this).serialize(),
                                                    //         cache: false,
                                                    //         success: function(data) {
                                                    //             Swal.fire({
                                                    //                 title: 'Do you want to save the changes?',
                                                    //                 showDenyButton: true,
                                                    //                 showCancelButton: true,
                                                    //                 confirmButtonText: 'Save',
                                                    //                 denyButtonText: `Don't save`,
                                                    //             }).then((result) => {
                                                    //                 /* Read more about isConfirmed, isDenied below */
                                                    //                 if (result.isConfirmed) {
                                                    //                     Swal.fire('Saved!', '', 'success')
                                                    //                 } else if (result.isDenied) {
                                                    //                      Swal.fire('Changes are not saved', '', 'info')
                                                    //                 }
                                                    //             })
                                                    //         }
                                                    //     })
                                                    // })

                                                    // function buatfg1(prs1_id) {
                                                    //     Swal.fire({
                                                    //         title: 'Apakah data sudah benar?',
                                                    //         showDenyButton: true,
                                                    //         showCancelButton: true,
                                                    //         confirmButtonText: 'Save',
                                                    //         denyButtonText: `Don't save`,
                                                    //     }).then((result) => {
                                                    //         /* Read more about isConfirmed, isDenied below */
                                                    //         if (result.isConfirmed) {
                                                    //             Swal.fire('Saved!', '', 'success')
                                                    //             window.location = ("add/buatfg1.php?id_prs1=" + prs1_id)
                                                    //         } else if (result.isDenied) {
                                                    //             Swal.fire('Changes are not saved', '', 'info')
                                                    //         }
                                                    //     })
                                                    // }

                                                    $('.tombol-save').on('click', function(e) {
                                                        e.preventDefault();

                                                        const href = $(this).attr('href');

                                                        Swal.fire({
                                                            title: 'Apakah data sudah benar?',
                                                            showDenyButton: true,
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Save',
                                                            denyButtonText: `Don't save`,
                                                        }).then((result) => {
                                                            /* Read more about isConfirmed, isDenied below */
                                                            if (result.isConfirmed) {
                                                                Swal.fire('Saved!', '', 'success')
                                                                window.location.href = href
                                                            } else if (result.isDenied) {
                                                                Swal.fire('Changes are not saved', '', 'info')
                                                            }
                                                        })
                                                    })

                                                    // document.getElementById(".tombol-save").onclick = function() {
                                                    //     this.disabled = true;
                                                    // }

                                                    function hapus1(prs1_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs1.php?id_prs1=" + prs1_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus2(prs2_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs2.php?id_prs2=" + prs2_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus3(prs3_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs3.php?id_prs3=" + prs3_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus4(prs4_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs4.php?id_prs4=" + prs4_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus5(prs5_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs5.php?id_prs5=" + prs5_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus6(prs6_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs6.php?id_prs6=" + prs6_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus7(prs7_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs7.php?id_prs7=" + prs7_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus8(prs8_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs8.php?id_prs8=" + prs8_id)
                                                            }
                                                        })
                                                    }

                                                    function hapus9(prs9_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusprs9.php?id_prs9=" + prs9_id)
                                                            }
                                                        })
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>