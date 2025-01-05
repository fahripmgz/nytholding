<?php
session_start();
include_once "../lib/config.php";

$kode=$_GET['mnp'];


$q=mysql_query("SELECT * FROM manufacture_planning WHERE code_planning='".$_GET['mnp']."'") or die(mysql_error());

$qr=mysql_fetch_array($conn,$q);




$header = "



<table class='table table-striped table-bordered' >
<thead>
<tr>
<td align='left'  rowspan='4' border='0' style='width:30%' ><img style='padding: 10px;' src='../images/logo_auder.png'></img></td>
<th align='left'  rowspan='4' border='0' align='center' style='width:40%;color:#6e6e6e' ><b>MANUFACTURE USAGE</b></th>
<td><font size='1' style='width:20%' >&nbsp; Nomor Dokumen</font></td>
<td><font size='1' style='width:20%' >&nbsp; AMI-F-PROC-P-01/01</font></td>
</tr>
<tr>
<td align='left' ><font size='1'>&nbsp; Revisi</font></td>
<td align='left'><font size='1'>&nbsp; 00</td>

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
<table class='table'>
<tr>
<tr>
<td align='left' style='width:10%'><font>Manufacture Number</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[code_planning]</font></td>
<td style='width:7%'></td>
<td style='width:10%'><font>Page No</font></td>
<td >:</td>
<td><font>page {PAGENO} of {nbpg}</font></td>
</tr>
<tr>
<tr>
<td align='left' valign='top' style='width:10%'><font>Date</font></td>:
<td valign='top'>:</td>
<td align='left' style='width:50%'><font>$qr[date_start]</font></td>
<td ></td>
<td style='width:10%'><font>Location</font></td>
<td>:</td>
<td><font>$qr[manufacture_location]</font></td>
</tr>	
<tr>
<td align='left' style='width:10%'><font>Manufacture Planning</font></td>:
<td>:</td>
<td align='left' style='width:50%'><font>$qr[planning_tittle]</font></td>
<td ></td>
<td style='width:10%'><font></font></td>
<td></td>
<td><font></font></td>
</tr>

</tr>
</table>

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


	
include 'item_mnf.php';	



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

$mpdf->SetTopMargin('80%');

$mpdf->setHTMLFooter($footer);
$content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($content);



$mpdf->Output(); // output as inline content
         
            exit;

//==============================================================
//==============================================================
//==============================================================


?>