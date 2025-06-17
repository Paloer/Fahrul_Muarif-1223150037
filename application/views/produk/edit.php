<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('produk'); ?>">Produk</a></li>
              <li class="breadcrumb-item active">Edit Produk</li>
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
          <h3 class="card-title">Edit Produk</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?= base_url('produk/edit/'. $produk['id']);?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" name="name" value="<?= $produk['name'];?>" id="name" placeholder="Nama Produk" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value="<?= $produk['price'];?>" id="price" placeholder="Price" required>
                </div>
                <div class="form-group">
                    <label for="role">Stock</label>
                    <input type="text" class="form-control" name="stock" value="<?= $produk['stock'];?>" id="stock" placeholder="Stock" required>
                </div>
                <div class="form-group">
                    <label for="updated_by">Updated By</label>
                    <input type="text" class="form-control" name="updated_by" value="<?= $user['id']; ?>" id="updated_by" placeholder="Updated By" required readonly>
                </div>
                <div class="form-group">
                    <label for="updated_by_name">Updated By Name</label>
                    <input type="text" class="form-control" name="updated_by_name" value="<?= $user['name']; ?>" id="updated_by_name" placeholder="Updated By Name" required readonly>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">update</button>
                <a href="<?= base_url('produk'); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
