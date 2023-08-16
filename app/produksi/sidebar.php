<!-- Navbar -->
<meta http-equiv="refresh" content="1800; url=login.php">
<?php
include('../koneksi.php');
// include ('header.php');
?>
<nav class="main-header navbar navbar-expand navbar-grey navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
    <ul class="navbar-nav  ml-auto">
      <!-- Sidebar user panel (optional) -->
      <marquee direction="left">
        <font face="Castellar">
          <h4 style="color: navy; font-weight: bold; font-size:30px;">PT. Ganding Toolsindo</h4>
        </font>
      </marquee>
      <hr />
      <div class="dropdown">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <b><?php echo $_SESSION['role'] ?></b>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="../logout.php" class="dropdown-item">
              <i class="fas fa-power-off mr-2"></i> Logout
            </a>
          </div>
      </div>
  </div>
</nav>
<!-- 
  <li class="nav-item">
    <a class="" data-widget="control-sidebar" data-slide="true" href="#" role="button">
    </a>
  </li>
  </ul>
  </nav> -->
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-light elevation-4" style="height: 1060;">

  <!-- Sidebar -->
  <a href="" class="brand-link">
    <img src="dist/img/gandingrbg.png" alt="..." class="brand-image img-circle elevation-9 mr-8" style="opacity: .8" width="50" height="50">
    <marquee behavior='slide' direction='left'>
      <span class="brand-text align-items-center mr-4">WELCOME</span>
    </marquee>
    <br>
    <marquee behavior='slide' direction='right'>
      <?php
      $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
      ?>
      <span class="brand-text align-items-center mr-4"><?php echo $hostname ?></span></br>
    </marquee>
    <!-- <hr color="blue"> -->
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 d-flex">
    </div>
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append text-dark">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="../produksi/index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-plus"></i>
            <p>
              Customer
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../produksi/datacustomer.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produksi/pocustomer.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Buat MRP</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="../produksi/mrp.php" class="nav-link">
            <i class="nav-icon fas fa-tools"></i>
            <p>
              MRP
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Supplier
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../produksi/datasupplier.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Data Supplier
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produksi/posupplier.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  PO Supplier
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Purchasing
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../produksi/materialreq.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Material Request
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produksi/materialrecipt.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Material Recipt
                </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="../produksi/material.php" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Warehouse RM
              <!-- <i class="right fas fa-angle-left"></i> -->
            </p>
          </a>
        </li>
        <!-- <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="../produksi/material.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Material
                <i class="right fas fa-angle-left"></i> -->
              <!-- </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
              <a href="../produksi/deliverynotesupp.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Rekap Surat Jalan Supplier
                </p>
              </a>
            </li> -->
        <!-- </ul> -->
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fab fa-product-hunt"></i>
            <p>
              Production
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="partstock.php" class="nav-link">
                Part Stock
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="../produksi/stampingproses.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Stamping Proses
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../produksi/assemblyproses.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Assembly Proses
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="scrap.php" class="nav-link">
                Scrap
                </p>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a href="stockwip.php" class="nav-link">
                WIP
                </p>
              </a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item">
          <a href="../produksi/datafg.php" class="nav-link">
            <i class="nav-icon fas fa-industry"></i>
            <p>
              Warehouse FG
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../produksi/delivery.php" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Delivery
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<!-- <script>
$(".nav .nav-link").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).addClass("active");
});
</script> -->