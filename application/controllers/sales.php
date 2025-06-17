<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('pengguna_model');
        $this->load->library('form_validation');
    }
    public function index() {
        $data['pengguna'] = $this->pengguna_model->get_all_pengguna();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $data['user'] = $this->session->userdata();
        $data['sales'] = $this->pengguna_model->get_user_sales();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('pengguna/sales', $data);
        $this->load->view('templates/footer');
    }
}
?>