<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url('orders'); ?>">Orders</a></li>
              <li class="breadcrumb-item active">Input Order</li>
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
          <h3 class="card-title">Order</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="<?php echo base_url(). "orders/tambah";?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select class="form-control" name="customer_id" id="customer_id" required>
                            <option value="">-- Pilih Customer --</option>
                            <?php foreach ($customers as $customer): ?>
                                <option value="<?= $customer['id']; ?>"><?= $customer['name_customer']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sales_id">Sales ID</label>
                        <input type="text" class="form-control" name="sales_id" id="sales_id" placeholder="Sales ID" value="<?= $user['id']; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Draft">Draft</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address_receive">Address Receive</label>
                        <textarea class="form-control" name="address_receive" id="address_receive" placeholder="Address Receive" required></textarea>
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
                                    <th>
                                        <button id="btn-tambah-produk" type="button" class="btn btn-primary" onclick="tambahProduk()">Tambah Produk</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr id="produk-0">
                                <td>
                                    <select class="form-control" name="products[0]" onchange="updatePrice(this, 0)" required>
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($produk as $p): ?>
                                            <option value="<?= $p['id']; ?>" data-price="<?= $p['price']; ?>"><?= $p['name']; ?> (Stock: <?= $p['stock']; ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td>
                                    <span id="price-0">Rp. 0</span>
                                </td>

                                <td>
                                    <input type="number" class="form-control" name="quantities[0]" placeholder="Jumlah" min="1" onchange="updateSubtotal(0)" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                </td>

                                <td>
                                    <span id="subtotal-0">Rp. 0</span>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger" onclick="hapusProduk(0)" disabled>Hapus</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>  
                    <div class="form-group">
                        <label for="total_amount">Total Amount</label>
                        <input type="text" class="form-control" name="total_amount" id="total_amount" placeholder="Total Amount" required readonly>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-success" id="calculate-total">Hitung</button> ||
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
</section>
</div>

<script>
    var indexProduk = 1;
    let totalProduk = <?= count($produk); ?>;
    const produkData = <?= json_encode($produk); ?>;
    
    document.getElementById('calculate-total').addEventListener('click', function() {
        var subtotals = document.querySelectorAll("#produk-list tbody tr td:nth-child(4)");
        var totalAmount = 0;
        subtotals.forEach(function(subtotal) {
            totalAmount += parseInt(subtotal.textContent.replace('Rp. ', '').replace(/\./g, ''));
        });
        document.getElementById('total_amount').value = 'Rp. ' + totalAmount.toLocaleString('id-ID');
    });
     
    function getJumlahBarisAktif() {
        return document.querySelectorAll("#produk-list tbody tr").length;
    }

    function getProdukTerpilih() {
        const selects = document.querySelectorAll("#produk-list select");
        let selected = [];
        selects.forEach(s => {
            if (s.value) selected.push(s.value);
        });
        return selected;
    }

    function updateStatusTombolTambah() {
        const btn = document.getElementById('btn-tambah-produk');
        const jumlahAktif = getJumlahBarisAktif();
        const jumlahDipilih = getProdukTerpilih().length;
        btn.disabled = jumlahAktif >= totalProduk || jumlahDipilih >= totalProduk;
    }

    function refreshSelectOptions() {
        const selected = getProdukTerpilih();
        const selects = document.querySelectorAll("#produk-list select");

        selects.forEach(select => {
            const currentVal = select.value;
            select.innerHTML = '<option value="">-- Pilih Produk --</option>';
            produkData.forEach(p => {
                if (!selected.includes(p.id.toString()) || p.id.toString() === currentVal) {
                    const opt = document.createElement("option");
                    opt.value = p.id;
                    opt.setAttribute("data-price", p.price);
                    opt.textContent = p.name;
                    if (p.id.toString() === currentVal) {
                        opt.selected = true;
                    }
                    select.appendChild(opt);
                }
            });
        });
    }

    function tambahProduk() {
        if (getJumlahBarisAktif() >= totalProduk) return;

        var produk = document.createElement('tr');
        produk.id = 'produk-' + indexProduk;
        produk.innerHTML = `
            <td>
                <select class="form-control" name="products[${indexProduk}]" onchange="updatePrice(this, ${indexProduk}); refreshSelectOptions();">
                    <option value="">-- Pilih Produk --</option>
                    ${produkData.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('')}
                </select>
            </td>
            <td><span id="price-${indexProduk}">Rp. 0</span></td>
            <td><input type="number" class="form-control" name="quantities[${indexProduk}]" placeholder="Jumlah" min="0" onchange="updateSubtotal(${indexProduk})"></td>
            <td><span id="subtotal-${indexProduk}">Rp. 0</span></td>
            <td><button type="button" class="btn btn-danger" onclick="hapusProduk(${indexProduk})">Hapus</button></td>
        `;
        document.querySelector('#produk-list tbody').appendChild(produk);
        indexProduk++;
        refreshSelectOptions();
        updateStatusTombolTambah();
    }

    function hapusProduk(id) {
        const row = document.getElementById('produk-' + id);
        if (row) row.remove();
        refreshSelectOptions();
        updateStatusTombolTambah();
    }

    function updatePrice(el, index) {
        var selectedOption = el.options[el.selectedIndex];
        var price = selectedOption.getAttribute('data-price') || 0;
        document.getElementById('price-' + index).innerHTML = 'Rp. ' + parseInt(price).toLocaleString('id-ID');
        updateSubtotal(index);
    }

    function updateSubtotal(index) {
        var quantity = document.querySelector(`input[name='quantities[${index}]']`).value || 0;
        var price = document.getElementById('price-' + index).textContent.replace('Rp. ', '').replace(/\./g, '');
        var subtotal = quantity * price;
        document.getElementById('subtotal-' + index).innerHTML = 'Rp. ' + subtotal.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', function () {
        refreshSelectOptions();
        updateStatusTombolTambah();
    });
</script>


