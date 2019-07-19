<?php

class pdf extends CI_Controller
{


public function batch_PDF($data)
{
    $id = 16801;
    $id2 = 16802;
    $this-> create_pdf($id);
    $this-> create_pdf($id2);
}

public function create_pdf(){
 require(APPPATH .'libraries/tcpdf/tcpdf.php');

        $printlist= $this->print_mod->get_printq(0);
        $line=0;


        $pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetMargins(12, 5, 0);


        foreach ($printlist as $row){

            $type = $row['typeid'];
            $id = $row['referenceid'];

            if ($type == 1){
                $pdf->SetAutoPageBreak(TRUE, 0);
                $pdf->SetMargins(12, 5, 0);
                $title = '売 上 書';
                $sale = $this->sale_mod->get_sale_by_id($id);
                $refno = $sale['referenceno'];
                $date = $this->date_utility->format_date($sale['datedelivered'], 'Y年 m月 d日');

                $custid = $sale['customerid'];
                $subtotal = $sale['subtotal'];
                $tax = $sale['tax'];
                $total = $sale['total'];
                $note = $sale['note'];

                $customer = $this->customer_mod->get_customer_by_id($custid);
                $custname = $customer['name'];
                $zip = $customer['zip'];
                $add1 = $customer['address1'];
                $add2 = $customer['address2'];
                $contact = $customer['contactperson'];

               if (empty($sale)) {
                    show_404();
                }

                $saleitems = $this->saledetail_mod->get_saledetail_by_saleid($id);



                $pdf->AddPage();



        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);

                $pdf -> cell(145,4,'',0,0,'',"false");// left filler

                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255, 255, 255);
                $pdf->  SetFont('cid0jp','B',16);
                $pdf -> cell(40,8,$title,1,1,"C","true");  //TITLEs

        //Address
                $pdf -> SetFont('cid0jp','',10);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);



                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(170,5,$zip,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add1,1,0,"1","true");     $pdf -> cell(40,5,'No. : ' . $refno,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add2,1,0,"1","true");     $pdf -> cell(40,5,'日付 : ' . $date,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(170,5,$custname . '  御中',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'612-8019',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'京都府京都市伏見区桃山町新町３５',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'キョッコウサンギョウ',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'旭興産業株式会社',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'Tel. No. 075-623-5477   Fax No. 075-623-5141',1,1,"1","true");



        //Colum Headers
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> cell(185,5,"",'B',1,"1","false"); //top line

                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf -> SetDrawColor(192, 192, 192);


                $pdf -> cell(110,6,"品　名",'L',0,"C","true");
                $pdf -> cell(25,6,"数　量",0,0,"C","true");
                $pdf -> cell(25,6,"単　価",0,0,"C","true");
                $pdf -> cell(25,6,"金　額",'R',1,"C","true");

        //Details
                $fill = false;
                $totrow = 0;
                $pdf -> SetFillColor(224, 224, 224);
                $pdf->  SetTextColor(0,0,0);
                foreach ($saleitems as $row){

                $itemname = $row['contractorbranch_name']. '様 '. $row['item_name']. ' '. $row['spec'];
                $pdf -> cell(110,5, $itemname,'L',0,'L',$fill);
                $pdf -> cell(15,5, number_format($row['qty']),'L',0,"R",$fill);
                $pdf -> cell(10,5, $row['itemunit_name'],'',0,"L",$fill);
                $pdf -> cell(25,5, number_format($row['price']),'L',0,"R",$fill);
                $pdf -> cell(25,5, number_format($row['amount']),'LR',1,"R",$fill);

                $fill = !$fill;
                $totrow ++;
                }

                $rem = 12-$totrow;

                for ($i = 0; $i < $rem; $i++){

                $pdf -> cell(110,5,'','L',0,'C',$fill);
                $pdf -> cell(15,5, '','L',0,"C",$fill);
                $pdf -> cell(10,5, '','',0,"C",$fill);
                $pdf -> cell(25,5, '','L',0,"C",$fill);
                $pdf -> cell(25,5, '','LR',1,"C",$fill);

                $fill = !$fill;
                $totrow ++;
                }
            //TOTALS
                $fill = false;

                $pdf -> cell(110,8, '','LTB',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '合','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($subtotal),'TB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '税','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($tax),'TB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '総','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($total),'RTB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '',0,1,"L", $fill); //ln

                $pdf -> cell(110,4, '','LB',0,"L", $fill);
                $pdf -> cell(4,4, '計','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','B',0,"L", $fill);
                $pdf -> cell(4,4, '額','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','B',0,"L", $fill);
                $pdf -> cell(4,4, '額','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','RB',0,"L", $fill);
                $pdf -> cell(4,4, '',0,1,"L", $fill); //ln


             //   $pdf -> cell(185,20,'',1,1,0,$fill);// SPACER
                $pdf -> cell(185,20,'',0,1,'',false);// left filler

            //============================== BOTTOM PAGE ==========================================



                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);

