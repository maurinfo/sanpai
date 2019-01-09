<?php

class manifest extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Recycle Firm';
        $data['manifest'] = $this->manifest_mod->get_manifest();

        $this->load->view('templates/header');
        $this->load->view('manifest/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {

        $data['title'] = 'Manifest';
        $data['prefecture'] = $this->prefecture_mod->get_prefecture(); //for prefecture list


        $this->load->view('templates/header');
        $this->load->view('manifest/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Manifest';
        $data['manifest'] = $this->manifest_mod->get_manifest($id);

        if (empty ($data['manifest'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('manifest/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['manifest'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset ($id)? 'Edit manifest': 'manifest';
            $data['manifest']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('manifest/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->manifest_mod->save($data['manifest']);

        redirect('manifest');
    }

    public function delete($id)
    {
        $this->manifest_mod->delete($id);
        redirect('manifest');
    }


 }
