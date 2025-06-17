<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales Order | PT Maju Jaya</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/jqvmap/jqvmap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons/bootstrap4.min.css')?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<aside class="main-sidebar sidebar-dark-primary elevation-4">
<div class="sidebar">
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="<?= base_url('assets/adminlte/dist/img/avatar.png');?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="<?php echo base_url('dashboard'); ?>" class="d-block"><?= $user['name']; ?></a>
    </div>
  </div>

  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <?php if ($user['role'] == 'Admin') : ?>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('pengguna'); ?>" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Pengguna</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('sales'); ?>" class="nav-link">
              <i class="fas fa-chart-pie nav-icon"></i>
              <p>Sales</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('produk'); ?>" class="nav-link">
              <i class="fas fa-box nav-icon"></i>
              <p>Produk</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('customer'); ?>" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>Customer</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('orders'); ?>" class="nav-link">
              <i class="fas fa-shopping-cart nav-icon"></i>
              <p>Orders</p>
            </a>
          </li>
        </ul>
        <?php elseif ($user['role'] == 'Sales') : ?>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('orders'); ?>" class="nav-link">
              <i class="fas fa-shopping-cart nav-icon"></i>
              <p>Orders</p>
            </a>
          </li>
        </ul>
      </li>
      <?php else : ?>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-file-alt"></i>
          <p>
            Laporan
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?= base_url('orders/laporan_waktu'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Per Waktu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('orders/laporan_sales'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Per Sales</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('orders/laporan_produk'); ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Laporan Per Produk</p>
            </a>
          </li>
        </ul>
      </li>
      <?php endif; ?>
    <li class="nav-item">
      <a href="<?= site_url('auth/logout') ?>" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Logout</p>
      </a>
    </li>
        </ul>
      </nav>
    </div>
  </aside>
</div>