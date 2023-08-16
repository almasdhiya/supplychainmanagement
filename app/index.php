<!DOCTYPE html>
<html lang="en">
<meta http-equiv="refresh" content="1800; url=login.php">
<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: login.php");
    exit;
}
?>
<?php include('header.php'); ?>
<!-- <body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper"> -->

<!-- Preloader -->
<?php include('preloader.php'); ?>

<!-- Main Sidebar Container -->
<!-- Sidebar -->
<?php include('sidebar.php'); ?>
<?php include('../koneksi.php');
$get1 = mysqli_query($conn, "SELECT * FROM customer");
$cust = mysqli_num_rows($get1);

$get2 = mysqli_query($conn, "SELECT * FROM supplier");
$supp = mysqli_num_rows($get2);

$get3 = mysqli_query($conn, "SELECT * FROM po_customer");
$pocust = mysqli_num_rows($get3);

$get4 = mysqli_query($conn, "SELECT * FROM po_supplier");
$posupp = mysqli_num_rows($get4); ?>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<!-- /.content-header -->

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="dist/img/1.png" class="d-block w-100 " alt="...">
          </div>
          <div class="carousel-item">
            <img src="dist/img/2.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="dist/img/3.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <br>
      <br>
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $cust; ?></h3>

              <p>Customer</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-plus"></i>
            </div>
            <a href="datacustomer.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $supp; ?></h3>

              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="datasupplier.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $pocust; ?></h3>

              <p>PO Customer</p>
            </div>
            <div class="icon">
              <i class="fas fa-cart-arrow-down"></i>
            </div>
            <a href="pocustomer.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small card -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $posupp; ?></h3>

              <p>PO Supplier</p>
            </div>
            <div class="icon">
              <i class="fas fa-parachute-box"></i>
            </div>
            <a href="posupplier.php" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Control Sidebar -->
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include('footer.php'); ?>
<!-- <script>
     var time = new Date().getTime();
     $(document.body).bind("mousemove keypress", function(e) {
         time = new Date().getTime();
     });

     function refresh() {
         if(new Date().getTime() - time >= 5) 
         window.location = ("login.php")
         else 
             setTimeout(refresh, 10000);
     }

     setTimeout(refresh, 10000);
</script> -->
</body>

</html>