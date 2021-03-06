<?php

class bill extends CI_Controller
{

    public function index()
    {
        $searchString = $this->input->get("search_text");
        $pagination_config = $this->pagination_utility->get_config($this);
        $pagination_config["reuse_query_string"] = true;
        $pagination_config['total_rows'] = $this->bill_mod->get_total_record_count($searchString);
        $this->pagination->initialize($pagination_config);

        $data['bill'] = $this->bill_mod->get_bills($searchString, $this->uri->segment(2));
        $this->load->view('templates/header');
        $this->load->view('templates/deleterecord');
        $this->load->view('templates/alerts');
        $this->load->view('bill/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Create';
        $this->load->view('templates/header');
        $this->load->view('bill/editor', $data);
        $this->load->view('bill/suppliersearchmodal');
        $this->load->view('templates/footer');

    }
    public function update($id)
    {

        $data['title'] = 'Update';
        $data['bill'] = $this->bill_mod->get_bill_by_id($id);



        if (empty($data['bill'])) {
            show_404();
        }

        $this->load->view('templates/header');
        $this->load->view('bill/editor', $data);
         $this->load->view('bill/suppliersearchmodal');
        $this->load->view('templates/footer');
    }

    public function save($id = null)
    {
        $data['bill'] = $this->get_postdata($id);
        print_r($data['bill']);
        $this->form_validation->set_rules($this->get_rules());

        if (!$this->form_validation->run()) {
            $data['title'] = isset($id) ? 'Update' : 'Create';
            $data['bill']['id'] = $id;
            $this->load->view('templates/header');
            $this->load->view('bill/editor', $data);
            $this->load->view('bill/suppliersearchmodal');
            $this->load->view('templates/footer');
            return;
        }

        if ($this->bill_mod->save($data['bill'])) {
            $this->session->set_flashdata('success', 'Record saved!');
        } else {
            $this->session->set_flashdata('error', 'Failed to save record!');
        }

        redirect('bill');
    }

    private function get_postdata($id)
    {
        if ($id == null) {
                $refno = $this->bill_mod->generate_referenceno();
            }else{
                $refno = $this->input->post('referenceno');
        };

        return array(
            'id' => $id,
            'referenceno' =>  $refno,
            'supplierid' => $this->input->post('supplierid'),
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


    public function getSupplierPrevAmountDue()
    {
        $firmid = $this->input->post('firmid');
        $datefrom = $this->date_utility->format_date($this->input->post('datefrom'));
        $dateend = $this->date_utility->format_date($this->input->post('dateend'));

        $prevdue =($this->accountledger_mod->getSupplierPrevAmountDue($firmid,$datefrom, $dateend));
        echo $prevdue;

    }
    public function fetchbillItems()
    {
        $supid = $this->input->post('supID');

        $datestart = $this->date_utility->format_date($this->input->post('datestart'));
        $dateend   = $this->date_utility->format_date($this->input->post('dateend'));
        $line = 0;
        $acctledgers = $this->accountledger_mod->get_supplieraccountledgers($supid,$datestart,$dateend);
        $response = null;

        if ($acctledgers !== null){

        foreach ($acctledgers as $acctledger){
            $recno=0;

            if ($acctledger['transactiontypeid']==3){ //expenseS

                $expenseid= $acctledger['referenceid'];
                $expense= $this->expense_mod->get_expense_by_id($expenseid);
                $expensedetails=$this->expensedetail_mod->get_expensedetail_by_expenseid($expenseid);
                foreach ($expensedetails as $expensedetail){
                    if ($recno ==0){
                        $response[$line] = array(
                            'type' => 'expense',
                            'date' => $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                            'refno' => sprintf("%'.06d", $expensedetail['expenseid']),
                            'item_name' =>$expensedetail['contractorbranch_name'].' '. $expensedetail['item_name'].' '. $expensedetail['spec'],
                            'qty' => number_format($expensedetail['qty'],2),
                            'item_unit' => $expensedetail['itemunit_name'],
                            'price' => floor($expensedetail['price']),
                            'amount' => floor($expensedetail['amount'])


                        );
                        $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'expense',
                            'item_name' =>$expensedetail['contractorbranch_name'].' '. $expensedetail['item_name'].' '. $expensedetail['spec'],
                            'qty' => number_format($expensedetail['qty'],2),
                            'item_unit' => $expensedetail['itemunit_name'],
                            'price' => floor($expensedetail['price']),
                            'amount' => floor($expensedetail['amount'])


                        );

                    }

                    $line = $line+1;

                }

                if ($expense['tax']<>0){
                    $response[$line] = array(
                            'type' => 'tax',
                            'item_name' =>  '消　費　税',
                            'amount' => floor($expense['tax'])
                    );
                    $line = $line+1;
                }
                if ($expense['note']<>''){
                    $response[$line] = array(
                            'item_name' =>  '備考欄：'.$expense['note'],
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


        return $response;


        }
    }
    public  function fetchLedgers(){  //株式会社　竹中工務店

        $supid = $this->input->post('supID');
        $datestart = $this->date_utility->format_date($this->input->post('datestart'));
        $dateend   = $this->date_utility->format_date($this->input->post('dateend'));
        $line = 0;
        $acctledgers = $this->accountledger_mod->get_supplieraccountledgers($supid,$datestart,$dateend);
        $response = null;
        if ($acctledgers !== null){

        foreach ($acctledgers as $acctledger){
            $recno=0;

            if ($acctledger['transactiontypeid']==3){ //expenseS

                $expenseid= $acctledger['referenceid'];
                $expense= $this->expense_mod->get_expense_by_id($expenseid);
                $expensedetails=$this->expensedetail_mod->get_expensedetail_by_expenseid($expenseid);
                foreach ($expensedetails as $expensedetail){
                    if ($recno ==0){
                        $response[$line] = array(
                            'type' => 'expense',
                            'date' => $this->date_utility->format_date($acctledger['datetransacted'], 'Y. m. d'),
                            'refno' => sprintf("%'.06d", $expensedetail['expenseid']),
                            'item_name' => $expensedetail['item_name'],
                            'qty' => number_format($expensedetail['qty'],2),
                            'item_unit' => $expensedetail['itemunit_name'],
                            'price' => floor($expensedetail['price']),
                            'amount' => floor($expensedetail['amount'])


                        );
                        $recno=1;
                    }else{
                        $response[$line] = array(
                            'type' => 'expense',
                            'item_name' =>$expensedetail['item_name'],
                            'qty' => number_format($expensedetail['qty'],2),
                            'item_unit' => $expensedetail['itemunit_name'],
                            'price' => floor($expensedetail['price']),
                            'amount' => floor($expensedetail['amount'])


                        );

                    }

                    $line = $line+1;

                }

                if ($expense['tax']<>0){
                    $response[$line] = array(
                            'type' => 'tax',
                            'item_name' =>  '消　費　税',
                            'amount' => floor($expense['tax'])
                    );
                    $line = $line+1;
                }
                if ($expense['note']<>''){
                    $response[$line] = array(
                            'item_name' =>  '備考欄：'.$expense['note'],
                            'amount' => ''
                    );

                    $line = $line+1;
                }

             //reset to display date and refno on first line.

            }else{  //PAYMENT

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
        $this->bill_mod->delete($id);
        redirect('bill');
    }

    public function getNextbillDate()
    {

        $firmid = $this->input->post('firmid');
        $nextdatestart = $this->bill_mod->getNextbillDate($firmid);
    print_r ($nextdatestart);

    }


    private function get_rules()
    {
         return array(
            array(
                'field' => 'suppliername',
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
