<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class customer_model extends CI_Model {
    function get_all_customers() {
        $query = $this->db->select('id, name_customer, address, phone, email')
                          ->from('customers')
                          ->get();
        return $query->result_array();
    }

    function insert_customer($data) {
        $return = $this->db->insert('customers', $data);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Customer successfully added',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to add customer',
            ];
        }
    }

    function get_customer_by_id($id) {
        $query = $this->db->get_where('customers', ['id' => $id]);
        return $query->row_array();
    }

    function update_customer($id, $data) {
        $return = $this->db->update('customers', $data, ['id' => $id]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Customer successfully updated',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to update customer',
            ];
        }
    }

    function delete_customer($id) {
        $return = $this->db->delete('customers', ['id' => $id]);
        if ($return) {
            return [
                'status' => 'success',
                'message' => 'Customer successfully deleted',
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete customer',
            ];
        }
    }
}
?>