<?php  $idtrans=$_GET['code'];
                    
$dataSqlgr = "SELECT a.id, a.receipt_number,a.status, a.delivery_number, a.document_number, a.notes, a.receipt_date, a.receipt_by, b.type_name, c.site_name, a.status,d.status_name,e.vendor_name FROM good_receipt a LEFT JOIN receipt_type b ON a.receipt_type = b.id LEFT JOIN master_site c ON a.receipt_at = c.id_site LEFT JOIN master_status_gr d ON a.status = d.id LEFT JOIN master_vendor e on a.vendor=e.id_vendor  where a.receipt_number='$idtrans'";
$dataQrygr = mysqli_query($conn,$dataSqlgr) or die ("Gagal Query".mysqli_error());
$xm = mysqli_fetch_array($dataQrygr);
$dn=$xm['document_number'];
$statusLabelClassGR = match($xm['status_name']) {
                                            'On Process' => 'label label-warning',
                                            'Created' => 'label label-success',
                                            'Reject' => 'label label-danger',
                                            default => ''
                                        };
                                        

    
                    ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><b>
                    Inbound</b> |
                <small>
                     Good Receipt
                </small>
            </h3>
        </div>
    </div>
         

                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Good Receipt Details <small></small></h2>
              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
<form method="post" class="form-horizontal form-label-left input_mask">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="receiptNumber" class="col-sm-4 control-label">Receipt Number</label>
                    <div class="col-sm-8">
                      <p class="form-control-static"> <b>  <?=$xm['receipt_number'];?></b></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliveryNumber" class="col-sm-4 control-label">Delivery Number</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['delivery_number'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptType" class="col-sm-4 control-label">Receipt Type</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['type_name'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="documentNumber" class="col-sm-4 control-label">Document Number</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"> <?=$xm['document_number'];?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vendorname" class="col-sm-4 control-label">Vendor Name</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"> <?=$xm['vendor_name'];?></p>
                    </div>
                </div>
            </div>

            <div class="col-xs-6">
                <div class="form-group">
                    <label for="receiptAt" class="col-sm-4 control-label">Receipt At</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"> <?=$xm['site_name'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptBy" class="col-sm-4 control-label">Receipt By</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['receipt_by'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptDate" class="col-sm-4 control-label">Date</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['receipt_date'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes" class="col-sm-4 control-label">Notes</label>
                    <div class="col-sm-8 ">
                       <p class="form-control-static"> <?=$xm['notes'];?></p>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="notes" class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-8 ">
                      <h2> <span class="<?php echo $statusLabelClassGR; ?>"><?php echo $xm['status_name']; ?></span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
     
            <br>
			     
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if($xm['status']=='1'){?>
              <div class="x_panel">
                <div class="x_title">
                 <h2>Add Item Receipt Details (Manual)<small></small></h2>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    
          <div class="clearfix">
                        <br>
                                    <div class="text-right">         <p>
                    <a class="btn btn-custom" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Partial Items</a></p></div>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
        <ul class="list-group">
          <h4>Item received with previous Purchase number</h4>
          <?php
          $dataSqlgr2 = "SELECT a.id, a.receipt_number, a.status, a.delivery_number, a.document_number, a.notes, a.receipt_date, a.receipt_by, b.type_name, c.site_name, a.status, d.status_name, e.vendor_name 
                         FROM good_receipt a 
                         LEFT JOIN receipt_type b ON a.receipt_type = b.id 
                         LEFT JOIN master_site c ON a.receipt_at = c.id_site 
                         LEFT JOIN master_status_gr d ON a.status = d.id 
                         LEFT JOIN master_vendor e ON a.vendor = e.id_vendor  
                         WHERE a.document_number = '$dn' AND a.status='2'";

          $dataQrygr2 = mysqli_query($conn, $dataSqlgr2) or die ("Gagal Query" . mysqli_error($conn));

          // Fetching the data for good receipts
          while ($xm2 = mysqli_fetch_array($dataQrygr2)) {
            $receiptnumber = $xm2['receipt_number'];
            $delnumber = $xm2['delivery_number'];

            // Query to get item details for the current receipt number
            $dataItemgr = "SELECT a.id, a.item_code, a.qty_do, a.qty_receipt, a.notes, b.item_name, b.spec, b.maesurename, a.create_date, a.create_by 
                           FROM item_received a 
                           LEFT JOIN view_catalog b ON a.item_code = b.item_code 
                           WHERE a.gr_number = '$receiptnumber'
                           ORDER BY a.id DESC;";

            $dataItemGr = mysqli_query($conn, $dataItemgr) or die ("Gagal Query" . mysqli_error($conn));
            
            // Fetch all rows using a while loop and check for discrepancies
  while ($xmt = mysqli_fetch_array($dataItemGr)) {
    $outstanding_qty = $xmt['qty_do'] - $xmt['qty_receipt'];

    if ($outstanding_qty > 0) {
        echo "<li class='list-group-item'>";
        echo "Item Code: " . $xmt['item_code'] . " - " . $xmt['item_name'] . "<br>";
        echo "Delivery Note: " . $xm2['document_number'] . "<br>";
         echo "Good Receipt Number: " . $xm2['receipt_number']  . "<br>";
        echo "Outstanding Quantity: " . $outstanding_qty . "<br>";
        echo "</li>";
    } else {
        // Item fully received
        echo "<li class='list-group-item'>";
        echo "Item Code: " . $xmt['item_code'] . " - " . $xmt['item_name'] . "<br>";
         echo "Delivery Note: " . $xm2['document_number'] . "<br>";
         echo "Good Receipt Number: " . $xm2['receipt_number']  . "<br>";
        echo "All quantities received";
        echo "</li>";
    }
}

          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
                         
    
                    </div>
               
               <br>       
                    
  <form action="../controller/process.php?actionItemGR=insert" method="post" class="form-horizontal form-label-left input_mask">
                <div class="col-xs-12">
                 <div class="row">
                     <div class="col-xs-4">
    
 <div class="form-group">
    <label class="col-sm-6 control-label">Item Code </label>
    <div class="col-sm-6">
        <select name="itemcode" id="itemcode" class="mySelect form-control" style="width: 100%;">
            <option value="0">-select Item-</option>
            <?php
                $query = "SELECT * FROM master_catalog";
                $hasil = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_array($hasil)) {
                    echo "<option value='" . $data['item_code'] . "'>" . $data['item_code'] .  "</option>";
                }
            ?>
        </select>
    </div>
</div>
</div>
<div class="col-xs-8">
    <div class="form-group" id="measurementGroup" style="display: none;">
    <div class="col-sm-6">
            <input type="text" id="item_name" class="form-control" readonly>
    </div>
        <div class="col-sm-3">
            <input type="text" id="measurement" class="form-control" readonly>
    </div>
</div>
</div>

</div>


                 <div class="row">
                     <div class="col-xs-4">
    
 <div class="form-group">
    <label class="col-sm-6 control-label">QTY D.O </label>
    <div class="col-sm-6">
          <input type="hidden" class="form-control" value="<?=$idtrans;?>" name="txtGrnumber">
      <input type="number" class="form-control" name="txtQtyDO" placeholder="Qty by DO">
    </div>
</div>
</div>
<div class="col-xs-8">
    
    <div class="col-sm-3">
          <input type="number" class="form-control" name="txtQtyReceipt" placeholder="Qty Receipt">
    </div>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="txtNotes" placeholder="Remark">
   
        </div>
        <div class="col-sm-3">
        	<button type="submit" class="btn btn-custom">Submit</button>
          </div>
</div>

</div>


</div>

  </form>
 
  <br>
     <div class="x_title">
                
    </div>
    
</div>
                </div>
                
                 <?php }?>
   <div class="x_title">
                  <h2>List Of Item <small></small></h2>
              
                  <div class="clearfix"></div>
                    <div class="text-right">
        <a href="../notes/good_receipt.php?gr_number=<?=$idtrans;?>" target="_BLANK"class="btn btn-custom">Download Item Received Report</a>
    </div>
                </div>

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
							   <th>Item Code</th>
							    <th>Item Name</th>
							     <th>Specification</th>
							       <th>Qty D.0</th>
							        <th>Qty Receipt</th>
							        <th>Measurement</th>
							        <th>Notes</th>
							        <th>Receipt by</th>
							          <th>Receipt Date</th>
							            <th>Status</th>
							            <?php if($xm['status']=='1'){?>
							  <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach((array)$db->viewGoodreceiptdetail($idtrans) as $x){
	    
	    // Calculate the difference
        $qtyDo = $x['qty_do'];
        $qtyReceipt = $x['qty_receipt'];
               
        // Determine status and label
        if ($qtyReceipt == 0) {
            $statusLabelClass = 'label label-danger'; // Red
            $statusText = 'Pending Receipt';
        } elseif ($qtyReceipt == $qtyDo) {
            $statusLabelClass = 'label label-success'; // Green
            $statusText = 'Receipts Matched';
        } elseif ($qtyReceipt < $qtyDo) {
            $statusLabelClass = 'label label-warning'; // Orange
            $statusText = 'Partial Receipt';
        }

       
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['spec']; ?></td>
	<td><?php echo $qtyDo; ?>(<?php echo $qtyDo - $qtyReceipt; ?>)</td>
            <td><?php echo $qtyReceipt; ?>(<?php echo $qtyReceipt - $qtyDo; ?>)</td>
           		<td><?php echo $x['maesurename']; ?></td>
			<td><?php echo $x['notes']; ?></td>
				<td><?php echo $x['create_by']; ?></td>
					<td><?php echo $x['create_date']; ?></td>
						<td>
                <span class="<?php echo $statusLabelClass; ?>"><?php echo $statusText; ?></span>
            </td>
     
		 
                <?php if($xm['status']=='1'){?>
                	       <td>
                         <a  href="#deleteItem<?php echo $x['id']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
                      </td> 
		         <?php }?>
			       <div id="deleteItem<?php echo $x['id']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Item?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id']; ?>&actionItemGR=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>		
	
	</tr>
	<?php 
	}
	?>
                </tbody>
                  </table>
				  	 
                <!-- Small modal -->
                

         
                <!-- /modals -->
                </div>
              
                </div>
                
                
              </div>
            </div>
             <?php if($xm['status']=='1'){?>
              <div class="x_panel">
                   <div class="text-right">
        <a href="../controller/process.php?id=<?php echo $idtrans ?>&actionGR=save" class="btn btn-custom">Save</a>
    </div>
     </div>
     <?php }?>
     
          </div>
    <?php
      include("jscript/datatables.php");
     ?>
        </div>
		<br>
		<br>
		<br>
		<br>
		
		
	