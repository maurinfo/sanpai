<?php

class payment_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

public function get_payments($query,$page = 0)
{

    return $this->db->order_by("datepayment", "desc")
        ->where('isactive',1)
        ->group_start()
        ->like('supplier',$query )
        ->or_where(($this->checkdatevalidformat($query,"datepayment")))
        ->or_like('total',$this->clearFormat($query))
        ->or_like('note',$query )
        ->or_like('referenceno',$query )
        ->or_like('yomi',$query )
        ->group_end()
        ->get('paymentlist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("datepayment", "desc")
        ->where('isactive',1)
        ->group_start()
        ->like('supplier',$query )
        ->or_where(($this->checkdatevalidformat($query,"datepayment")))
        ->or_like('total',$this->clearFormat($query))
        ->or_like('note',$query )
        ->or_like('referenceno',$query )
        ->or_like('yomi',$query )
        ->group_end()
        ->get('paymentlist')
        ->num_rows();
}
    public function get_payment_by_id($id)
    {
        return $this->db
            ->get_where('paymentlist', array('id' => $id))
            ->row_array();
    }
    public function getNextpaymentDate($firmid)
    {
        $row =  $this->db
            ->query('select max(datepayment) as lastpaymentdate from payment where supplierid ='.$firmid)
            ->row_array();
            $lastdate = $row['lastpaymentdate'];
            $nextdate =  strftime("%Y/%m/%d", strtotime("$lastdate +1 month"));
            echo $nextdate;
         //   return $lastdate;
    }


/*    public function save($data)
    {
        $this->db->trans_start();
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('payment', $data);
            $refid = $data['id'];
        }else{

            $this->db->insert('payment', $data);
            $refid = $this->db->insert_id();

        }

        // FOR ACCOUNT LEDGER
        $acctledger = array(
            'referenceid' => $refid,
            'firmid' => $data['supplierid'],
            'datetransacted' => $data['datereceipt'],
            'amount' => $data['total'],
            'transactiontypeid' =>2,

        );

        $this->accountledger_mod->save($acctledger);
        $this->db->trans_complete();
        return $this->db->trans_status();


    }
*/
    public function save($data)
    {
        $this->db->trans_start();
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('payment', $data);
            $refid = $data['id'];
        }else{

            $this->db->insert('payment', $data);
            $refid = $this->getLastID();
        }

// FOR ACCOUNT LEDGER

        $acctledger = array(
            'referenceid' => $refid,
            'firmid' => $data['supplierid'],
            'datetransacted' => $data['datepayment'],
            'amount' => $data['total'],
            'transactiontypeid' =>4,

        );

        $this->accountledger_mod->save($acctledger);
        $this->db->trans_complete();
        return $this->db->trans_status();

    }

    public function delete($id)
    {
        $this->accountledger_mod->delete($id,4);

        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('payment');

    }


    public function generate_referenceno()
    {
         $lastid = $this->db
            ->select_max('id')
            ->get('payment')
            ->row()
            ->id;
        return sprintf("%'.06d", $lastid + 1);
    }
    public function getLastID()
    {
         return $this->db
            ->select_max('id')
            ->get('payment')
            ->row()
            ->id;

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
