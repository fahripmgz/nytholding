    <style>
    table.custom {
 
    font-size: 12px;
    }

    .super_script {
    font-size: 80%;
    vertical-align: super;
    }

    </style>
<?php
session_start();
include_once "../lib/config.php";

$po=$_GET['po'];

$sqlquery=mysql_query("select * from item_purchase_order_tmp a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_po='$po' ORDER BY a.id_item_po ASC  ");


?>

	  <div class="table-responsive">
<table class="table custom table-striped table-bordered" >
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

<td align='center'><font size='2'>&nbsp;<?php  echo $no?></font></td>
<td align='center'><font size='2'>&nbsp;<?php  echo $data['qty']?></font></td>

<?php if ($data['item_code']==''){?>
<td><font size='2'>&nbsp;<?=$data['description']?>(<?php  echo $data['spec']?>)</font>&nbsp;&nbsp;<font></font></td>
<?php }else{?>
<td><font size='2'>&nbsp;<?=$data['item_name']?>(<?php  echo $data['specification']?>)</font>&nbsp;&nbsp;<font></font></td>
<?php }?>
<td a align='right'><font size='2' align='right'>&nbsp;<?php  echo number_format($data['price'],2)?></font></td>
<td align='right'><font size='2' align='right'>&nbsp;<?php  echo number_format($totalprice,2)?></font></td>
</tr>


    

<?php
$no++; } ?>
<tr>
<td colspan="2" style='padding: 5px;' align='left'>
<font size='1'  >Notes :</font>
</td>
<td  style='padding: 5px;' align='left'>
<font size='1' align='right' ><?php  echo $data['notes']?></font>
</td>
<td  style='padding: 5px;' align='left'>
<font size='1' align='right' ></font>
</td>
<td  style='padding: 5px;' align='left'>
<font size='1' align='right' ></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1'  >SUB TOTAL</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='1' align='right' ><?php  echo number_format($grandtotal,2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1' align='right' >DISCOUNT</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='1' align='right' ><?php  echo number_format($qr['total_discount'],2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1' align='right' >AFTER DICOUNT</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='1' align='right' ><?php  echo number_format($grandtotal-$qr['total_discount'],2)?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1' align='right' >PPN%</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='1' align='right' ><?php  echo number_format($afterppn) ?></font>
</td>
</tr>
<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1' align='right' >TRANSPORT</font>
</td>
<td  style='padding: 5px;' align='right' align='right'>
<font size='1' align='right' ><?php  echo number_format($qr['transport_price']) ?></font>
</td>
</tr>

<tr>
<td colspan="4" style='padding: 5px;' align='right'>
<font size='1' align='right' >GRAND TOTAL</font>
</td>
<td  style='padding: 5px;' align='right'>
<font size='1' align='right' ><?php  if($qr['total_price']==0.00){

echo number_format($qr['transport_price']+$afterppn+$grandtotal-$qr['total_discount'],2);

}else{
    
 echo number_format($qr['total_price']);  
}




?></font>
</td>
</tr>


</table>
<table class="table" style="border-collapse: collapse; border: none;" >


<tr>
<td colspan="5">
<?php  echo $qr['info'] ?>
</td>

</table>

<table class="table" style="border-collapse: collapse; border: none;" >



<tr>
&nbsp;<br>
<td width='25%'><font size='2'>&nbsp;Kind Regards <br>PT. Audemars Indonesia</font>

<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>

&nbsp;<br>
&nbsp;<font size='2'>Manager Procurement</font>
<br>

&nbsp;<br>
&nbsp;<font size='2'><?php  echo ucfirst($qr['status1'])?></font>

&nbsp;<br>		


</td>

&nbsp;<br>

<td width='25%'>&nbsp;<font size='2'><?php  echo $qr['vendor_name']?></font>
<br>
&nbsp;<br>

&nbsp;<br>
<br>
&nbsp;<br>

&nbsp;<br>
&nbsp;<font size='2'><?php  echo $qr['attn']?> </font>
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


