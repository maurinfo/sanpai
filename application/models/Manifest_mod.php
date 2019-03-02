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

    public function fetch_data($params)
    {
        if (empty($params) || trim($params->search_string) == '') {
            return;
        }

        $date_cond = '';
        $bind_params = $this->utility->multiply_param("%{$params->search_string}%", 3);

        if($params->date_from !== '' && $params->date_to !== '') {
            $date_cond = " AND datemanifest BETWEEN ? AND ? ";
            $bind_params[] = $params->date_from; 
            $bind_params[] = $params->date_to;
        }
        
        $sql = "
            SELECT  
                referenceno, 
                datemanifest,
                contractor, 
                contractorbranch, 
                contractor_yomi, 
                contractorbranch_yomi, 
                wasteclass
            FROM manifestpending 
            WHERE
                (referenceno LIKE ? OR
                contractor_yomi LIKE ? OR
                contractorbranch_yomi LIKE ?)
                {$date_cond}
        ";
        
        return $this->db->query($sql, $bind_params)
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
