<?php

class contractor extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->contractor_mod->get_total_record_count($searchString);

        $this->pagination->initialize($pagination_config);
        $data['title'] = 'Contractors';
        $data['contractor'] = $this->contractor_mod->get_contractors($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('contractor/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $this->load->view('templates/header');
        $this->load->view('contractor/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['contractor'] = $this->contractor_mod->get_contractor_by_id($id);

        if (empty($data['contractor'])) {
            show_404();
        }

        $data['prefectures'] = $this->prefecture_mod->get_prefecture();

        $this->load->view('templates/header');
        $this->load->view('contractor/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['contractor'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['contractor']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('contractor/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->contractor_mod->save($data['contractor'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('contractor');
    }

    public function delete($id)
    {
        if ($this->contractor_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('contractor');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'name' => $this->input->post('name'),
            'yomi' => $this->input->post('yomi') ?: null,
            'contactperson' => $this->input->post('contactperson') ?: null,
            'department' => $this->input->post('department') ?: null,
            'zip' => $this->input->post('zip') ?: null,
            'prefectureid' => $this->input->post('prefectureid'),
            'address1' => $this->input->post('address1') ?: null,
            'address2' => $this->input->post('address2') ?: null,
            'telno' => $this->input->post('telno') ?: null,
            'faxno' => $this->input->post('faxno') ?: null,
            'email' => $this->input->post('email') ?: null,
            'notes' => $this->input->post('notes') ?: null,
            'contractno' => $this->input->post('contractno') ?: null,
            'contractdate' => $this->date_utility->format_date($this->input->post('contractdate'), 'Y-m-d') ?: null,
        );
    }

    public function fetch()
    {
        $txttosearch = $this->input->post('query');

        if ($txttosearch == null) {
            return;
        }

        $response = $this->contractor_mod->fetch_data($txttosearch);

        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

    }

    private function get_rules()
    {
        return array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[100]',
            ),
            array(
                'field' => 'yomi',
                'label' => 'Furigna Name',
                'rules' => 'max_length[100]',
            ),
            array(
                'field' => 'contactperson',
                'label' => 'Contact Person',
                'rules' => 'max_length[100]',
            ),
            array(
                'field' => 'department',
                'label' => 'Department',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'zip',
                'label' => 'Zip Code',
                'rules' => 'max_length[8]',
            ),
            array(
                'field' => 'prefectureid',
                'label' => 'Prefecture',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'address2',
                'label' => 'Address 1',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'address2',
                'label' => 'Address 2',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'address2',
                'label' => 'Address 2',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'email',
                'label' => 'E-Mail',
                'rules' => 'trim|valid_email',
            ),
            array(
                'field' => 'notes',
                'label' => 'Notes',
                'rules' => 'max_length[255]',
            ),
            array(
                'field' => 'contractdate',
                'label' => 'Contract Date',
                'rules' => 'trim|valid_date[m/d/Y]',
            ),
        );
    }

}
