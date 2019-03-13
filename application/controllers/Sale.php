<?php

class sale extends CI_Controller
{
    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->sale_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);
        $data['title'] = 'Recycle Firm';
        $data['sale'] = $this->sale_mod->get_sales($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('sale/index', $data);
        $this->load->view('templates/footer');
    }
    public function create()
    {
        $data['title'] = 'Create';
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['taxrate'] = $this->taxrate_mod->get_taxrates()[0]['rate'];
        $data['sale'] = [];
        $data['saleitems'] = [];
        $this->load->view('templates/header');
        $this->load->view('sale/editor', $data);
        $this->load->view('sale/customersearchmodal');
        $this->load->view('sale/additemmodal');
        $this->load->view('sale/manifestsearchmodal');
        $this->load->view('sale/wastesearchmodal');
        $this->load->view('templates/footer');
    }
    public function update($id)
    {
        $data['title'] = 'Create';
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['taxrate'] = $this->taxrate_mod->get_taxrates()[0]['rate'];
        $data['sale'] = $this->sale_mod->get_sale_by_id($id);
        if (empty($data['sale'])) {
            show_404();
        }
        $data['saleitems'] = $this->saledetail_mod->get_saledetail_by_saleid($data['sale']['id']);
        $this->load->view('templates/header');
        $this->load->view('sale/editor', $data);
        $this->load->view('sale/customersearchmodal');
        $this->load->view('sale/additemmodal');
        $this->load->view('sale/manifestsearchmodal');
        $this->load->view('sale/wastesearchmodal');
        $this->load->view('templates/footer');
    }
    public function save()
    {
        $data = $this->get_postdata(json_decode($this->input->raw_input_stream));
        $this->form_validation->set_data($data['sale']);
        $this->form_validation->set_rules($this->get_sales_rules());
        if (!$this->form_validation->run()) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('text', 'utf-8')
                ->set_output(json_encode($this->form_validation->error_array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
        $status = 200;
        if ($this->sale_mod->save($data)) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
            $status = 400;
        }
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    public function delete($id)
    {
        if ($this->sale_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('sale');
    }
    private function get_postdata($sales)
    {
        // Sale Data
        $data['sale'] = array(
            'id' => $sales->id ?: null,
            'customerid' => $sales->customerid,
            'datedelivered' => $this->date_utility->format_date($sales->datesale, 'Y-m-d'),
            'referenceno' => $sales->referenceno ?: null,
            'note' => $sales->notes ?: null,
            'subtotal' => $sales->subtotal ?: 0,
            'tax' => $sales->tax ?: 0,
            'total' => $sales->total ?: 0,
        );
        // Sale Detail Data
        foreach ($sales->saleitems as $item) {
            $data['saleitem'][] = array(
                'id' => $item->id ?: null,
                'manifestid' => $item->manifestid ?: null,
                'datedelivered' => $this->date_utility->format_date($item->datedelivered, 'Y-m-d'),
                'itemid' => $item->itemid,
                'spec' => $item->spec ?: null,
                'itemunitid' => $item->itemunitid ?: 0,
                'qty' => $item->qty ?: 0,
                'price' => $item->price ?: 0,
                'amount' => $item->amount ?: 0,
            );
        }
        return $data;
    }
    private function get_sales_rules()
    {
        return array(
            array(
                'field' => 'id',
                'label' => 'Sales ID',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'customerid',
                'label' => 'Customer ID',
                'rules' => 'required',
            ),
            array(
                'field' => 'note',
                'label' => 'Note',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'datedelivered',
                'label' => 'Date',
                'rules' => 'trim|valid_date[Y-m-d]',
            ),
            array(
                'field' => 'subtotal',
                'label' => 'Sub Total',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'tax',
                'label' => 'Tax',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'total',
                'label' => 'Total',
                'rules' => 'numeric',
            ),
        );
    }
}

