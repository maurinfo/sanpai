<?php

class disposalmethod_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_disposalmethods($page = 0)
    {
        return $this->db->order_by("id")
            ->where('isactive', 1)
            ->get('disposalmethod', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_disposalmethod_by_id($id)
    {
        return $this->db
            ->get_where('disposalmethod', array('id' => $id))
            ->row_array();
    }
    public function get_disposalmethodname($id)
    {
        return $this->db
            ->get_where('disposalmethod', array('id' => $id))
            ->row('name');
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('disposalmethod', $data);
        }

        return $this->db->insert('disposalmethod', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('disposalmethod');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('disposalmethod');
    }
}
