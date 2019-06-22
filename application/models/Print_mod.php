<?php
class print_mod extends CI_Model
{

public function __construct()
{
$this->load->database();
}



public function add($data)
{

return $this->db->insert('printq', $data);
}

public function clear_all(){

    return $this->db->empty_table('printq');

}


public function get_printq($id)
{
 return $this->db
            ->get('printq')
            ->result_array();
//return $this->db->get('printq')->result();
}
public function delete($id)
{
return $this->db->where('id', $id)
->set('isactive', 0)
->update('permit');
}

public function get_total_record_count()
{
return $this->db->count_all_results('printq');
}

}
