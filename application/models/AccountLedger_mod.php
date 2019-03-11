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

        if ($this->db
            ->where('referenceid', $refid)
            ->count_all_results('saleledgerlist') <> 0 ){

            return $this->db->where('id', $refid)
            ->update('accountledger',$data);
        }else{

            return $this->db->insert('accountledger', $data);
        }
    }



    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('accountledger');
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

}
