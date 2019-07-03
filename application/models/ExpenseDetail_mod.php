<?php

class ExpenseDetail_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_expensedetail_by_expenseid($expenseid)
    {
        return $this->db->where('expenseid', $expenseid)
            ->where('isactive', 1)
            ->order_by("id", "asc")
            ->get('expensedetaillist')
            ->result_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('expensedetail', $data);
        }

        return $this->db->insert('expensedetail', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('expense');
    }

    public function delete_by_expenseid($id)
    {
        return $this->db->where('expenseid', $id)
            ->set('isactive', 0)
            ->update('expensedetail');
    }

}
