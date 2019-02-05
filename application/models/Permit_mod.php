<?php

class permit_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_permits($firmid, $permittype, $page = 0)
    {
        return $this->db->order_by("dateexpire", "desc")
            ->where(array(
                        'firmid'=> $firmid,
                        'permittype' => $permittype, // 1 for forwarder 2 for recyclefirm
                        'isactive'=> 1,
                        ))
            ->get('permitlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_permit_by_id($id)
    {
        return $this->db
            ->get_where('permitlist', array('id' => $id))
            ->row_array();
    }
     public function get_permitsof($firmid,$page = 0)
    {
        return $this->db->order_by("dateexpire", "desc")
            ->where(array(
                        'firmid'=> $firmid,
                        'permittype' => $permittype, // 1 for forwarder 2 for recyclefirm
                        'isactive'=> 1,
                        ))
            ->get('permitlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('permit', $data);
        }

        return $this->db->insert('permit', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('permit');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('permit');
    }

    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        return $this->db->order_by("dateexpire", "desc")
            ->where(array(
                        'firmid'=> $query,
                    //    'permittype' => 1, // 1 for forwarder 2 for recyclefirm
                        'isactive'=> 1,
                        ))
            ->get('permitlist')
            ->result_array();
    }
}
