
  <?php if(($_SESSION['SES_LEVEL']==17)OR($_SESSION['SES_LEVEL']==18)OR($_SESSION['SES_LEVEL']==14)) { ?>    
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Document | 
                    <small>
                       Please insert New Document
                    </small>
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Input New Document <small></small></h2>
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
                  <form action="../controller/process.php?actionDocument=insert" method="post" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">

            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Document Number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtdocnum" placeholder="Document Number" value="<?php echo $_GET['code']?>">
                      </div>
                    </div>
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Document Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  name="txtDocname" placeholder="Document Name">
                      </div>
                    </div>
     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea type="text" class="form-control"  name="txtNotes" placeholder="Notes"></textarea>
                      </div>
                    </div>
					         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="file" name="doc">
                       
                       <br><br>
                      </div> </div>
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
                  <h2>Document List <small></small></h2>
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

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
							   <th>Document Number</th>
                              <th>Document Name</th>
								<th>Document Notes</th>
               	<th>Download</th>
							  <th>Delete</th>
                            </tr>
                          </thead>


                                   <tbody>
                <?php
	$no = 1;
	foreach($db->viewDocument() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['doc_number']; ?></td>
		<td><?php echo $x['doc_name']; ?></td>
		<td><?php echo $x['notes']; ?></td>
		 	<td><a href="<?php echo $x['location']; ?>" download="Doc-<?php echo $x['doc_name']; ?>">
 <span class="fa fa-file"></span>
</a></td>
		<td>
			  <a   href="#DelDocument<?php echo $x['id_doc']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
				     <div id="DelDocument<?php echo $x['id_doc']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Document?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_doc']; ?>&doc=<?php echo $x['location']; ?>&actionDocument=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
	<?php }?>