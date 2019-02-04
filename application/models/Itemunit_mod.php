<?php

class itemunit_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_itemunits($page = 0)
    {
        return $this->db->order_by("id")
            ->where('isactive', 1)
            ->get('itemunit', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_itemunit_by_id($id)
    {
        return $this->db
            ->get_where('itemunit', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('itemunit', $data);
        }

        return $this->db->insert('itemunit', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('itemunit');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('itemunit');
    }
}
