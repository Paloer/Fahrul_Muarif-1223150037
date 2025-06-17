<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {
    function get_all_pengguna() {
        $query = $this->db->select('id, name, username, role')
                          ->from('user')
                          ->get();
        return $query->result_array();
    }
    function insert_pengguna($data) {
        $return = $this->db->insert('user', $data);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Pengguna berhasil ditambahkan',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal menambahkan pengguna',
            ];
        }
    }
    function get_pengguna_by_id($id) {
        $query = $this->db->get_where('user', ['id' => $id]);
        return $query->row_array();
    }
    function update_pengguna($id, $data) {
        $return = $this->db->update('user', $data, ['id' => $id]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Pengguna berhasil diubah',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal mengubah pengguna',
            ];
        }
    }
    function delete_pengguna($id) {
        $return = $this->db->delete('user', ['id' => $id]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Pengguna berhasil dihapus',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Gagal menghapus pengguna',
            ];
        }
    }
    function get_user_sales() {
        $query = $this->db->select('id, name, username, role')
                          ->from('user')
                          ->where('role', 'Sales')
                          ->get();
        return $query->result_array();
    }
}