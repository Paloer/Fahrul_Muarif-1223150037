<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('orders'); ?>">Orders</a></li>
              <li class="breadcrumb-item active">Detail Order</li>
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
          <h3 class="card-title">Detail Order</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="box-body">
                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <input type="text" class="form-control" name="customer_id" id="customer_id" placeholder="Customer" value="<?= $order['customer_name']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="sales_id">Sales ID</label>
                    <input type="text" class="form-control" name="sales_id" id="sales_id" placeholder="Sales ID" value="<?= $order['sales_name']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?= $order['status']; ?>" required readonly>
                </div>
                <div class="form-group">    
                    <label for="total_amount">Total Amount</label>
                    <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="Total Amount" value="<?= $order['total_amount']; ?>" required readonly>
                </div>
                <div class="form-group">
                    <label for="address_receive">Address Receive</label>
                    <textarea class="form-control" name="address_receive" id="address_receive" placeholder="Address Receive" required readonly><?= $order['address_receive']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="products">Pilih Produk</label>
                <div id="produk-list">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($details as $index => $detail): ?>
                        <tr id="produk-<?= $index; ?>">
                            <td><?= $detail['product_name']; ?></td>
                            <td><span id="price-<?= $index; ?>">Rp. <?= number_format($detail['price'], 0, ',', '.'); ?></span></td>
                            <td><input type="number" class="form-control" name="quantities[<?= $index; ?>]" value="<?= $detail['qty']; ?>" placeholder="Jumlah" min="1" onchange="updateSubtotal(<?= $index; ?>)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" readonly></td>
                            <td><span id="subtotal-<?= $index; ?>">Rp. <?= number_format($detail['subtotal'], 0, ',', '.'); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <a href="<?= base_url('orders'); ?>" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>