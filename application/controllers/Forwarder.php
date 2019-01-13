<?php

class forwarder extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->forwarder_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Forwarder';
        $data['forwarder'] = $this->forwarder_mod->get_forwarder($this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('forwarder/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {

        $data['title'] = 'forwarder';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture(); //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('forwarder/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Forwarder';
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
            $data['title'] = isset ($id)? 'Edit Forwarder': 'forwarder';
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
