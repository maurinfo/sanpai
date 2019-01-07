<?php

class recyclefirm extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Recycle Firm';
        $data['recyclefirm'] = $this->recyclefirm_mod->get_recyclefirm();

        $this->load->view('templates/header');
        $this->load->view('recyclefirm/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {

        $data['title'] = 'Recycle Firm';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture(); //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('recyclefirm/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Recyclefirm';
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
