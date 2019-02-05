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

        $this->load->view('templates/header');
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

        if (empty($data['manifest'])) {
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
            $data['title'] = isset($id) ? 'Edit manifest' : 'manifest';
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
