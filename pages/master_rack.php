

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Rack 
                </h3>
            </div>

    
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Add New Rack <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionRack=insert" method="post" class="form-horizontal form-label-left input_mask">


              <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                     
                                         <select name="txtLocation" class="form-control">
          <option>Select Location</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_location";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_location']."'>".$data['location_name']."</option>";
                 }
          ?>
          </select>
                      </div>
                    </div>
       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Rack Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Rack Name" name="txtRack">
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
                  <h2>Rack List <small></small></h2>
                
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Location Name</th>
							   <th>Rack Name</th>
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>


                                   <tbody>
                <?php
	$no = 1;
	foreach((array)$db->viewRack() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['location_name']; ?></td>
		<td><?php echo $x['rack_name']; ?></td>
        <td>
        <a  href="#updateCon<?php echo $x['id_rack']; ?>" data-id='"<?php echo $x['id_rack'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updateCon<?php echo $x['id_rack']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionRack=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
					  
					  

                      <div class="modal-body">
					  
					  	  	        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                     
                                         <select name="txtLocation" class="form-control">
          <option>Select Location</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_location";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil))
                 {
					 if ($data['id_location']==$x['id_location']) {
						 $cek="selected";
					 } else { $cek=""; }
                    echo "<option value='".$data['id_location']."' $cek>".$data['location_name']."</option>";
                 }
				 
		 
          ?>
          </select>
                      </div>
                    </div>
					  <br>
					  <br>
					  
					  
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Rack Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_rack']; ?>" placeholder="Rack Name" name="id">
                        <input type="text" class="form-control"  value="<?php echo $x['rack_name']; ?>" placeholder="Rack Name" name="txtRack">
                      </div>
                    </div>
				
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
            </form>
                    </div>
                  </div>
                </div>
		<td>
			  <a  href="" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="fa fa-trash"></span></a>
					
		</td>
	</tr>
	<?php 
	}
	?>
                </tbody>


                  </table>
				  
				   <!-- Small modal -->
                

                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Rack?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_rack']; ?>&actionRack=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>
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
	