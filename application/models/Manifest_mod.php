<?php

class manifest_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_manifest($query,$page = 0)
    {
        return $this->db->order_by("id", "desc")
            ->where('isactive', 1)
            ->like('referenceno',$query )
            ->or_where(($this->checkdatevalidformat($query,"datereceived")))
            ->or_like('contractor',$query )
            ->or_like('contractorbranch',$query )
            ->get('manifestlist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }
    public function get_total_record_count($query)
      {
        return $this->db->order_by("id", "desc")
            ->where('isactive', 1)
            ->like('referenceno',$query )
            ->or_where(($this->checkdatevalidformat($query,"datereceived")))
            ->or_like('contractor',$query )
            ->or_like('contractorbranch',$query )
            ->get('manifestlist')
            ->num_rows();
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

        return $this->db->insert('manifest', $data);
    }

    public function fetch_data($params)
    {
        if (empty($params) || trim($params->search_string) == '') {
            return;
        }

        $date_cond = '';
        $bind_params = $this->utility->multiply_param("%{$params->search_string}%", 3);

        if ($params->date_from !== '' && $params->date_to !== '') {
            $date_cond = " AND datemanifest BETWEEN ? AND ? ";
            $bind_params[] = $this->date_utility->format_date($params->date_from, 'Y-m-d');
            $bind_params[] = $this->date_utility->format_date($params->date_to, 'Y-m-d');
        } elseif ($params->date_from !== '') {
            $date_cond = " AND datemanifest >= ? ";
            $bind_params[] = $this->date_utility->format_date($params->date_from, 'Y-m-d');
        } elseif ($params->date_to !== '') {
            $date_cond = " AND datemanifest <= ? ";
            $bind_params[] = $this->date_utility->format_date($params->date_to, 'Y-m-d');
        }

        $sql = "
            SELECT
                id as manifestid,
                referenceno,
                datemanifest,
                contractor as contractor_name,
                contractorbranch contractorbranch_name,
                contractor_yomi,
                contractorbranch_yomi,
                wasteclass as wasteclass_name,
                wasteclassid as wasteclass_id,
                itemunit,
                itemunitid
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
    
    
   function checkdatevalidformat($query,$table){

    if(strtotime($query) == true) {
       return $rtv = " ".$table." = date('".$query."')";
     } else {
       return $table;
     }
   }


/*    public function get_total_record_count()
    {
        return $this->db
            ->where('isactive', 1)
            ->count_all_results('manifestlist');
    }*/


}
