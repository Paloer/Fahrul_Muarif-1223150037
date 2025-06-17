<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Daftar Customer</li>
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
          <h3 class="card-title">Customer</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <a href="<?= base_url('customer/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
          <?php if (!empty($customers)): ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Customer</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 1; foreach ($customers as $c): ?>
                  <tr>
                    <td><?= $index++;?></td>
                    <td><?= $c['name_customer'];?></td>
                    <td><?= $c['address'];?></td>
                    <td><?= $c['phone'];?></td>
                    <td><?= $c['email'];?></td>
                    <td>
                      <a href="<?= base_url('customer/edit/'. $c['id']); ?>" class="btn btn-sm btn-info">Edit</a>
                      <a href="<?= base_url('customer/hapus/'. $c['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin menghapus customer ini?')">Hapus</a>
                    </td>
                  </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <?php else: ?>
                  <p> Tidak Ada Customer yang tersedia</p>
                  <?php endif; ?>
        </div>
        <!-- /.card-body -->
         
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>