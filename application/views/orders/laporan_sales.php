<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Order By Sales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Laporan Order By Sales</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Order By Sales</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="<?php echo base_url('orders/laporan_sales'); ?>" method="post">
            <div class="form-group">
              <label>Dari Tanggal:</label>
              <input type="date" class="form-control" name="tanggal_dari" required>

              <label>Sampai Tanggal:</label>
              <input type="date" class="form-control" name="tanggal_sampai" required>
              <br>
              <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
            </div>
          </form>
          <?php if (!empty($orders)): ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Sales</th>
                  <th>Email</th>
                  <th>Total Orders</th>
                  <th>Total Sales Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php $index = 0; foreach ($orders as $o): $index++ ?>
                  <tr>
                    <td><?= $index ?></td>
                    <td><?= $o['sales_name'];?></td>
                    <td><?= $o['username'];?></td>
                    <td><?= $o['total_orders'];?></td>
                    <td><?= 'Rp. ' . number_format($o['total_sales'], 0, ',', '.'); ?></td>
                  </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
                <?php else: ?>
                  <p>Tidak Ada Data Sales yang tersedia</p>
                  <?php endif; ?>
        </div>
        <!-- /.card-body -->
         
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>