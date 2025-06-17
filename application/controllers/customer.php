<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $data['customers'] = $this->customer_model->get_all_customers();
        $data['user'] = $this->session->userdata();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer');
    }
    function tambah()
    {
        $this->form_validation->set_rules('name_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('phone', 'Telepon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('created_by', 'Created By', 'required');
        $this->form_validation->set_rules('created_by_name', 'Created By Name', 'required');
        $data['user'] = $this->session->userdata();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header');
            $this->load->view('customer/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name_customer' => $this->input->post('name_customer'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'created_by' => $this->input->post('created_by'),
                'created_by_name' => $this->input->post('created_by_name')
            );
            $this->customer_model->insert_customer($data);
            redirect('customer/index');
        }
    }
    function edit($id)
    {
        $this->form_validation->set_rules('name_customer', 'Nama Customer', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('phone', 'Telepon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('updated_by', 'Updated By', 'required');
        $this->form_validation->set_rules('updated_by_name', 'Updated By Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['customer'] = $this->customer_model->get_customer_by_id($id);
            $data['user'] = $this->session->userdata();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('customer/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'name_customer' => $this->input->post('name_customer'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'updated_by' => $this->input->post('updated_by'),
                'updated_by_name' => $this->input->post('updated_by_name'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->customer_model->update_customer($id, $data);
            redirect('customer/index');
        }
    }
    function hapus($id)
    {
        $this->customer_model->delete_customer($id);
        redirect('customer/index');
    }
}
?>