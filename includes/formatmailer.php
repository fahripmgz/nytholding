


<?php


function InquiryEmail($namafrom, $noinq, $date,$emailcorp) {
	
$message2 = "<html><body>

<table width='100%' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0' border='0'>
<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:600px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>
<thead>

<tr height='80'>

<th colspan='2' align='center' style='background-color:#3a6874;border-bottom:solid 1px #2537aa; font-family:arial, Geneva, sans-serif;    padding: 5px; color:#e1e1e4; font-size:18px;' > <p align='center'> PT. SARANA GASTEKINDO UTAMA</p></th>
</tr>
</thead>

<tbody>

<tr style='background-color:#f5f5f5;'>


<td colspan='4' style='padding:10px;' >

<hr />
<p style='font-size:12px;'>Hi,<br />
You have notification email from $emailcorp for Inquiry  number  <b>$noinq</b>

<p>

<p style='font-size:12px;'><b>Email From:</b> $emailcorp</p>
<p style='font-size:12px;'><b>Created By:</b> $namafrom</p>

<h4><b>Inquiry Number: $noinq</b></h4>


<p style='font-size:12px;'><b>Date :</b> $date <p>

<p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>Please Check System www.sarana.co.id</p>
</td>
</tr>

<tr height='30'>
<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>

</td>
</tr>
<tr>
<td colspan='4' align='center' style='background-color:#49a5bf;  font-size:14px; '><p></p>

</td>
</tr><br />
<br

</tbody>

</table>

</td></tr>
</table>

</body></html>";

}


?>