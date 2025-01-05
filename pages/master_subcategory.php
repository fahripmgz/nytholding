

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master Subcategory
                </h3>
            </div>

          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Add New Subcategory <small></small></h2>
              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionSubcategory=insert" method="post" class="form-horizontal form-label-left input_mask">


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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Subcategory Name </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control"  name="txtsubcategory"  placeholder="Subcategory Name">
                      </div>
                    </div>
                    
                       <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                           <button type="submit" class="btn btn-primary">Cancel</button>
                      	<button type="submit" class="btn crud-submit btn-success">Submit</button>
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
                
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Category Name</th>
							   <th>Subcategory Name</th>
							    <th>Initial</th>
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach((array)$db->viewSubCat() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['category_name']; ?></td>
		<td><?php echo $x['sub_catname']; ?></td>
		<td><?php echo $x['code_type']; ?></td>
        <td>
        <a  href="#updatesubcat<?php echo $x['id_subcat']; ?>" data-id='"<?php echo $x['id_subcat'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
        
        	 <div id="updatesubcat<?php echo $x['id_subcat']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
       
             <form action="../controller/process.php?actionSubcategory=update" method="post">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Category Name:</label>
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
          <div class="form-group">
            <label for="recipient-name" class="control-label">Sub Category Name:</label>
            <input type="hidden" class="form-control"  value="<?php echo $x['id_subcat']; ?>" placeholder="Category Name" name="id">
            <input type="text" class="form-control"  value="<?php echo $x['sub_catname']; ?>" placeholder="Category Name" name="txtsubcategory">
                      
          </div>
        
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-custom">Send message</button>
      </div>
         </form>
    </div>
  </div>
</div>
        
        
		 
                
                	       <td>
					    <?php	$qC=mysqli_query($conn,"SELECT count(*) as jum FROM master_catalog T where T.sub_category='".$x['id_subcat']."'") or die(mysql_error());
																$qrC=mysqli_fetch_array($qC);
																if ($qrC['jum']==0) {
																?>
                         <a  href="#deletesubcat<?php echo $x['id_subcat']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
			 	<?php } else {
																echo "<span class='label label-warning'>In Use</span>";
																	
																} ?>
                      </td> 
		
			       <div id="deletesubcat<?php echo $x['id_subcat']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Subcategory?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_subcat']; ?>&actionSubcategory=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>		
	
	</tr>
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
          </div>
    <?php
      include("jscript/datatables.php");
     ?>
        </div>
		<br>
		<br>
		<br>
		<br>
	