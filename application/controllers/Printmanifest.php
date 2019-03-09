<?php

class printmanifest extends CI_Controller
{

function create_pdf(){
 //     define('FPDF_FONTPATH',APPPATH .'libraries/font/');
    require(APPPATH .'libraries/tcpdf/tcpdf.php');
  //   require('japanese.php');

/*      $pdf = new FPDF('l','mm','A4');
      $pdf -> AddPage();

      $pdf -> setDisplayMode ('fullpage');

      $pdf -> setFont ('arial','B',10);
      $pdf -> SetDrawColor(255, 255, 255);
      $pdf -> SetFillColor(28, 142, 108);

      $pdf -> SetTextColor(255, 255, 255);

      $pdf -> cell(30,7,"Date",1,0,"c","true");
      $pdf -> cell(30,7,"Ref no",1,0,"c","true");
      $pdf -> cell(140,7,"蕀三合",1,0,"c","true");

      $pdf -> cell(100,10,"Ref No,",1,1);

      $pdf -> setFont ('times','B','20');
      $pdf -> write (10,"蕀三合");

      $pdf -> output ('your_file_pdf.pdf','D'); */


$pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
  $pdf -> SetDrawColor(255, 255, 255);
      $pdf -> SetFillColor(28, 142, 108);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('cid0jp','',16);
$pdf->cell(140,7,"蕀三合",1,0,"c","true");
$pdf ->Cell(95,20,'坂本工業竹内','L',0,'L','',0,false,'T','C');
$pdf ->output ('your_file_pdf.pdf','D');




  }
}
