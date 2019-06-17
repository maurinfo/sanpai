<?php

class customer extends CI_Controller
{

   public function index()
    {
         $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->customer_mod->get_total_record_count($searchString);
        $pagination_config["reuse_query_string"] = true;
        $this->pagination->initialize($pagination_config);

        $data['title'] = 'customers';
        $data['customer'] = $this->customer_mod->get_customers($searchString, $this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer');
    }


    public function create()
    {
        $data['title'] = 'Create';
        $data['prefectures'] = $this->prefecture_mod->get_prefecture();
        $this->load->view('templates/header');
        $this->load->view('customer/editor', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['customer'] = $this->customer_mod->get_customer_by_id($id);

        if (empty($data['customer'])) {
            show_404();
        }

        $data['prefectures'] = $this->prefecture_mod->get_prefecture();

        $this->load->view('templates/header');
        $this->load->view('customer/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['customer'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['customer']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('customer/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->customer_mod->save($data['customer'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('customer');
    }

    public function delete($id)
    {
        if ($this->customer_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
        redirect('customer');
    }

       public function getAccountSettings($id)
    {

    }


    private function get_postdata($id)
    {
        if ($id == null) {
                $code = sprintf('C%04d', $this->customer_mod->get_lastid()+1);
            }else{
                $code = $this->input->post('code');
        };

        return array(
            'id' => $id,
            'code' => $code,
            'name' => $this->input->post('name'),
            'yomi' => $this->input->post('yomi') ?: null,
            'contactperson' => $this->input->post('contactperson') ?: null,
            'department' => $this->input->post('department') ?: null,
            'zip' => $this->input->post('zip') ?: null,
            'address1' => $this->input->post('address1') ?: null,
            'address2' => $this->input->post('address2') ?: null,
            'telno' => $this->input->post('telno') ?: null,
            'faxno' => $this->input->post('faxno') ?: null,
            'email' => $this->input->post('email') ?: null,
            'notes' => $this->input->post('notes') ?: null,
            'taxinclusive' => $this->input->post('taxinclusive') ?: null,
            'roundofftypeid' => $this->input->post('roundofftypeid') ?: null,
            'termid' => $this->input->post('termid') ?: null,
            'paymethodid' => $this->input->post('paymethodid') ?: null,
            'cutoffdate' => $this->input->post('cutoffdate') ?: null,
            'collectdate' => $this->input->post('collectdate') ?: null,
            'reportvisibility' => $this->input->post('reportvisibility') ?: 0,
            'isactive'=> 1,


        );
    }

    public function fetch()
    {
        $txttosearch = $this->input->post('query');

        if ($txttosearch == null) {
            return;
        }

        $response = $this->customer_mod->fetch_data($txttosearch);

        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
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
            array(
                'field' => 'contractdate',
                'label' => 'Contract Date',
                'rules' => 'trim|valid_date[m/d/Y]',
            ),
        );
    }

}
