<?php

class taxrate extends CI_Controller
{



    public function create()
    {
        $data['title'] = 'Tax Rate';
        $this->load->view('templates/header');
        $this->load->view('accounting/taxrateeditor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['taxrate'] = $this->taxrate_mod->get_taxrate_by_id($id);

        if (empty($data['taxrate'])) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('accounting/taxrateeditor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['taxrate'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
             $data['taxrate']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('accounting/taxrateeditor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->taxrate_mod->save($data['taxrate'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('accounting/3');
    }

    public function delete($id)
    {
        if ($this->taxrate_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('accounting/3');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,

            'rate' => $this->input->post('rate'),
             'startdate' => $this->date_utility->format_date($this->input->post('startdate'), 'Y-m-d') ?: null,

        );
    }

    public function fetch()
    {
        $txttosearch = $this->input->post('query');

        if ($txttosearch == null) {
            return;
        }

        $response = $this->taxrate_mod->fetch_data($txttosearch);

        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    private function get_rules()
    {
        return array(
            array(

                'field' => 'rate',
                'label' => 'Rate',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'startdate',
                'label' => 'Start Date',
                'rules' => 'trim|valid_date[m/d/Y]',
            ),
        );
    }

}
