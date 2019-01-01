<?php

class contractor extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Contractors';
        $data['contractor'] = $this->contractor_mod->get_contractor();

        $this->load->view('templates/header');
        $this->load->view('contractor/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {

        $data['title'] = 'Contractor';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture();


        $this->load->view('templates/header');
        $this->load->view('contractor/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit contractor';
        $data['contractor'] = $this->contractor_mod->get_contractor($id);

        if (empty ($data['contractor'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('contractor/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['contractor'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset ($id)? 'Edit contractor': 'contractor';
            $data['contractor']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('contractor/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->contractor_mod->save($data['contractor']);

        redirect('contractor');
    }

    public function delete($id)
    {
        $this->contractor_mod->delete($id);
        redirect('contractor');
    }


 }
