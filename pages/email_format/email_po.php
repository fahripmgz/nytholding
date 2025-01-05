<?php 

 
	 //send Mail
	 
	 $datereqPO=date('Y-m-d');
$messagePO = "<html><body>
<table width='100%' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0' border='0'>
<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:600px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>
<thead>
<tr height='80'>
<th colspan='2' align='center' style='background-color:#607d8b;border-bottom:solid 1px #2537aa; font-family:arial, Geneva, sans-serif;    padding: 5px; color:#ffffff; font-size:20px;' > <p align='center'> PT. Audemars Indonesia</p></th>
</tr>
<tr height='80'>
<th colspan='2' align='center' style='background-color:#00BCD4;border-bottom:solid 1px #18afb4; font-family:arial, Geneva, sans-serif;    padding: 3px; color:#ffffff; font-size:26px;' > <p align='center'> $txtnoPO</p></th>
</tr>
</thead>
<tbody>
<tr style='background-color:#f5f5f5;'>
<td colspan='4' style='padding:10px;' >
<hr />
<p style='font-size:12px;'>Hi,<br />
You have  notification email Purchase Order number  <b>$txtnoPO</b>
<p>
<p style='font-size:12px;'><b>Created By: $txtPICreqPO</b></p>
<p style='font-size:12px;'><b>Date : $datereqPO</b> <p></p>
<p style='font-size:12px;'><b>Notes: $txtNotesPO</b></p>
<p style='font-size:12px;'><b>Status: $txtStatusPO</b></p>
<h4><b>Material Request Number: $txtnoPO</b></h4>

<p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'align='center'>Please Check System </p>
	<p align='center'> <a href='www.audemars.nyt.co.id'>
                <button style='background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;'>
                  Go to Application
                </button>
                </a></p>
</td>
</tr>
<tr height='30'>
<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>
</td>
</tr>
<tr>
<td colspan='4' align='center' style='background-color:#ffeb3b;  font-size:14px; '><p style='font-family:sans-serif;font-size:12px;line-height:44px;text-align:center;text-decoration:none;color:#ffffff;'>www.Audemars.co.id</p>
</td>
</tr><br />
<br
</tbody>
</table>
</td></tr>
</table>
</body></html>";



?>