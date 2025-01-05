  <link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />

<?php

$nomr=$_GET['mr'];
?>
	 
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
                  <h2>Material Request<small></small></h2>
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
                  <form action="../controller/process.php?actionMRhead=insert" method="post" class="form-horizontal form-label-left input_mask">



                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Material Request Code  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php  echo $nomr ?> </label>
                        
                    
                      </div>
                    </div>
                    
                    
                    <?php
                    
                    	$dataSqlmr = "select * from material_request a left join master_site b on a.location_request=b.id_site left join master_type_material c on a.type_mr=c.id_type where a.no_mr='$nomr'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xm = mysqli_fetch_array($dataQrymr);
                    ?>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Request  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                <?php  echo $xm['type_name']?>
                      </div>
                    </div>
                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site Name  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                <?php  echo $xm['site_name']?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">PIC Request  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <?php  echo $xm['pic_request']?>
                      </div>
                    </div>
			
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Request  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    
                          
                      <?php  echo $xm['date_register']?>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <?php  echo $xm['notes']?>
                      </div>
                    </div><br>
				  <div class="form-group">
				      
				          <?php
                    
                    	$dataSqlsratus = "select * from material_request  where no_mr='$nomr'";
							$dataQrymrstatus = mysqli_query($conn,$dataSqlsratus) or die ("Gagal Query".mysqli_error());
							$xs = mysqli_fetch_array($dataQrymrstatus);
                    ?>
                    
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Status  :</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?php if ($xs['status']==0){ ?>
                          
                 <span class="label label-warning">Pending</span>
                 
                 <?php }else if($xs['status']==1){?>
                   <span class="label label-primary">Created</span>
                  <?php }else if($xs['status']==2){?>
                  <span class="label label-success">Approved</span>
                  <?php }else if($xs['status']==3){?>
                  <span class="label label-danger">Rejected</span>
                  <?php }else if($xs['status']==4){?>
                   <span class="label label-info">PO Created</span>
                  <?php }else if($xs['status']==5){?>
                   <span class="label label-danger">MR Void</span>
                  <?php }?>
                  
                      </div>
                    </div>
           
                  

                  </form>
		<div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                       <br><br>
                          <?php if ($xs['status']==1){
                          if (($_SESSION['SES_LEVEL']==10)OR($_SESSION['SES_LEVEL']==17)){?>
                        	  <a  href="#Approve"  data-toggle="modal">  <button  class="btn btn-success">Approve MR</button></a>
                        	  <a  href="#Reject"  data-toggle="modal">  <button  class="btn btn-danger">Reject MR</button></a>
         
                        	  <?php }}?>
                        	  
                        	     <?php
        	if ($xs['status']==0){
		    if ($_SESSION['SES_LEVEL']==12){
		?>
                        	
                        	  <a  href="#Void"  data-toggle="modal">  <button  class="btn btn-danger">Void MR</button></a>
                        	  <?php }}?>
                        	  
    <?php
        	if (($xs['status']==3)OR $xs['status']==6){
		    if (($_SESSION['SES_LEVEL']==12)OR($_SESSION['SES_LEVEL']==16)){
		?>
                        	  <a  href="#Revision"  data-toggle="modal">  <button  class="btn btn-warning">Revison MR</button></a>
                        	
                        	  <?php }}?>
                        	  
			 <div  id="Approve" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
               <form action="../controller/process.php?actionMRstatus=Approve&mr=<?=$_GET['mr']?>" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Approve MR?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Approve MR</button>  </div>
</form>
                    </div>
                  </div>
                </div>
                        
                   	 <div  id="Reject" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionMRstatus=Reject&mr=<?=$_GET['mr']?>" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Reject MR?</p>
                      </div>
                                <div class="form-group">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12"><u>Please Insert Reason</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotesReject"></textarea>
                        <br>  <br>  <br>
                      </div>
                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Reject MR</button>  </div>
