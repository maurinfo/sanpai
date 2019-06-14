<?php

class contractorbranch_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

  
    public function get_contractorbranch($query,$page = 0)
    {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->like('id',$query )
            ->or_like('name',$query )
            ->or_like('address1',$query )
            ->or_like('address2',$query )
            ->or_like('contractor',$query )
            ->get('contractorbranchlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }
    public function get_total_record_count($query)
      {
        return $this->db->order_by("yomi", "asc")
            ->where('isactive', 1)
            ->like('id',$query )
            ->or_like('name',$query )
            ->or_like('address1',$query )
            ->or_like('address2',$query )
            ->or_like('contractor',$query )
            ->get('contractorbranchlist')
            ->num_rows();
      }

      

    public function get_contractorbranch_by_id($id)
    {
        return $this->db
            ->get_where('contractorbranchlist', array('id' => $id))
            ->row_array();
    }

    public function get_contractorbranchname($id)
    {
        return $this->db
            ->get_where('contractorbranch', array('id' => $id))
            ->row('name');
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('contractorbranch', $data);
        }

        return $this->db->insert('contractorbranch', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('contractorbranch');
    }
   

    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->select("*")
            ->from("contractorbranch")
            ->where('name like', '%' . $query . '%')
            ->or_where('yomi like', $query . '%')
            ->order_by('yomi', 'ASC')
            ->get()
            ->result_array();
    }

}
