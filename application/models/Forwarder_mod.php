<?php

class forwarder_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_forwarder($page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->get('forwarder', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_forwarder_by_id($id)
    {
        return $this->db
            ->get_where('forwarder', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('forwarder', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('forwarder');
        return true;
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('forwarder');
    }
}
