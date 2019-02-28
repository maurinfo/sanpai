<?php

class manifest_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_manifest($page = 0)
    {
        return $this->db->order_by("id", "desc")
            ->where('isactive', 1)
            ->get('manifestlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_manifest_by_id($id)
    {
        return $this->db
            ->get_where('manifestlist', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('manifest', $data);
        }

        return $this->db->insert('manifest',$data);
    }

    public function fetch_data($query)
    {
        if ($query == '') {
            return;
        }

        $sql = "
            SELECT 
                id, 
                referenceno, 
                contractor, 
                contractorbranch, 
                contractor_yomi, 
                contractorbranch_yomi, 
                datemanifest,
                wasteclass
            FROM manifestlist 
            WHERE 
                referenceno LIKE '%:PARAM%' OR
                contractor_yomi LIKE '%:PARAM%' OR
                contractorbranch_yomi LIKE '%:PARAM%'
        ";

        return $this->db->query($sql, array("PARAM" => $query))
            ->result_array();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('manifest');
    }

    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('manifestlist');
    }
}
