


<?php

$mnp=$_GET['mnp'];
?>
	 
  <script type="text/javascript">
           $(document).ready(function(){

			    $("#site").change(function(){
                     var site=$("#site").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_location.php",
           	   	     	data:"site="+site,
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
               Planning Detail 
                  
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Info<small></small></h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionMRhead=insert" method="post" class="form-horizontal form-label-left input_mask">

    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">CODE : </label>
                       <label><?php echo $mnp ?></label>
                    </div>

              
                    
                    <?php
                    
                    	$dataSqlmr = "select * from manufacture_planning  where code_planning='$mnp'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xm = mysqli_fetch_array($dataQrymr);
                    ?>
                        <div class="form-group">
                        <label for="recipient-name" class="form-control-label">NAME : </label>
                       <label><?php  echo $xm['planning_tittle']?></label>
                    </div>
                   <div class="form-group">
                        <label for="recipient-name" class="form-control-label">DATE : </label>
                        <label>
                       <?php  echo $xm['date_start']?> To <?php  echo $xm['date_finish']?>
                     </label>
                    </div>
                   <div class="form-group">
                        <label for="recipient-name" class="form-control-label">PIC : </label>
                        <label>
                           <?php  echo $xm['pic']?>
                     </label>
                    </div>
			
					  
      
           
                    <div class="ln_solid"></div>
               
                </div>
              </div>
            </div>
			
			     <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2><small></small></h2>
              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                
    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">LOCATION : </label>
                        <label>
                           <?php  echo $xm['manufacture_location']?>
                     </label>
                    </div>
					   
                       <div class="form-group">
                        <label for="recipient-name" class="form-control-label">NOTES : </label>
                        <label>
                           <?php  echo $xm['notes']?>
                     </label>
                    </div>
                       <div class="form-group">
                        <label for="recipient-name" class="form-control-label">STATUS : </label>
                        <label>
                         <?php if ($xm['status']==0){ ?>
                          
                 <span class="label label-warning">Preparing</span>
                 
                 <?php }else if($xm['status']==1){?>
                   <span class="label label-primary">On Progress</span>
                  <?php }else if($xm['status']==2){?>
                  <span class="label label-success">Finish</span>
                  <?php }?>
                     </label>
                    </div>

           
                  

                  </form>
		<div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                       <br><br>
                          <?php if ($xs['status']==1){ ?>
                        	  <a  href="#Approve"  data-toggle="modal">  <button  class="btn btn-success">Approve MR</button></a>
                        	  <a  href="#Reject"  data-toggle="modal">  <button  class="btn btn-danger">Reject MR</button></a>
                        	  				  	<?php
		    if ($_SESSION['SES_LEVEL']==12){
		?>
                        	  <a  href="#Revision"  data-toggle="modal">  <button  class="btn btn-warning">Revison MR</button></a>
                        	  <a  href="#Void"  data-toggle="modal">  <button  class="btn btn-danger">Void MR</button></a>
                        	  <?php }?>
                        	  <?php }?>
			 <div  id="Approve" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
               <form action="../controller/process.php?actionManufacturestatus=Approve&mnp=<?=$_GET['mnp']?>" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Approve Manufacture Planning?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Approve</button>  </div>
</form>
                    </div>
                  </div>
                </div>
                        
                   	 <div  id="Reject" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionManufacturestatus=Reject&mnp=<?=$_GET['mnp']?>" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Reject Manufacturing planning?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Reject</button>  </div>
</form>
                    </div>
                  </div>
                </div>     
					 	 <div  id="Revision" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Revisi?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     <a href="../controller/process.php?actionManufacturestatus=Revision&mnp=<?=$_GET['mnp']?>"> <button type="submit" class="btn btn-warning">Revision</button></a>	
                    </div>
                  </div>
                </div> 	
                      </div>
                      
                            	 <div  id="Void" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionMRstatus=Void&mnp=<?=$_GET['mnp']?>" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Void?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Void</button>  </div>
</form>
                    </div>
                  </div>
                </div> 
                      
                    </div> 
		          </div>
		    
		    
                </div>
                   <br><br>
              </div>
            </div>
			
			
	<?php if (($xm['status']==0)OR($xm['status']==1)){?>
	
            <div class="clearfix"></div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-align-left"></i> Stock List <small>For Manufacturing</small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <!-- start accordion -->
                  
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        
                       	
                      <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnecat" aria-expanded="false" aria-controls="collapseOne">
                       <button type="button" class="btn btn-primary"> <h4 class="panel-title">Open Catalog</h4></button>
                      </a>
             
                      <div id="collapseOnecat" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                                 
                        
               <div class="table-responsive">
                            <table id="assettable" class=" table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                              <th>Item Name</th>
						
                           <th>Specification</th>
                              <th>Category</th>
                              <th>Sub Category</th>
							     <th>Manufacture</th>
                              <th>Brand</th>
                            <th>Measurement</th> 
                             <th>Remark</th>
                            <th>Add To List</th>
                            </tr>
                          </thead>

                        </table>  </div>
                        </div>
                      </div>
                    </div>

                  
                  
                  
                  
              </div>
            </div>
             </div> </div>
         <?php }?>   

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Component to be used<small></small></h2>
                  
         
                  
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
	      <div class="form-group">
                      <div >
                        
                        
                
                        
               <div class="table-responsive">
                   
                  <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                               <th>Item Name</th>
                              <th>Specification</th>
							   <th>Stock In Warehouse</th>
							   
                             <th>Qty Planning</th>
                                
                                 <th >Used</th>
								  <th >Notes</th>
                               
                                 <?php if ($xs['status']==0){ ?>
                               <th>Edit</th>
                              
							     <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>


                          <tbody>
                          <?php
        
    
	$no = 1;
	foreach($db->viewAddItemMnp($mnp) as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
			<td>
			   <?php 
			   	$dataSqlmnp = "select *,SUM(qty) as totalqtystock  from stock_location  where item_code='".$x['item_code']."'";
							$dataQrymnp = mysqli_query($conn,$dataSqlmnp) or die ("Gagal Query".mysqli_error());
							$xmnp = mysqli_fetch_array($dataQrymnp);
							
							
							
					
						
			   
			   ?>
				<?php if (($xm['status']==1)OR($xm['status']==0)){?>
			     	 <a  href="?pages=stock_list_usage&id=<?=$x['item_code']?>&mnp=<?=$_GET['mnp']?>" target="_BLANK"><button type="button" class="btn btn-primary btn-xs"> <?=$xmnp['totalqtystock']?>&nbsp; <?php echo $x['maesurename']; ?></button></a>
				<?php }else{?>
				 <?=$xmnp['totalqtystock']?> &nbsp; <?php echo $x['maesurename']; ?>
				<?php }?>
		     
		       
		   
			</td>
		
			<td bgcolor="#FFFF00"><?php echo $x['qty']; ?></td>
					
		
					<td bgcolor="#FFFF00">
			   <?php 
			   	$dataSqlmnp1 = "select *,SUM(qty) as totalqty from material_usage   where no_mnp='".$_GET['mnp']."' AND item_code='".$x['item_code']."'";
							$dataQrymnp1 = mysqli_query($conn,$dataSqlmnp1) or die ("Gagal Query".mysqli_error());
							$xmnp1 = mysqli_fetch_array($dataQrymnp1);
							
					
					echo $xmnp1['totalqty'];	
			   
			   ?>
			  
			</td>
				<td bgcolor="#FFFF00"><?php echo $x['notes']; ?></td>
		
			
        <td>
            
        <?php if ($xm['status']==2){ ?>
         <a  href="#" data-id='"<?php echo $x['item_code'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
        <?php }else{?>
        <a  href="#UpdateItem<?php echo $x['item_code']; ?>" data-id='"<?php echo $x['item_code'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>

		<?php }?>	   
		
		
        </td>
		 <div id="UpdateItem<?php echo $x['item_code']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-xs">
                    <div class="modal-content">
             <form action="../controller/process.php?actionAddItemMnp=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update Qty</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty Planning </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_item_mnp']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo $x['no_mnp']; ?>" placeholder="Level Name" name="txtMnp">
                        <input type="hidden" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Level Name" name="txtItemCode">
                        <input type="text" class="form-control"  value="<?php echo $x['qty']; ?>" placeholder="Qty" name="txtEditqty">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Notes</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotesedit"><?php echo $x['notes'] ?></textarea>
                      </div>
                    </div>
			  	
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
        
		<td>
		       <?php 
			   	$dataSqlmnp2 = "select qty from material_usage   where no_mnp='".$_GET['mnp']."' AND item_code='".$x['item_code']."'";
							$dataQrymnp2 = mysqli_query($conn,$dataSqlmnp2) or die ("Gagal Query".mysqli_error());
							$xmnp2 = mysqli_fetch_array($dataQrymnp2);
							
					
				
			   
			   ?>
	<?php  if($xmnp2['qty']=='' ){ ?>
	   <a  href="#DeleteItem<?php echo $x['id_item_mnp']; ?>" data-id='"<?php echo $x['id_item_mnp'];?>"' data-toggle="modal"><span class="fa fa-trash"></span></a>
<?php }else{?>
  <a  href="#"><span class="fa fa-remove"></span></a>
  <?php }?>
		</td>
		<div  id="DeleteItem<?php echo $x['id_item_mnp']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionAddItemMnp=delete" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                           <input type="hidden" class="form-control"  value="<?php echo $x['id_item_mnp']; ?>" placeholder="" name="id">
                          <input type="hidden" class="form-control"  value="<?php echo $x['no_mnp']; ?>" placeholder="" name="txtNoMNPDelete">
                        <p>Are You sure, You want to Delete Item?</p>
                      </div> 
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-primary">Delete</button>
                        
                       	
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

                  </table>
                      <div class="form-group">
                      
                    <?php
                    
                    	$dataSqlmr = "select *,status as sts from manufacture_planning  where code_planning='$mnp'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xmss = mysqli_fetch_array($dataQrymr);
                    ?>
                    
                                    <div class="form-group">
            
                    <?php if ($xmss['sts']==0){ ?>
               
                <a  href="#Start" data-toggle="modal"> <button type="submit" class="btn btn-primary">Start</button></a>
	        
               <?php }?>
                   <?php if ($xmss['sts']==1){ ?>
                <a  href="#finish" data-toggle="modal"> <button type="submit" class="btn btn-success">Finish</button></a>
                  <?php }?>
                   <?php if ($xmss['sts']==2){ ?>
                <a  href="?pages=master_asset&mnp=<?=$_GET['mnp']?>" data-toggle="modal"> <button type="submit" class="btn btn-success">Create asset </button></a>
                  <?php }?>
                        		<div id="Start" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Start This Project?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="../controller/process.php?startProject=start&mnp=<?=$_GET['mnp']?>"> <button type="submit" class="btn btn-primary">Start</button></a>
			 </div>

                    </div>
                  </div>
                </div>	
                         		<div id="finish" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Finish This Project ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="../controller/process.php?startProject=finish&mnp=<?=$_GET['mnp']?>"> <button type="submit" class="btn btn-primary">Finish</button></a>
			 </div>

                    </div>
                  </div>
                </div>
                <?php if ($xs['status']==3){ ?>
                         <a href="../notes/mnf.php?mnp=<?=$_GET['mnp']?>" target="_BLANK"> <button type="submit" class="btn btn-info">Print</button></a>	     
                         <?php }?>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
 

	 <?php
      include("jscript/datatables.php");
     ?>
    <script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
            
            var oTable1 =
               $('#assettable')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
           
           "processing": true,
                "language": {
        "processing": " Please Wait..." //add a loading image,simply putting <img src="loader.gif" /> tag.
    },
        "bServerSide": true,
 
"sAjaxSource": "serverside_catalog.php",
     
    "ordering": true,
    "searching": true,
    "aoColumns":  [

     { "aaData": null, "bSortable": false },
     { "aaData": "item_code"}, 
     { "aaData": "part_number"},
     { "aaData": "item_name"},
     { "aaData": "spec"},
     { "aaData": "category_name"},
     { "aaData": "sub_catname"},
     { "aaData": "manufacture_name"},
     { "aaData": "brand_name"},
     { "aaData": "maesurename"},
    { "aaData": "remark"},
                   

     {
				"mData": [ 1 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-plus" href="../controller/process.php?addCatalogtomfp=insert&mfp=<?php echo $mnp ?>&code='+data+'"></a>';
		}
	 }
            
      
 
]
					  
					
} );
	
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
			})
		</script>
  