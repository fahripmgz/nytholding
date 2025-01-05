
<?PHP
$itemcode=$_GET['id'];
?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Stock |
                    <small>
                       Stock List
                    </small>
                </h3>
            </div>

 
          </div>
          <div class="clearfix"></div>
 <br><br>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Stock List <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                        
                      <div class="card-box table-responsive">
                      

                        <table id="datatable-keytable" class="table table-striped table-bordered">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                              <th>Item Name</th>
							   <th>Specification</th>
                           
							     <th>Manufacture</th>
                              <th>Brand</th>
                              <th>Qty</th>
                                <th>Maesurement</th>
                                  <th>Site</th>
                                   <th>Location</th>
                                    <th>Rack</th>
                                     <th>Usage</th>
                        
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach((array)$db->viewStoclist($itemcode) as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
		
	
		<td><?php echo $x['manufacture_name']; ?></td>
		<td><?php echo $x['brand_name']; ?></td>
	
		<td><?php echo $x['qty']; ?></td>
		<td><?php echo $x['maesurename']; ?></td>
		<td><?php echo $x['site_name']; ?></td>
		<td><?php echo $x['location_name']; ?></td>
		<td><?php echo $x['rack_name']; ?></td>
		<td>
        <a  href="#usage<?php echo $x['id_stock_loc']; ?>" data-id='"<?php echo $x['id_stock_loc'];?>"' data-toggle="modal"><span class="fa fa-search"></span></a>
		
			   
		
		
        </td>
    
		 <div id="usage<?php echo $x['id_stock_loc']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
             <form action="../controller/process.php?actionStocklistusage=Usaged" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Usage Item</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Code </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                           <input type="hidden" class="form-control"  value="<?php echo $_GET['mnp']; ?>" placeholder="Level Name" name="txtMnp">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_stock_loc']; ?>" placeholder="Level Name" name="id" readonly>
                       <input type="text" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Level Name" name="idcode" readonly>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <input type="text" class="form-control"  value="<?php echo $x['item_name']; ?>" placeholder="Item Name" name="txtItemname" readonly>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['part_number']; ?>" placeholder="Part Number" name="txtPartnumber" readonly>
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtSpecification" readonly><?php echo $x['specification']; ?></textarea>
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['manufacture_name']; ?>" placeholder="Manufacture" name="txtPartnumber" readonly>
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['brand_name']; ?>" placeholder="Brand" name="txtPartnumber" readonly>
                      </div>
                    </div>
                      
                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">remark </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <textarea class="form-control" rows="3"  name="txtSpecification" readonly><?php echo $x['remark']; ?></textarea>
                      </div>
                    </div>
                    
                    
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Stock Qty </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="number" class="form-control"  value="<?php echo $x['qty']; ?>" placeholder="Total Qty" name="txtQty" readonly>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Qty Planning </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <?php 
					  
					     	$dataSqlmnp2 = "select * from item_manufacture   where no_mnp='".$_GET['mnp']."' AND item_code='".$x['item_code']."'";
							$dataQrymnp2 = mysqli_query($conn,$dataSqlmnp2) or die ("Gagal Query".mysqli_error());
							$xmnp2 = mysqli_fetch_array($dataQrymnp2);
		
			   
			   ?>
                       <input type="text" class="form-control"  value="<?php echo $xmnp2['qty']; ?>" placeholder="Total Qty Request" name="txtQty" readonly>
                 
                      </div>
                    </div>
                    
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Qty Used </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <?php 
					 
			   
					  
			   	$dataSqlmnp1 = "select *,SUM(qty) as totalqty from material_usage   where no_mnp='".$_GET['mnp']."' AND item_code='".$x['item_code']."'";
							$dataQrymnp1 = mysqli_query($conn,$dataSqlmnp1) or die ("Gagal Query".mysqli_error());
							$xmnp1 = mysqli_fetch_array($dataQrymnp1);
		
			   
			   ?>
                       <input type="text" class="form-control"  value="<?php echo $xmnp1['totalqty']; ?>" placeholder="Total Qty Used" name="txtQty" readonly>
                 
                      </div>
                    </div>
                    
                           <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty Use </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
		
                       <input type="text" class="form-control"  value="" placeholder="Qty" name="txtQtyusage">
                  
                      </div>
                    </div>
                    
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Maesurement </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['maesurename']; ?>" placeholder="Maesurement" name="txtMae" readonly>
                      </div>
                    </div>
                    
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 <input type="text" class="form-control"  value="<?php echo $x['site']; ?>" placeholder="Maesurement" name="txtSite" readonly>
                       <input type="text" class="form-control"  value="<?php echo $x['site_name']; ?>" placeholder="Maesurement" readonly>
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 	 <input type="text" class="form-control"  value="<?php echo $x['location']; ?>" placeholder="Maesurement" name="txtLocation" readonly>
                       <input type="text" class="form-control"  value="<?php echo $x['location_name']; ?>" placeholder="Maesurement"  readonly>
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Rack </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 	 <input type="hidden" class="form-control"  value="<?php echo $x['id_rack']; ?>" placeholder="Maesurement" name="txtRack" readonly>
                       <input type="text" class="form-control"  value="<?php echo $x['rack_name']; ?>" placeholder="Maesurement"  readonly>
                      </div>
                    </div>
                    
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <textarea class="form-control" rows="3"  name="txtNotes" readonly></textarea>
               
                      </div>
                    </div>
                    
                    
           <div class="modal-footer">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp; </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-primary">Use Now</button>
                      </div>
                    </div>
                        
                      </div>
                    </form>
                
     
                    </div>
                  </div>       
               </div> </div></div>
    
			
	</tr>
	<?php 
	}
	?>
                          </tbody>

                        </table>
                      </div>
                    </div>
                  </div>
                </div>
       <!-- Small modal -->
                

                </div>
                </div>
          </div>
     <?php
      include("jscript/datatables.php");
     ?>