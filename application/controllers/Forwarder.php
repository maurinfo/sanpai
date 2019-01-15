<?php

class forwarder extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->forwarder_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Forwarder';
        $data['forwarder'] = $this->forwarder_mod->get_forwarders($this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('forwarder/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Forwarder';
        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $this->load->view('templates/header');
        $this->load->view('forwarder/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Forwarder';
        $data['forwarder'] = $this->forwarder_mod->get_forwarder_by_id($id);

        if (empty($data['forwarder'])) {
            show_404();
        }

        $data['prefectures'] = $this->prefecture_mod->get_prefecture();

        $this->load->view('templates/header');
        $this->load->view('forwarder/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['forwarder'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit forwarder' : 'forwarder';
            $data['forwarder']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('forwarder/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->forwarder_mod->save($data['forwarder']);

        redirect('forwarder');
    }

    public function delete($id)
    {
        $this->forwarder_mod->delete($id);
        redirect('forwarder');
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

}
