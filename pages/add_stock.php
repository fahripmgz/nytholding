
 
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Stock |
                    <small>
                        Add Item /Receive Item
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
                  <h2>Stock List <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                        
                      <div class="card-box table-responsive">
                      

                        <table id="datatable-keytable" class="table table-striped table-bordered">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th> 
                              <th>Item Name</th>
							   <th>Specification</th>
                             <th>Maesurement</th>
                              <th>Category</th>
                              <th>Sub Category</th>
							     <th>Manufacture</th>
                              <th>Brand</th>
                         
							   <th>Stock</th>
                               <th>Add To Stock</th>
							  
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach((array) $db->viewCatalog() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
			<td><?php echo $x['maesurename']; ?></td>
				<td><?php echo $x['category_name']; ?></td>
		<td><?php echo $x['sub_catname']; ?></td>
		<td><?php echo $x['manufacture_name']; ?></td>
		<td><?php echo $x['brand_name']; ?></td>
	<?php 
$query = "SELECT sum(qty) as jum FROM stock_location where item_code='".$x['item_code']."'";
                 $hasil = mysqli_query($conn,$query);
                 $data = mysqli_fetch_array($hasil);
  if ($data['jum']==''){?>
		<td style="background:#ffeb3b;">Null</td>
	<?php }else{?>
			<td>
	<a href="?pages=stock_location&code=<?=$x['item_code']?>"><?=$data['jum']?></a>
	
	</td>
	<?php }?>
	
        <td>
        <a  href="#addstock<?php echo $x['item_code']; ?>" data-id='"<?php echo $x['item_code'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
        

	    


		 <div id="addstock<?php echo $x['item_code']; ?>" class="modal fade bs-example-modal-lg"  role="dialog" aria-hidden="true">
		     
 
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionStock=add" method="post" class="form-horizontal form-label-left input_mask"enctype="multipart/form-data">
                
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Receive Item</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Code </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="text" class="form-control"  value="<?php echo $x['item_code']; ?>" placeholder="Level Name" name="id" readonly>
                      
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                        <input type="text" class="form-control"  value="<?php echo $x['item_name']; ?>" placeholder="Item Name" name="txtItemname" readonly>
                      </div>
                    </div>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['part_number']; ?>" placeholder="Part Number" name="txtPartnumber" readonly>
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtSpecification" readonly><?php echo $x['specification']; ?></textarea>
                      </div>
                    </div>
         
                    
                    
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Add Qty </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $_SESSION['SES_LOGIN']; ?>" placeholder="PIC" name="txtPIC">
                       <input type="number" class="form-control"  value="<?php echo $x['qty']; ?>" placeholder="Qty Receive" name="txtQty">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Maesurement </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
                       <input type="text" class="form-control"  value="<?php echo $x['maesurename']; ?>" placeholder="Maesurement" name="txtMae" readonly>
                      </div>
                    </div>
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
			<select name="txtsite" id="txtsite" class="form-control" tabindex="-1" required>
          <option value="0">-select Site-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_site";
                 $hasil = mysqli_query($conn,$query);
                 while ($data2 = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_site']."'>".$data2['site_name']."</option>";
 
  	    } ?>
  	    </select>
                      
                      </div>
                    </div>
                    
                    		  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                        <select name="location" id="location" class="form-control" tabindex="-1" required>
  	      <option value="0">-select Location-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_location";
                 $hasil = mysqli_query($conn,$query);
                 while ($data2 = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_location']."'>".$data2['location_name']."</option>";
 
  	    } ?>
			
      
			
  	    </select>
                      </div>
                    </div>
				<br><br>
					
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">MR Number </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  
			<select name="txtPOnumber" id="txtPOnumber" class="form-control" tabindex="-1" required>
          <option>-Select MR Number-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM material_request where status='2' order by id_mr DESC";
                 $hasil = mysqli_query($conn,$query);
                 while ($data2 = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['no_mr']."'>".$data2['no_mr']."</option>";
 
  	    } ?>
  	    </select>
                      
                      
                     
                      </div>
                    </div>
                           <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Photo</label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <input type="file" name="picture">
                        <span style="color:red">* <strong>Info!</strong>Format data use JPG OR PNG And Don't use Special Charcter image name</span>
                       <br><br>
                      </div>
                    </div>
                           <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Document </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <input type="file" name="document">
                           <span style="color:red">* <strong>Info!</strong>Format data use .doc/.pdf/.xls Don't use Special Charcter document name</span>
                       <br><br>
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <textarea class="form-control" rows="3"  name="txtNotes" ></textarea>
                      </div>
                    </div>
                   
           <div class="modal-footer">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp; </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					 
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


