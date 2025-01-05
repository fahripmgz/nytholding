	
	  <?php if ($xs['status_po']==0){ ?>
	
            <div class="clearfix"></div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-align-left"></i> Material Request list <small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <!-- start accordion -->
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h4 class="panel-title">Select MR</h4>
                      </a>
                      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                                 
                        
               <div class="table-responsive">
                     <table id="datatable-keytable" class="table table-striped table-bordered" width="100%">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                              <th>Item Name</th>
							   <th>Specification</th>
							     <th>Qty</th>
                             <th>Maesurement</th>
                              
                              <th>Brand</th>
                    
                               <th>Add</th>
							   
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	$numbermr=$xm['no_mr'];
	foreach($db->viewMRlistforPO($numbermr) as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['no_mr']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
			<td><?php echo $x['qty']; ?></td>
			<td><?php echo $x['maesurename']; ?></td>
	
		<td><?php echo $x['brand_name']; ?></td>
	
	
        <td>
        <a  href="#AddItem<?php echo $x['id_item']; ?>" data-id='"<?php echo $x['id_item'];?>"' data-toggle="modal"><span class="fa fa-plus"></span></a>
		

		
		
        </td>
			 <div id="AddItem<?php echo $x['id_item']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionAddItemPO=insert" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Item To Purchase Order List</h4>
                      </div> 
                      <div class="modal-body">
                           <div class="form-group">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12"><u>MR Number</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 <input type="text" class="form-control"  value="<?php echo $x['no_mr']; ?>" placeholder="No.MR" name="txtNomr" readonly>
                    
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Item Code</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $_GET['po'] ?>" placeholder="Level Name" name="txtPO">
                        <input type="hidden" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Item Code" name="txtItemCode" readonly>
                         <h3> <?php  echo $x['item_code']?></h3>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12"><u>Part Number</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        
                         <h4> <?php  echo $x['part_number']?></h4>
                      </div>
                    </div>
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Item Name</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        
                        <h4> <?php  echo $x['item_name']?></h4>
                      </div>
                    </div>
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Specification</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                      
                          <h4> <?php  echo $x['specification']?></h4>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Maesurement</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                      
                          <h4> <?php  echo $x['maesurename']?></h4>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Qty</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <input type="number" class="form-control"  value="<?php echo $x['qty']?>" placeholder="Qty Request" name="txtQtyrequest">
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Unit Price</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <input type="number" class="form-control"  value="<?php echo $_POST['txtPrice']?>" placeholder="Unit Price" name="txtPrice">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Notes</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotesrequest" readonly><?php echo $x['notes'] ?></textarea>
                      </div>
                    </div>
			    
				<br><Br>
                      <div class="modal-footer">		
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               	<br><Br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
            </form>
                    </div>
                  </div>
                </div>	   

	</tr>
	<?php 
	}
	?>
                          </tbody>

                        </table>  </div>
                        </div>
                      </div>
                    </div>
           
                  </div>
                  <!-- end of accordion -->

  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne">
                       <h4 class="panel-title">Other Item</h4>
                      </a>
                              <div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                              <form action="../controller/process.php?actionAddItemPO=insertother" method="post" class="form-horizontal form-label-left input_mask">
     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $_GET['po'] ?>" placeholder="Level Name" name="txtPO">
                        <input type="text" class="form-control"  value="" placeholder="Item Description" name="txtItemdesc">
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					  
                        <input type="text" class="form-control"  value="" placeholder="Specification" name="txtSpec">
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Unit Price</u></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
					 
                        <input type="text" class="form-control"  value="" placeholder="Unit Price" name="txtUnitprice">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Qty</u> </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                       <input type="number" class="form-control"  value="" placeholder="Qty" name="txtQty">
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Notes</u> </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotesrequest"></textarea>
                      </div>
                    </div>
                       <div class="modal-footer">		
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               	<br><Br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                      </div>
                      </form>
                </div>
                  </div>
            </div>
                 </div>
            </div> 
                
              </div>
            </div>
            <?php }?>