
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Material Request |
                    <small>
                         Material Request List
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
                  <h2>Material Request List <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                        
                      <div class="card-box table-responsive">
                      

                                     <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>No MR</th>
                                <th>Type</th>
                              <th>Date Register</th>
                               <th>Location Request</th>
                              <th>Pic Request</th>
							 
                             <th>Notes</th>
                               <th>Status</th>
                                <th>Detail Item</th>
					
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewMRheadlist() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['no_mr']; ?></td>
				<td><?php echo $x['type_name']; ?></td>
		
		<td><?php echo $x['date_register']; ?></td>
		<td><?php 
		 $query = "SELECT * FROM master_site where id_site='".$x['location_request']."'";
                 $hasil = mysqli_query($conn,$query);
                 $data = mysqli_fetch_array($hasil);
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
                  <?php }else if($x['status']==5){?>
                   <span class="label label-danger">MR Void</span>
                  <?php }else if($x['status']==6){?>
                   <span class="label label-warning">MR Revised</span>
                  <?php }?></td>
       
        
                	<td>
                	    <?php 
                	    if ($x['type_mr']==4){
                	    
                	    ?>  
			  <a  href="../pages/index.php?pages=add_item_request&mr=<?php echo $x['no_mr']?>"><span class="fa fa-plus"></span></a>
			<?php  } else if($x['type_mr']==3){?>
			    <a  href="../pages/index.php?pages=add_item_request_asset&mr=<?php echo $x['no_mr']?>"><span class="fa fa-plus"></span></a>
		<?php	  }?>
			  
	
			  
					
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
       <!-- Small modal -->
                

                </div>
                </div>
          </div>
     <?php
      include("jscript/datatables.php");
     ?>