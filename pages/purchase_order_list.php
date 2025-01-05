
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Purchase Order |
                    <small>
                        Purchase Order List
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
                  <h2>Purchase Order List <small></small></h2>
                 
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
                              <th>No PO</th>
                              <th>To(Vendor)</th>
                               <th>Reff Number</th>
                              <th>Date PO</th>
							  <th>MR Number</th>
                             <th>Subject</th>
                             <th>PIC Created</th>
                              <th>Direksi Status</th>
                              <th>Date Status</th>
                              
                             <th>Status</th>
                          
                                <th>PO Detail</th>
							  
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewPOhead() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['number_po']; ?></td>
		<td><?php echo $x['vendor_name']; ?></td>
		<td><?php 
			 echo $x['reff_number']; ?></td>
		<td><?php echo $x['date_po']; ?></td>

<td><?php echo $x['mr_number']; ?></td>
<td><?php echo $x['subject']; ?></td>
<td><?php echo $x['first_name']; ?></td>
<td><?php echo $x['status1']; ?></td>
<td><?php echo $x['date_status1']; ?></td>
<td><?php if ($x['status_po']==0){ ?>
                          
                 <span class="label label-warning">Pending</span>
                 
                 <?php }else if($x['status_po']==1){?>
                   <span class="label label-primary">Created</span>
                  <?php }else if($x['status_po']==2){?>
                  <span class="label label-success">Approved</span>
                  <?php }else if($x['status_po']==3){?>
                  <span class="label label-danger">Rejected</span>
                  <?php }else if($x['status_po']==4){?>
                   <span class="label label-info">PO Created</span>
                  <?php }?></td>
 
                        	<td>
                	    
                	                 	    <?php 
                	    if ($x['type_req']==4){
                	    
                	    ?>  
			   <a  href="../pages/index.php?pages=add_item_po&po=<?php echo $x['number_po']?>"><span class="fa fa-list"></span></a>
					
			<?php  } else if($x['type_req']==3){?>
			    <a  href="../pages/index.php?pages=add_item_po_asset&po=<?php echo $x['number_po']?>"><span class="fa fa-list"></span></a>
					
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