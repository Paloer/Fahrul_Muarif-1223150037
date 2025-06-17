<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('orders'); ?>">Orders</a></li>
              <li class="breadcrumb-item active">Edit Order</li>
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
          <h3 class="card-title">Edit Order</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('orders/edit/'. $order['id']);?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="id">Order Id</label>
                    <input type="text" class="form-control" name="id" value="<?= $order['id'];?>" id="id" placeholder="Order Id" required readonly>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Draft" <?= $order['status'] == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                        <option value="Dikirim" <?= $order['status'] == 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                        <option value="Selesai" <?= $order['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        <option value="Dibatalkan" <?= $order['status'] == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="updated_by">Updated By Id</label>
                <input type="text" class="form-control" name="updated_by" value="<?= $user['id'];?>" id="updated_by" placeholder="Updated By" required readonly>
            </div>
            <div class="form-group">
                <label for="updated_by_name">Updated By Name</label>
                <input type="text" class="form-control" name="updated_by_name" value="<?= $user['name'];?>" id="updated_by_name" placeholder="Updated By Name" required readonly>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">update</button>
                <a href="<?= base_url('orders'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
