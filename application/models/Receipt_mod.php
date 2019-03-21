<?php
class receipt_mod extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


public function get_receipts($query,$page = 0)
{

    return $this->db->order_by("datereceipt", "desc")
        ->where('isactive', 1)
        ->like('name',$query )
        ->or_like('referenceno',$query )
        ->or_like('yomi',$query )
        ->get('receiptlist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("datereceipt", "desc")
        ->where('isactive', 1)
        ->like('name',$query )
        ->or_where('isactive', 1)
        ->like('referenceno',$query )
         ->or_where('isactive', 1)
        ->like('yomi',$query )
        ->get('receiptlist')
        ->num_rows();
}
    public function get_receipt_by_id($id)
    {
        return $this->db
            ->get_where('receiptlist', array('id' => $id))
            ->row_array();
    }
    public function save($data)
    {
        $receipt = $data['receipt'];
        $receiptdetail = $data['receiptitem'];
        $this->db->trans_start();
        $receipt['referenceno'] = $receipt['referenceno'] ?: $this->generate_referenceno();
        if (isset($receipt['id'])) {
            $this->db->where('id', $receipt['id']);
            $this->db->update('receipt', $receipt);
      //      $receiptid = $receipt['id'];
        } else {
            $this->db->insert('receipt', $receipt);
       //     $receiptid = $this->db->insert_id();
        }
        $receiptid = $receipt['id'] ?: $this->db->insert_id();
        $this->receiptdetail_mod->delete_by_receiptid($receiptid);
        foreach ($receiptdetail as $receiptitem) {
            $receiptitem['receiptid'] = $receiptid;
            $receiptitem['isactive'] = 1;
            $this->receiptdetail_mod->save($receiptitem);
        }

// FOR ACCOUNT LEDGER

        $acctledger = array(
            'referenceid' => $receiptid,
            'firmid' => $receipt['customerid'],
            'datetransacted' => $receipt['datereceipt'],
            'amount' => $receipt['total'],
            'transactiontypeid' =>1,

        );
        $this->accountledger_mod->save($acctledger);


 /*       if ($this->db
            ->where('referenceid', $refid)
            ->count_all_results('receiptledger') <> 0 ){

            return $this->db->where('id', $refid)
            ->update('accountledger',$data);
        }else{

            return $this->db->insert('accountledger', $data);
        }*/
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('receipt');
    }
    private function generate_referenceno()
    {
   /*     $referenceno = $this->db
            ->select_max('referenceno')
            ->get('receipt')
            ->row()
            ->referenceno;
        return sprintf("%'.06d", (int) $referenceno + 1);*/
         $lastid = $this->db
            ->select_max('id')
            ->get('receipt')
            ->row()
            ->id;
        return sprintf("%'.06d", $lastid + 1);
    }
//    public function get_receipts($page = 0)
//    {
//        return $this->db->order_by("datereceipt", "desc")
//            ->where('isactive', 1)
//            ->get('receiptlist', DEFAULT_PAGE_LIMIT, $page)
//            ->result_array();
//    }
///
//
//   public function get_total_record_count()
//    {
//        return $this->db
//            ->where('isactive', 1)
//            ->count_all_results('receiptlist');
//    }
//
}
