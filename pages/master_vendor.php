
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Vendor
                </h3>
            </div>

          
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Add New Vendor <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionven=insert" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Vendor Name" name="txtVendor">
                      </div>
                    </div>
                    
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Address" name="txtAddress">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Phone" name="txtPhone">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Fax" name="txtFax">
                      </div>
                    </div>
                    
  
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Email" name="txtEmail">
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                         <button type="submit" class="btn btn-primary">Cancel</button>
                      	<button type="submit" class="btn crud-submit btn-success">Submit</button>
                      </div>
                    </div>
           
                    <div class="ln_solid"></div>
               

                  </form>
                </div>
              </div>
            </div>
			
			     
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Vendor List <small></small></h2>
               
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Vendor Name</th>
                                <th>Address</th>
                                  <th>Phone</th>
                                    <th>Fax</th>
                                      <th>Email</th>
                                       
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>


                                   <tbody>
                <?php
	$no = 1;
	foreach((array)$db->viewVen() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['vendor_name']; ?></td>
			<td><?php echo $x['address']; ?></td>
				<td><?php echo $x['phone']; ?></td>
					<td><?php echo $x['fax']; ?></td>
						<td><?php echo $x['email']; ?></td>
					
        <td>
        <a  href="#updateVend<?php echo $x['id_vendor']; ?>" data-id='"<?php echo $x['id_vendor'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updateVend<?php echo $x['id_vendor']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionven=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Name </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_vendor']; ?>" placeholder="Currency Name" name="id">
                        <input type="text" class="form-control"  value="<?php echo $x['vendor_name']; ?>" placeholder="Vendor Name" name="txtVendor">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Address </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  
                        <input type="text" class="form-control"  value="<?php echo $x['address']; ?>" placeholder="Address Name" name="txtAddress">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  
                        <input type="text" class="form-control"  value="<?php echo $x['phone']; ?>" placeholder="Phone" name="txtPhone">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax </label>
                      <div class="col-md-12 col-sm-12 col-xs-12" >
		
                        <input type="text" class="form-control"  value="<?php echo $x['fax']; ?>" placeholder="Fax" name="txtFax">
                      </div>
                    </div>
                    
                             <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Email </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
		
                        <input type="text" class="form-control"  value="<?php echo $x['email']; ?>" placeholder="Email" name="txtEmail">
                      </div>
                    </div>
                             <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> &nbsp; </label>
                      <div class="col-md-12 col-sm-12 col-xs-12" align="right">
		
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
				   <div class="modal-footer">
                       &nbsp;
                      </div>
                      </div>
                   
            </form>
                    </div>
                  </div>
                </div>
                
                	       <td>
					    <?php	$qC=mysqli_query($conn,"SELECT count(*) as jum FROM purchase_order T where T.to='".$x['id_vendor']."'") or die(mysql_error());
																$qrC=mysqli_fetch_array($qC);
																if ($qrC['jum']==0) {
																?>
                         <a  href="#deleteVendor<?php echo $x['id_vendor']; ?>" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="fa fa-trash"></span></a>
				<?php } else {
																echo "<span class='label label-warning'>In Use</span>";
																	
																} ?>
                      </td> 
                
	        <div id="deleteVendor<?php echo $x['id_vendor']; ?>"class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Vendor?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_vendor']; ?>&actionven=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
          </div>
    <?php
      include("jscript/datatables.php");
     ?>
        </div>
		<br>
		<br>
		<br>
		<br>
	