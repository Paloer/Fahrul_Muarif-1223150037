<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('pengguna_model');
        $this->load->model('customer_model');
        $this->load->model('produk_model');
        $this->load->library('form_validation');
    }
    public function index() {
        $data['pengguna'] = $this->pengguna_model->get_all_pengguna();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $data['user'] = $this->session->userdata();
        $data['orders'] = $this->orders_model->get_all_orders();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('orders/index', $data);
        $this->load->view('templates/footer');
    }
    function tambah()
    {
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
        $this->form_validation->set_rules('sales_id', 'Sales ID', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        // $this->form_validation->set_rules('total_amount', 'Total Amount', 'required|numeric');
        $this->form_validation->set_rules('address_receive', 'Address Receive', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['customers'] = $this->customer_model->get_all_customers();
            $data['produk'] = $this->produk_model->get_all_produk();
            $data['user'] = $this->session->userdata();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('orders/tambah', $data);
            $this->load->view('templates/footer');
            return;
        }

        $data = [
            'customer_id' => $this->input->post('customer_id'),
            'sales_id' => $this->input->post('sales_id'),
            'status' => $this->input->post('status'),
            'total_amount' => preg_replace('/[^0-9]/', '', $this->input->post('total_amount')),
            'address_receive' => $this->input->post('address_receive'),
            'created_by' => $this->session->userdata('id'),
            'created_by_name' => $this->session->userdata('name')
        ];

        $products = $this->input->post('products');
        $quantities = $this->input->post('quantities');

        $valid = TRUE;

        if (!is_array($products) || count($products) == 0) {
            $valid = FALSE;
            $this->session->set_flashdata('message', 'Produk tidak boleh kosong.');
        }

        foreach ($products as $i => $p) {
            if (empty($p)) {
                $valid = FALSE;
                $this->session->set_flashdata('message', "Produk di baris ke-" . ($i + 1) . " belum dipilih.");
                break;
            }
            if (!isset($quantities[$i]) || !is_numeric($quantities[$i]) || $quantities[$i] <= 0) {
                $valid = FALSE;
                $this->session->set_flashdata('message', "Kuantitas di baris ke-" . ($i + 1) . " tidak valid.");
                break;
            }
        }

        if (!$valid) {
            redirect('orders/tambah');
        }

        $data['products'] = json_encode($products);
        $data['quantities'] = json_encode($quantities);

        $return = $this->orders_model->insert_order($data);
        
        if ($return['status'] == 'success') {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders') . "'; }</script>";
        } else {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders/tambah') . "'; }</script>";
        }
    }
    function detail($id)
    {
        $data['order'] = $this->orders_model->get_order_by_id($id);
        $data['details'] = $this->orders_model->get_order_details($id);
        if (!$data['order'] || !$data['details']) {
            show_404();
        }
        $data['user'] = $this->session->userdata();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header', $data);
        $this->load->view('orders/detail', $data);
        $this->load->view('templates/footer');
    }
    function edit($id)
    {
        $this->form_validation->set_rules('id', 'Order ID', 'required|numeric');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('updated_by', 'Updated By', 'required|numeric');
        $this->form_validation->set_rules('updated_by_name', 'Updated By Name', 'required');
        $data['user'] = $this->session->userdata();
        if ($this->form_validation->run() == FALSE) {
            $data['order'] = $this->orders_model->get_order_by_id($id);
            if (!$data['order']) {
                show_404();
            }
            $data['customers'] = $this->customer_model->get_all_customers();
            $data['produk'] = $this->produk_model->get_all_produk();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('orders/edit', $data);
            $this->load->view('templates/footer');
            return;
        }
        $data = [
            'id' => $this->input->post('id'),
            'status' => $this->input->post('status'),
            'updated_by' => $this->input->post('updated_by'),
            'updated_by_name' => $this->input->post('updated_by_name'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $return = $this->orders_model->update_order($data);
        if ($return['status'] == 'success') {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders') . "'; }</script>";
        } else {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders/edit/' . $data['id']) . "'; }</script>";
        }
    }
    function hapus($id)
    {
        $return = $this->orders_model->delete_order($id);
        if ($return['status'] == 'success') {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders') . "'; }</script>";
        } else {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('orders') . "'; }</script>";
        }
    }

    function laporan_waktu()
    {
        $this->form_validation->set_rules('tanggal_dari', 'Tanggal Dari', 'required');
        $this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'required');
        $data['user'] = $this->session->userdata();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('orders/laporan');
            $this->load->view('templates/footer');
            return;
        }
        $tanggal_dari = $this->input->post('tanggal_dari');
        $tanggal_sampai = $this->input->post('tanggal_sampai');
        $data['orders'] = $this->orders_model->get_orders_by_date($tanggal_dari, $tanggal_sampai);
        if (empty($data['orders'])) {
            $this->session->set_flashdata('message', 'Tidak ada data order untuk rentang tanggal tersebut.');
            redirect('orders/laporan_');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('orders/laporan', $data);
        $this->load->view('templates/footer');
    }
    function laporan_sales() {
        
        $this->form_validation->set_rules('tanggal_dari', 'Tanggal Dari', 'required');
        $this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'required');
        $data['user'] = $this->session->userdata();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('orders/laporan_sales');
            $this->load->view('templates/footer');
            return;
        }
        $tanggal_dari = $this->input->post('tanggal_dari');
        $tanggal_sampai = $this->input->post('tanggal_sampai');
        $data['orders'] = $this->orders_model->get_orders_by_sales($tanggal_dari, $tanggal_sampai);
        if (empty($data['orders'])) {
            print_r('disini');
            redirect('orders/laporan');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('orders/laporan_sales', $data);
        $this->load->view('templates/footer');
        // $this->form_validation->set_rules('tanggal_dari', 'Tanggal Dari', 'required');
        // $this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'required');
        // $data['user'] = $this->session->userdata();
        // if ($this->form_validation->run() == FALSE) {
        //     $this->load->view('templates/sidebar', $data);
        //     $this->load->view('templates/header');
        //     $this->load->view('orders/laporan_sales');
        //     $this->load->view('templates/footer');
        //     return;
        // }
        // $tanggal_dari = $this->input->post('tanggal_dari');
        // $tanggal_sampai = $this->input->post('tanggal_sampai');
        // print_r($tanggal_dari, $tanggal_sampai);
        // $data['orders'] = $this->orders_model->get_orders_by_sales($tanggal_dari, $tanggal_sampai);
        // print_r($data['orders']);
        // if (empty($data['orders'])) {
        //     $this->session->set_flashdata('message', 'Tidak ada data order untuk rentang tanggal tersebut.');
        //     redirect('orders/laporan_sales');
        // }
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/header');
        // $this->load->view('orders/laporan_sales', $data);
        // $this->load->view('templates/footer');
    }
    function laporan_produk(){
        $this->form_validation->set_rules('tanggal_dari', 'Tanggal Dari', 'required');
        $this->form_validation->set_rules('tanggal_sampai', 'Tanggal Sampai', 'required');
        $data['user'] = $this->session->userdata();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('orders/laporan_produk');
            $this->load->view('templates/footer');
            return;
        }
        $tanggal_dari = $this->input->post('tanggal_dari');
        $tanggal_sampai = $this->input->post('tanggal_sampai');
        $data['orders'] = $this->orders_model->get_orders_by_product($tanggal_dari, $tanggal_sampai);
        if (empty($data['orders'])) {
            $this->session->set_flashdata('message', 'Tidak ada data order untuk rentang tanggal tersebut.');
            redirect('orders/laporan_produk');
        }
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('orders/laporan_produk', $data);
        $this->load->view('templates/footer');
    }
}

