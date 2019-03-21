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

        return $this->db->insert('invoice', $data);
/*
    $invoice = $data['invoice'];
        $this->db->trans_start();
        $invoice['referenceno'] = $invoice['referenceno'] ?: $this->generate_referenceno();
        if (isset($invoice['id'])) {
            $this->db->where('id', $invoice['id']);
             return $this->db->update('invoice', $invoice);
       } else {
          return  $this->db->insert('invoice', $invoice);
        }
*/
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
    public function generate_referenceno()
    {
         $lastid = $this->db
            ->select_max('id')
            ->get('invoice')
            ->row()
            ->id;
        return sprintf("%'.06d", $lastid + 1);
    }
}