                $pdf -> cell(145,4,'',1,0,"R","false");// left filler

                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf-> SetTextColor(255, 255, 255);
                $pdf->  SetFont('cid0jp','B',16);
                $pdf -> cell(40,8,'請　求　書',1,1,"C","true");  //TITLEs

        //Address
                $pdf -> SetFont('cid0jp','',10);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);


                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(170,5,$zip,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add1,1,0,"1","true");     $pdf -> cell(40,5,'No. : ' . $refno,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add2,1,0,"1","true");     $pdf -> cell(40,5,'日付 : ' . $date,1,1,"1","true");
                $pdf -> cell(15,5,'',1,0,"1","true"); $pdf -> cell(170,5,$custname . '  御中',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'612-8019',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'京都府京都市伏見区桃山町新町３５',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'キョッコウサンギョウ',1,1,"1","true");
                $pdf -> cell(110,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'旭興産業株式会社',1,1,"1","true");
                $pdf -> SetTextColor(128, 128, 128);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(110,5,'振込先　：　京都中央信用金庫　大手筋支店　当座　0002239',1,0,"1","true");
                $pdf->  SetTextColor(0,0,0);  $pdf -> SetFont('cid0jp','',10);
                                                                                                     $pdf -> cell(75,5,'Tel. No. 075-623-5477   Fax No. 075-623-5141',1,1,"1","true");




        //Colum Headers
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> cell(185,5,"",'B',1,"1","false"); //top line

                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf -> SetDrawColor(192, 192, 192);


                $pdf -> cell(110,6,"品　名",'L',0,"C","true");
                $pdf -> cell(25,6,"数　量",0,0,"C","true");
                $pdf -> cell(25,6,"単　価",0,0,"C","true");
                $pdf -> cell(25,6,"金　額",'R',1,"C","true");

        //Details
                $fill = false;
                $totrow = 0;
                $pdf -> SetFillColor(224, 224, 224);
                $pdf->  SetTextColor(0,0,0);
                foreach ($saleitems as $row){
                $pdf -> cell(110,5, $itemname,'L',0,'L',$fill);
                $pdf -> cell(15,5, number_format($row['qty']),'L',0,"R",$fill);
                $pdf -> cell(10,5, $row['itemunit_name'],'',0,"L",$fill);
                $pdf -> cell(25,5, number_format($row['price']),'L',0,"R",$fill);
                $pdf -> cell(25,5, number_format($row['amount']),'LR',1,"R",$fill);

                $fill = !$fill;
                $totrow ++;
                }

                $rem = 12-$totrow;

                for ($i = 0; $i < $rem; $i++){

                $pdf -> cell(110,5,'','L',0,'C',$fill);
                $pdf -> cell(15,5, '','L',0,"C",$fill);
                $pdf -> cell(10,5, '','',0,"C",$fill);
                $pdf -> cell(25,5, '','L',0,"C",$fill);
                $pdf -> cell(25,5, '','LR',1,"C",$fill);

                $fill = !$fill;
                $totrow ++;
                }
            //TOTALS
                $fill = false;
                $pdf -> SetTextColor(128, 128, 128);
                $pdf -> cell(110,8, $note,'LTB',0,"L", $fill);
                $pdf -> SetTextColor(0, 0, 0);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '合','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($subtotal),'TB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '税','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($tax),'TB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '総','LT',0,"L", $fill);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> cell(21,8, number_format($total),'RTB',0,"R",$fill);
                $pdf -> SetFont('cid0jp','',7);
                $pdf -> cell(4,4, '',0,1,"L", $fill); //ln

                $pdf -> cell(110,4, '','LB',0,"L", $fill);
                $pdf -> cell(4,4, '計','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','B',0,"L", $fill);
                $pdf -> cell(4,4, '額','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','B',0,"L", $fill);
                $pdf -> cell(4,4, '額','LB',0,"L", $fill);
                $pdf -> cell(21,4, '','RB',0,"L", $fill);
                $pdf -> cell(4,4, '',0,1,"L", $fill); //ln


            } else { // END SALEPDF



//------------------------------ I N V O I C E   P D F --------------------------------------------------------------------


                $title = '請　求　書';
                $invoice = $this->invoice_mod->get_invoice_by_id($id);
                $refno = $invoice['referenceno'];
                $custid = $invoice['customerid'];
                $datestart = $this->date_utility->format_date($invoice['datestart'], 'Y-m-d');
                $dateend = $this->date_utility->format_date($invoice['dateend'], 'Y-m-d');
                $dateinvoice = $this->date_utility->format_date($invoice['dateend'], 'Y年 m月 d日');
                $subtotal = $invoice['subtotal'];
                $tax = $invoice['tax'];
                $total = $invoice['total'];
                $note = $invoice['note'];
                $prevtotal = $this->accountledger_mod->getCustomerPrevAmountDue($custid,$datestart, $dateend);
                $paytotal =  - $this->accountledger_mod->getCustomerTotalPayment($custid,$datestart, $dateend) ;
                $amountdue = $prevtotal - $paytotal + $total;
                $customer = $this->customer_mod->get_customer_by_id($custid);
                $custname = $customer['name'];
                $zip = $customer['zip'];
                $add1 = $customer['address1'];
                $add2 = $customer['address2'];
                $contact = $customer['contactperson'];

               if (empty($invoice)) {
                    show_404();
                };


                //$pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $pdf->SetAutoPageBreak(TRUE, 5);
                $pdf->SetMargins(12, 5, 0);
                $pdf->AddPage();



        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);

                $pdf -> cell(140,4,'',0,0,'',"false");// left filler

                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255, 255, 255);
                $pdf->  SetFont('cid0jp','B',16);
                $pdf -> cell(40,8,$title,1,1,"C","true");  //TITLEs

        //Address
                $pdf -> SetFont('cid0jp','',10);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);



                $pdf -> cell(10,5,'',1,0,"1","true"); $pdf -> cell(170,5,$zip,1,1,"1","true");
                $pdf -> cell(10,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add1,1,0,"1","true");     $pdf -> cell(40,5,'No. : ' . $refno,1,1,"1","true");
                $pdf -> cell(10,5,'',1,0,"1","true"); $pdf -> cell(130,5,$add2,1,0,"1","true");     $pdf -> cell(40,5,'日付 : ' . $dateinvoice,1,1,"1","true");
                $pdf -> cell(10,5,'',1,0,"1","true"); $pdf -> cell(170,5,$custname . '  御中',1,1,"1","true");
                $pdf -> cell(105,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'612-8019',1,1,"1","true");
                $pdf -> cell(105,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'京都府京都市伏見区桃山町新町３５',1,1,"1","true");
                $pdf -> cell(105,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'キョッコウサンギョウ',1,1,"1","true");
                $pdf -> cell(105,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'旭興産業株式会社',1,1,"1","true");
                $pdf -> cell(105,5,'',1,0,"1","true");                                              $pdf -> cell(75,5,'Tel. No. 075-623-5477   Fax No. 075-623-5141',1,1,"1","true");


        //Totals Headers

                $pdf -> SetFont('cid0jp','',8);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf -> SetDrawColor(255, 255, 255);
                $pdf -> cell(185,5,"",'B',1,"1","false"); //top line

                $pdf -> cell(105,5,'',0,0,"1","true");
                $pdf -> SetTextColor(0, 0, 0);
                $pdf -> cell(75,5,'振込先',0,1,"1","true");
                $pdf -> cell(105,5,'',0,0,"1","true");
                $pdf -> cell(75,5,'キョッコウサンギョウカブシキガイシャ',0,1,"1","true");

                $pdf -> SetTextColor(128, 128, 128);
                $pdf -> cell(105,5,'毎度有難うございます',0,0,"1","true");
                $pdf -> SetTextColor(0, 0, 0);
                $pdf -> cell(75,5,'京都中央信用金庫　大手筋支店',0,1,"1","true");

                $pdf -> SetTextColor(128, 128, 128);
                $pdf -> cell(110,5,'下記の通り御請求申し上げます。',0,0,"1","true");
                $pdf -> SetTextColor(0, 0, 0);
                $pdf -> cell(75,5,'当座　0002239。',0,1,"1","true");


                $pdf->  SetTextColor(0,0,0);  $pdf -> SetFont('cid0jp','',10);
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf -> SetDrawColor(192, 192, 192);


                $pdf -> cell(25,6,"前回御請求額",'L',0,"C","true");
                $pdf -> cell(25,6,"御入金額",'L',0,"C","true");
                $pdf -> cell(25,6,"繰越金額",'L',0,"C","true");
                $pdf -> cell(25,6,"合計",'L',0,"C","true");
                $pdf -> cell(25,6,"内　消費税額",'L',0,"C","true");
                $pdf -> cell(25,6,"今回御買上額",'L',0,"C","true");
                $pdf -> cell(2,6,"",'L',0,"C",false);
                $pdf -> cell(28,6,"今回御請求額",'LR',1,"C","true");
                $fill = false;
                $totrow = 0;
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(0,0,0);


                $pdf -> cell(25,10,number_format(floor($prevtotal)),'LB',0,"C",false);
                $pdf -> cell(25,10,number_format(floor($paytotal)),'LB',0,"C",false);
                $pdf -> cell(25,10,number_format(floor($prevtotal-$paytotal)),'LB',0,"C","false");
                $pdf -> cell(25,10,number_format(floor($subtotal)),'LB',0,"C","false");
                $pdf -> cell(25,10,number_format(floor($tax)),'LB',0,"C","false");
                $pdf -> cell(25,10,number_format(floor($total)),'LB',0,"C","false");
                $pdf -> cell(2,10,"",'L',0,"C","false");
                $pdf -> cell(28,10,number_format(floor($prevtotal - $paytotal + $total)),'LBR',1,"C","false");
                $pdf -> cell(180,2,"",0,1,"C",false);


        //Colum Headers
                $pdf -> SetFont('cid0jp','',9);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(255, 255, 255);
                $pdf -> SetDrawColor(255, 255, 255);

                $pdf -> SetFillColor(128, 128, 128);
                $pdf->  SetTextColor(255,255,255);
                $pdf -> SetFillColor(128, 128, 128);
                $pdf -> SetDrawColor(192, 192, 192);


                $pdf -> cell(15,6,"伝票日付",'L',0,"C","true");
                $pdf -> cell(15,6,"伝票No.",'L',0,"C","true");
                $pdf -> cell(75,6,"品 番　・　品 名",'L',0,"C","true");
                $pdf -> cell(25,6,"数量・単位",'L',0,"C","true");
                $pdf -> cell(25,6,"単価",'L',0,"C","true");
                $pdf -> cell(25,6,"金額",'LR',1,"C","true");

        //Details
                $pdf -> SetFillColor(224, 224, 224);
                $pdf->  SetTextColor(0,0,0);

                $fill = false;
                $totrow = 0;
                $currentrow = 0;

                $invoiceitems = $this->invoice_mod->fetchInvoiceItems($custid,$datestart,$dateend);
                $totrow = sizeof($invoiceitems);
              //  $pdf -> cell(15,5,' Total Rows'.$totrow,'LB',1,"C",$fill);

                if ($totrow >91) {
                    foreach ($invoiceitems as $row){

                        if (isset($row['type'])){
                            $type = $row['type'];
                        }
                        if (isset($row['date'])){$date = $row['date'];}else{$date='';}
                        if (isset($row['refno'])){$refno = $row['refno'];}else{$refno='';}
                        if (isset($row['item_name'])){$item_name = $row['item_name'];}
                        if (isset($row['qty'])){$qty = $row['qty'];}
                        if (isset($row['item_unit'])){$item_unit = $row['item_unit'];}
                        if (isset($row['price'])){$price = $row['price'];}
                        if (isset($row['amount'])){$amount = $row['amount'];}

                        $pdf -> cell(15,5, $date,'LB',0,"C",$fill);
                        $pdf -> cell(15,5, $refno ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, $item_name,'LB',0,'L',$fill);
                        $pdf -> cell(15,5, $qty,'LB',0,"R",$fill);
                        $pdf -> cell(10,5, $item_unit,'LB',0,"L",$fill);
                        $pdf -> cell(25,5, $price,'LB',0,"R",$fill);
                        $pdf -> cell(25,5, $amount,'LBR',1,"R",$fill);

                        $fill = !$fill;
                        $currentrow ++;

                        if ($currentrow == 91) {
                             $pdf -> cell(25,5, $currentrow .  ' Page 1 of 2','',1,"L",'');
                        }

                    }//FOR
                    $rem = 34-$totrow;

                    for ($i = 0; $i < $rem; $i++){
                        $pdf -> cell(15,5, '','LB',0,"C",$fill);
                        $pdf -> cell(15,5, '' ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, '','LB',0,'L',$fill);
                        $pdf -> cell(15,5, '','LB',0,"R",$fill);
                        $pdf -> cell(10,5, '','LB',0,"L",$fill);
                        $pdf -> cell(25,5, '','LB',0,"R",$fill);
                        $pdf -> cell(25,5, '','LBR',1,"R",$fill);


                    $fill = !$fill;
                    $currentrow ++;
                    }
                 //   $pdf -> cell(25,5, '','',1,"L",'');


                } elseif ($totrow >35) {
                    foreach ($invoiceitems as $row){

                        if (isset($row['type'])){
                            $type = $row['type'];
                        }
                        if (isset($row['date'])){$date = $row['date'];}else{$date='';}
                        if (isset($row['refno'])){$refno = $row['refno'];}else{$refno='';}
                        if (isset($row['item_name'])){$item_name = $row['item_name'];}
                        if (isset($row['qty'])){$qty = $row['qty'];}
                        if (isset($row['item_unit'])){$item_unit = $row['item_unit'];}
                        if (isset($row['price'])){$price = $row['price'];}
                        if (isset($row['amount'])){$amount = $row['amount'];}

                        $pdf -> cell(15,5, $date,'LB',0,"C",$fill);
                        $pdf -> cell(15,5, $refno ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, $item_name,'LB',0,'L',$fill);
                        $pdf -> cell(15,5, $qty,'LB',0,"R",$fill);
                        $pdf -> cell(10,5, $item_unit,'LB',0,"L",$fill);
                        $pdf -> cell(25,5, $price,'LB',0,"R",$fill);
                        $pdf -> cell(25,5, $amount,'LBR',1,"R",$fill);

                        $fill = !$fill;
                        $currentrow ++;

                        if ($currentrow == 35) {
                            $pdf -> cell(25,5, 'Page 1 of 2','',1,"L",'');
                            $pdf -> cell(25,5, '','',1,"L",'');


                            $pdf -> SetFillColor(128, 128, 128);
                            $pdf->  SetTextColor(255,255,255);
                            $pdf -> SetFillColor(128, 128, 128);
                            $pdf -> SetDrawColor(192, 192, 192);


                            $pdf -> cell(15,6,"伝票日付",'L',0,"C","true");
                            $pdf -> cell(15,6,"伝票No.",'L',0,"C","true");
                            $pdf -> cell(75,6,"品 番　・　品 名",'L',0,"C","true");
                            $pdf -> cell(25,6,"数量・単位",'L',0,"C","true");
                            $pdf -> cell(25,6,"単価",'L',0,"C","true");
                            $pdf -> cell(25,6,"金額",'LR',1,"C","true");

                            $pdf -> SetFillColor(224, 224, 224);
                            $pdf->  SetTextColor(0,0,0);

                        }

                    }//FOR
                    $rem = 89-$totrow;

                    for ($i = 0; $i < $rem; $i++){
                        $pdf -> cell(15,5, '','LB',0,"C",$fill);
                        $pdf -> cell(15,5, '' ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, '','LB',0,'L',$fill);
                        $pdf -> cell(15,5, '','LB',0,"R",$fill);
                        $pdf -> cell(10,5, '','LB',0,"L",$fill);
                        $pdf -> cell(25,5, '','LB',0,"R",$fill);
                        $pdf -> cell(25,5, '','LBR',1,"R",$fill);


                    $fill = !$fill;
                    $currentrow ++;


                    } //FOR

                    $pdf -> cell(25,5, 'Page 2 of 2','',1,"L",'');

                } else {
                    foreach ($invoiceitems as $row){

                        if (isset($row['type'])){
                            $type = $row['type'];
                        }
                        if (isset($row['date'])){$date = $row['date'];}else{$date='';}
                        if (isset($row['refno'])){$refno = $row['refno'];}else{$refno='';}
                        if (isset($row['item_name'])){$item_name = $row['item_name'];}
                        if (isset($row['qty'])){$qty = $row['qty'];}
                        if (isset($row['item_unit'])){$item_unit = $row['item_unit'];}
                        if (isset($row['price'])){$price = $row['price'];}
                        if (isset($row['amount'])){$amount = $row['amount'];}

                        $pdf -> cell(15,5, $date,'LB',0,"C",$fill);
                        $pdf -> cell(15,5, $refno ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, $item_name,'LB',0,'L',$fill);
                        $pdf -> cell(15,5, $qty,'LB',0,"R",$fill);
                        $pdf -> cell(10,5, $item_unit,'LB',0,"L",$fill);
                        $pdf -> cell(25,5, $price,'LB',0,"R",$fill);
                        $pdf -> cell(25,5, $amount,'LBR',1,"R",$fill);

                        $fill = !$fill;
                        $currentrow ++;

                    }//FOR
                    $rem = 35-$totrow;

                    for ($i = 0; $i < $rem; $i++){
                        $pdf -> cell(15,5, '','LB',0,"C",$fill);
                        $pdf -> cell(15,5, '' ,'LB',0,"C",$fill);
                        $pdf -> cell(75,5, '','LB',0,'L',$fill);
                        $pdf -> cell(15,5, '','LB',0,"R",$fill);
                        $pdf -> cell(10,5, '','LB',0,"L",$fill);
                        $pdf -> cell(25,5, '','LB',0,"R",$fill);
                        $pdf -> cell(25,5, '','LBR',1,"R",$fill);


                    $fill = !$fill;
                    $currentrow ++;

                    }
                }
            }

        } //FOR

        date_default_timezone_set('Asia/Tokyo');
        return $pdf ->output (date("Y.m.d.H.i").'.pdf','D');

    }
}
