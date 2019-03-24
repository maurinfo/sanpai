<?php

class receipt extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->receipt_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);

        $data['receipt'] = $this->receipt_mod->get_receipts($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('receipt/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $this->load->view('templates/header');
        $this->load->view('receipt/editor', $data);
        $this->load->view('receipt/customersearchmodal');
        $this->load->view('templates/footer');

    }
    public function update($id)
    {

        $data['title'] = 'Update';
        $data['receipt'] = $this->receipt_mod->get_receipt_by_id($id);



        if (empty($data['receipt'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('receipt/editor', $data);
         $this->load->view('receipt/customersearchmodal');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['receipt'] = $this->get_postdata($id);
        print_r($data['receipt']);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['receipt']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('receipt/editor', $data);
            $this->load->view('receipt/customersearchmodal');
            $this->load->view('templates/footer');
            return;
        }

        if ($this->receipt_mod->save($data['receipt'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('receipt');
    }

    private function get_postdata($id)
    {
        if ($id == null) {
                $refno = $this->receipt_mod->generate_referenceno();
            }else{
                $refno = $this->input->post('referenceno');
        };

        return array(
            'id' => $id,
            'referenceno' =>  $refno,
            'customerid' => $this->input->post('customerid'),
            'datereceipt' => $this->date_utility->format_date($this->input->post('datereceipt'),'Y-m-d'),
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

    public function getCustomerPrevAmountDue()
    {
        $firmid = $this->input->post('firmid');
        $datefrom = $this->date_utility->format_date($this->input->post('datefrom'));
        $dateend = $this->date_utility->format_date($this->input->post('dateend'));

        $prevdue =($this->accountledger_mod->getCustomerPrevAmountDue($firmid,$datefrom, $dateend));
        echo $prevdue;

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
        $this->receipt_mod->delete($id);
        redirect('receipt');
    }

    public function getNextreceiptDate()
    {

        $firmid = $this->input->post('firmid');
        $nextdatestart = $this->receipt_mod->getNextreceiptDate($firmid);
    print_r ($nextdatestart);

    }


    private function get_rules()
    {
         return array(
            array(
                'field' => 'customername',
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
