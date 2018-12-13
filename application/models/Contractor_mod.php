<?php

class contractor_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_contractor($id = false)
    {

        if ($id === false) {
            $this->db->order_by("yomi", "asc");
          //  $query = $this->db->get('contractor');
             $query = $this->db->get_where('contractor', array('isactive' => '1'),100,1);
        
            return $query->result_array();

        }

        $query = $this->db->get_where('contractor', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('contractor', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('contractor');
        return true;
    }
}