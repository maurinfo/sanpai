<?php

class printq extends CI_Controller
{


    public function add()
    {
        $data['printq']['typeid'] = 1;
        $data['printq']['refid'] = $this->input->post('refid');


        return  $this->print_mod->add( $data['printq']);

        if ($this->print_mod->add($data)){
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');

    };

    }
}
