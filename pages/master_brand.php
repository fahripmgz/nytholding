
          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Brand 
                </h3>
            </div>


          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Add New Brand <small></small></h2>
      
                  <div class="clearfix"></div>
                </div>
                   <div class="x_content">
                  <br />
                     <form action="../controller/process.php?actionBrand=insert" method="post" class="form-horizontal form-label-left input_mask">


        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Category Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                     
                                         <select name="txtcategory" class="form-control">
          <option>Select Category</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_category";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_cat']."'>".$data['category_name']."</option>";
                 }
          ?>
          </select>
                      </div>
                    </div>
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  placeholder="Brand Name" name="txtBrand">
                      </div>
                    </div>

                       <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

           
                    <div class="ln_solid"></div>
               

                  </form>
                </div>
              </div>
            </div>
			
			     
	
          
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                 <h2>Status List <small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="brand" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Category Name</th>
							   <th>Brand Name</th>
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>


                           <tbody>
                           <?php
	$no = 1;
	foreach($db->viewBrand() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['category_name']; ?></td>
		<td><?php echo $x['brand_name']; ?></td>
        <td>
        <a  href="#updateBrand<?php echo $x['id_brand']; ?>" data-id='"<?php echo $x['id_brand'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updateBrand<?php echo $x['id_brand']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionBrand=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
					  	        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Category Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                     
                                         <select name="txtcategory" class="form-control">
          <option>Select Category</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_category";
                 $hasil = mysqli_query($conn,$query);
                 while ($data = mysqli_fetch_array($hasil))
                 {
					 if ($data['id_cat']==$x['id_cat']) {
						 $cek="selected";
					 } else { $cek=""; }
                    echo "<option value='".$data['id_cat']."' $cek>".$data['category_name']."</option>";
                 }
				 
		 
          ?>
          </select>
                      </div>
                    </div>
					  <br>
					  <br>
					
					  
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">`SubCategory Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_brand']; ?>" placeholder="Category Name" name="id">
					  
				
					  
                        <input type="text" class="form-control"  value="<?php echo $x['brand_name']; ?>" placeholder="Brand Name" name="txtBrand">
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
					    <?php	$qC=mysqli_query($conn,"SELECT count(*) as jum FROM master_catalog T where T.brand='".$x['id_brand']."'") or die(mysql_error());
																$qrC=mysqli_fetch_array($qC);
																if ($qrC['jum']==0) {
																?>
                         <a href="#deleteBrand<?php echo $x['id_brand']; ?>"data-toggle="modal" ><span class="fa fa-trash"></span></a>
						<?php } else {
																echo "<span class='label label-warning'>In Use</span>";
																	
																} ?>
                      </td> 
			
		        	<?php 
	}
	?>
        
                </tbody>
                  </table>
				  		
                <!-- Small modal -->
                

       
                <!-- /modals -->
                </div>
                </div>
              </div>
            </div>
         