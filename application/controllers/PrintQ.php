<?php

class printq extends CI_Controller
{


    public function add()
    {
        $data['printq']['typeid'] = 1;
        $data['printq']['referenceid'] = $this->input->post('refid');


        return  $this->print_mod->add( $data['printq']);

        if ($this->print_mod->add($data)){
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');

        };

    }

    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->print_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Print Queue';
        $printlist= $this->print_mod->get_printq(0);
        $line=0;
        if ($printlist !== null){

        foreach ($printlist as $list):

         if ($list['typeid']==1){ //SALES

             $saleid= $list['referenceid'];
                $sale= $this->sale_mod->get_sale_by_id($saleid);
             $printq[$line] = array(
                'type' => 'Sales',
                 'refno' => $saleid,
             );
         }else{
             $invoiceid= $list['referenceid'];
                $invoice = $this->invoice_mod->get_invoice_by_id($invoiceid);
             $printq[$line] = array(
                'type' => 'Invoice',
                 'refno' => $invoiceid,

            );

         };
         $line++;
        endforeach;
        $data['printq']=$printq;
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('printq/index', $data);
        $this->load->view('templates/footer');
        }
    }




    public function delete($id,$firmid,$printqtype)
    {
        if ($this->printq_mod->delete($id)) {
            $this->session->set_flashdata('success', 'Record deleted!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete record!');
        }
         redirect('printq/'.$firmid.'/'.$printqtype);
    }

    private function get_postdata($id)
    {
        return array(
            'id' => $id,
            'firmid' => $this->input->post('firmid'),
            'printqclassid' => $this->input->post('printqclassid'),
            'prefectureid' => $this->input->post('prefectureid'),
            'printqtype' => $this->input->post('printqtype') ?: null,
            'printqno' => $this->input->post('printqno') ?: null,
            'dateexpire' => $this->date_utility->format_date($this->input->post('dateexpire'), 'Y-m-d') ?: null,
            'isactive' => 1,
        );
    }




}
