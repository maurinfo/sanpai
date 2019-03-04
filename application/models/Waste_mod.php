<?php

class waste_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_wastes($page = 0)
    {
        return $this->db->order_by("yomi")
            ->where('isactive', 1)
            ->get('wastelist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }


    public function get_waste_by_id($id)
    {
        return $this->db
            ->get_where('wastelist', array('id' => $id))
            ->row_array();
    }
    public function get_wastename($id)
    {
        return $this->db
            ->get_where('wastelist', array('id' => $id))
            ->row('name');
    }


    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('item', $data);
        }

        return $this->db->insert('item', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('item');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('wastelist');
    }
}
