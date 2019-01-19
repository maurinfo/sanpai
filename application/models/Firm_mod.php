<?php

class Firm_mod extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function insert($data)
    {
        if ($this->db->insert("firm", $data)) {
            return true;
        }
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('firm');
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where("id", $id);
        $this->db->update("firm", $data);
    }

}
