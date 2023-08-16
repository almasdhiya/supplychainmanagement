<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalcetak">CETAK DELIVERY SUBCONT</button>
                                                                            <br>
                                                                            <table id="example2" class="table table-bordered table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th class="text-center">No</th>
                                                                                        <th class="text-center">Nama Part</th>
                                                                                        <th class="text-center">No Purchase Order</th>
                                                                                        <th class="text-center">Qty Delivery</th>
                                                                                        <th class="text-center">Tanggal Delivery</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php
                                                                                    include('../koneksi.php');
                                                                                    $no = 1;
                                                                                    if (isset($_POST['aneh'])) {
                                                                                        $surjalsubcont = $_POST['surjalsubcont'];

                                                                                        $data = mysqli_query($conn, "SELECT delivery_subcont.*, part.nama_part, part.id_part FROM delivery_subcont
                                                                                        JOIN part on part.id_part = delivery_subcont.id_part where delivery_subcont.surjalsubcont like '$surjalsubcont%'")  or die(mysqli_error($conn));
                                                                                        // $hasil = mysqli_fetch_array($data);
                                                                                    } else if (isset($_POST['cetak'])) {
                                                                                        $surjalsubcont = $_POST['surjalsubcont'];
                                                                                    }
                                                                                    $data = mysqli_query($conn, "SELECT delivery_subcont.*, part.nama_part, part.id_part FROM delivery_subcont
                                                                                        JOIN part on part.id_part = delivery_subcont.id_part");
                                                                                    // $hasil = mysqli_fetch_array($data);

                                                                                    while ($row = mysqli_fetch_array($data)) {
                                                                                        // foreach (mysqli_fetch_array($data) as $row){
                                                                                    ?>

                                                                                        <tr>
                                                                                            <td><?php echo $no++; ?></td>
                                                                                            <td><?php echo $row['nama_part']; ?></td>
                                                                                            <td><?php echo $row['posubcont']; ?></td>
                                                                                            <td><?php echo $row['qty_deliv']; ?></td>
                                                                                            <td><?php echo $row['tgl_deliv']; ?></td>

                                                                                        </tr>
                                                                                    <?php } ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <!-- MODAL CETAK SURJAL-->
                                                                        <div class="modal fade" id="modalcetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header bg-warning">
                                                                                        <h4 class="modal-title"><i class="fa fa-print mr-2"></i>Cetak Rekap Subcont Delivery</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form action="exportsubcontdelivery.php" method="post">
                                                                                        <div class="modal-body">
                                                                                            <div class="form-group">
                                                                                                <div class="row">
                                                                                                    <div class="col-3">
                                                                                                        <label for="nama customer">No Surat Jalan Delivery</label>
                                                                                                        <select class="form-control" id="surjalsubcont" name="surjalsubcont">
                                                                                                            <option value="" hidden>- Pilih No Surjal -</option>
                                                                                                            <?php
                                                                                                            $sql = mysqli_query($conn, "SELECT id_sub, surjalsubcont FROM delivery_subcont") or die(mysqli_error($conn));
                                                                                                            while ($data = mysqli_fetch_array($sql)) {
                                                                                                            ?>
                                                                                                                <option value="<?php echo $data['surjalsubcont'] ?>"><?php echo $data['surjalsubcont'] ?></option>

                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="modal-footer justify-content-left">
                                                                                                    <button type="submit" name="cetak" class="btn btn-md btn-warning">CETAK</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>