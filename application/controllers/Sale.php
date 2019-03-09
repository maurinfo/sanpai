<?php

class sale extends CI_Controller
{

    public function index()
    {
  
       // important get_total_record_count($searchString)
       // important get_sales($searchString, $this->uri->segment(2));
          
          $searchString = $this->input->get("search_text");
          $pagination_config = $this->pagination_utility->get_config($this);
          $pagination_config["reuse_query_string"] = true;
          $pagination_config['total_rows'] = $this->sale_mod->get_total_record_count($searchString);
          $this->pagination->initialize($pagination_config);
          $data['title'] = 'Recycle Firm';
          $data['sale'] = $this->sale_mod->get_sales($searchString, $this->uri->segment(2));
          $this->load->view('templates/header');
          $this->load->view('templates/deleterecord');
          $this->load->view('templates/alerts');
          $this->load->view('sale/index', $data);
          $this->load->view('templates/footer');
  
     }

    public function create()
    {
        $data['title'] = 'Create';
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['taxrate'] = $this->taxrate_mod->get_taxrates()[0]['rate'];

        $this->load->view('templates/header');
        $this->load->view('sale/editor', $data);
        $this->load->view('sale/customersearchmodal');
        $this->load->view('sale/additemmodal');
        $this->load->view('sale/manifestsearchmodal');
        $this->load->view('sale/wastesearchmodal');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['sale'] = $this->sale_mod->get_sale_by_id($id);
        $data['sale']['1forwarder'] = $this->forwarder_mod->get_forwardername($data['sale']['1forwarderid']);
        $permit = $this->permit_mod->get_permit_by_id($data['sale']['1forwardpermitid']);
        $data['sale']['1forwardpermit'] = $permit['prefecture'] . '  ' . $permit['permitclass'] . '  ' . $permit['permitno'];
        $data['sale']['2forwarder'] = $this->forwarder_mod->get_forwardername($data['sale']['2forwarderid']);
        $permit = $this->permit_mod->get_permit_by_id($data['sale']['2forwardpermitid']);
        $data['sale']['2forwardpermit'] = $permit['prefecture'] . '  ' . $permit['permitclass'] . '  ' . $permit['permitno'];

        $data['sale']['3forwarder'] = $this->forwarder_mod->get_forwardername($data['sale']['3forwarderid']);
        $permit = $this->permit_mod->get_permit_by_id($data['sale']['3forwardpermitid']);
        $data['sale']['3forwardpermit'] = $permit['prefecture'] . '  ' . $permit['permitclass'] . '  ' . $permit['permitno'];

        $data['sale']['recyclefirm'] = $this->forwarder_mod->get_forwardername($data['sale']['recyclefirmid']);
        $permit = $this->permit_mod->get_permit_by_id($data['sale']['recyclepermitid']);
        $data['sale']['recyclepermit'] = $permit['prefecture'] . '  ' . $permit['permitclass'] . '  ' . $permit['permitno'];

        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
        $data['items'] = $this->item_mod->get_items();
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
        $data['employees'] = $this->employee_mod->get_employees();

        if (empty($data['sale'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('sale/editor', $data);
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['sale'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit sale' : 'sale';
            $data['sale']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('sale/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->sale_mod->save($data['sale'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('sale');
    }

    public function delete($id)
    {
        $this->sale_mod->delete($id);
        redirect('sale');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'referenceno' => $this->input->post('referenceno'),
            'datesale' => $this->date_utility->format_date($this->input->post('datesale'), 'Y-m-d') ?: null,
            'incharge' => $this->input->post('incharge') ?: null,
            'contractorid' => $this->input->post('contractorid') ?: null,
            'contractorbranchid' => $this->input->post('contractorbranchid') ?: null,
            'permitclassid' => $this->input->post('permitclassid'),
            'wasteclassid' => $this->input->post('wasteclassid') ?: null,
            'itemid' => $this->input->post('itemid') ?: null,
            'otheritemname' => $this->input->post('otheritemname') ?: null,
            'qty' => number_format($this->input->post('qty'), 2) ?: null,
            'itemunitid' => $this->input->post('itemunitid') ?: null,
            '1forwarderid' => $this->input->post('1forwarderid') ?: null,
            '1forwardpermitid' => $this->input->post('1forwardpermitid') ?: null,
            '1dateforward' => $this->date_utility->format_date($this->input->post('1dateforward'), 'Y-m-d') ?: null,
            '2forwarderid' => $this->input->post('2forwarderid') ?: null,
            '2forwardpermitid' => $this->input->post('2forwardpermitid') ?: null,
            '2dateforward' => $this->date_utility->format_date($this->input->post('2dateforward'), 'Y-m-d') ?: null,
            '3forwarderid' => $this->input->post('3forwarderid') ?: null,
            '3forwardpermitid' => $this->input->post('3forwardpermitid') ?: null,
            '3dateforward' => $this->date_utility->format_date($this->input->post('3dateforward'), 'Y-m-d') ?: null,
            'recyclefirmid' => $this->input->post('recyclefirmid') ?: null,
            'recyclepermitid' => $this->input->post('recyclepermitid') ?: null,
            '1recycledate' => $this->date_utility->format_date($this->input->post('1recycledate'), 'Y-m-d') ?: null,
            '2recycledate' => $this->date_utility->format_date($this->input->post('2recycledate'), 'Y-m-d') ?: null,
            'disposalmethodid' => $this->input->post('disposalmethodid') ?: null,
            'datereceived' => $this->date_utility->format_date($this->input->post('datereceived'), 'Y-m-d') ?: null,
            'receivedbyid' => $this->input->post('receivedbyid') ?: null,
            'datemailed' => $this->date_utility->format_date($this->input->post('datemailed'), 'Y-m-d') ?: null,
            'notes' => $this->input->post('notes') ?: null,

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