</form>
                    </div>
                  </div>
                </div>     
					 	 <div  id="Revision" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
   <form action="../controller/process.php?actionMRstatus=Revisimr&mr=<?=$_GET['mr']?>" method="post" class="form-horizontal form-label-left input_mask">
 
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Revisi MR?</p>
                                <div class="form-group">
                                    
                                            <?php
                    
                    	$dataSqlreject = "select * from material_request_reject  where no_mr='$nomr'";
							$dataQrymrreject = mysqli_query($conn,$dataSqlreject) or die ("Gagal Query".mysqli_error());
							$xr = mysqli_fetch_array($dataQrymrreject);
                    ?>
                      <label class="control-label col-md-12 col-sm-12 col-xs-12"><u>Please Insert Reason</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          
                        <textarea class="form-control" rows="3"  name="txtNotesRevision"><?php echo $xr['notes']?></textarea>
                        <br>  <br>  <br>
                      </div>
                    </div>
                        
                      </div>
                      <div class="modal-footer">
                          
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-danger">Revision MR</button>
                    </div>
                  </div>
                </div> 	
                </form>
                      </div>
                      
                            	 <div  id="Void" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                         <form action="../controller/process.php?actionMRstatus=Voidmr&mr=<?=$_GET['mr']?>" method="post" class="form-horizontal form-label-left input_mask">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Void MR?</p>
                      
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Void MR</button>  </div>
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
			
			
	
	
            <div class="clearfix"></div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-align-left"></i> Catalog List <small>For Material Request</small></h2>
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

                  <!-- start accordion -->
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        
                    <?php
        	if (($xs['status']==0) OR $xs['status']==6) {
		    if (($_SESSION['SES_LEVEL']==12)OR($_SESSION['SES_LEVEL']==16)){
		?>   
                      <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <h4 class="panel-title">Open Table Catalog</h4>
                      </a>
                      
                      <?php }}?>
                      <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                                 
                        
               <div class="table-responsive">
                     <table id="datatable-keytable" class="table table-striped table-bordered" width="100%">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                              <th>Item Name</th>
							   <th>Specification</th>
                             <th>Maesurement</th>
                              
                              <th>Brand</th>
                    
                               <th>Add</th>
							   
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewCatalog() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
			<td><?php echo $x['maesurename']; ?></td>
	
		<td><?php echo $x['brand_name']; ?></td>
	
	
        <td>
        <a  href="#AddItem<?php echo $x['item_code']; ?>" data-id='"<?php echo $x['item_code'];?>"' data-toggle="modal"><span class="fa fa-plus"></span></a>
		

		
		
        </td>
			 <div id="AddItem<?php echo $x['item_code']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionAddItem=insert" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Item To Material Request List</h4>
                      </div> 
                      <div class="modal-body">
                      
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Item Code</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $_GET['mr'] ?>" placeholder="Level Name" name="txtMR">
                        <input type="hidden" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Item Code" name="txtItemCode" readonly>
                         <h3> <?php  echo $x['item_code']?></h3>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-12 col-sm-12 col-xs-12"><u>Part Number</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        
                         <h4> <?php  echo $x['part_number']?></h4>
                      </div>
                    </div>
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Item Name</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        
                        <h4> <?php  echo $x['item_name']?></h4>
                      </div>
                    </div>
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Specification</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                      
                          <h4> <?php  echo $x['specification']?></h4>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Maesurement</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                      
                          <h4> <?php  echo $x['maesurename']?></h4>
                      </div>
                    </div>
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Qty</u></label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <input type="number" class="form-control"  value="<?php echo $_POST['txtQtyrequest'] ?>" placeholder="Qty Request" name="txtQtyrequest">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"><u>Notes</u> </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotesrequest"><?php echo $_POST['txtNotesrequest'] ?></textarea>
                      </div>
                    </div>
			    
				<br><Br>
                      <div class="modal-footer">		
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               	<br><Br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add To MR</button>
                        </div>
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

                        </table>  </div>
                    
                  </div>
                  <!-- end of accordion -->


                </div>
              </div>
            </div>
            
            

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Material Request List<small></small></h2>
                  
                  
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
                             <th>Qty</th>
                               <th>Maesurement</th>
                                    <th>In Stock</th>
                                <th>Notes</th>
                                
                                 <?php if ($xs['status']==0){ ?>
                               <th>Edit</th>
                              
							     <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>


                          <tbody>
                          <?php
        
    
	$no = 1;
	foreach($db->viewAddItem($nomr) as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
			<td><?php echo $x['qty']; ?></td>
					<td><?php echo $x['maesurename']; ?></td>
					       <?php
                    
                    	$dataSqlsratus1 = "select qty from stock_location  where item_code='".$x['item_code']."'";
							$dataQrymrstatus1 = mysqli_query($conn,$dataSqlsratus1) or die ("Gagal Query".mysqli_error());
							$xs1 = mysqli_fetch_array($dataQrymrstatus1);
                    ?>
                    	<td><?php echo $xs1['qty']; ?></td>
			<td><?php echo $x['notes']; ?></td>
      
        <?php if ($xs['status']==0){ ?>
          <td>
            
        <a  href="#UpdateItem<?php echo $x['item_code']; ?>" data-id='"<?php echo $x['item_code'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>

			   
		
		
        </td>
		 <div id="UpdateItem<?php echo $x['item_code']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionAddItem=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update Qty</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty Request </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_item']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo $x['no_mr']; ?>" placeholder="Level Name" name="txtNoMRedit">
                        <input type="hidden" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Level Name" name="txtItemCode">
                        <input type="number" class="form-control"  value="<?php echo $x['qty']; ?>" placeholder="Qty" name="txtEditqty">
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
	
	   <a  href="#DeleteItem<?php echo $x['id_item']; ?>" data-id='"<?php echo $x['id_item'];?>"' data-toggle="modal"><span class="fa fa-trash"></span></a>

       			<div  id="DeleteItem<?php echo $x['id_item']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionAddItem=delete" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                           <input type="hidden" class="form-control"  value="<?php echo $x['id_item']; ?>" placeholder="" name="id">
                          <input type="hidden" class="form-control"  value="<?php echo $x['no_mr']; ?>" placeholder="" name="txtNoMRDelete">
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
		</td>

                  <?php }?>
		
	</tr>
	<?php 
	}
	?>
                          </tbody>

                  </table>
                      <div class="form-group">
                    
                                    <div class="form-group">
                 
                   <?php if ($xs['status']==0){ ?>
               
                <a  href="#Deleteall" data-toggle="modal">  <button type="submit" class="btn btn-warning">Clear All Item</button></a>
                   
               <?php }?>
                       
                        
			<div id="Deleteall" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete All Item ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <a href="../controller/process.php?sendReq=deleteall&mr=<?=$_GET['mr']?>"> <button type="submit" class="btn btn-warning">Clear All Item</button></a>	
                      </div>

                    </div>
                  </div>
                </div>	
                    <?php if ($xs['status']==0){ ?>
               
                <a  href="#Sendrequest" data-toggle="modal"> <button type="submit" class="btn btn-primary">Send Request</button></a>
	        
               <?php }?>
                        		<div id="Sendrequest" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Send Reequest ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="../controller/process.php?sendReq=insert&mr=<?=$_GET['mr']?>"> <button type="submit" class="btn btn-primary">Send Request</button></a>
			 </div>

                    </div>
                  </div>
                </div>		
                         <a href="../notes/mr.php?mr=<?=$_GET['mr']?>"> <button type="submit" class="btn btn-info">Print</button></a>	     
                         
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
 

	 <?php
      include("jscript/datatables.php");
     ?>
	