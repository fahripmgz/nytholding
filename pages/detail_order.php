<?php  $idtrans=$_GET['code'];
                    
$dataSqlgr = "SELECT a.`id`, a.`order_number`, a.`document_number`,a.department, a.pic,a.`notes`,a. `create_date`, a.`create_by`, a.`status` ,b.department_name,c.pic_name,d.pic_name AS approval1,d.pic_name AS approval2,f.status_name FROM `order_list` a LEFT JOIN department b on a.department=b.id
LEFT JOIN master_pic c on a.pic=c.id
LEFT JOIN master_pic d on a.approval_1=d.id
LEFT JOIN master_pic e on a.approval_2=d.id
LEFT JOIN master_status_gr f on a.status=f.id
WHERE a.order_number='$idtrans'";
$dataQrygr = mysqli_query($conn,$dataSqlgr) or die ("Gagal Query".mysqli_error());
$xm = mysqli_fetch_array($dataQrygr);
$dn=$xm['document_number'];
$statusLabelClassGR = match($xm['status_name']) {
                                            'On Process' => 'label label-warning',
                                            'Created' => 'label label-success',
                                            'Reject' => 'label label-danger',
                                             'Confirm' => 'label label-info',
                                            default => ''
                                        };
                                        

    
                    ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><b>
                    Outbound</b> |
                <small>
                     Order
                </small>
            </h3>
        </div>
    </div>
         

                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Order Details <small></small></h2>
              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
<form method="post" class="form-horizontal form-label-left input_mask">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="receiptNumber" class="col-sm-4 control-label">Order Number</label>
                    <div class="col-sm-8">
                      <p class="form-control-static"> <b>  <?=$xm['order_number'];?></b></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deliveryNumber" class="col-sm-4 control-label">Delivery Number</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['document_number'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptType" class="col-sm-4 control-label">Department</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['department_name'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="documentNumber" class="col-sm-4 control-label">PIC</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"> <?=$xm['pic_name'];?>
                    </div>
                </div>
               
            </div>

            <div class="col-xs-6">
        
                <div class="form-group">
                    <label for="receiptBy" class="col-sm-4 control-label">Order By</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_by'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptDate" class="col-sm-4 control-label">Create Date</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_date'];?></p>
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
                 <h2>Add Item Order (Manual)<small></small></h2>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    
          <div class="clearfix">
                  
               
               <br>       
                    
  <form action="../controller/process.php?actionItemOrder=insert" method="post" class="form-horizontal form-label-left input_mask">
                <div class="col-md-12">
                 <div class="row">
                       <div class="col-md-2">
 <div class="form-group">
    <div class="col-sm-12">
         <input type="text" id="itemcode" name="itemcode" class="form-control" >
        <input type="hidden" class="form-control" value="<?=$idtrans;?>" name="txtOrder">
    </div>
</div>
</div>
     <div class="col-md-10">
  <div class="form-group" id="measurementGroup" style="display: none;">
    <div class="col-sm-4">
            <input type="text" id="item_name" class="form-control" readonly>
    </div>
 
              <div class="col-sm-2">
            <input type="text" id="measurement" class="form-control" readonly>
    </div>    
      <div class="col-sm-2">
           <input type="number" class="form-control" id="stock" name="stock" placeholder="Qty Stock" readonly>
    </div>
</div>
</div>
</div>



                 <div class="row">

<div class="col-xs-12">
    
    <div class="col-sm-3">
          <input type="number" class="form-control" name="txtQtyorder" placeholder="Qty Order">
    </div>
        <div class="col-sm-3">
                    <select name="txtUserfor" id="txtUserfor" class="mySelect form-control" required>
                                                <option value="">Select Department</option>
                                                <?php
                                                $query = "SELECT * FROM master_project";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['id']}'>{$data['project_name']}</option>";
                                                }
                                                ?>
                                            </select>
   
        </div>
          <div class="col-sm-4">
           <textarea type="text" class="form-control" id="txtNotes" name="txtNotes"></textarea>
    </div>
        <div class="col-sm-2">
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
        <a href="../notes/order_detail.php?code=<?=$idtrans;?>" target="_BLANK"class="btn btn-custom">Download Item Order Report</a>
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
							       <th>Qty</th>
							        <th>Measurement</th>
							          <th>Project Name</th>
							        <th>Notes</th>
							           
							            <?php if($xm['status']=='1'){?>
							  <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach((array)$db->viewOrderdetail($idtrans) as $x){
	  

	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['spec']; ?></td>
			<td><?php echo $x['qty']; ?></td>
           		<td><?php echo $x['maesurename']; ?></td>
           		<td><?php echo $x['project_name']; ?></td>
			<td><?php echo $x['notes']; ?></td>
		
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
                        <a  href="../controller/process.php?id=<?php echo $x['id']; ?>&code=<?php echo $idtrans; ?>&actionItemOrder=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
        <a href="../controller/process.php?id=<?php echo $idtrans ?>&actionItemOrder=save" class="btn btn-custom">Save</a>
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
		
		
	