

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Level 
                </h3>
            </div>

            
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Input New Level <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionLevel=insert" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Level Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Level Name" name="txtLevel">
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Code Level </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Code Level" name="txtcodLevel2">
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
                  <h2>Level List <small></small></h2>
                
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Level Name</th>
                         <th>Code level</th>
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>


                                   <tbody>
                <?php
	$no = 1;
	foreach($db->viewLevel() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['level_name']; ?></td>
		<td><?php echo $x['code_level']; ?></td>
        <td>
        <a  href="#updateLev<?php echo $x['id_level']; ?>" data-id='"<?php echo $x['id_level'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updateLev<?php echo $x['id_level']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionLevel=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Level Name </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_level']; ?>" placeholder="Level Name" name="id">
                        <input type="text" class="form-control"  value="<?php echo $x['level_name']; ?>" placeholder="Level Name" name="txtLevelupdate">
                      </div>
                    </div>
			      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Code Level </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  
                      <input type="text" class="form-control"  name="txtcodLevelupdate2"  value="<?php echo $x['code_level']?>" placeholder="Code Level">
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
			  <a  href="#deleteLev<?php echo $x['id_level']; ?>" data-toggle="modal"><span class="fa fa-trash"></span></a>
				          <div id="deleteLev<?php echo $x['id_level']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Level?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_level']; ?>&actionLevel=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>	
		</td>
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
	