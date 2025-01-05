<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Good Receipt</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New Stock From Good Receipt</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="../controller/process.php?actionGR=insert" method="post" class="form-horizontal form-label-left input_mask">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Delivery Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="txtDO" placeholder="DO" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Receipt Type</label>
                                        <div class="col-sm-8">
                                            <select name="txtType" class="mySelect form-control" required>
                                                <option value="">Select Type</option>
                                                <?php
                                                $query = "SELECT * FROM receipt_type";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['id']}'>{$data['type_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Document Number</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="txtDN" placeholder="PO Number, Etc" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Vendor/Supplier</label>
                                        <div class="col-sm-8">
                                            <select name="txtVendor" class="mySelect form-control" required>
                                                <option value="">Select Vendor</option>
                                                <?php
                                                $query = "SELECT * FROM master_vendor";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['id_vendor']}'>{$data['vendor_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Receipt At</label>
                                        <div class="col-sm-8">
                                            <select name="txtAt" class="mySelect form-control" required>
                                                <option value="">Select Site</option>
                                                <?php
                                                $query = "SELECT * FROM master_site";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['id_site']}'>{$data['site_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Receipt By</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="txtreceiptby" class="form-control" value="<?=$_SESSION['SES_LOGIN'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Receipt Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="txtDate" value="<?=date('Y-m-d');?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Notes</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="txtNotes"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4">
                                            <a href="your_cancel_link" class="btn btn-custom">Cancel</a>
                                            <button type="submit" class="btn btn-custom">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                            <table id="example" class="table table-striped responsive-utilities jambo_table bulk_action">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Good Receipt Number</th>
                                        <th>Delivery Number</th>
                                        <th>Receipt Type</th>
                                        <th>Document Number</th>
                                        <th>Vendor</th>
                                        <th>Item</th>
                                        <th>Receipt At</th>
                                        <th>Receipt by</th>
                                        <th>Receipt Date</th>
                                        <th>Status</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ((array)$db->viewGoodreceipt() as $x) {
                                        // Determine status and label
                                        $statusLabelClass = match($x['status_name']) {
                                            'On Process' => 'label label-warning',
                                            'Created' => 'label label-success',
                                            'Reject' => 'label label-danger',
                                            default => ''
                                        };
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><a href="?pages=detail_receive&code=<?php echo $x['receipt_number']; ?>"><b><?php echo $x['receipt_number']; ?></b></a></td>
                                            <td><?php echo $x['delivery_number']; ?></td>
                                            <td><?php echo $x['type_name']; ?></td>
                                            <td><?php echo $x['document_number']; ?></td>
                                            <td><?php echo $x['vendor_name']; ?></td>
                                            <td> <?php
                                                    // Prepare the SQL statement to prevent SQL injection
                                                    $deliveryNumber = $x['receipt_number'];
                                                    $query = "SELECT COUNT(id) AS total FROM item_received WHERE gr_number = ?";
                                                    
                                                    if ($stmt = mysqli_prepare($conn, $query)) {
                                                        // Bind the parameter and execute the statement
                                                        mysqli_stmt_bind_param($stmt, 's', $deliveryNumber); // Use 's' for string type
                                                        
                                                        if (mysqli_stmt_execute($stmt)) {
                                                            // Get the result and fetch data
                                                            $result = mysqli_stmt_get_result($stmt);
                                                            
                                                            if ($data = mysqli_fetch_array($result)) {
                                                                echo $data['total'];
                                                            } else {
                                                                echo "No results found.";
                                                            }
                                                        } else {
                                                            echo "Error executing query.";
                                                        }
                                                        
                                                        // Close the statement
                                                        mysqli_stmt_close($stmt);
                                                    } else {
                                                        echo "Error preparing the statement.";
                                                    }
                                                    ?>

                                            </td>
                                            <td><?php echo $x['site_name']; ?></td>
                                            <td><?php echo $x['receipt_by']; ?></td>
                                            <td><?php echo $x['receipt_date']; ?></td>
                                            <td><span class="<?php echo $statusLabelClass; ?>"><?php echo $x['status_name']; ?></span></td>
                                            <td>
                                                <?php if ($x['status'] == '1') { ?>
                                                    <a href="#updateGR<?php echo $x['id']; ?>" data-toggle="modal"><span class="fa fa-edit"></span></a>
                                                <?php } else { ?>
                                                    <span class="fa fa-edit" disabled></span>
                                                <?php } ?>
                                            </td>
                                                    	 <div id="updateGR<?php echo $x['id']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                                      <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="exampleModalLabel">Edit Data</h4>
                                                          </div>
                                                          <div class="modal-body">
                                                           
                                                                 <form action="../controller/process.php?actionGR=update" method="post">
                                                                     <input type="hidden" class="form-control"  value="<?php echo $x['id']; ?>"  name="id">
                                                                     <div class="form-group">
                                                        <label for="inputPassword3" class="control-label">Delivery Number</label>
                                                          <input type="text" class="form-control" name="txtDO" placeholder="DO" value="<?=$x['delivery_number']?>">
                                                      </div>
                                                              <div class="form-group">
                                                                          <label class="control-label">Receipt Type </label>
                                                                          
                                                                         
                                                                                             <select name="txtType" class="mySelect form-control" style="width: 100%;">
                                                              <option>Select Type</option>
                                                           
                                                              <?php
                                                                     // query untuk menampilkan propinsi
                                                                     $query = "SELECT * FROM receipt_type";
                                                                     $hasil = mysqli_query($conn,$query);
                                                                     while ($data = mysqli_fetch_array($hasil))
                                                                     
                                                                       {
                                                    					 if ($data['type_name']==$x['type_name']) {
                                                    						 $cek="selected";
                                                    					 } else { $cek=""; }
                                                                        echo "<option value='".$data['id']."' $cek>".$data['type_name']."</option>";
                                                                     }
                                                              ?>
                                                              </select>
                                                                          
                                                                        </div>
                                                                        <div class="form-group">
                                                        <label for="inputPassword3" class="control-label">Document Number</label>
                                                       
                                                          <input type="text" class="form-control" name="txtDN" placeholder="PO Number,Etc" value="<?=$x['document_number']?>">
                                                       
                                                      </div>
                                                      
                                                       <div class="form-group">
                                                                          <label class="control-label">Vendor/Supplier </label>
                                                                        
                                                                         
                                                                                             <select name="txtVendor" class="mySelect form-control" style="width: 100%;">
                                                              <option>Select Vendor</option>
                                                           
                                                              <?php
                                                                     // query untuk menampilkan propinsi
                                                                     $query = "SELECT * FROM master_vendor";
                                                                     $hasil = mysqli_query($conn,$query);
                                                                     while ($data = mysqli_fetch_array($hasil))
                                                                     
                                                                          {
                                                    					 if ($data['vendor_name']==$x['vendor_name']) {
                                                    						 $cek="selected";
                                                    					 } else { $cek=""; }
                                                                        echo "<option value='".$data['id_vendor']."' $cek>".$data['vendor_name']."</option>";
                                                                     }
                                                                     
                                                                
                                                              ?>
                                                              </select>
                                                                          
                                                                        </div>
                                                                     <div class="form-group">
                                                                          <label class="control-label">Receipt At </label>
                                                                         
                                                                         
                                                                                             <select name="txtAt" class="mySelect form-control" style="width: 100%;">
                                                              <option>Select Type</option>
                                                           
                                                              <?php
                                                                     // query untuk menampilkan propinsi
                                                                     $query = "SELECT * FROM master_site";
                                                                     $hasil = mysqli_query($conn,$query);
                                                                     while ($data = mysqli_fetch_array($hasil))
                                                                     
                                                                           {
                                                    					 if ($data['site_name']==$x['site_name']) {
                                                    						 $cek="selected";
                                                    					 } else { $cek=""; }
                                                                        echo "<option value='".$data['id_site']."' $cek>".$data['site_name']."</option>";
                                                                     }
                                                                    
                                                              ?>
                                                              </select>
                                                                         
                                                                        </div>
                                                                    
                                                      
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-custom">Update Now</button>
                                                          </div>
                                                             </form>
                                                        </div>
                                                      </div>
                                                    </div>
        
                                            
                                            
                                            <td>
                                                <?php if ($x['status'] == '1') { ?>
                                                    <a href="#deleteGR<?php echo $x['id']; ?>" data-toggle="modal"><span class="fa fa-trash"></span></a>
                                                <?php } else { ?>
                                                    <span class="fa fa-trash"></span>
                                                <?php } ?>
                                            </td>
                                            
                                            <div id="deleteGR<?php echo $x['id']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                       <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                                                      </div>
                                                      <div class="modal-body" align="center">
                                                        
                                                        <p>Are You sure, You want to Delete Good Receipt?</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <a  href="../controller/process.php?id=<?php echo $x['id']; ?>&actionGR=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                                                      </div>
                            
                                                </div>
                                              </div>
                                            </div>
                                                                        
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
