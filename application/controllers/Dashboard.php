<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $data['user'] = $this->session->userdata();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
        // $this->load->view('templates/blank', $data);
    }
}

