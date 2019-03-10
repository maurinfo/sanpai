<?php

class SaleDetail_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_saledetail_by_saleid($saleid)
    {
        return $this->db->where('saleid', $saleid)
            ->where('isactive', 1)
            ->order_by("id", "desc")
            ->get('saledetaillist')
            ->result_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('saledetail', $data);
        }

        return $this->db->insert('saledetail', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('sale');
    }

    public function delete_by_saleid($id)
    {
        return $this->db->where('saleid', $id)
            ->set('isactive', 0)
            ->update('saledetail');
    }

}
