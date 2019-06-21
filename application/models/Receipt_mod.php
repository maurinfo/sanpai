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
        ->where('isactive',1)
        ->group_start()
        ->like('customer',$query )
        ->or_where(($this->checkdatevalidformat($query,"datereceipt")))
        ->or_like('referenceno',$query )
        ->or_like('customer',$query )
        ->or_like('total',$this->clearFormat($query) )
        ->or_like('note', $query)
        ->or_like('yomi',$query )
        ->group_end()
        ->get('receiptlist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("datereceipt", "desc")
        ->where('isactive',1)
        
        ->group_start()
        ->or_where(($this->checkdatevalidformat($query,"datereceipt")))
        ->like('customer',$query )
        ->or_like('referenceno',$query )
        ->or_like('customer',$query )
        ->or_like('total',$this->clearFormat($query))
        ->or_like('note', $query)
        ->or_like('yomi',$query )
        ->group_end()
        ->get('receiptlist')
        ->num_rows();
}

    public function get_receipt_by_id($id)
    {
        return $this->db
            ->get_where('receiptlist', array('id' => $id))
            ->row_array();
    }
    public function getNextreceiptDate($firmid)
    {
        $row =  $this->db
            ->query('select max(datereceipt) as lastreceiptdate from receipt where customerid ='.$firmid)
            ->row_array();
            $lastdate = $row['lastreceiptdate'];
            $nextdate =  strftime("%Y/%m/%d", strtotime("$lastdate +1 month"));
            echo $nextdate;
         //   return $lastdate;
    }


    public function save($data)
    {

        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        return $this->db->update('receipt', $data);
        }

        return $this->db->insert('receipt', $data);

    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('receipt');
    }


    public function generate_referenceno()
    {
         $lastid = $this->db
            ->select_max('id')
            ->get('receipt')
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
