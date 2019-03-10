<?php

class invoice extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->invoice_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);


        $data['invoice'] = $this->invoice_mod->get_invoices($this->uri->segment(2));

        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('invoice/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {

        $data['title'] = 'Create';
   //     $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
   //     $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
  //      $data['items'] = $this->item_mod->get_items();
  //      $data['itemunits'] = $this->itemunit_mod->get_itemunits();
  //      $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
 //       $data['employees'] = $this->employee_mod->get_employees();
   //     $modaldata['modaltitle'] = 'Contractor Search';
   //     $modaldata['searchplaceholder'] = 'Contractor';
        $this->load->view('templates/header');
        $this->load->view('invoice/editor', $data);
  //      $this->load->view('invoice/modalContractor');
    //    $this->load->view('invoice/modalContractorBranch');
    //    $this->load->view('invoice/modalForwarder');
    //    $this->load->view('invoice/modalForwarder2');
    //    $this->load->view('invoice/modalForwarder3');
    //    $this->load->view('invoice/modalRecycleFirm');
     //   $this->load->view('invoice/modalPermit1');
       // $this->load->view('invoice/modalPermit2');
    //    $this->load->view('invoice/modalPermit3');
    //    $this->load->view('invoice/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['invoice'] = $this->invoice_mod->get_invoice_by_id($id);
        $data['invoice']['1forwarder'] =  $this->forwarder_mod->get_forwardername($data['invoice']['1forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['invoice']['1forwardpermitid']);
        $data['invoice']['1forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];
        $data['invoice']['2forwarder'] =  $this->forwarder_mod->get_forwardername($data['invoice']['2forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['invoice']['2forwardpermitid']);
        $data['invoice']['2forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];


        $data['invoice']['3forwarder'] =  $this->forwarder_mod->get_forwardername($data['invoice']['3forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['invoice']['3forwardpermitid']);
        $data['invoice']['3forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

        $data['invoice']['recyclefirm'] =  $this->forwarder_mod->get_forwardername($data['invoice']['recyclefirmid']);
        $permit= $this->permit_mod->get_permit_by_id($data['invoice']['recyclepermitid']);
        $data['invoice']['recyclepermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

//        $data['invoice']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['invoice']['contractorbranchid']);
//        $data['invoice']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['invoice']['contractorbranchid']);


//        $data['invoice']['permitclass'] = $this->permitclass_mod->get_permitclassname($data['invoice']['permitclassid']);
//        $data['invoice']['wasteclass'] = $this->wasteclass_mod->get_wasteclassname($data['invoice']['wasteclassid']);
//        $data['invoice']['item'] =  $this->item_mod->get_itemname($data['invoice']['itemid']);
//        $data['invoice']['itemunit'] = $this->itemunit_mod->get_itemunitname($data['invoice']['itemunitid']);
//        $data['invoice']['disposalmethod'] = $this->disposalmethod_mod->get_disposalmethodname($data['invoice']['disposalmethodid']);
//        $data['invoice']['employee'] =  $this->employee_mod->get_employeename($data['invoice']['employeeid']);

        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
        $data['items'] = $this->item_mod->get_items();
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
        $data['employees'] = $this->employee_mod->get_employees();


        if (empty($data['invoice'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('invoice/editor', $data);
        $this->load->view('invoice/modalContractor');
        $this->load->view('invoice/modalContractorBranch');
        $this->load->view('invoice/modalForwarder');
        $this->load->view('invoice/modalForwarder2');
        $this->load->view('invoice/modalForwarder3');
        $this->load->view('invoice/modalRecycleFirm');
        $this->load->view('invoice/modalPermit1');
        $this->load->view('invoice/modalPermit2');
        $this->load->view('invoice/modalPermit3');
        $this->load->view('invoice/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['invoice'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit invoice' : 'invoice';
            $data['invoice']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('invoice/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->invoice_mod->save($data['invoice'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('invoice');
    }


    public function delete($id)
    {
        $this->invoice_mod->delete($id);
        redirect('invoice');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'referenceno' => $this->input->post('referenceno'),
            'dateinvoice' => $this->date_utility->format_date($this->input->post('dateinvoice'), 'Y-m-d') ?: null,
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
