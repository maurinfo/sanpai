<?php

class contractorbranch extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->contractorbranch_mod->get_total_record_count($searchString);

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Contractor Branch';
        $data['contractorbranch'] = $this->contractorbranch_mod->get_contractorbranch($searchString, $this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('contractorbranch/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $modaldata['modaltitle'] = 'Contractor Search';
        $modaldata['searchplaceholder'] = 'Contractor';
        $this->load->view('templates/header');
        $this->load->view('contractorbranch/editor', $data);
        $this->load->view('contractorbranch/modalsearch', $modaldata);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $data['title'] = 'Update';
        $data['contractorbranch'] = $this->contractorbranch_mod->get_contractorbranch_by_id($id);

        if (empty($data['contractorbranch'])) {
            show_404();
        }

        $data['prefectures'] = $this->prefecture_mod->get_prefecture();

        $modaldata['modaltitle'] = 'Contractor Search';
        $modaldata['searchplaceholder'] = 'Contractor';

        $this->load->view('templates/header');
        $this->load->view('contractorbranch/editor', $data);
        $this->load->view('contractorbranch/modalsearch', $modaldata);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['contractorbranch'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit Contractorbranch' : 'contractorbranch';
            $data['contractorbranch']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('contractorbranch/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->contractorbranch_mod->save($data['contractorbranch'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('contractorbranch');
    }

    public function delete($id)
    {
        if ($this->contractorbranch_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('contractorbranch');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'contractorid' => $this->input->post('contractorid'),
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
        );
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

        );
    }

    public function fetch()
    {
        $txttosearch = $this->input->post('query');

        if ($txttosearch == null) {
            return;
        }

        $response = $this->contractorbranch_mod->fetch_data($txttosearch);

        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
