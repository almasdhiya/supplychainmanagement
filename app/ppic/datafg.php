<meta http-equiv="refresh" content="1800; url=login.php">
<?php
session_start();
if($_SESSION['role']==""){
  header("location:index.php?pesan=gagal");
}
?>
<?php
include('header.php');
include('sidebar.php');
include('../koneksi.php');


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
                                <h1 class="card-title font-weight-bold"><i class="fas fa-network-wired mr-2"></i>Data Finsih Good</h1>
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
                                                                    <br>
                                                                    <div class="tab-content" id="nav-tabContent">
                                                                            <table id="example3" class="table table-bordered table-striped" style="text-align:center">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center" width="40%">Nama Customer</th>
                                                                                        <th class="text-center" width="20%">Nomor PO Customer</th>
                                                                                        <th class="text-center" width="40%">Nama | Kode Produk</th>
                                                                                        <th class="text-center" width="40%">Quantity Produk</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php include "../koneksi.php";
                                                                                    $no = 1;
                                                                                    // $select = mysqli_query($conn, "SELECT id_po FROM proses");
                                                                                    // $po = mysqli_fetch_assoc($select);
                                                                                    // if ($po['id_po'] == $po['id_po']) {
                                                                                        // SELECT SUM(qty_fg) AS value_sum, po_customer.id_po FROM fg inner join po_customer on po_customer.id_po = fg.id_po Group by fg.id_po;
                                                                                        $data = mysqli_query($conn, "SELECT fg.*, po_customer.id_po, 
                                                                                        customer.nama_cust, part.*, po_customer.no_po    
                                                                                    FROM fg inner join po_customer on po_customer.id_po = fg.id_po
                                                                                    inner join customer on customer.id_cust = fg.id_cust
                                                                                    inner join part on part.id_part = fg.id_part 
                                                                                    Group by fg.id_part order by fg.id_part desc;");
                                                                                    // }
                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_cust']; ?></td>
                                                                                            <td><?php echo $row['no_po']; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?> | <?php echo $row['kode_part']; ?></td>
                                                                                            <td><?php echo $row['total_qty'] ?></td>
                                                                                            <!-- <td>
                                                                                                <center>
                                                                                                    <a onclick="hapusfg(<?php echo $row['id_po']; ?>)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                                                                </center>
                                                                                            </td> -->
                                                                                        </tr>

                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php include('footer.php') ?>
                                                <script>
                                                    $(document).ready(function() {

                                                        $('#example3').DataTable({});

                                                        $('#example4').DataTable({});

                                                        $('#example5').DataTable({});

                                                        $('#example6').DataTable({});

                                                        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                                                            $($.fn.dataTable.tables(true)).DataTable()
                                                                .columns.adjust()
                                                                .responsive.recalc();
                                                        });
                                                    });
                                                </script>
                                                <script>
                                                    function hapusfg(po_id) {
                                                        Swal.fire({
                                                            title: 'Yakin Ingin Menghapus Data Ini?',
                                                            text: "Data tidak dapat dikembalikan!",
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: 'red',
                                                            confirmButtonText: 'Hapus'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = ("delete/hapusfg.php?id_po=" + po_id)
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
<!-- inner join proses1 on proses1.id_prs1 = fg.id_prs1
                                                                                    inner join proses2 on proses2.id_prs2 = fg.id_prs2
                                                                                    inner join proses3 on proses3.id_prs3 = fg.id_prs3
                                                                                    inner join proses4 on proses4.id_prs4 = fg.id_prs4
                                                                                    inner join proses5 on proses5.id_prs5 = fg.id_prs5
                                                                                    inner join proses6 on proses6.id_prs6 = fg.id_prs6
                                                                                    inner join proses7 on proses7.id_prs7 = fg.id_prs7
                                                                                    inner join proses8 on proses8.id_prs8 = fg.id_prs8
                                                                                    inner join proses9 on proses9.id_prs9 = fg.id_prs9 -->