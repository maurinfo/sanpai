<?php

class recyclefirm_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_recyclefirm($id = false)
    {

        if ($id === false) {
            $this->db->order_by("yomi", "asc");
          //  $query = $this->db->get('recyclefirm');
             $query = $this->db->get_where('recyclefirm', array('isactive' => '1'),100,1);

            return $query->result_array();

        }

        $query = $this->db->get_where('recyclefirm', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('recyclefirm', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('recyclefirm');
        return true;
    }
}
