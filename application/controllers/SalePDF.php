<?php

class salepdf extends CI_Controller
{


public function batch_PDF($data)
{
    $id = 16801;
    $id2 = 16802;
    $this-> create_pdf($id);
    $this-> create_pdf($id2);
}

public function create_pdf($id){
    require(APPPATH .'libraries/tcpdf/tcpdf.php');

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


        $pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetMargins(12, 5, 0);
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




        return $pdf ->output ('Sale_'. $refno,'S');


  }
}
