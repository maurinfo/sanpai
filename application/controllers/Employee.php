<?php

class employee extends CI_Controller
{

    public function index()
    {

        $data['title'] = 'Employees';
        $data['employee'] = $this->employee_mod->get_employee();

        $this->load->view('templates/header');
        $this->load->view('employee/index', $data);
        $this->load->view('templates/footer');

    }

    public function create()
    {

        $data['title'] = 'Employee';

        $this->load->view('templates/header');
        $this->load->view('employee/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Edit Employee';
        $data['employee'] = $this->employee_mod->get_employee($id);

        if (empty($data['employee'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('employee/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['employee'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit Employee' : 'Employee';
            $data['employee']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('employee/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        $this->employee_mod->save($data['employee']);

        redirect('employee');
    }

    public function delete($id)
    {
        $this->employee_mod->delete($id);
        redirect('employee');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'name' => $this->input->post('name'),
            'furigana' => $this->input->post('furigana'),
            'birthdate' => $this->date_utility->format_date($this->input->post('birthdate'), 'Y-m-d'),
            'gender' => $this->input->post('gender'),
            'zip' => $this->input->post('zip'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'telno' => $this->input->post('telno'),
            'email' => $this->input->post('email'),
            'position' => $this->input->post('position'),
            'hiredate' => $this->date_utility->format_date($this->input->post('hiredate'), 'Y-m-d'),
            'schedulein' => $this->input->post('schedulein'),
            'scheduleout' => $this->input->post('scheduleout'),
            'resigndate' => $this->date_utility->format_date($this->input->post('resigndate'), 'Y-m-d'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'accesslevel' => $this->input->post('accesslevel'),
        );
    }

    private function get_rules()
    {
        return array(
            array(
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|max_length[50]',
            ),
            array(
                'field' => 'furigana',
                'label' => 'furigana',
                'rules' => 'max_length[50]',
            ),
            array(
                'field' => 'birthdate',
                'label' => 'birthdate',
                'rules' => 'valid_date[m/d/Y]',
            ),
            array(
                'field' => 'hiredate',
                'label' => 'hiredate',
                'rules' => 'required|valid_date[m/d/Y]',
            ),
            array(
                'field' => 'resigndate',
                'label' => 'resigndate',
                'rules' => 'valid_date[m/d/Y]',
            ),
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'valid_email',
            ),
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|max_length[50]',
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|max_length[50]',
            ),
        );
    }
}
