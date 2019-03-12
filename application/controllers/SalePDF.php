<?php

class salepdf extends CI_Controller
{

function create_pdf($id){

    require(APPPATH .'libraries/tcpdf/tcpdf.php');

        $title = 'Invoice';
        $sale = $this->sale_mod->get_sale_by_id($id);
        $custid = $sale['customerid'];
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
        $pdf->SetMargins(5, 5, 5);
        $pdf->AddPage();
        $pdf->SetFont('cid0jp','',16);
        $pdf -> SetDrawColor(255, 255, 255);
        $pdf -> SetFillColor(28, 142, 108);
        $pdf->SetTextColor(255, 255, 255);

//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

        $pdf -> cell(200,7,"Invoice",1,1,"R","true");
        $pdf->SetFont('cid0jp','',12);
        $pdf -> SetDrawColor(255, 255, 255);
        $pdf -> SetFillColor(255, 255, 255);
        $pdf->  SetTextColor(0,0,0);
        $pdf -> cell(140,7,$id,1,1,"1","true");
        $pdf -> cell(140,7,$zip,1,1,"1","true");
        $pdf -> cell(140,7,$add1,1,1,"1","true");
        $pdf -> cell(140,7,$add2,1,1,"1","true");
        $pdf -> cell(140,7,$custname,1,1,"1","true");
        //Colum Headers
        $pdf -> SetDrawColor(0, 0, 0);
        $pdf -> cell(50,7,"Item Name",1,0,"1","true");
        $pdf -> cell(30,7,"Remarks",1,0,"1","true");
        $pdf -> cell(20,7,"Qty",1,0,"1","true");
        $pdf -> cell(20,7,"Unit",1,0,"1","true");
        $pdf -> cell(20,7,"Price",1,0,"1","true");
        $pdf -> cell(20,7,"Amount",1,1,"1","true");
        //Details
        foreach ($saleitems as $row){

        $pdf -> cell(50,7, $row['item_name'],1,0,"1","true");
        $pdf -> cell(30,7, $row['spec'],1,0,"1","true");
        $pdf -> cell(20,7, $row['qty'],1,0,"1","true");
        $pdf -> cell(20,7, $row['itemunit_name'],1,0,"1","true");
        $pdf -> cell(20,7, $row['price'],1,0,"1","true");
        $pdf -> cell(20,7, $row['amount'],1,1,"1","true");
        }

        $pdf->MultiCell(55, 60, '[FIT CELL] ',"TEST", 1, 'J', 1, 1, '10', '200', true, 0, false, true, 60, 'M', true);

        $pdf->MultiCell(55, 60, '[FIT CELL] ',"TEST", 1, 'J', 1, 1, '110', '200', true, 0, false, true, 60, 'M', true);



        $pdf ->output ('your_file_pdf.pdf','D');




  }
}
