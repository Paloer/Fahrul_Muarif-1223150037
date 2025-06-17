<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['produk'] = $this->produk_model->get_all_produk();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $data['user'] = $this->session->userdata();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    function tambah() {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('price', 'Harga Produk', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stok Produk', 'required|integer');
        $data['user'] = $this->session->userdata();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('produk/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6)) . date('Ymd');
            $data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'created_by' => $this->input->post('created_by'),
                'created_by_name' => $this->input->post('created_by_name'),
                'kode_produk' => $code,
            ];
            $return = $this->produk_model->insert_produk($data);
            if ($return['status'] == 'success') {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('produk') . "'; }</script>";
            } else {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('produk/tambah') . "'; }</script>";
            }
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('name', 'Nama Produk', 'required');
        $this->form_validation->set_rules('price', 'Harga Produk', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stok Produk', 'required|integer');
        $data['user'] = $this->session->userdata();

        if ($this->form_validation->run() == FALSE) {
            $data['produk'] = $this->produk_model->get_produk_by_id($id);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('produk/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'updated_by' => $this->input->post('updated_by'),
                'updated_by_name' => $this->input->post('updated_by_name'),
                'kode_produk' => $this->input->post('kode_produk')
            ];
            $return = $this->produk_model->update_produk($id, $data);
            if ($return['status'] == 'success') {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('produk') . "'; }</script>";
            } else {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url("produk/edit/{$id}") . "'; }</script>";
            }
        }
    }

    function hapus($id) {
        $return = $this->produk_model->delete_produk($id);
        if ($return['status'] == 'success') {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('produk') . "'; }</script>";
        } else {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('produk') . "'; }</script>";
        }
    }
}