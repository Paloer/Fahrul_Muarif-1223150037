<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Daftar Order</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Order</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <a href="<?= base_url('orders/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
          <?php if (!empty($orders)): ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Customer</th>
                  <th>Nama Sales</th>
                  <th>Tanggal Order</th>
                  <th>Status</th>
                  <th>Total Amount</th>
                  <th>Alamat Penerima</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 0; foreach ($orders as $o): $index++ ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $o['customer_name'];?></td>
                    <td><?= $o['sales_name'];?></td>
                    <td><?= $o['order_date'];?></td>
                    <td><?= $o['status'];?></td>
                    <td><?= 'Rp. ' . number_format($o['total_amount'], 0, ',', '.'); ?></td>
                    <td><?= $o['address_receive'];?></td>
                    <td>
                      <a href="<?= base_url('orders/detail/'. $o['id']); ?>" class="btn btn-sm btn-success">Detail</a> ||
                      <a href="<?= base_url('orders/edit/'. $o['id']); ?>" class="btn btn-sm btn-info">Edit</a> ||
                      <a href="<?= base_url('orders/hapus/'. $o['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin menghapus order ini?')">Hapus</a>
                    </td>
                  </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <?php else: ?>
                  <p> Tidak Ada Pengguna yang tersedia</p>
                  <?php endif; ?>
        </div>
        <!-- /.card-body -->
         
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>