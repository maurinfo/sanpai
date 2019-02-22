<?php

class expense_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_expenses($page = 0)
    {
        return $this->db->order_by("datedelivered", "desc")
            ->where('isactive', 1)
            ->get('expenselist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_expense_by_id($id)
    {
        return $this->db
            ->get_where('expenselist', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('expense', $data);
        }

        return $this->db->insert('expense',$data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('expense');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('expenselist');
    }
}
