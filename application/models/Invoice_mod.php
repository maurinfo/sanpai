<?php

class invoice_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

public function get_invoices($query,$page = 0)
{

    return $this->db->order_by("dateend", "desc")

            ->like('name',$query )
            ->or_like('referenceno',$query )
            ->or_like('yomi',$query )

        ->get('invoicelist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("dateend", "desc")
        ->where('isactive', 1)
        ->like('name',$query )
        ->or_like('referenceno',$query )
        ->or_like('yomi',$query )
        ->get('invoicelist')
        ->num_rows();
}
    public function get_invoice_by_id($id)
    {
        return $this->db
            ->get_where('invoicelist', array('id' => $id))
            ->row_array();
    }
    public function getNextInvoiceDate($firmid)
    {
        $row =  $this->db
            ->query('select max(dateend) as lastinvoicedate from invoice where customerid ='.$firmid)
            ->row_array();
            $lastdate = $row['lastinvoicedate'];
            $nextdate =  strftime("%Y/%m/%d", strtotime("$lastdate +1 month"));
            echo $nextdate;
         //   return $lastdate;
    }


    public function save($data)
    {

        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        return $this->db->update('invoice', $data);
        }

        return $this->db->insert('invoice', $data);

    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('invoice');
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
