<?php

class User_model extends CI_Model{
    
    public function insert_user($data){
        return $this->db->insert('users',$data);
    }
    public function check_user($email, $password) {
        $return = $this->db->get_where('user', ['username' => $email])->row();
        $user = $return;

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
