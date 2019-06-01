<?php

class bill_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

public function get_bills($query,$page = 0)
{

    return $this->db->order_by("dateend", "desc")

            ->like('name',$query )
            ->or_like('referenceno',$query )
            ->or_like('yomi',$query )

        ->get('billlist', DEFAULT_PAGE_LIMIT, $page)
        ->result_array();
}
  public function get_total_record_count($query)
{

    return $this->db->order_by("dateend", "desc")
        ->where('isactive', 1)
        ->like('name',$query )
        ->or_like('referenceno',$query )
        ->or_like('yomi',$query )
        ->get('billlist')
        ->num_rows();
}
    public function get_bill_by_id($id)
    {
        return $this->db
            ->get_where('billlist', array('id' => $id))
            ->row_array();
    }
    public function getNextbillDate($firmid)
    {
        $row =  $this->db
            ->query('select max(dateend) as lastbilldate from bill where customerid ='.$firmid)
            ->row_array();
            $lastdate = $row['lastbilldate'];
            $nextdate =  strftime("%Y/%m/%d", strtotime("$lastdate +1 month"));
            echo $nextdate;
         //   return $lastdate;
    }


    public function save($data)
    {

        if (isset($data['id'])) {
        $this->db->where('id', $data['id']);
        return $this->db->update('bill', $data);
        }

        return $this->db->insert('bill', $data);

    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('bill');
    }


    public function generate_referenceno()
    {
         $lastid = $this->db
            ->select_max('id')
            ->get('bill')
            ->row()
            ->id;
        return sprintf("%'.06d", $lastid + 1);
    }
    public function fetchbillItems($cusid, $datestart, $dateend)
    {
//        $cusid = $this->input->post('cusID');
//
//        $datestart = $this->date_utility->format_date($this->input->post('datestart'));
//        $dateend   = $this->date_utility->format_date($this->input->post('dateend'));
        $line = 0;
        $acctledgers = $this->accountledger_mod->get_customeraccountledgers($cusid,$datestart,$dateend);
        $response = null;

        if ($acctledgers !== null){

        foreach ($acctledgers as $acctledger){
            $recno=0;

            if ($acctledger['transactiontypeid']==1){ //SALES

                $saleid= $acctledger['referenceid'];
                $sale= $this->sale_mod->get_sale_by_id($saleid);
                $saledetails=$this->saledetail_mod->get_saledetail_by_saleid($saleid);
                foreach ($saledetails as $saledetail){
                    if ($recno ==0){
                        $response[$line] = array(
                            'type' => 'sale',
                            'date' => $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                            'refno' => sprintf("%'.06d", $saledetail['saleid']),
                            'item_name' =>$saledetail['contractorbranch_name'].' '. $saledetail['item_name'].' '. $saledetail['spec'],
                            'qty' => number_format($saledetail['qty']),
                            'item_unit' => $saledetail['itemunit_name'],
                            'price' => number_format(floor($saledetail['price'])),
                            'amount' => number_format(floor($saledetail['amount']))


                        );
                        $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'sale',
                            'item_name' =>$saledetail['contractorbranch_name'].' '. $saledetail['item_name'].' '. $saledetail['spec'],
                            'qty' => number_format($saledetail['qty']),
                            'item_unit' => $saledetail['itemunit_name'],
                            'price' => number_format(floor($saledetail['price'])),
                            'amount' => number_format(floor($saledetail['amount']))


                        );

                    }

                    $line = $line+1;

                }

                if ($sale['tax']<>0){
                    $response[$line] = array(
                            'type' => 'tax',
                            'item_name' =>  '消　費　税',
                            'amount' => number_format(floor($sale['tax']))
                    );
                    $line = $line+1;
                }
                if ($sale['note']<>''){
                    $response[$line] = array(
                            'item_name' =>  '備考欄：'.$sale['note'],
                            'amount' => ''
                    );

                    $line = $line+1;
                }

             //reset to display date and refno on first line.

            }else{  //RECEIPTS
                $receiptid= $acctledger['referenceid'];
                $receipt= $this->receipt_mod->get_receipt_by_id($receiptid);

                if ($receipt['amount0']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）現金',
                           'amount' => number_format(floor($receipt['amount0']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）現金',
                           'amount' => number_format(floor($receipt['amount0']))
                          );
                    }

                    $line = $line+1;

                };
               if ($receipt['amount1']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）小切手',
                           'amount' => number_format(floor($receipt['amount1']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）小切手',
                           'amount' => number_format(floor($receipt['amount1']))
                          );
                    }

                    $line = $line+1;

                };

                if ($receipt['amount2']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                            'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）手形',
                           'amount' => number_format(floor($receipt['amount2']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）手形',
                           'amount' => number_format(floor($receipt['amount2']))
                          );
                    }

                    $line = $line+1;

                };

                if ($receipt['amount3']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）相殺',
                           'amount' => number_format(floor($receipt['amount3']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）相殺',
                           'amount' => number_format(floor($receipt['amount3']))
                          ) ;
                    }

                    $line = $line+1;

                };
                if ($receipt['amount4']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '（入金）口座',
                           'amount' => number_format(floor($receipt['amount4']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'receipt',
                           'item_name' =>   '（入金）口座',
                           'amount' => number_format(floor($receipt['amount4']))
                          ) ;
                    }

                    $line = $line+1;


                };
                if ($receipt['amount5']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '（入金）手数料',
                           'amount' => number_format(floor($receipt['amount5']))
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'receipt',
                           'item_name' =>   '（入金）手数料',
                           'amount' => number_format(floor($receipt['amount5']))
                          ) ;
                    }

                    $line = $line+1;


                };


                if ($receipt['note']<>'' ){
                    if ( $recno==0 ){

                      $response[$line] = array(

                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'm. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '備考欄：'. $receipt['note'],
                          'amount' =>''
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'item_name' =>   '備考欄：'. $receipt['note'],
                             'amount' =>''
                          )  ;
                    }

                    $line = $line+1;


                };


            }

        }


        return $response;


        }
    }
}
