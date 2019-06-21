<?php

class supplier_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_suppliers($query,$page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->like('id',$query )
            ->or_like('name',$query )
            ->or_like('zip',$query )
            ->or_like('address1',$query )
            ->or_like('address2',$query )
            ->or_like('telno',$query )
            ->or_like('faxno',$query )
            ->or_like('email',$query )    
            ->get('supplier', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }
    
    
    public function get_total_record_count($query)
      {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->like('id',$query )
            ->or_like('name',$query )
            ->or_like('zip',$query )
            ->or_like('address1',$query )
            ->or_like('address2',$query )
            ->or_like('telno',$query )
            ->or_like('faxno',$query )
            ->or_like('email',$query )
            ->get('supplier')
            ->num_rows();
      }
      
    

    public function get_supplier_by_id($id)
    {
        return $this->db
            ->get_where('supplier', array('id' => $id))
            ->row_array();
    }

    public function get_suppliername($id)
    {
        return $this->db
            ->get_where('supplier', array('id' => $id))
            ->row('name');
    }


    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('supplier', $data);
        }

        return $this->db->insert('supplier', $data);

    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('supplier');
    }


    public function get_lastid()
    {
        return $this->db->select_max('id')
                        ->get('supplier')
                        ->row()->id;


    }
    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->select("*")
            ->from("supplier")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->order_by('yomi,name', 'ASC')
            ->get()
            ->result_array();
    }


    //    public function get_total_record_count()
//    {
//        return $this->db
//            ->where('isactive', 1)
//            ->count_all_results('supplier');
//    }
    
    
}
