<?php

class accountledger_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_accountledgers($data)

    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->get('accountledger')
            ->result_array();
    }

    public function get_accountledger_by_id($id)
    {
        return $this->db
            ->get_where('accountledger', array('id' => $id))
            ->row_array();
    }

    public function get_accountledgername($id)
    {
        return $this->db
            ->get_where('accountledger', array('id' => $id))
            ->row('name');
    }


    public function save($data)
    {
        $refid = $data['referenceid'];
        $transtypeid = $data['transactiontypeid'];

        $id = $this->db
            ->where('referenceid', $refid)
            ->where('transactiontypeid', $transtypeid)
            ->get('accountledger')
            ->row('id');
        if (isset($id)) {
            $this->db->where('id', $id);
            return $this->db->update('accountledger', $data);

        } else {
            return $this->db->insert('accountledger', $data);
        }

    }


    public function syncAccountLedger($data)
    {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('accountledger', $data);

        } else {
            return $this->db->insert('accountledger', $data);
        }

    }

    public function saleLedgerExists($referenceid)
    {

     return $this->db
            -get_>where('saleledgerlist', array('referenceid'=> $referenceid))
            ->row('id');

    }
    public function receiptLedgerExists($referenceid)
    {

     return $this->db
            -get_>where('receiptledgerlist', array('referenceid'=> $referenceid))
            ->row('id');

    }
    public function expenseLedgerExists($referenceid)
    {

     return $this->db
            -get_>where('expenseledgerlist', array('referenceid'=> $referenceid))
            ->row('id');

    }
    public function paymentLedgerExists($referenceid)
    {

     return $this->db
            -get_>where('paymentledgerlist', array('referenceid'=> $referenceid))
            ->row('id');

    }
    public function delete($refid,$transactiontypeid)
    {
        return $this->db
            ->where('referenceid', $refid)
            ->where('transactiontypeid', $transactiontypeid)
            ->delete('accountledger');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('accountledger');
    }
    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->select("*")
            ->from("accountledger")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->order_by('yomi', 'ASC')
            ->get()
            ->result_array();
    }

//CUSTOMER

    public function getCustomerBeginningBalanceInfo($firmid,$date)
    {
        return $this->db
            ->query("SELECT * from accountledger where firmid = " .$firmid . " and transactiontypeid =-1 and datetransacted = (select max(datetransacted) from accountledger where firmid = " .$firmid . "  and transactiontypeid =-1 and datetransacted <='" .$date . "')")
            ->row_array();

    }
    public function getCustomerLedgerDateRangeTotal($firmid,$datefrom,$dateto)
    {
        $row= $this->db
            ->query("SELECT sum(amount) as total from accountledger where firmid = " .$firmid . " and datetransacted >='" .$datefrom . "'and datetransacted <='" .$dateto . "'and (transactiontypeid =1 or transactiontypeid =2)")
            ->row_array();
         return $row['total'];
    }


    public function getCustomerTotalPayment($firmid,$datefrom,$dateto)
    {
        $row= $this->db
            ->query("SELECT sum(amount) as total from accountledger where firmid = " .$firmid . " and datetransacted >='" .$datefrom . "'and datetransacted <='" .$dateto . "'and transactiontypeid =2")
            ->row_array();
         return $row['total'];
    }
    public function getCustomerPrevAmountDue($firmid,$invdatefrom, $invdateend)
    {
        $prevdateto   = strftime("%Y/%m/%d", strtotime("$invdatefrom -1 day"));

        $begbalrow      =  $this->accountledger_mod->getCustomerBeginningBalanceInfo($firmid,$prevdateto);
        $begbaldate     = $begbalrow['datetransacted'];
        $begbalamount   = $begbalrow['amount'];

        $prevdatefrom = $begbaldate;

        // for after begining date and right before the specified date
        $prevtotal =  $this->accountledger_mod->getCustomerLedgerDateRangeTotal($firmid,$prevdatefrom,$prevdateto);
        $prevtotaldue = floor($begbalamount + $prevtotal);
        return $prevtotaldue;
    }


    public function get_customeraccountledgers($cusid,$datefrom,$dateto)

    {

        return $this->db->order_by("datetransacted")
            ->where('firmid', $cusid)
            ->where('datetransacted>=', $datefrom)
            ->where('datetransacted<=', $dateto)
            ->get('customerledgerlist')
            ->result_array();
    }


//SUPPLIER

    public function getSupplierBeginningBalanceInfo($firmid,$date)
    {
        return $this->db
            ->query("SELECT * from accountledger where firmid = " .$firmid . " and transactiontypeid =-1 and datetransacted = (select max(datetransacted) from accountledger where firmid = " .$firmid . "  and transactiontypeid =-2 and datetransacted <='" .$date . "')")
            ->row_array();

    }
    public function getSupplierLedgerDateRangeTotal($firmid,$datefrom,$dateto)
    {
        $row= $this->db
            ->query("SELECT sum(amount) as total from accountledger where firmid = " .$firmid . " and datetransacted >='" .$datefrom . "'and datetransacted <='" .$dateto . "'and (transactiontypeid =3 or transactiontypeid =4)")
            ->row_array();
         return $row['total'];
    }


    public function getSupplierTotalPayment($firmid,$datefrom,$dateto)
    {
        $row= $this->db
            ->query("SELECT sum(amount) as total from accountledger where firmid = " .$firmid . " and datetransacted >='" .$datefrom . "'and datetransacted <='" .$dateto . "'and transactiontypeid =4")
            ->row_array();
         return $row['total'];
    }
    public function getSupplierPrevAmountDue($firmid,$invdatefrom, $invdateend)
    {
        $prevdateto   = strftime("%Y/%m/%d", strtotime("$invdatefrom -1 day"));

        $begbalrow      =  $this->accountledger_mod->getSupplierBeginningBalanceInfo($firmid,$prevdateto);
        $begbaldate     = $begbalrow['datetransacted'];
        $begbalamount   = $begbalrow['amount'];

        $prevdatefrom = $begbaldate;

        // for after begining date and right before the specified date
        $prevtotal =  $this->accountledger_mod->getSupplierLedgerDateRangeTotal($firmid,$prevdatefrom,$prevdateto);
        $prevtotaldue = floor($begbalamount + $prevtotal);
        return $prevtotaldue;
    }


    public function get_supplieraccountledgers($supid,$datefrom,$dateto)

    {

        return $this->db->order_by("datetransacted")
            ->where('firmid', $supid)
            ->where('datetransacted>=', $datefrom)
            ->where('datetransacted<=', $dateto)
            ->get('supplierledgerlist')
            ->result_array();


    }


}
