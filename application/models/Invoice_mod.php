<?php

class invoice_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_invoices($page = 0)
    {
        return $this->db->order_by("dateend", "desc")
            ->where('isactive', 1)
            ->get('invoicelist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_invoice_by_id($id)
    {
        return $this->db
            ->get_where('invoicelist', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('invoice', $data);
        }

        return $this->db->insert('invoice',$data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('invoice');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('invoicelist');
    }
}
