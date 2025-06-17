<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Daftar Pengguna</li>
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
		
          <h3 class="card-title">pengguna</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <a href="<?= base_url('pengguna/tambah'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
          <?php if (!empty($pengguna)): ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 0; foreach ($pengguna as $p): $index++ ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $p['name'];?></td>
                    <td><?= $p['username'];?></td>
                    <td><?= $p['role'];?></td>
                    <td>
                      <a href="<?= base_url('pengguna/edit/'. $p['id']); ?>" class="btn btn-sm btn-info">Edit</a>
                      <a href="<?= base_url('pengguna/hapus/'. $p['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin menghapus pengguna ini?')">Hapus</a>
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