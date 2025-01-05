<?php 

 
	 //send Mail
	 
	 $datereqmr=date('Y-m-d');
$messagemr = "<html><body>
<table width='100%' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0' border='0'>
<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:600px; background-color:#fff; font-family:Calibri;'>
<thead>
<tr height='80'>
<th colspan='2' align='center' style='background-color:#0e72a6;border-bottom:solid 1px #2537aa; font-family:Calibri;    padding: 5px; color:#ffffff; font-size:20px;' > <p align='center'> PT. Audemars Indonesia</p></th>
</tr>
<tr height='80'>
<th colspan='2' align='center' style='background-color:#0e72a6;border-bottom:solid 1px #18afb4; font-family:Calibri;    padding: 3px; color:#ffffff; font-size:24px;' > <p align='center'> $txtnoMR</p></th>
</tr>
</thead>
<tbody>
<tr style='background-color:#f5f5f5;'>
<td colspan='4' style='padding:10px;' >
<hr />
<p style='font-size:12px;'>Hi,<br />
You have  notification email for Material Request  number  <b>$txtnoMR</b>
<p>
<p style='font-size:12px;'><b>Created By: $txtPICreqmr</b></p>
<p style='font-size:12px;'><b>Date : $datereqmr</b> <p></p>
<p style='font-size:12px;'><b>Notes: $txtNotesmr</b></p>
<p style='font-size:12px;'><b>Status: $txtStatusmr</b></p>
<h4><b>Material Request Number: $txtnoMR</b></h4>

<p style='font-size:12px; font-family:Calibri;'align='center'>Please Check System </p>
	<p align='center'> <a href='www.audemars.nyt.co.id'>
                <button style='background-color:#EB7035;border:1px solid #EB7035;border-radius:3px;color:#ffffff;display:inline-block;font-family:Calibri;font-size:16px;line-height:44px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;mso-hide:all;'>
                  Go to Dashboard
                </button>
                </a></p>
</td>
</tr>
<tr height='30'>
<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>
</td>
</tr>
<tr>
<td colspan='4' align='center' style='background-color:#0e72a6;  font-size:14px; '><p style='font-family:Calibri;font-size:12px;line-height:44px;text-align:center;text-decoration:none;color:#ffffff;'>www.nyt.co.id</p>
</td>
</tr><br />
<br
</tbody>
</table>
</td></tr>
</table>
</body></html>";



?>