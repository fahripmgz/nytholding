    <style>
    table {
 
    font-size: 0.8em;

    border-collapse: collapse;
    }

    .super_script {
    font-size: 80%;
    vertical-align: super;
    }

    </style>
<?php
session_start();
include_once "../lib/config.php";

$mr=$_GET['mr'];


$sqlquery=mysql_query("select * from add_asset_request a left join master_maesurement b on a.maesurement=b.id_mae where a.no_mr_asset='$mr'");


?>

	  <div class="table-responsive">
<table class="table table-striped table-bordered" >
<thead>
<tr bgcolor='#ffffff'>
<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;NO</b></font></td>
<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;PART NUMBER / SIZE</b></font></td>
<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;ITEMS DESCRIPTION</b></font></td>
<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;QTY</b></font></td>
<td align='center' style='padding: 5px;' rowspan='2'><font size='1'><b>&nbsp;UNIT</b></font></td>  
<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;ON HAND</b></font></td>
<td align='center' style='padding: 5px;' colspan='3'><font size='1' ><b>&nbsp;LAST RECEIVED</b></font></td>

<td align='center' style='padding: 5px;' rowspan='2'><font size='1' ><b>&nbsp;REMARKS</b></font></td>

</tr>
<tr>
    <td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;DATE</b></font></td>
  <td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;QTY</b></font></td>
<td align='center' style='padding: 5px;'><font size='1'><b>&nbsp;UNIT</b></font></td>  
</tr>   </thead>
                  
                  
                  <tbody>
<?php
$no=1;

while($data = mysql_fetch_array($sqlquery)){
    
 
   
?>

<tr>

<td align='center'  style='padding: 5px;'><font size='2'>&nbsp;<?=$no?></font></td>
<td  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['part_number']?></font> </td>
<td  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['item_description']?>,<font>&nbsp; <?=$data['specification']?></font>&nbsp;&nbsp;</font></td>
<td align='center'  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['qty']?></font></td>
<td align='left' style='padding: 5px;'><font size='2'>&nbsp;<?=$data['maesurename']?></font></td>
<td align='center'  style='padding: 5px;'><font size='2'>&nbsp;<?php 

$sqlquery2=mysql_query("select SUM(a.qty)as qtytot from stock_location a   where  a.item_code='$data[item_code]' and a.site='$qr[location_request]'");
while($data2 = mysql_fetch_array($sqlquery2)){

echo $data2['qtytot'];

} ?></font></td>
<td align='left'  style='padding: 5px;'><font size='2'>&nbsp;<?php 

$sqlquery2=mysql_query("select a.date from receive_item a   where  a.item_code='$data[item_code]' and a.site='$qr[location_request]' ORDER by a.date Desc limit 1");
while($data2 = mysql_fetch_array($sqlquery2)){

echo $data2['date'];

} ?></font></td>
<td align='center'><font size='2'>&nbsp;<?php 

$sqlquery2=mysql_query("select a.qty,a.id_receive from receive_item a   where  a.item_code='$data[item_code]' and a.site='$qr[location_request]' ORDER by a.id_receive Desc limit 1");
while($data2 = mysql_fetch_array($sqlquery2)){

echo $data2['qty'];

} ?></font></td>
<td align='left'  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['maesurename']?></font></td>
<td align='left'  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['notes']?></font></td>
</tr>


    

<?php
$no++; } ?>

<tr>
<td colspan="10" style='padding: 5px;'>
<font size='1'  >&nbsp;</font>
</td>
</tr>

</table>
<table class="table table-striped table-bordered" >



<tr>
&nbsp;<br>
<td width='25%'  align='center'><font size='2'>&nbsp;Prepare By</font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>



</td>

&nbsp;<br>

<td width='25%' border='0' align='center'>

&nbsp;<font size='2'>Check By</font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>

		
</td>


<td width='25%'  align='center'>&nbsp;<font size='2'>Approved By</font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>


</td>
<td width='25%'  align='center'>&nbsp;<font size='2'>Receive By</font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>


</td>
</tr>

   </tbody>
 

</table>

</div>
<br>



<br><br>


