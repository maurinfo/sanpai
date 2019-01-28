<?php

class permit extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->permit_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Permit';
        $data['firmid'] = $this->uri->segment(2);
        $data['permittype'] = $this->uri->segment(3);
        $data['permit'] = $this->permit_mod->get_permits($this->uri->segment(2),$this->uri->segment(3));

        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('permit/index', $data);
        $this->load->view('templates/footer');
    }

    public function create($firmid,$permittype)
    {
        $data['title'] = 'Permit';
        $data['firmid'] = $firmid;
        $data['permittype'] = $permittype;
        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();

        $this->load->view('templates/header');
        $this->load->view('permit/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Permit';
        $data['permit'] = $this->permit_mod->get_permit_by_id($id);

        if (empty($data['permit'])) {
            show_404();
        }

        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $this->load->view('templates/header');
        $this->load->view('permit/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['permit'] = $this->get_postdata($id);
        $firmid = $data['permit']['firmid'];
        $permittype= $data['permit']['permittype'];
       $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit permit' : 'Permit';
            $data['prefectures'] = $this->prefecture_mod->get_prefecture();
            $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();

            $this->load->view('templates/header');
            $this->load->view('permit/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->permit_mod->save($data['permit'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('permit/'.$firmid.'/'.$permittype);
    }

    public function delete($id,$firmid,$permittype)
    {
        if ($this->permit_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
         redirect('permit/'.$firmid.'/'.$permittype);
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'firmid' => $this->input->post('firmid'),
            'permitclassid' => $this->input->post('permitclassid'),
            'prefectureid' => $this->input->post('prefectureid'),
            'permittype' => $this->input->post('permittype') ?: null,
            'permitno' => $this->input->post('permitno') ?: null,
            'dateexpire' => $this->date_utility->format_date($this->input->post('dateexpire'), 'Y-m-d') ?: null,
            'isactive' => 1,
        );
    }

    private function get_rules()
    {
        return array(

            array(
                'field' => 'prefectureid',
                'label' => 'Prefecture',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'permittype',
                'label' => 'Permit Class',
                'rules' => 'numeric',
            ),
            array(
                'field' => 'permitno',
                'label' => 'Permit No',
                'rules' => 'max_length[255]',
            ),

            array(
                'field' => 'dateexpire',
                'label' => 'Expiry Date',
                'rules' => 'trim|valid_date[m/d/Y]',
            ),
        );
    }

}
