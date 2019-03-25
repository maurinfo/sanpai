<?php

class payment extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->payment_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);

        $data['payment'] = $this->payment_mod->get_payments($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('payment/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $this->load->view('templates/header');
        $this->load->view('payment/editor', $data);
        $this->load->view('payment/suppliersearchmodal');
        $this->load->view('templates/footer');

    }
    public function update($id)
    {

        $data['title'] = 'Update';
        $data['payment'] = $this->payment_mod->get_payment_by_id($id);



        if (empty($data['payment'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('payment/editor', $data);
        $this->load->view('payment/suppliersearchmodal');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['payment'] = $this->get_postdata($id);
        $data['payment']['id'] = $id;
      //  print_r($data['payment']);
     //   $this->form_validation->set_rules($this->get_rules());
//
//        if (!$this->form_validation->run()) {
//
//            echo 'hello';
//            $data['title'] = isset($id) ? 'Update' : 'Create';
//            $data['payment']['id'] = $id;
//            $this->load->view('templates/header');
//            $this->load->view('payment/editor', $data);
//            $this->load->view('payment/suppliersearchmodal');
//            $this->load->view('templates/footer');
//            return;
//        }

        if ($this->payment_mod->save($data['payment'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('payment');
    }

    private function get_postdata($id)
    {
        if ($id == null) {
                $refno = $this->payment_mod->generate_referenceno();
            }else{
                $refno = $this->input->post('referenceno');
        };

        return array(
            'id' => $id,
            'referenceno' =>  $refno,
            'supplierid' => $this->input->post('supplierid'),
            'datepayment' => $this->date_utility->format_date($this->input->post('datepayment'),'Y-m-d'),
            'amount0' => $this->input->post('amount0') ?: null,
            'amount1' => $this->input->post('amount1') ?: null,
            'amount2' => $this->input->post('amount2') ?: null,
            'amount3' => $this->input->post('amount3') ?: null,
            'amount4' => $this->input->post('amount4') ?: null,
            'amount5' => $this->input->post('amount5') ?: null,
            'total' => $this->input->post('total') ?: null,
            'isactive'=> 1,
        );

    }

    public function getsupplierPrevAmountDue()
    {
        $firmid = $this->input->post('firmid');
        $datefrom = $this->date_utility->format_date($this->input->post('datefrom'));
        $dateend = $this->date_utility->format_date($this->input->post('dateend'));

        $prevdue =($this->accountledger_mod->getsupplierPrevAmountDue($firmid,$datefrom, $dateend));
        echo $prevdue;

    }

    public  function fetchLedgers(){  //株式会社　竹中工務店

        $cusid = $this->input->post('cusID');
        $datestart = $this->date_utility->format_date($this->input->post('datestart'));
        $dateend   = $this->date_utility->format_date($this->input->post('dateend'));
        $line = 0;
        $acctledgers = $this->accountledger_mod->get_supplieraccountledgers($cusid,$datestart,$dateend);
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

            }else{  //paymentS
                $paymentid= $acctledger['referenceid'];
                $payment= $this->payment_mod->get_payment_by_id($paymentid);

                if ($payment['amount0']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>  '（入金）現金',
                           'amount' => floor($payment['amount0'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'payment',
                           'item_name' =>  '（入金）現金',
                           'amount' => floor($payment['amount0'])
                          );
                    }

                    $line = $line+1;

                };
               if ($payment['amount1']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>  '（入金）小切手',
                           'amount' => floor($payment['amount1'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'payment',
                           'item_name' =>  '（入金）小切手',
                           'amount' => floor($payment['amount1'])
                          );
                    }

                    $line = $line+1;

                };

                if ($payment['amount2']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                            'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>  '（入金）手形',
                           'amount' => floor($payment['amount2'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'payment',
                           'item_name' =>  '（入金）手形',
                           'amount' => floor($payment['amount2'])
                          );
                    }

                    $line = $line+1;

                };

                if ($payment['amount3']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>  '（入金）相殺',
                           'amount' => floor($payment['amount3'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'payment',
                           'item_name' =>  '（入金）相殺',
                           'amount' => floor($payment['amount3'])
                          ) ;
                    }

                    $line = $line+1;

                };
                if ($payment['amount4']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>   '（入金）口座',
                           'amount' => floor($payment['amount4'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'payment',
                           'item_name' =>   '（入金）口座',
                           'amount' => floor($payment['amount4'])
                          ) ;
                    }

                    $line = $line+1;


                };
                if ($payment['amount5']<> 0){

                    if ( $recno==0 ){

                      $response[$line] = array(
                           'type' => 'payment',
                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>   '（入金）手数料',
                           'amount' => floor($payment['amount5'])
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                             'type' => 'payment',
                           'item_name' =>   '（入金）手数料',
                           'amount' => floor($payment['amount5'])
                          ) ;
                    }

                    $line = $line+1;


                };


                if ($payment['note']<>'' ){
                    if ( $recno==0 ){

                      $response[$line] = array(

                           'date' =>  $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                           'refno' => sprintf("%'.06d", $payment['id']),
                           'item_name' =>   '備考欄：'. $payment['note'],
                          'amount' =>''
                          );
                          $recno=1;
                    }else{
                        $response[$line] = array(
                            'item_name' =>   '備考欄：'. $payment['note'],
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
        $this->payment_mod->delete($id);
        redirect('payment');
    }

    public function getNextpaymentDate()
    {

        $firmid = $this->input->post('firmid');
        $nextdatestart = $this->payment_mod->getNextpaymentDate($firmid);
    print_r ($nextdatestart);

    }


    private function get_rules()
    {
//         return array(
//            array(
//                'field' => 'suppliername',
//                'label' => 'Name',
//                'rules' => 'required|max_length[100]',
//            ),
//            array(
//                'field' => 'yomi',
//                'label' => 'Furigna Name',
//                'rules' => 'max_length[100]',
//            ),
//            array(
//                'field' => 'contactperson',
//                'label' => 'Contact Person',
//                'rules' => 'max_length[100]',
//            ),
//            array(
//                'field' => 'department',
//                'label' => 'Department',
//                'rules' => 'max_length[255]',
//            ),
//            array(
//                'field' => 'zip',
//                'label' => 'Zip Code',
//                'rules' => 'max_length[8]',
//            ),
//            array(
//                'field' => 'prefectureid',
//                'label' => 'Prefecture',
//                'rules' => 'numeric',
//            ),
//            array(
//                'field' => 'address2',
//                'label' => 'Address 1',
//                'rules' => 'max_length[255]',
//            ),
//            array(
//                'field' => 'address2',
//                'label' => 'Address 2',
//                'rules' => 'max_length[255]',
//            ),
//            array(
//                'field' => 'address2',
//                'label' => 'Address 2',
//                'rules' => 'max_length[255]',
//            ),
//            array(
//                'field' => 'email',
//                'label' => 'E-Mail',
//                'rules' => 'trim|valid_email',
//            ),
//            array(
//                'field' => 'notes',
//                'label' => 'Notes',
//                'rules' => 'max_length[255]',
//            ),
//
//        );

    }
}
