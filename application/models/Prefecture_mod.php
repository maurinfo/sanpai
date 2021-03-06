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

        $query = $this->db->get_where('prefecture', array('id' => $id,'isactive' => '1'));
        return $query->row_array();
    }
    public function get_prefecture_by_id($id)
    {
        return $this->db
            ->get_where('prefecture', array('id' => $id))
            ->row_array();
    }
    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('prefecture', $data);
        }

        return $this->db->insert('prefecture', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('prefecture');
    }
}
