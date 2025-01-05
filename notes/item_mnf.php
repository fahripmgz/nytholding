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

$mr=$_GET['mnp'];

$sqlquery=mysql_query("select * from item_manufacture a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_mnp='$mr'");


?>

	  <div class="table-responsive">
<table class="table table-striped table-bordered" >
<thead>
<tr bgcolor='#ffffff'>
<td align='center' style='padding: 5px;' rowspan='1'><font size='1' ><b>&nbsp;NO</b></font></td>
<td align='center' style='padding: 5px;' rowspan='1'><font size='1' ><b>&nbsp;Item Code</b></font></td>
<td align='center' style='padding: 5px;' rowspan='1'><font size='1' ><b>&nbsp;ITEMS DESCRIPTION</b></font></td>
<td align='center' style='padding: 5px;' rowspan='1'><font size='1' ><b>&nbsp;QTY</b></font></td>
<td align='center' style='padding: 5px;' rowspan='1'><font size='1'><b>&nbsp;UNIT</b></font></td>  



<td align='center' style='padding: 5px;' rowspan='1'><font size='1' ><b>&nbsp;REMARKS</b></font></td>

</tr>
  </thead>
                  
                  
                  <tbody>
<?php
$no=1;

while($data = mysql_fetch_array($sqlquery)){
    
 
   
?>

<tr>

<td align='center'  style='padding: 5px;'><font size='2'>&nbsp;<?=$no?></font></td>
<td  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['item_code']?></font> </td>
<td  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['item_name']?>,<font>&nbsp; <?=$data['specification']?></font>&nbsp;&nbsp;</font></td>
<td align='center'  style='padding: 5px;'><font size='2'>&nbsp;<?=$data['qty']?></font></td>
<td align='left' style='padding: 5px;'><font size='2'>&nbsp;<?=$data['maesurename']?></font></td>
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


