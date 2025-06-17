<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Daftar Sales</li>
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
          <h3 class="card-title">Sales</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <?php if (!empty($sales)): ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 0; foreach ($sales as $p): $index++ ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $p['name'];?></td>
                    <td><?= $p['username'];?></td>
                    <td><?= $p['role'];?></td>
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