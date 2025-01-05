<?php
session_start();
?>  <link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />


	 
  <script type="text/javascript">
           $(document).ready(function(){
 
           	  
           	   $("#category").change(function(){
                     var category=$("#category").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_category.php",
           	   	     	data:"category="+category,
           	   	     	success:function(data){
                              $("#subcat").html(data);
           	   	     	}
           	   	     });
           	   });
			   
			    $("#txtsite").change(function(){
                     var txtsite=$("#txtsite").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_location.php",
           	   	     	data:"txtsite="+txtsite,
           	   	     	success:function(data){
                              $("#location").html(data);
           	   	     	}
           	   	     });
           	   });
			   
			   
			       $("#location").change(function(){
                     var location=$("#location").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_rack.php",
           	   	     	data:"location="+location,
           	   	     	success:function(data){
                              $("#rack").html(data);
           	   	     	}
           	   	     });
           	   });
           });
      </script>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                   Material Request
                    <small>
                       
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Create  Material Request<small></small></h2>
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
                  <form action="../controller/process.php?actionMRhead=insertmr" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Material Request Code</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
							<?php 
							$dataSqlJ = "select substring(no_mr,9,7) as asd from material_request order by asd desc limit 1";
							$dataQryJ = mysql_query($dataSqlJ) or die ("Gagal Query".mysql_error());
							$dataRowJ = mysql_fetch_array($dataQryJ);
							$num=$dataRowJ['asd'];
							$numnow=$num+1;	
							$fzeropadded = sprintf("%07s", $numnow);
							$label="MR";
							$txtAssetCode = $label.date('ymd').$fzeropadded;
							?>
                        <input type="text" class="form-control"  name="txtnoMR" placeholder="Code" value="<?=$txtAssetCode?>" readonly>
                      </div>
                    </div>

                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location Request </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="txtLocationReq"  class="select2_single form-control" tabindex="-1" >
          <option>-select Location-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_site";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_site']."'>".$data['site_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">PIC Request</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtPICreq" value="<?php  echo $_SESSION['SES_LOGIN']?>" placeholder="PIC Request">
                      </div>
                    </div>
			
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Request</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <?php
                          $date=date("Y-m-d");
                          
                          ?>
                        <input type="text" class="form-control" name="txtdateReg" value="<?php  echo $date ?>" placeholder="Date Request">
                      </div>
                    </div>
                        

           
                    <div class="ln_solid"></div>
               
                </div>
              </div>
            </div>
			
			     <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2><small></small></h2>
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
                

					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtNotesmr" placeholder='Notes'></textarea>
                      </div>
                    </div>
				
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        
                        	  <a  href="#Request"  data-toggle="modal">  <button  class="btn btn-primary">Create MR</button></a>
			 <div  id="Request" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Create MR?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Create MR</button>  </div>

                    </div>
                  </div>
                </div>
                        
                        
						
                      </div>
                    </div>

                  </form>
		
		    
                </div>
                   <br><br>
              </div>
            </div>
			
			
	
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Last Insert Material Request<small></small></h2>
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
                              <th>No MR</th>
                              <th>Date Register</th>
                               <th>Location Request</th>
                              <th>Pic Request</th>
							 
                             <th>Notes</th>
                               <th>Status</th>
                               <th>Edit</th>
                                <th>Add Item</th>
							     <th>Delete</th>
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewMRhead() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['no_mr']; ?></td>
		<td><?php echo $x['date_register']; ?></td>
		<td><?php 
		 $query = "SELECT * FROM master_site where id_site='".$x['location_request']."'";
                 $hasil = mysql_query($query);
                 $data = mysql_fetch_array($hasil);
					 echo $data['site_name']; ?></td>
		<td><?php echo $x['pic_request']; ?></td>
			<td><?php echo $x['notes']; ?></td>
<td><?php if ($x['status']==0){ ?>
                          
                 <span class="label label-warning">Pending</span>
                 
                 <?php }else if($x['status']==1){?>
                   <span class="label label-primary">Created</span>
                  <?php }else if($x['status']==2){?>
                  <span class="label label-success">Approved</span>
                  <?php }else if($x['status']==3){?>
                  <span class="label label-danger">Rejected</span>
                  <?php }else if($x['status']==4){?>
                   <span class="label label-info">PO Created</span>
                  <?php }
                  else if($x['status']==5){?>
                   <span class="label label-info">PO Created</span>
                  <?php } else if($x['status']==6){?>
                   <span class="label label-warning">P0 Revision</span>
                  <?php }?></td>
        <td>
            
        <?php if ($x['status']==0) { ?>    
        <a  href="#updateMRhead<?php echo $x['id_mr']; ?>" data-id='"<?php echo $x['id_mr'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		<?php }else{?>
		<span class="fa fa-edit"></span>
		<?php }?>
			   
		
		
        </td>
        
		 <div id="updateMRhead<?php echo $x['id_mr']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionMRhead=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_mr']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo $x['no_mr']; ?>" placeholder="Level Name" name="txtnumMR">
                        <textarea class="form-control" rows="3" name="txtNotes" placeholder='Notes'><?php echo $x['notes']; ?></textarea>
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
                     	    <?php if ($x['status']==0) { 
                	    if ($x['type_mr']==4){
                	    
                	    ?>  
			  <a  href="../pages/index.php?pages=add_item_request&mr=<?php echo $x['no_mr']?>"><span class="fa fa-plus"></span></a>
			<?php  } else if($x['type_mr']==3){?>
			    <a  href="../pages/index.php?pages=add_item_request_asset&mr=<?php echo $x['no_mr']?>"><span class="fa fa-plus"></span></a>
		<?php	  }?>
			  
			  	<?php }else{?>
	<span class="fa fa-plus"></span>
		<?php }?>
			  
					
		</td>
		<td>
			  <a  href="#DeleteMRhead<?php echo $x['id_mr']; ?>" data-id='"<?php echo $x['id_mr'];?>"' data-toggle="modal"><span class="fa fa-trash"></span></a>
			 <div  id="DeleteMRhead<?php echo $x['id_mr']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Material Request?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_mr']; ?>&actionMRhead=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
                </div>
                </div>
              </div>
            </div>
          </div>

	 
	 
        </div>
	
		 <script src="../js/select/select2.full.js"></script>
  <!-- form validation -->
  <script type="text/javascript" src="../js/parsley/parsley.min.js"></script>
  <!-- textarea resize -->
  <script src="../js/textarea/autosize.min.js"></script>
  <script>
    autosize($('.resizable_textarea'));
  </script>
  <!-- Autocomplete -->
  <script type="text/javascript" src="../js/autocomplete/countries.js"></script>
  <script src="../js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->


  <!-- select2 -->
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Select a Sub Category",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
  </script>