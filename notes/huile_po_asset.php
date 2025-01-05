
<?php
session_start();
include_once "../lib/config.php";

$po=$_GET['po'];

$sqlquery=mysql_query("select * from purchase_order_asset_tmp a  left join master_maesurement c on a.maesurement=c.id_mae where a.no_po='$po' ORDER BY a.id_item_po ASC  ");


?>

	  <div class="table-responsive">
<table class="table table-striped table-bordered" >
<thead>
<tr bgcolor='#ffffff'>
<td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;NO</b></font></td>
<td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;QTY</b></font></td>
<td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;DESCRIPTION</b></font></td>
<td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;UNIT PRICE</b></font></td>
<td align='center' style='padding: 5px;'><font size='1' ><b>&nbsp;TOTAL PRICE</b></font></td>
</tr>
   </thead>
                  
                  
                  <tbody>
<?php
$no=1;

while($data = mysql_fetch_array($sqlquery)){
    
    
     $price=$data['price'];
	 $qty=$data['qty'];
	 $totalprice=$price*$qty;
	 $grandtotal=$totalprice+$grandtotal;
	 $afterdisc= $grandtotal-$qr['total_discount'];
	 $ppn=$qr['ppn'];
	 
	 if ($ppn=='0'){
	 $afterppn=0;   
	 }else{
	 $afterppn=$afterdisc*$ppn/100;
	 }
    
?>

<tr>

<td align='center'><font size='2'>&nbsp;<?=$no?></font></td>
<td align='center'><font size='2'>&nbsp;<?=$data['qty']?></font></td>

<td><font size='2'>&nbsp;<?=$data['item_name']?>(<?=$data['specification']?>)</font>&nbsp;&nbsp;<font></font></td>

<td a align='right'><font size='2' align='right'>&nbsp;<?=number_format($data['price'],1)?></font></td>
<td align='right'><font size='2' align='right'>&nbsp;<?=number_format($totalprice,1)?></font></td>
</tr>
<tr>
<td colspan="2" style='padding: 5px;' align='left'>
<font size='2'  >Notes :</font>
</td>
<td  style='padding: 5px;' align='left'>
<font size='2' align='left' ><?=$data['notes']?></font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='left' ></font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='left' ></font>
</td>
</tr>

    

<?php
$no++; } ?>

<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2'  >SUB TOTAL</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='right' ><?=number_format($grandtotal,2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2' align='right' >DISCOUNT</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='right' ><?=number_format($qr['total_discount'],2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2' align='right' >AFTER DICOUNT</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='right' ><?=number_format($grandtotal-$qr['total_discount'],2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2' align='right' >PPN%</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='right' ><?=number_format($afterppn) ?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2' align='right' >TRANSPORT</font>
</td>
<td  style='padding: 5px;' align='right' align='right'>
<font size='2' align='right' ><?=number_format($qr['transport_price']) ?></font>
</td>
</tr>

<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='2' align='right' >GRAND TOTAL</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='2' align='right' ><?=number_format($qr['transport_price']+$afterppn+$grandtotal-$qr['total_discount'],2)?></font>
</td>
</tr>
</table>
<table class="table" style="border-collapse: collapse; border: none;" >


<tr>
<td colspan="5">
<font size='1'><?=$qr['info'] ?></font>
</td>

</table>
<table class="table" style="border-collapse: collapse; border: none;" >



<tr>
&nbsp;<br>
<td width='25%'><font size='1'>&nbsp;Kind Regards <br>PT. Audemars Indonesia</font>

<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>

&nbsp;<br>
&nbsp;<font size='1'>Manager Procurement</font>
<br>

&nbsp;<br>
&nbsp;<font size='1'><?=ucfirst($qr['status1'])?></font>

&nbsp;<br>		


</td>

&nbsp;<br>

<td width='25%'>&nbsp;<font size='1'><?=$qr['vendor_name']?></font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>

&nbsp;<br>
&nbsp;<font size='1'><?=$qr['attn']?> </font>
<br>

&nbsp;<br>
&nbsp;

&nbsp;<br>		


</td>
</tr>

   </tbody>
 

</table>

</div>
<br>



<br><br>


