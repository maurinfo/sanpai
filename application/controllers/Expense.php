<?php

class expense extends CI_Controller
{
    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->expense_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Expense';
        $data['expense'] = $this->expense_mod->get_expenses($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('expense/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['taxrate'] = $this->taxrate_mod->get_taxrates()[0]['rate'];
        $data['expense'] = [];
        $data['expenseitems'] = [];
        $this->load->view('templates/header');
        $this->load->view('expense/editor', $data);
        $this->load->view('expense/suppliersearchmodal');
        $this->load->view('expense/itemsearchmodal');
        $this->load->view('expense/editorscriptlinkage');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $data['title'] = 'Create';
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['taxrate'] = $this->taxrate_mod->get_taxrates()[0]['rate'];
        $data['expense'] = $this->expense_mod->get_expense_by_id($id);
        if (empty($data['expense'])) {
            show_404();
        }
        $data['expenseitems'] = $this->expensedetail_mod->get_expensedetail_by_expenseid($data['expense']['id']);
        $this->load->view('templates/header');
        $this->load->view('expense/editor', $data);
        $this->load->view('expense/suppliersearchmodal');
        $this->load->view('expense/itemsearchmodal');
        $this->load->view('expense/editorscriptlinkage');
        $this->load->view('templates/footer');
    }

    public function save()
    {
        $data = $this->get_postdata(json_decode($this->input->raw_input_stream));

        $this->form_validation->set_data($data['expense']);
        $this->form_validation->set_rules($this->get_expenses_rules());
        if (!$this->form_validation->run()) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('text', 'utf-8')
                ->set_output(json_encode($this->form_validation->error_array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
        $status = 200;
        if ($this->expense_mod->save($data)) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
            $status = 400;
        }
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $data['title'] = 'Expense';
        $data['expense'] = $this->expense_mod->get_expenses($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('expense/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        if ($this->expense_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('expense');
    }


    private function get_postdata($expenses)
    {
        // Expense Data
        $data['expense'] = array(
            'id' => $expenses->id ?: null,
            'supplierid' => $expenses->supplierid,
            'datedelivered' => $this->date_utility->format_date($expenses->dateexpense, 'Y-m-d'),
            'referenceno' => $expenses->referenceno ?: null,
            'note' => $expenses->notes ?: null,
            'subtotal' => $expenses->subtotal ?: 0,
            'tax' => $expenses->tax ?: 0,
            'total' => $expenses->total ?: 0,
        );
        // Expense Detail Data
        foreach ($expenses->expenseitems as $item) {
            $data['expenseitem'][] = array(
                'id' => $item->id ?: null,
                'manifestid' => $item->manifestid ?: null,
                'itemid' => $item->itemid,
                'itemunitid' => $item->itemunitid ?: 0,
                'qty' => $item->qty ?: 0,
                'price' => $item->price ?: 0,
                'amount' => $item->amount ?: 0,
            );
        }
        return $data;
    }
    
    private function get_expenses_rules()
    {
        return array(
            array(
                'field' => 'id',
                'label' => 'Expenses ID',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'supplierid',
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
