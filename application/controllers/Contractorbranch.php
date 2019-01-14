<?php

class contractorbranch extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->contractorbranch_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Recycle Firm';
        $data['contractorbranch'] = $this->contractorbranch_mod->get_contractorbranch($this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('contractorbranch/index', $data);
        $this->load->view('templates/footer');
    }


    public function create()
    {

        $data['title'] = 'Contractor Branch';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture();
        //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('contractorbranch/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Contractor Branch';
        $data['contractorbranch'] = $this->contractorbranch_mod->get_contractorbranch($id);

        if (empty ($data['contractorbranch'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('contractorbranch/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['contractorbranch'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset ($id)? 'Edit contractorbranch': 'contractorbranch';
            $data['contractorbranch']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('contractorbranch/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->contractorbranch_mod->save($data['contractorbranch']);

        redirect('contractorbranch');
    }

    public function delete($id)
    {
        $this->contractorbranch_mod->delete($id);
        redirect('contractorbranch');
    }


 }
