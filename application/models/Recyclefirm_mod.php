<?php

class recyclefirm_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_recyclefirms($page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->get('recyclefirmlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_recyclefirm_by_id($id)
    {
        return $this->db
            ->get_where('recyclefirmlist', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('recyclefirm', $data);
        }

        return $this->db->insert('recyclefirm', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('recyclefirm');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('recyclefirm');
    }
}
