<?php

class contractor_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_contractors($page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->get('contractor', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_contractor_by_id($id)
    {
        return $this->db
            ->get_where('contractor', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('contractor', $data);
        }

        return $this->db->insert('contractor', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('contractor');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('contractor');
    }
    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->select("*")
            ->from("contractor")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->order_by('yomi', 'ASC')
            ->get()
            ->result_array();
    }

}
