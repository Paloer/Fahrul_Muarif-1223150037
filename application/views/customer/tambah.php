<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('customer'); ?>">Customer</a></li>
              <li class="breadcrumb-item active">Input Customer</li>
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
            <form action="<?php echo base_url(). "customer/tambah";?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="name_customer">Name</label>
                    <input type="text" class="form-control" name="name_customer" id="name_customer" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="created_by">Created By</label>
                    <input type="text" class="form-control" name="created_by" id="created_by" value="<?= $user['id']; ?>" placeholder="Created By" required readonly>
                </div>
                <div class="form-group">
                    <label for="created_by_name">Created By Name</label>
                    <input type="text" class="form-control" name="created_by_name" id="created_by_name" value="<?= $user['name']; ?>" placeholder="Created By Name" required readonly>
                </div>
            </div>
            <br>
            <div class="box-footer">
                <a href="<?php echo base_url('customer'); ?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
