<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {
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
        $data['pengguna'] = $this->pengguna_model->get_all_pengguna();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/header');
        $this->load->view('pengguna/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $data['user'] = $this->session->userdata();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('pengguna/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            ];
            $return = $this->pengguna_model->insert_pengguna($data);
            if ($return['status'] == 'success') {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('pengguna') . "'; }</script>";
            } else {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('pengguna/tambah') . "'; }</script>";
            }
        }
    }

    function edit($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['pengguna'] = $this->pengguna_model->get_pengguna_by_id($id);
            $data['user'] = $this->session->userdata();
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/header', $data);
            $this->load->view('pengguna/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role')
            ];
            if ($this->input->post('password')) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $return = $this->pengguna_model->update_pengguna($id, $data);
            if ($return['status'] == 'success') {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('pengguna') . "'; }</script>";
            } else {
                echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url("pengguna/edit/$id") . "'; }</script>";
            }
        }
    }

    function hapus($id) {
        $return = $this->pengguna_model->delete_pengguna($id);
        if ($return['status'] == 'success') {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('pengguna') . "'; }</script>";
        } else {
            echo "<script>if(confirm('{$return['message']}')){ window.location.href = '" . base_url('pengguna') . "'; }</script>";
        }
    }
}
?>