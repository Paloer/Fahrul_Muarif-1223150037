<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Customer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('customer'); ?>">Customer</a></li>
              <li class="breadcrumb-item active">Edit Customer</li>
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
          <h3 class="card-title">Edit Customer</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('customer/edit/'. $customer['id']);?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="name_customer">Nama Customer</label>
                    <input type="text" class="form-control" name="name_customer" value="<?= $customer['name_customer'];?>" id="name_customer" placeholder="Nama Customer" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" class="form-control" name="address" value="<?= $customer['address'];?>" id="address" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telepon</label>
                    <input type="text" class="form-control" name="phone" value="<?= $customer['phone'];?>" id="phone" placeholder="Telepon" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value="<?= $customer['email'];?>" id="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="updated_by">Updated By</label>
                    <input type="text" class="form-control" name="updated_by" value="<?= $user['id'];?>" id="updated_by" placeholder="Updated By" required readonly>
                </div>
                <div class="form-group">
                    <label for="updated_by_name">Updated By Name</label>
                    <input type="text" class="form-control" name="updated_by_name" value="<?= $user['name'];?>" id="updated_by_name" placeholder="Updated By Name" required readonly>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">update</button>
                <a href="<?= base_url('customer'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
