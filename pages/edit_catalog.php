 
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Consumable Catalog | 
                    <small>
                        Update  Consumable 
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Update Catalog <small></small></h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionCatalog=update" method="post" class="form-horizontal form-label-left input_mask"  enctype="multipart/form-data">
             

            <?php	$q=mysqli_query($conn,"SELECT * From master_catalog where id_cat='".$_GET['id']."'") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);?>
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Code </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  name="id" placeholder="Code" value="<?php echo $qr['item_code']?>" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Part Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtPartnumbers" value="<?php echo $qr['part_number']?>" placeholder="Part Number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtItemname" placeholder="Item Name" value="<?php echo $qr['item_name']?>">
                      </div>
                    </div>
					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtSpecification" placeholder='Specification'><?php echo $qr['specification']?></textarea>
                      </div>
                    </div>
			
						  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="txtbrand" id="txtbrand" class="select2_single form-control" tabindex="-1" >
          <option>-select Brand-</option>

  	       	<?php
						$dataSql21 = "SELECT * FROM master_brand ORDER BY brand_name ASC";
						$dataQry21 = mysqli_query($conn,$dataSql21) or die ("Gagal Query".mysqli_error());
						while ($dataRow21 = mysqli_fetch_array($dataQry21)) {
						if ($dataRow21['id_brand']==$qr['brand']) {
						$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow21[id_brand]' $cek>$dataRow21[brand_name]</option>";
						}
						$sqlData ="";
					?>
  	    </select>
                      </div>
                    </div>
			
					  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Maesurement </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                                 <select name="txtMaesurement" id="txtMaesurement" class="select2_single form-control" tabindex="-1" >
          <option>-select Maesurement-</option>

  	    	<?php
						$dataSql21 = "SELECT * FROM master_maesurement ORDER BY maesurename ASC";
						$dataQry21 = mysqli_query($conn,$dataSql21) or die ("Gagal Query".mysqli_error());
						while ($dataRow21 = mysqli_fetch_array($dataQry21)) {
						if ($dataRow21['id_mae']==$qr['maesurement']) {
						$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow21[id_mae]' $cek>$dataRow21[maesurename]</option>";
						}
						$sqlData ="";
					?>
  	    </select>
  	    
  	    
                      </div>
                    </div>
					 
                          	<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Min Stock </label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="number" class="form-control" name="minstock" value="<?=$qr['min_stock']?>" placeholder="Minimum Stock">
							</div>
						</div> 

           
                    <div class="ln_solid"></div>
               
                </div>
              </div>
            </div>
               
        
			
			     <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                
                <div class="x_content">
                  <br />
                 

						    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtRemark" placeholder='Remark'><?php echo $qr['remark']?></textarea>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control"  value="<?php echo $qr['picture']; ?>"  name="oldpic">
                        <img value="<?php echo $qr['picture']; ?>" class="img-rounded img-thumbnail" src="<?php echo $qr['picture']; ?>">
                        
                    </div></div>
                    
                            <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Update Image </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                       <input type="file" name="picture">
                       
                       <br><br>
                      </div>
                    </div>
                   
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Catalog</button>
						
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