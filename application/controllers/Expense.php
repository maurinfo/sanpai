<?php

class expense extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->expense_mod->get_total_record_count($searchString);

        $this->pagination->initialize($pagination_config);
        $data['expense'] = $this->expense_mod->get_expenses($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('expense/index', $data);
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
        $this->load->view('expense/editor', $data);
  //      $this->load->view('expense/modalContractor');
    //    $this->load->view('expense/modalContractorBranch');
    //    $this->load->view('expense/modalForwarder');
    //    $this->load->view('expense/modalForwarder2');
    //    $this->load->view('expense/modalForwarder3');
    //    $this->load->view('expense/modalRecycleFirm');
     //   $this->load->view('expense/modalPermit1');
       // $this->load->view('expense/modalPermit2');
    //    $this->load->view('expense/modalPermit3');
    //    $this->load->view('expense/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['expense'] = $this->expense_mod->get_expense_by_id($id);
        $data['expense']['1forwarder'] =  $this->forwarder_mod->get_forwardername($data['expense']['1forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['expense']['1forwardpermitid']);
        $data['expense']['1forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];
        $data['expense']['2forwarder'] =  $this->forwarder_mod->get_forwardername($data['expense']['2forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['expense']['2forwardpermitid']);
        $data['expense']['2forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];


        $data['expense']['3forwarder'] =  $this->forwarder_mod->get_forwardername($data['expense']['3forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['expense']['3forwardpermitid']);
        $data['expense']['3forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

        $data['expense']['recyclefirm'] =  $this->forwarder_mod->get_forwardername($data['expense']['recyclefirmid']);
        $permit= $this->permit_mod->get_permit_by_id($data['expense']['recyclepermitid']);
        $data['expense']['recyclepermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

//        $data['expense']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['expense']['contractorbranchid']);
//        $data['expense']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['expense']['contractorbranchid']);


//        $data['expense']['permitclass'] = $this->permitclass_mod->get_permitclassname($data['expense']['permitclassid']);
//        $data['expense']['wasteclass'] = $this->wasteclass_mod->get_wasteclassname($data['expense']['wasteclassid']);
//        $data['expense']['item'] =  $this->item_mod->get_itemname($data['expense']['itemid']);
//        $data['expense']['itemunit'] = $this->itemunit_mod->get_itemunitname($data['expense']['itemunitid']);
//        $data['expense']['disposalmethod'] = $this->disposalmethod_mod->get_disposalmethodname($data['expense']['disposalmethodid']);
//        $data['expense']['employee'] =  $this->employee_mod->get_employeename($data['expense']['employeeid']);

        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
        $data['items'] = $this->item_mod->get_items();
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
        $data['employees'] = $this->employee_mod->get_employees();


        if (empty($data['expense'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('expense/editor', $data);
        $this->load->view('expense/modalContractor');
        $this->load->view('expense/modalContractorBranch');
        $this->load->view('expense/modalForwarder');
        $this->load->view('expense/modalForwarder2');
        $this->load->view('expense/modalForwarder3');
        $this->load->view('expense/modalRecycleFirm');
        $this->load->view('expense/modalPermit1');
        $this->load->view('expense/modalPermit2');
        $this->load->view('expense/modalPermit3');
        $this->load->view('expense/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['expense'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit expense' : 'expense';
            $data['expense']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('expense/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->expense_mod->save($data['expense'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('expense');
    }


    public function delete($id)
    {
        $this->expense_mod->delete($id);
        redirect('expense');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'referenceno' => $this->input->post('referenceno'),
            'dateexpense' => $this->date_utility->format_date($this->input->post('dateexpense'), 'Y-m-d') ?: null,
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
