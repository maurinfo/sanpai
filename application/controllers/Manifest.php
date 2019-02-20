<?php

class manifest extends CI_Controller
{

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->manifest_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Recycle Firm';
        $data['manifest'] = $this->manifest_mod->get_manifest($this->uri->segment(2));
    //    $data['manifest']['mergedname'] =  word_limiter(($data['manifest']['contractor'] . '   ' . $data['manifest']['contractorbranch']),200);

        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('manifest/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {

        $data['title'] = 'Create';
        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
        $data['items'] = $this->item_mod->get_items();
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
        $data['employees'] = $this->employee_mod->get_employees();
        $modaldata['modaltitle'] = 'Contractor Search';
        $modaldata['searchplaceholder'] = 'Contractor';
        $this->load->view('templates/header');
        $this->load->view('manifest/editor', $data);
        $this->load->view('manifest/modalContractor');
        $this->load->view('manifest/modalContractorBranch');
        $this->load->view('manifest/modalForwarder');
        $this->load->view('manifest/modalForwarder2');
        $this->load->view('manifest/modalForwarder3');
        $this->load->view('manifest/modalRecycleFirm');
        $this->load->view('manifest/modalPermit1');
        $this->load->view('manifest/modalPermit2');
        $this->load->view('manifest/modalPermit3');
        $this->load->view('manifest/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function update($id)
    {

        $data['title'] = 'Update';
        $data['manifest'] = $this->manifest_mod->get_manifest_by_id($id);

        $data['manifest']['1forwarder'] =  $this->forwarder_mod->get_forwardername($data['manifest']['1forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['manifest']['1forwardpermitid']);
        $data['manifest']['1forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];
        $data['manifest']['2forwarder'] =  $this->forwarder_mod->get_forwardername($data['manifest']['2forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['manifest']['2forwardpermitid']);
        $data['manifest']['2forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];


        $data['manifest']['3forwarder'] =  $this->forwarder_mod->get_forwardername($data['manifest']['3forwarderid']);
        $permit= $this->permit_mod->get_permit_by_id($data['manifest']['3forwardpermitid']);
        $data['manifest']['3forwardpermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

        $data['manifest']['recyclefirm'] =  $this->forwarder_mod->get_forwardername($data['manifest']['recyclefirmid']);
        $permit= $this->permit_mod->get_permit_by_id($data['manifest']['recyclepermitid']);
        $data['manifest']['recyclepermit'] = $permit['prefecture'].'  '.$permit['permitclass'].'  '.$permit['permitno'];

//        $data['manifest']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['manifest']['contractorbranchid']);
//        $data['manifest']['contractorbranch'] =  $this->contractorbranch_mod->get_contractorbranchname($data['manifest']['contractorbranchid']);


//        $data['manifest']['permitclass'] = $this->permitclass_mod->get_permitclassname($data['manifest']['permitclassid']);
//        $data['manifest']['wasteclass'] = $this->wasteclass_mod->get_wasteclassname($data['manifest']['wasteclassid']);
//        $data['manifest']['item'] =  $this->item_mod->get_itemname($data['manifest']['itemid']);
//        $data['manifest']['itemunit'] = $this->itemunit_mod->get_itemunitname($data['manifest']['itemunitid']);
//        $data['manifest']['disposalmethod'] = $this->disposalmethod_mod->get_disposalmethodname($data['manifest']['disposalmethodid']);
//        $data['manifest']['employee'] =  $this->employee_mod->get_employeename($data['manifest']['employeeid']);

        $data['permitclasses'] = $this->permitclass_mod->get_permitclasses();
        $data['wasteclasses'] = $this->wasteclass_mod->get_wasteclasses();
        $data['items'] = $this->item_mod->get_items();
        $data['itemunits'] = $this->itemunit_mod->get_itemunits();
        $data['disposalmethods'] = $this->disposalmethod_mod->get_disposalmethods();
        $data['employees'] = $this->employee_mod->get_employees();


        if (empty($data['manifest'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('manifest/editor', $data);
        $this->load->view('manifest/modalContractor');
        $this->load->view('manifest/modalContractorBranch');
        $this->load->view('manifest/modalForwarder');
        $this->load->view('manifest/modalForwarder2');
        $this->load->view('manifest/modalForwarder3');
        $this->load->view('manifest/modalRecycleFirm');
        $this->load->view('manifest/modalPermit1');
        $this->load->view('manifest/modalPermit2');
        $this->load->view('manifest/modalPermit3');
        $this->load->view('manifest/modalPermit4');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {

        $data['manifest'] = $this->get_postdata($id);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Edit manifest' : 'manifest';
            $data['manifest']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('manifest/editor', $data);
            $this->load->view('templates/footer');
            return;
        }

        if ($this->manifest_mod->save($data['manifest'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('manifest');
    }


    public function delete($id)
    {
        $this->manifest_mod->delete($id);
        redirect('manifest');
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'referenceno' => $this->input->post('referenceno'),
            'datemanifest' => $this->date_utility->format_date($this->input->post('datemanifest'), 'Y-m-d') ?: null,
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
