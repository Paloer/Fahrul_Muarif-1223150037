<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('produk'); ?>">Produk</a></li>
              <li class="breadcrumb-item active">Input Produk</li>
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
          <h3 class="card-title">Produk</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url(). "produk/tambah";?>" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Price" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" required>
                </div>
                <div>
                    <label for="created_by">Created By</label>
                    <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $user['id']; ?>" required readonly>
                </div>
                <div>
                    <label for="created_by_name">Created By Name</label>
                    <input type="text" class="form-control" name="created_by_name" id="created_by_name" placeholder="Created By Name" value="<?php echo $user['name']; ?>" required readonly>
                </div>
            </div>
            <br>
            <div class="box-footer">
              <a href="<?php echo base_url('produk'); ?>" class="btn btn-default">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>
