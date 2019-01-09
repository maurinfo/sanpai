<?php

class manifest_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_manifest($id = false)
    {

        if ($id === false) {
            $this->db->order_by("id", "desc");
          //  $query = $this->db->get('manifest');
             $query = $this->db->get_where('manifest', array('isactive' => '1'),100,1);

            return $query->result_array();

        }

        $query = $this->db->get_where('manifest', array('id' => $id));
        return $query->row_array();
    }

    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            return $this->db->update('manifest', $data);
        }

        return $this->db->insert($data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('manifest');
        return true;
    }
}
