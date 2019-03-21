<?php

class taxrate_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_taxrates($page = 0)
    {
        return $this->db->order_by("id",'desc')
            ->where('isactive', 1)
            ->get('taxrate', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_taxrate_by_id($id)
    {
        return $this->db
            ->get_where('taxrate', array('id' => $id))
            ->row_array();
    }
    public function get_taxrate_of_date($date)
    {
        $reault_array = $this->db
            ->query("select * from taxrate where startdate=(select MAX(startdate) from taxrate where startdate <='".$date."')")
            ->result_array();
            return $reault_array[0]['rate'];
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('taxrate', $data);
        }

        return $this->db->insert('taxrate', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('taxrate');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('taxrate');
    }
}
