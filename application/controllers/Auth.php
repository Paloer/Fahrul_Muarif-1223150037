<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
    }
    public function login(){
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }
    function process_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email dan password harus diisi');
            redirect('auth/login');
        }

        $user = $this->User_model->check_user($email, $password);
        if ($user) {
            $this->session->set_userdata([
                'logged_in' => true,
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->username,
                'role' => $user->role
            ]);
            $this->session->set_flashdata('success', 'Login berhasil');
            redirect('dashboard');
        } 
        else {
            $this->session->set_flashdata('error', 'Login gagal, email atau password salah');
            redirect('auth/login');
        }
    }
    private function redirect_by_role($role) {
        switch ($role) {
            case 'admin':
                redirect('dashboard');
                break;
            case 'user':
                redirect('dashboard_user');
                break;
            default:
                redirect('auth/login');
        }
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}

