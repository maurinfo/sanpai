<?php
class expense_mod extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


public function get_expenses($query,$page = 0)
{

    return $this->db->order_by("datedelivered,id", "desc")
        ->where('isactive', 1)
        ->group_start()
        ->like('name',$query )
        ->or_where(($this->checkdatevalidformat($query,"datedelivered")))
        ->or_like('referenceno',$query )
        ->or_like('subtotal',$this->clearFormat($query) )
        ->or_like('tax',$this->clearFormat($query) )
        ->or_like('total',$this->clearFormat($query) )
        ->or_like('yomi',$query )
        ->group_end()
        ->get('expenselist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("datedelivered", "desc")
        ->where('isactive', 1)
        ->like('name',$query )
        ->or_where(($this->checkdatevalidformat($query,"datedelivered")))
        ->or_like('referenceno',$query )
        ->or_like('subtotal',$this->clearFormat($query) )
        ->or_like('tax',$this->clearFormat($query) )
        ->or_like('total',$this->clearFormat($query) )
        ->or_like('yomi',$query )
        ->get('expenselist')
        ->num_rows();
}
    public function get_expense_by_id($id)
    {
        return $this->db
            ->get_where('expenselist', array('id' => $id))
            ->row_array();
    }
    public function save($data)
    {
        $expense = $data['expense'];
        $expensedetail = $data['expenseitem'];
        $this->db->trans_start();
        $expense['referenceno'] = $expense['referenceno'] ?: $this->generate_referenceno();

        if (isset($expense['id'])) {
            $this->db->where('id', $expense['id']);
            $this->db->update('expense', $expense);
      //      $expenseid = $expense['id'];
        } else {
            $this->db->insert('expense', $expense);
       //     $expenseid = $this->db->insert_id();
        }

        $expenseid = $expense['id'] ?: $this->db->insert_id();
        $this->expensedetail_mod->delete_by_expenseid($expenseid);
        foreach ($expensedetail as $expenseitem) {
            $expenseitem['expenseid'] = $expenseid;
            $expenseitem['isactive'] = 1;
            $this->expensedetail_mod->save($expenseitem);
        }

// FOR ACCOUNT LEDGER

        $acctledger = array(
            'referenceid' => $expenseid,
            'firmid' => $expense['customerid'],
            'datetransacted' => $expense['datedelivered'],
            'amount' => $expense['total'],
            'transactiontypeid' =>1,

        );

        $this->accountledger_mod->save($acctledger);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    public function delete($id)
    {
        $this->accountledger_mod->delete($id,1);

        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('expense');

    }
    private function generate_referenceno()
    {

         $lastid = $this->db
            ->select_max('id')
            ->get('expense')
            ->row()
            ->id;
        return sprintf("%'.06d", $lastid + 1);
    }


      public function clearFormat($queryString){
       $rtvalue = "";
       $regExpression = '/^[0-9,]+$/';

          if(preg_match($regExpression, $queryString)) {
            $rtvalue= filter_var($queryString,FILTER_SANITIZE_NUMBER_INT);
                    return $rtvalue;
           } else {

           return $queryString;
     }
   }

    function checkdatevalidformat($query,$table){

    if(strtotime($query) == true) {
       return $rtv = " ".$table." = date('".$query."')";
     } else {
       return $table;
     }
   }


}
