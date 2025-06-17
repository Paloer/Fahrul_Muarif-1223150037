<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
    }
    function get_all_orders() {
        $this->db->select('o.*, c.name_customer as customer_name, s.name as sales_name');
        $this->db->from('orders o');
        $this->db->join('customers c', 'o.cust_id = c.id', 'left');
        $this->db->join('user s', 'o.sales_id = s.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    function insert_order($data) {
        $this->db->trans_start(); // 🔁 Mulai transaksi

        try {
            // 1. Insert orders
            $orderData = [
                'cust_id' => $data['customer_id'],
                'sales_id' => $data['sales_id'],
                'status' => $data['status'],
                'total_amount' => $data['total_amount'],
                'address_receive' => $data['address_receive'],
                'created_by' => $data['created_by'],
                'created_by_name' => $data['created_by_name']
            ];

            $dataOrder = $this->db->insert('orders', $orderData);
            if (!$dataOrder) {
                $this->db->trans_rollback();
                return ['status' => 'error', 'message' => 'Gagal menambahkan order'];
            }

            $order_id = $this->db->insert_id();

            // 2. Ambil data produk & quantity
            $produkIds = json_decode($data['products'], true);
            $quantities = json_decode($data['quantities'], true);

            $query = $this->db->select('id, price, stock')
                            ->from('produk')
                            ->where_in('id', $produkIds)
                            ->get();
            $productData = $query->result_array();

            $produkMap = [];
            foreach ($productData as $p) {
                $produkMap[$p['id']] = $p;
            }

            // 3. Validasi stok cukup
            foreach ($produkIds as $index => $product_id) {
                $qty = $quantities[$index];

                if (!isset($produkMap[$product_id])) {
                    $this->db->trans_rollback();
                    return ['status' => 'error', 'message' => "Produk ID $product_id tidak ditemukan"];
                }

                if ($qty > $produkMap[$product_id]['stock']) {
                    $this->db->trans_rollback();
                    return [
                        'status' => 'error',
                        'message' => "Stok produk ID $product_id tidak mencukupi (stok: {$produkMap[$product_id]['stock']}, diminta: $qty)"
                    ];
                }
            }

            // 4. Simpan detail order
            $DetailData = [];
            foreach ($produkIds as $index => $product_id) {
                $qty = $quantities[$index];
                $price = $produkMap[$product_id]['price'];

                $DetailData[] = [
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'qty' => $qty,
                    'unit_price' => $price,
                    'subtotal' => $qty * $price,
                ];
            }

            $queryDetail = $this->db->insert_batch('orders_detail', $DetailData);
            if (!$queryDetail) {
                $this->db->trans_rollback();
                return ['status' => 'error', 'message' => 'Gagal menambahkan detail order'];
            }

            // 5. Kurangi stok produk (hanya dilakukan kalau order & detail berhasil)
            foreach ($produkIds as $index => $product_id) {
                $qty = (int)$quantities[$index];
                $this->db->set('stock', 'stock - ' . $qty, false)
                        ->where('id', $product_id)
                        ->update('produk');
            }

            $this->db->trans_complete(); // ✅ Commit

            if ($this->db->trans_status() === FALSE) {
                return ['status' => 'error', 'message' => 'Transaksi gagal, semua perubahan dibatalkan'];
            }

            return [
                'status' => 'success',
                'message' => 'Order berhasil ditambahkan dan stok berhasil diperbarui',
                'order_id' => $order_id,
                'data' => $data
            ];

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['status' => 'error', 'message' => 'Gagal menambahkan order: ' . $e->getMessage()];
        }
    }
    function get_order_by_id($id) {
        $this->db->select('o.*, c.name_customer as customer_name, s.name as sales_name');
        $this->db->from('orders o');
        $this->db->join('customers c', 'o.cust_id = c.id', 'left');
        $this->db->join('user s', 'o.sales_id = s.id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function update_order($data) {
        $return = $this->db->update('orders', $data, ['id' => $data['id']]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Order berhasil diubah',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal mengubah order',
            ];
        }
    }

    function delete_order($id) {
        $return = $this->db->delete('orders', ['id' => $id]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Order berhasil dihapus',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal menghapus order',
            ];
        }
    }

    function get_order_details($order_id) {
        $this->db->select('od.*, p.name as product_name, p.price');
        $this->db->from('orders_detail od');
        $this->db->join('produk p', 'od.product_id = p.id', 'left');
        $this->db->where('od.order_id', $order_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_orders_by_date($start_date, $end_date) {
        $this->db->select("o.*, c.name_customer as customer_name, s.name as sales_name, 
            GROUP_CONCAT(concat(od.qty, ',', p.name, ',', od.unit_price, ',', od.subtotal) SEPARATOR '|') as produk");
        $this->db->from('orders o');
        $this->db->join('customers c', 'o.cust_id = c.id', 'left');
        $this->db->join('user s', 'o.sales_id = s.id', 'left');
        $this->db->join('orders_detail od', 'o.id = od.order_id', 'left');
        $this->db->join('produk p', 'od.product_id = p.id', 'left');
        $this->db->where('o.order_date >=', $start_date);
        $this->db->where('o.order_date <=', $end_date);
        $this->db->order_by('o.order_date', 'ASC');
        $this->db->group_by('o.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_orders_by_sales($start_date, $end_date) {
        $this->db->select("u.id, u.name as sales_name, u.username, COUNT(o.id) as total_orders, SUM(o.total_amount) as total_sales");
        $this->db->from('user u');
        $this->db->join('orders o', 'u.id = o.sales_id', 'left');
        $this->db->where('o.order_date >=', $start_date);
        $this->db->where('o.order_date <=', $end_date);
        $this->db->group_by('u.id');
        $this->db->where('u.role', 'Sales');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_orders_by_product($start_date, $end_date) {
        $this->db->select("p.id, p.name as product_name, SUM(od.qty) as total_quantity, SUM(od.subtotal) as total_sales");
        $this->db->from('orders o');
        $this->db->join('orders_detail od', 'o.id = od.order_id', 'left');
        $this->db->join('produk p', 'od.product_id = p.id', 'left');
        $this->db->where('o.order_date >=', $start_date);
        $this->db->where('o.order_date <=', $end_date);
        $this->db->group_by('p.id');
        $this->db->order_by('total_quantity', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>