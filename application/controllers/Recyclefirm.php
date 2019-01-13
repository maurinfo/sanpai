<?php

class recyclefirm extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->recyclefirm_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'recyclefirm';
        $data['recyclefirm'] = $this->recyclefirm_mod->get_recyclefirm($this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('recyclefirm/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {

        $data['title'] = 'recyclefirm';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture(); //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('recyclefirm/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit recyclefirm';
        $data['recyclefirm'] = $this->recyclefirm_mod->get_recyclefirm($id);

        if (empty ($data['recyclefirm'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('recyclefirm/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['recyclefirm'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset ($id)? 'Edit recyclefirm': 'recyclefirm';
            $data['recyclefirm']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('recyclefirm/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->recyclefirm_mod->save($data['recyclefirm']);

        redirect('recyclefirm');
    }

    public function delete($id)
    {
        $this->recyclefirm_mod->delete($id);
        redirect('recyclefirm');
    }


 }
