<?php

class permitclass_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_permitclasses($page = 0)
    {
        return $this->db->order_by("id")
            ->where('isactive', 1)
            ->get('permitclass', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_permitclass_by_id($id)
    {
        return $this->db
            ->get_where('permitclass', array('id' => $id))
            ->row_array();

    }


    public function get_permitclassname($id)
    {
        return $this->db
            ->get_where('permitclass', array('id' => $id))
            ->row('name');
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('permitclass', $data);
        }

        return $this->db->insert('permitclass', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('permitclass');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('permitclass');
    }
}
