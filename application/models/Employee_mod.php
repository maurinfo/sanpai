<?php

class employee_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_employee($id = false)
    {

        if ($id === false) {
            $this->db->order_by("furigana", "asc");
            $query = $this->db->get('employee');
            return $query->result_array();

        }

        $query = $this->db->get_where('employee', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('employee', $data);
        }

        return $this->db->insert('employee', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('employee');
        return true;
    }
}
