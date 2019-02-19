<?php

class customer_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_customers($page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->get('customer', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_customer_by_id($id)
    {
        return $this->db
            ->get_where('customer', array('id' => $id))
            ->row_array();
    }

    public function get_customername($id)
    {
        return $this->db
            ->get_where('customer', array('id' => $id))
            ->row('name');
    }


    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('customer', $data);
        }

        return $this->db->insert('customer', $data);

    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('customer');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('customer');
    }
    public function get_lastid()
    {
        return $this->db->select_max('id')
                        ->get('customer')
                        ->row()->id;


    }
    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->select("*")
            ->from("customer")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->order_by('yomi', 'ASC')
            ->get()
            ->result_array();
    }


}
