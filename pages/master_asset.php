  <link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />


  
	 
  <script type="text/javascript">
           $(document).ready(function(){
 
           	  
           	   $("#category").change(function(){
                     var category=$("#category").val();
           	   	     $.ajax({
           	   	     	type:"get",
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
                    Create New Asset |
                    <small>
                Asset item
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Input Asset <small></small></h2>
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
                  <form action="../controller/process.php?actionAsset=insert" method="post" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Code </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
							<?php 
							$dataSqlJ = "select substring(item_code,9,7) as asd from master_asset order by asd desc limit 1";
							$dataQryJ = mysql_query($dataSqlJ) or die ("Gagal Query".mysql_error());
							$dataRowJ = mysql_fetch_array($dataQryJ);
							$num=$dataRowJ['asd'];
							$numnow=$num+1;	
							$fzeropadded = sprintf("%07s", $numnow);
							$txtAssetCode = "A".date('ymd').$fzeropadded;
							?>
                        <input type="text" class="form-control"  name="txtCode" placeholder="Code" value="<?=$txtAssetCode?>" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtpartnumber" value="<?=$_GET['mnp']?>" placeholder="Manufacture Number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtitemname" placeholder="Asset Name">
                      </div>
                    </div>
					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtspec" placeholder='Specification'></textarea>
                      </div>
                    </div>
				  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Serial Number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text"class="form-control" rows="3" name="txtSN" placeholder='Serial Number'>
                      </div>
                    </div>
					 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Category </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    <select name="category" class="select2_single form-control" tabindex="-1" >
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
                   
  	     <select name="subcat" class="select2_single form-control" tabindex="-1" >
          <option>-select Category-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_subcat";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_subcat']."'>".$data['sub_catname']."</option>";
 
  	    } ?>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Measurement </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="txtMaesurement" id="txtMaesurement" class="select2_single form-control" tabindex="-1" >
          <option>-select Measurement-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_maesurement";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_mae']."'>".$data['maesurename']."</option>";
 
  	    } ?>
  	    </select>
                      </div>
                    </div>
					 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="cmbSite" id="cmbSite" class="select2_single form-control" tabindex="-1">
          <option>-select Site-</option>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="cmbLoc" id="cmbLoc" class="select2_single form-control" tabindex="-1" >
          <option>-select Location-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_location";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data['id_location']."'>".$data['location_name']."</option>";
 
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtRemark" placeholder='Remark'></textarea>
                      </div>
                    </div>
                           <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <input type="file" name="picture">
                      <span style="color:red"> * Format Upload JPG & PNG(Name not use Special Character)</span>
                       <br><br>
                      </div>
                    </div>
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Insert Asset</button>
						
                      </div>
                    </div>

                  </form>
		
				  
				      
                </div>
                   <br><br>
              </div>
            </div>
			
			
	
	
            <div class="clearfix"></div>

            
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
