<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('pengguna'); ?>">Pengguna</a></li>
              <li class="breadcrumb-item active">Edit Pengguna</li>
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
          <h3 class="card-title">Edit Pengguna</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('pengguna/edit/'. $pengguna['id']);?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" value="<?= $pengguna['name'];?>" id="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $pengguna['username'];?>" id="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="Admin" <?= $pengguna['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="Sales" <?= $pengguna['role'] == 'Sales' ? 'selected' : ''; ?>>Sales</option>
                        <option value="Manager" <?= $pengguna['role'] == 'Manager' ? 'selected' : ''; ?>>Manager</option>
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">update</button>
                <a href="<?= base_url('pengguna'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
