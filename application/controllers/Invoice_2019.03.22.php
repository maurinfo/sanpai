<?php

class invoice extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->invoice_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);

        $data['invoice'] = $this->invoice_mod->get_invoices($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('invoice/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $this->load->view('templates/header');
        $this->load->view('invoice/editor', $data);
        $this->load->view('invoice/customersearchmodal');
        $this->load->view('templates/footer');

    }
    public function update($id)
    {

        $data['title'] = 'Update';
        $data['invoice'] = $this->invoice_mod->get_invoice_by_id($id);



        if (empty($data['invoice'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('invoice/editor', $data);
         $this->load->view('invoice/customersearchmodal');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['invoice'] = $this->get_postdata($id);
        print_r($data['invoice']);
        $this->form_validation->set_rules($this->get_rules());

       /* if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['invoice']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('invoice/editor', $data);
            $this->load->view('templates/footer');
            return;
        }*/



      /*  if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['invoice']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('invoice/editor', $data);
            $this->load->view('templates/footer');
            return;
        }*/
        if ($this->invoice_mod->save($data['invoice'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('invoice');
    }
    public  function fetchLedgers(){  //株式会社　竹中工務店

        $cusid = $this->input->post('cusID');
        $datestart = $this->date_utility->format_date($this->input->post('datestart'));
        $dateend   = $this->date_utility->format_date($this->input->post('dateend'));
        $line = 0;
        $acctledgers = $this->accountledger_mod->get_customeraccountledgers($cusid,$datestart,$dateend);
        $response = null;
        if ($acctledgers !== null){

        foreach ($acctledgers as $acctledger){
            $recno=0;

            if ($acctledger['transactiontypeid']==1){ //SALES

                $saleid= $acctledger['referenceid'];
                $sale= $this->sale_mod->get_sale_by_id($saleid);
                $saledetails=$this->saledetail_mod->get_saledetail_by_saleid($saleid);
                foreach ($saledetails as $saledetail){
                    if ($recno ==0){
                        $response[$line] = array(
                            'type' => 'sale',
                            'date' => $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                            'refno' => sprintf("%'.06d", $saledetail['saleid']),
                            'item_name' =>$saledetail['contractorbranch_name'].' '. $saledetail['item_name'].' '. $saledetail['spec'],
                            'qty' => number_format($saledetail['qty'],2),
                            'item_unit' => $saledetail['itemunit_name'],
                            'price' => floor($saledetail['price']),
                            'amount' => floor($saledetail['amount'])


                        );
                        $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'sale',
                            'item_name' =>$saledetail['contractorbranch_name'].' '. $saledetail['item_name'].' '. $saledetail['spec'],
                            'qty' => number_format($saledetail['qty'],2),
                            'item_unit' => $saledetail['itemunit_name'],
                            'price' => floor($saledetail['price']),
                            'amount' => floor($saledetail['amount'])


                        );

                    }

                    $line = $line+1;

                }

                if ($sale['tax']<>0){
                    $response[$line] = array(
                            'type' => 'tax',
                            'item_name' =>  '消　費　税',
                            'amount' => floor($sale['tax'])
                    );
                    $line = $line+1;
                }
                if ($sale['note']<>''){
                    $response[$line] = array(
                            'item_name' =>  '備考欄：'.$sale['note'],
                            'amount' => ''
                    );

                    $line = $line+1;
                }

             //reset to display date and refno on first line.

            }else{  //RECEIPTS
                $receiptid= $acctledger['referenceid'];
                $receipt= $this->receipt_mod->get_receipt_by_id($receiptid);

                if ($receipt['amount0']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）現金',
                           'amount' => floor($receipt['amount0'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）現金',
                           'amount' => floor($receipt['amount0'])
                          );
                    }

                    $line = $line+1;

                };
               if ($receipt['amount1']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）小切手',
                           'amount' => floor($receipt['amount1'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）小切手',
                           'amount' => floor($receipt['amount1'])
                          );
                    }

                    $line = $line+1;

                };

                if ($receipt['amount2']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                            'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）手形',
                           'amount' => floor($receipt['amount2'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）手形',
                           'amount' => floor($receipt['amount2'])
                          );
                    }

                    $line = $line+1;

                };

                if ($receipt['amount3']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>  '（入金）相殺',
                           'amount' => floor($receipt['amount3'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'receipt',
                           'item_name' =>  '（入金）相殺',
                           'amount' => floor($receipt['amount3'])
                          ) ;
                    }

                    $line = $line+1;

                };
                if ($receipt['amount4']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '（入金）口座',
                           'amount' => floor($receipt['amount4'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'receipt',
                           'item_name' =>   '（入金）口座',
                           'amount' => floor($receipt['amount4'])
                          ) ;
                    }

                    $line = $line+1;


                };
                if ($receipt['amount5']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'receipt',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '（入金）手数料',
                           'amount' => floor($receipt['amount5'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'receipt',
                           'item_name' =>   '（入金）手数料',
                           'amount' => floor($receipt['amount5'])
                          ) ;
                    }

                    $line = $line+1;


                };


                if ($receipt['note']<>'' ){
                    if ( $recno==0 ){

                      $response[$line] = array(

                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $receipt['id']),
                           'item_name' =>   '備考欄：'. $receipt['note'],
                          'amount' =>''
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'item_name' =>   '備考欄：'. $receipt['note'],
                             'amount' =>''
                          )  ;
                    }

                    $line = $line+1;


                };


            }

        }
        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
    }
    public function delete($id)
    {
        $this->invoice_mod->delete($id);
        redirect('invoice');
    }

    private function get_postdata($id)
    {
        if ($id == null) {
                $refno = $this->invoice_mod->generate_referenceno();
            }else{
                $refno = $this->input->post('referenceno');
        };

        return array(
            'id' => $id,
            'referenceno' =>  $refno,
            'customerid' => $this->input->post('customerid'),
            'datestart' => $this->date_utility->format_date($this->input->post('datestart'),'Y-m-d'),
            'dateend' =>  $this->date_utility->format_date($this->input->post('dateend'),'Y-m-d'  ),
            'datedue' =>  $this->date_utility->format_date($this->input->post('datedue'),'Y-m-d' ),
            'showduedate' => $this->input->post('showduedate') ?: null,
            'subtotal' => $this->input->post('subtotal') ?: null,
            'tax' => $this->input->post('tax') ?: null,
            'total' => $this->input->post('total') ?: null,
            'isactive'=> 1,
        );


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

        );

    }
}
