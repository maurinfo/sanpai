<?php

class contractor_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_contractors()
    {
        return $this->db->order_by("yomi", "asc")
            ->get_where('contractor', array('isactive' => '1'), 100, 0)
            ->result_array();
    }

    public function get_contractor_by_id($id)
    {
        return $this->db
            ->get_where('contractor', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('contractor', $data);
        }

        return $this->db->insert('contractor', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('contractor');
        return true;
    }
}
