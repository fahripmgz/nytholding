<?php
session_start();
include_once "../lib/config.php";

$kode=$_GET['po'];


$q=mysql_query("select *,b.email as mailvendor,b.address as addressven from purchase_order a left join master_vendor b on a.to=b.id_vendor left join material_request c on a.mr_number=c.id_mr left join master_user d on a.pic_created=d.id_user left join master_currency e on a.currency=e.id_cur WHERE number_po='".$_GET['po']."'") or die(mysql_error());

$qr=mysql_fetch_array($q);



$header = "



<table class='table table-striped table-bordered' >
<thead>
<tr>
<td align='left'  rowspan='4' border='0' style='width:30%' ><img style='padding: 10px;' src='../images/logo_auder.png'></img></td>
<th align='left'  rowspan='4' border='0' align='center' style='width:40%;color:#6e6e6e' ><b>PURCHASE ORDER (PO)</b></th>
<td><font size='1' style='width:20%' >&nbsp; Nomor Dokumen</font></td>
<td><font size='1' style='width:20%' >&nbsp; AMI-F-PROC-P-01/04</font></td>
</tr>
<tr>
<td align='left' ><font size='1'>&nbsp; Revisi</font></td>
<td align='left'><font size='1'>&nbsp; 02</td>

</tr>
<tr>
<td align='left'><font size='1'>&nbsp; Tanggal Terbit</font></td>
<td align='left'><font size='1'>&nbsp; 13 Februari 2017</font></td>

</tr>
<tr>

<td align='left'><font size='1'> &nbsp; Halaman</font></td>
<td align='left'><font size='1'> &nbsp; 1/1</font></td>

</tr>


</thead>
</table>



<br/>

<table class='table' style='font-size:10px'>
<tr>
<tr>
<td align='left' style='width:10%'><font>To</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[vendor_name]</font></td>
<td style='width:7%'></td>
<td style='width:10%' colspan='3'><font>PURCHASE ORDER</font></td>
</tr>
<tr>
<tr>
<td align='left' valign='top' style='width:10%'><font>Address</font></td>:
<td valign='top'>:</td>
<td align='left' style='width:50%'><font>$qr[addressven]</font></td>
<td ></td>
<td style='width:10%' colspan=3><font>$_GET[po]</font></td>
</tr>	
<tr>
<td align='left' style='width:10%'><font>Telephone</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[phone]</font></td>
<td ></td>
<td style='width:10%'><font></font></td>
<td></td>
<td><font></font></td>
</tr>
<tr>
<tr>
<td align='left' style='width:10%'><font>Fax</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[fax]</font></td>
<td ></td>
<td style='width:10%'><font>Date</font></td>
<td>:</td>
<td><font>$qr[date_po]</font></td>
</tr>
<tr>
<td align='left' style='width:10%'><font>Your Reff</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[reff_number]</font></td>
<td ></td>
<td style='width:10%'><font></font></td>
<td></td>
<td><font></font></td>
</tr>
<tr>
<td align='left' style='width:10%'><font>Attn</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[attn]</font></td>
<td ></td>
<td style='width:10%'><font>KP No</font></td>
<td>:</td>
<td><font>$qr[kp_number]</font></td>
</tr>
<tr>
<td align='left' style='width:10%'><font>Subject</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[subject]</font></td>
<td ></td>
<td style='width:10%'><font></font></td>
<td></td>
<td><font></font></td>
</tr>
</tr>
</table>
<br/>

 
 


";

$footer= "<table class='table-list' border='0' width='100%'  cellspacing='0'>
          <tr>
              <td width='33%'><font size='3'></font></td>
              <td width='33%' align='center'><font size='3'></font></td>
              <td width='33%' align='right'><font size='3'>page {PAGENO} of {nbpg}</font></td>
          </tr>
          </table>
";	


	
	




//==============================================================
//==============================================================
//==============================================================

include("../mpdf60/mpdf.php");

ob_start();  // start output buffering

if ($qr['type_req']==4){
	
include 'huile_po.php';	
}else{
    
 	
include 'huile_po_asset.php';	   
}


$content = ob_get_clean(); // get content of the buffer and clean the buffer
$mpdf = new mPDF(); 

   $stylesheet = file_get_contents('../assets/css/bootstrap.min.css');
   $stylesheetextra1 = file_get_contents('../assets/font-awesome/4.2.0/css/font-awesome.min.css');
   $stylesheetextra2 = file_get_contents('../assets/fonts/fonts.googleapis.com.css');
            $mpdf->WriteHTML($stylesheet,1);    // The parameter 1 tells that this is css/style only and no body/html/text
          // LOAD a stylesheet 2
         
            $mpdf->WriteHTML($stylesheetextra1 ,1);  // The parameter 1 tells that this is css/style only and no body/html/text
    		$mpdf->WriteHTML($stylesheetextra2 ,1);  // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->SetHTMLHeader($header);
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetTopMargin('85%');

$mpdf->setHTMLFooter($footer);
$content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($content);



$mpdf->Output(); // output as inline content
         
            exit;

//==============================================================
//==============================================================
//==============================================================


?>