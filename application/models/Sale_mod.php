<?php

class sale_mod extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_sales($query, $page = 0)
    {
        return $this->db->order_by("datedelivered", "desc")
            ->where('isactive', 1)
            ->like('name', $query)
            ->or_where('isactive', 1)
            ->like('referenceno', $query)
            ->get('salelist', DEFAULT_PAGE_LIMIT, $page)
            ->result_array();
    }

    public function get_total_record_count($query)
    {
        return $this->db->order_by("datedelivered", "desc")
            ->where('isactive', 1)
            ->like('name', $query)
            ->or_where('isactive', 1)
            ->like('referenceno', $query)
            ->get('salelist')
            ->num_rows();
    }

    public function get_sale_by_id($id)
    {
        return $this->db
            ->get_where('salelist', array('id' => $id))
            ->row_array();
    }

    public function save($data)
    {
        $sale = $data['sale'];
        $saledetail = $data['saleitem'];

        $this->db->trans_start();

        $sale['referenceno'] = $sale['referenceno'] ?: $this->generate_referenceno();

        if (isset($sale['id'])) {
            $this->db->where('id', $sale['id']);
            $this->db->update('sale', $sale);
        } else {
            $this->db->insert('sale', $sale);
        }

        $saleid = $sale['id'] ?: $this->db->insert_id();
        $this->saledetail_mod->delete_by_saleid($saleid);

        foreach ($saledetail as $saleitem) {
            $saleitem['saleid'] = $saleid;
            $saleitem['isactive'] = 1;
            $this->saledetail_mod->save($saleitem);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)
            ->set('isactive', 0)
            ->update('sale');
    }

    private function generate_referenceno()
    {
        $referenceno = $this->db
            ->select_max('referenceno')
            ->get('sale')
            ->row()
            ->referenceno;
        return sprintf("%'.06d", (int) $referenceno + 1);
    }

}
