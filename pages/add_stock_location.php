  <link href="../css/select/select2.min.css" rel="stylesheet">
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
                   Add Stock Location | 
                    <small>
                       Stock Location
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Add Stock Location<small></small></h2>
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
                    <form action="../controller/process.php?actionStock=add" method="post" class="form-horizontal "enctype="multipart/form-data">
                

            <?php	$q=mysql_query("select *,SUM(qty) as totalqty,b.id_cat as icat from stock a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_Rack left join master_manufacture g on b.manufacture=g.id_manu left join master_brand h on b.brand=h.id_brand  where a.item_code='".$_GET['id']."' group by a.rack") or die(mysql_error());
									$qr=mysql_fetch_array($q);?>
									
									
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Receive Item</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                      <label>Item Code </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="text" class="form-control"  value="<?php echo $qr['item_code']; ?>" placeholder="Level Name" name="id" readonly>
                      
                    </div>
                      <div class="form-group">
                      <label >Item Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					 
                        <input type="text" class="form-control"  value="<?php echo $qr['item_name']; ?>" placeholder="Item Name" name="txtItemname" readonly>
                      </div>
                    </div>
                      <div class="form-group">
                      <label >Part Number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['part_number']; ?>" placeholder="Part Number" name="txtPartnumber" readonly>
                      </div>
                    </div>
                        <div class="form-group">
                 <label >Specification </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtSpecification" readonly><?php echo $x['specification']; ?></textarea>
                      </div>
                    </div>
         
                    
                    
                       <div class="form-group">
                      <label >Add Qty </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $_SESSION['SES_LOGIN']; ?>" placeholder="PIC" name="txtPIC">
                       <input type="number" class="form-control"  value="<?php echo $x['qty']; ?>" placeholder="Qty" name="txtQty">
                      </div>
                    </div>
                        <div class="form-group">
                      <label >Maesurement </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['maesurename']; ?>" placeholder="Maesurement" name="txtMae" readonly>
                      </div>
                    </div>
					  <div class="form-group">
                      <label >Site </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
			<select name="txtsite" id="txtsite" class="form-control" tabindex="-1" >
          <option>-select Site-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_site";
                 $hasil = mysql_query($query);
                 while ($data2 = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_site']."'>".$data2['site_name']."</option>";
 
  	    } ?>
  	    </select>
                      
                      </div>
                    </div>
                    
                    		  <div class="form-group">
                      <label >Location</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                        <select name="location" id="location" class="form-control" tabindex="-1">
  	      <option>-select Location-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_location";
                 $hasil = mysql_query($query);
                 while ($data2 = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_location']."'>".$data2['location_name']."</option>";
 
  	    } ?>
			
      
			
  	    </select>
                      </div>
                    </div>
				<br><br>
						  <div class="form-group">
                      <label >Rack</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="rack" id="rack" class=" form-control" tabindex="-1">
  	        <option>-select Rack-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_rack";
                 $hasil = mysql_query($query);
                 while ($data2 = mysql_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_rack']."'>".$data2['rack_name']."</option>";
 
  	    } ?>
			
      
			
  	    </select>
                      </div>
                    </div>
                        <div class="form-group">
                      <label >From PO number </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					 
                       <input type="text" class="form-control"  value="" placeholder="PO Number" name="txtPOnumber">
                      </div>
                    </div>
                           <div class="form-group">   <div class="col-md-9 col-sm-9 col-xs-12">
                      <label >Upload Photo</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="file" name="picture">
                       
                       <br><br>
                      </div>
                    </div>
                           <div class="form-group">
                      <label >Upload Document </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="file" name="document">
                       
                       <br><br>
                      </div>
                    </div>
                         <div class="form-group">
                      <label >Notes </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotes" ></textarea>
                      </div>
                    </div>
                   
           <div class="modal-footer">
                    <div class="form-group">
                      <label >&nbsp; </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                        
                      </div>
                    
                
     
                    </div>
                  </div>       
               </div> </div>
               
    
                
               
               </div>
			   </form>
                 
		
				  
				      
                </div>
                   <br><br>
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