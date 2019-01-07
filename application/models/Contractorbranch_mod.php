<?php

class contractorbranch_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_contractorbranch($id = false)
    {

        if ($id === false) {
            $this->db->order_by("yomi", "asc");
          //  $query = $this->db->get('contractorbranch');
             $query = $this->db->get_where('contractorbranch', array('isactive' => '1'),100,1);

            return $query->result_array();

        }

        $query = $this->db->get_where('contractorbranch', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('contractorbranch', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('contractorbranch');
        return true;
    }
}
