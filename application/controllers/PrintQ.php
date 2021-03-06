<?php

class printq extends CI_Controller
{


    public function add()
    {
        $data['printq']['typeid'] =  $this->input->post('typeid');
        $data['printq']['referenceid'] = $this->input->post('refid');


        return  $this->print_mod->add( $data['printq']);

        if ($this->print_mod->add($data)){
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');

        };

    }
    public function printAll(){
       // $this->load->library('../controllers/salepdf');
        $printlist= $this->print_mod->get_printq(0);
        $line=0;

        foreach ($printlist as $list):
            $printq[$line] = $list['referenceid'];

            $line++;
        endforeach;

        $this->PDF->create_pdf($printq);


    }

    public function clearAll(){
       // $this->load->library('../controllers/salepdf');
        $this->print_mod->clear_all(0);
        $data['printq']= $this->print_mod->get_printq(0);
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('printq/index', $data);
        $this->load->view('templates/footer');

    }
     public function getCount(){

         $count = $this->print_mod->get_total_record_count();

         print_r ($count);

     }


    public function index()
    {
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config['total_rows'] = $this->print_mod->get_total_record_count();

        $this->pagination->initialize($pagination_config);

        $data['title'] = 'Print Queue';
        if ($this->print_mod->get_total_record_count() != 0) {
        $printlist= $this->print_mod->get_printq(0);
        $line=0;



        foreach ($printlist as $list):

         if ($list['typeid']==1){ //SALES

             $saleid= $list['referenceid'];
                $sale= $this->sale_mod->get_sale_by_id($saleid);
             $printq[$line] = array(
                'type' => 'Sales',
                 'date' => $sale['datedelivered'],
                 'refno' => $sale['referenceno'],
                 'customer' => $sale['name'],
                 'total' => $sale['total'],

             );
         }else{
             $invoiceid= $list['referenceid'];
                $invoice = $this->invoice_mod->get_invoice_by_id($invoiceid);
           //  print_r ($invoice);
             $printq[$line] = array(
                 'type' => 'Invoice',
                 'date' => $invoice['dateend'],
                 'refno' => $invoice['referenceno'],
                 'customer' => $invoice['name'],
                 'total' => $invoice['total'],

            );

         };
         $line++;
        endforeach;
            $data['printq'] = $printq;

        }else{
            $data['printq'] = $this->print_mod->get_printq(0);

        }
            $this->load->view('templates/header');
            $this->load->view('templates/deleterecord');
            $this->load->view('templates/alerts');
            $this->load->view('printq/index', $data);
            $this->load->view('templates/footer');
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
