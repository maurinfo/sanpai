<?php

class prefecture_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_prefecture($id = false)
    {

        if ($id === false) {
            $this->db->order_by("yomi", "asc");
          //  $query = $this->db->get('contractor');
             $query = $this->db->get_where('prefecture', array('isactive' => '1'));

            return $query->result_array();

        }

        $query = $this->db->get_where('prefecture', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('prefecture', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('prefecture');
        return true;
    }
}
