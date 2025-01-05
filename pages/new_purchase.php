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
                    Purchase Order 
                    <small>
                       
                    </small>
                </h3>
            </div>

     
          </div>
          
           <form action="../controller/process.php?actionPOhead=insert" method="post" class="form-horizontal form-label-left input_mask">
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Create Purchase Order <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                 


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Purchase Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
							<?php 
							$dataSqlJ = "select substring(number_po,9,7) as asd from purchase_order order by asd desc limit 1";
							$dataQryJ = mysqli_query($conn,$dataSqlJ) or die ("Gagal Query".mysqli_error());
							$dataRowJ = mysqli_fetch_array($dataQryJ);
							$num=$dataRowJ['asd'];
							$numnow=$num+1;	
							$fzeropadded = sprintf("%07s", $numnow);
							$label="PO";
							$txtAssetCode = $label.date('ymd').$fzeropadded;
							?>
                        <input type="text" class="form-control"  name="txtnoPO" placeholder="Code" value="<?=$txtAssetCode?>" readonly>
                      </div>
                    </div>

               
                 				 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">To </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="txtTO" class="select2_single form-control" tabindex="-1" >
          <option>-select To-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_vendor";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_vendor']."'>".$data['vendor_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
                    		  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Type Request </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
			<select name="txtTypereq"  class="form-control" tabindex="-1"  required>
          <option value="0">-Select Type Request-</option>
  	    <?php 
  	 
       $query2 = "SELECT * FROM master_type_material";
                 $hasil2 = mysqli_query($conn,$query2);
                 while ($data3 = mysqli_fetch_array($hasil2)){
  	    
          echo "<option value='".$data3['id_type']."'>".$data3['type_name']."</option>";
 
  	    } ?>
  	    </select>
                      
                      </div>
                    </div>
                    
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Reff Number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" name="txtReff" class="form-control" placeholder="Reff Number">
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Attn</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" name="txtAttn" class="form-control" placeholder="Attn">
                      </div>
                    </div>
                    			 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Currency </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="txtCur" id="currency" class="select2_single form-control" tabindex="-1" >
          <option value="0">-select Currency-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_currency";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_cur']."'>".$data['currency_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Request</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <?php
                          $date=date("Y-m-d");
                          
                          ?>
                        <input type="text" class="form-control" name="txtdateReg" value="<?php  echo $date ?>" placeholder="Date Request" readonly>
                         <input class="form-control" type="hidden"  name="txtPIC" placeholder='PIC Created' value="<?php  echo $_SESSION['SES_ID_USER'] ?>" >
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">MR Number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="txtMR" class="select2_single form-control" tabindex="-1" >
          <option>-select MR-</option>
  	    <?php 
  	 
       $query = "SELECT no_mr FROM material_request where status=2";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data['no_mr']."'>".$data['no_mr']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>     
 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" name="txtSubject" class="form-control" placeholder="Subject">
                      </div>
                    </div>

					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtNotes" placeholder='Notes'></textarea>
                      </div>
                    </div>
				
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        <a href="../controller/process.php?actionPOhead=insert"><button type="submit" class="btn btn-success">Create Purchase Order</button></a>
						
                      </div>
                    </div>

              
		
		    
                </div>
                   <br><br>
              </div>
            </div>
			
			
	    </form>
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Last Insert Purchase Order<small></small></h2>
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
                              <th>No PO</th>
                              <th>To(Vendor)</th>
                                <th>Type Request</th>
                               <th>Reff Number</th>
                              <th>Date PO</th>
							  <th>MR Number</th>
                             <th>Subject</th>
                             <th>PIC Created</th>
                             <th>Status</th>
                           
                               <th>Edit</th>
                                <th>Add Item</th>
							   
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
			<td><?php echo $x['vendor_name']; ?></td>
		<td><?php 
			 echo $x['reff_number']; ?></td>
		<td><?php echo $x['date_po']; ?></td>

<td><?php 
echo $x['mr_number'];
 ?></td>
<td><?php echo $x['subject']; ?></td>
<td><?php echo $x['first_name']; ?></td>

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
   	<TD>

              <?php if ($x['status_po']==0) { ?>    
        <a  href="#additemPO<?php echo $x['number_po']; ?>" data-id='"<?php echo $x['number_po'];?>"' data-toggle="modal"><span class="fa fa-pencil"></span></a>
		<?php }else{?>
		<span class="fa fa-edit"></span>
		<?php }?>
		
		
        </td>  
        	<td>
                	    
                	                 	    <?php if ($x['status_po']==0) { 
                	    if ($x['type_req']==2){
                	    
                	    ?>  
			   <a  href="../pages/index.php?pages=add_item_po&po=<?php echo $x['number_po']?>"><span class="fa fa-plus"></span></a>
					
			<?php  } else if($x['type_req']==3){?>
			    <a  href="../pages/index.php?pages=add_item_po_asset&po=<?php echo $x['number_po']?>"><span class="fa fa-plus"></span></a>
					
		<?php	  }?>
			  
			  	<?php }else{?>
	<span class="fa fa-plus"></span>
		<?php }?>
			  
                	    
                	    
			
		</td>
		 <div id="additemPO<?php echo $x['number_po']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionPOhead=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_po']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo $x['number_po']; ?>" placeholder="Level Name" name="txtnumMR">
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