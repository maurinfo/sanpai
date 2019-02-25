<?php

class wasteclass extends CI_Controller
{



    public function create()
    {
        $data['title'] = 'Waste Class';
        $this->load->view('templates/header');
        $this->load->view('lists/wasteclasseditor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['wasteclass'] = $this->wasteclass_mod->get_wasteclass_by_id($id);

        if (empty($data['wasteclass'])) {
            show_404();
        }
        $this->load->view('templates/header');
        $this->load->view('lists/wasteclasseditor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['wasteclass'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['wasteclass']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('lists/wasteclasseditor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->wasteclass_mod->save($data['wasteclass'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('lists/1');
    }

    public function delete($id)
    {
        if ($this->wasteclass_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('lists/1');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'yomi' => $this->input->post('yomi') ?: null,

        );
    }

    public function fetch()
    {
        $txttosearch = $this->input->post('query');

        if ($txttosearch == null) {
            return;
        }

        $response = $this->wasteclass_mod->fetch_data($txttosearch);

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
