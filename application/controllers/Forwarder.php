<?php

class forwarder extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'forwarders';
        $data['forwarder'] = $this->forwarder_mod->get_forwarder();

        $this->load->view('templates/header');
        $this->load->view('forwarder/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {

        $data['title'] = 'Forwarder';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture(); //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('forwarder/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit forwarder';
        $data['forwarder'] = $this->forwarder_mod->get_forwarder($id);

        if (empty ($data['forwarder'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('forwarder/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['forwarder'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset ($id)? 'Edit forwarder': 'forwarder';
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


 }
