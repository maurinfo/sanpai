<?php

class item_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_items($page = 0)
    {
        return $this->db->order_by("yomi")
            ->where('isactive', 1)
            ->get('itemlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }


    public function get_item_by_id($id)
    {
        return $this->db
            ->get_where('itemlist', array('id' => $id))
            ->row_array();
    }

    public function get_item_by_name($name)
    {
        return $this->db
            ->get_where('itemlist', array('name' => $name))
            ->row_object();
    }

    public function get_itemname($id)
    {
        return $this->db
            ->get_where('itemlist', array('id' => $id))
            ->row('name');
    }

    public function get_itemId_by_name($name)
    {
        $item = $this->get_item_by_name($name);
        if($item){
            return $item->id;
        }
        return 0;
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
            ->count_all_results('itemlist');
    }

    public function fetch_data($query)
    {
     //   if ($query == '') {
    //        return;
    //    }

        return $this->db->select("*")
            ->from("itemlist")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->where('isactive', 1)
            ->order_by('yomi', 'ASC')
            ->get()
            ->result_array();
    }
}
