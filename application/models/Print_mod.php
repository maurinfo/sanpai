<?php

class print_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }



    public function add($data)
    {

        return $this->db->insert('printq', $data);
    }

    public function delete($id)
    {

    }

    public function get_total_record_count()
    {
        return $this->db->count_all_results('printq');
    }
}
