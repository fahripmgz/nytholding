  <link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />

  
	<style>
	    
	    .form-group .select2-container {
  position: relative;
  z-index: 2;
  float: left;
  width: 100%;
  margin-bottom: 0;
  display: table;
  table-layout: fixed;
}
	    
	</style> 
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
                    Consumable Stock | 
                    <small>
                       Please insert  Consumable in your location
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
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Input Stock <small></small></h2>
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
                  <form action="../controller/process.php?actionStock=insert" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Link ID </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  name="txtlinkid" placeholder="Link ID">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtpartnumber" placeholder="Part Number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtitemname" placeholder="Item Name">
                      </div>
                    </div>
					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtspec" placeholder='Specification'></textarea>
                      </div>
                    </div>
				
					 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Category </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="category" id="category" class="select2_single form-control" tabindex="-1" >
          <option>-select Category-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_category";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_cat']."'>".$data['category_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
					
						  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="subcat" id="subcat" class="select2_single form-control" tabindex="-1">
  	    	<option>-select Sub Category-</option>
			
      
			
  	    </select>
                      </div>
                    </div>
					
							  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture	</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="txtmanufacture" id="txtmanufacture" class="select2_single form-control" tabindex="-1" >
          <option>-select Manufacture-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_manufacture";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_manu']."'>".$data['manufacture_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
						  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="txtbrand" id="txtbrand" class="select2_single form-control" tabindex="-1" >
          <option>-select Brand-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_brand";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_brand']."'>".$data['brand_name']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty Stock </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="number" name="txtqty" class="form-control" placeholder="Qty Stock">
                      </div>
                    </div>
					
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Maesurement </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="txtmaesurement" id="txtmaesurement" class="select2_single form-control" tabindex="-1" >
          <option>-select Maesurement-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_maesurement";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_mae']."'>".$data['maesurename']."</option>";
 
  	    } ?>
  	    </select>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                         <select name="txtsite" id="txtsite" class="select2_single form-control" tabindex="-1" >
          <option>-select Site-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_site";
                 $hasil = mysql_query($query);
                 while ($data2 = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_site']."'>".$data2['site_name']."</option>";
 
  	    } ?>
  	    </select>
		
                      </div>
                    </div><br><br>
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="location" id="location" class="select2_single form-control" tabindex="-1">
  	    	<option>-select Location-</option>
			
      
			
  	    </select>
                      </div>
                    </div>
				<br><br>
						  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Rack</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="rack" id="rack" class="select_single form-control" tabindex="-1">
  	    	<option>-select Rack-</option>
			
      
			
  	    </select>
                      </div>
                    </div>
				
                   <br><br>
                        
              <div class="form-group">
                      <label class="col-md-3 col-sm-3 col-xs-12 control-label">Condition
                        
                      </label>

                      <div class="col-md-9 col-sm-9 col-xs-12">
					  
					                 <?php
	$no = 1;
	foreach($db->viewCon() as $a){
	?>
					  
				       <div class="radio">
                          <label>
	<input type="radio" value="<?php echo $a['id_condition']; ?>" name="iCheck" >&nbsp;<?php echo $a['condition_name']; ?>
                          </label>
                        </div>	  
					
					  
	<?php }?>
                
						
                       
                      </div>
                    </div>
						    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtRemark" placeholder='Remark'></textarea>
                      </div>
                    </div>
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Insert Stock</button>
						
                      </div>
                    </div>

                  </form>
		
				   <a href="#"> <button  class="btn btn-success">Import Stock</button></a>
				      
                </div>
                   <br><br>
              </div>
            </div>
			
			
	
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Last Insert Consumable To Stock <small></small></h2>
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
                              <th>Link Id</th>
                              <th>Part Number</th>
                              <th>Description</th>
							   <th>Specification</th>
                           
                              <th>Category</th>
                              <th>Sub Category</th>
							     <th>Manufacture</th>
                              <th>Brand</th>
                              <th>Remark</th>
                               <th>Action</th>
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewStock() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['link_id']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
		<td><?php echo $x['category_name']; ?></td>
		<td><?php echo $x['sub_catname']; ?></td>
		<td><?php echo $x['manufacture']; ?></td>
		<td><?php echo $x['brand']; ?></td>
		<td><?php echo $x['qty_stock']; ?></td>
		<td><?php echo $x['maesurement']; ?></td>
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
			  <a  href="" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="fa fa-trash"></span></a>
					
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