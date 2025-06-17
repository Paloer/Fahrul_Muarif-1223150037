<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {
    function get_all_produk() {
        $this->db->select('*');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->result_array();
    }

    function insert_produk($data) {
        $this->db->insert('produk', $data);
        if ($this->db->affected_rows() > 0) {
            return [
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan.',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Produk gagal ditambahkan.'
            ];
        }
    }

    function get_produk_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('produk');
        return $query->row_array();
    }

    function update_produk($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('produk', $data);
        if ($this->db->affected_rows() > 0) {
            return [
                'status' => 'success',
                'message' => 'Produk berhasil diubah.',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Produk gagal diubah.'
            ];
        }
    }
    
    function delete_produk($id) {
        $this->db->where('id', $id);
        $this->db->delete('produk');
        if ($this->db->affected_rows() > 0) {
            return [
                'status' => 'success',
                'message' => 'Produk berhasil dihapus.'
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Produk gagal dihapus.'
            ];
        }
    }
}
?>