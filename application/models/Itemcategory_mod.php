<?php

class itemcategory_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_itemcategories($page = 0)
    {
        return $this->db->order_by("yomi")
            ->where('isactive', 1)
            ->get('itemcategory', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_itemcategory_by_id($id)
    {
        return $this->db
            ->get_where('itemcategory', array('id' => $id))
            ->row_array();
    }
    public function get_itemcategoryname($id)
    {
        return $this->db
            ->get_where('itemcategory', array('id' => $id))
            ->row('name');
    }


    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('itemcategory', $data);
        }

        return $this->db->insert('itemcategory', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('itemcategory');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('itemcategory');
    }
}
