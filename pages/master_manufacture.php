

    <script src="ajax/item-ajax.js"></script>

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Manufacture| 
                    <small>
                       Please insert New Manufacture
                    </small>
                </h3>
            </div>

   
          </div>
		  
		  
		  
		  
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel" >
                <div class="x_title">
                  <h2>Add New Manufacture<small></small></h2>
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
                  <br />
				 
                  <form action="../controller/process.php?actionManu=insert" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Manufacture Name" name="txtManufacture">
                      </div>
                    </div>

               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Code </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Manufacture Code" name="txtManufacturecode">
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
                  <h2>Manufacture List <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Manufacture Name</th>
							    <th>Manufacture Code</th>
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>
                         <tbody>
                <?php
	$no = 1;
	foreach($db->viewManu() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['manufacture_name']; ?></td>
		<td><?php echo $x['manufacture_code']; ?></td>
        <td>
        <a  href="#updatemanu<?php echo $x['id_manu']; ?>" data-id='"<?php echo $x['id_manu'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updatemanu<?php echo $x['id_manu']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionManu=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Name </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_manu']; ?>" placeholder="Manufacture id" name="id">
                        <input type="text" class="form-control"  value="<?php echo $x['manufacture_name']; ?>" placeholder="Manufacture Name" name="txtManufactureupdate">
                      </div>
                    </div><BR><BR>
					     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Code </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					    <input type="text" class="form-control"  value="<?php echo $x['manufacture_code']; ?>" placeholder="Manufacture Code" name="txtManufacturecodeupdate">
                      </div>
                    </div>
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
			  <a  href="#deltemanu<?php echo $x['id_manu']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
					
		</td>
	</tr>
	<?php 
	}
	?>
                </tbody>

                     

                  </table>
                </div>
				
			
                <!-- Small modal -->
                

                <div id="deltemanu<?php echo $x['id_manu']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Manufacture?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_manu']; ?>&actionManu=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /modals -->
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
	