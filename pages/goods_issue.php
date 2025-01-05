<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Goods Issue</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Good Issue Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="../controller/process.php?actionGI=insert" method="post" class="form-horizontal form-label-left input_mask">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Order Number</label>
                                    
                                        <div class="col-sm-8">
                                            <select name="txtOrdernumber" class="mySelect form-control" required>
                                                <option value="">Select Order Number</option>
                                                <?php
                                                $query = "SELECT id,order_number, department,pic FROM order_list where status='2'";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['order_number']}'>{$data['order_number']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-xs-6">
                     
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Create By</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="createby" class="form-control" value="<?=$_SESSION['SES_LOGIN'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Create Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="createdate" value="<?=date('Y-m-d');?>" required>
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
                                        <th>Good Issue Number</th>
                                        <th>Order Number</th>
                                        <th>Department</th>
                                        <th>PIC</th>
                                        <th>Order Date</th>
                                        <th>Order Notes</th>
                                        <th>Create By</th>
                                        <th>Create Date</th>
        
                                        <th>Status</th>
                                       
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ((array)$db->viewGoodsIssue() as $x) {
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
                                            <td><a href="?pages=detail_issue&code=<?php echo $x['good_issue_number']; ?>"><b><?php echo $x['good_issue_number']; ?></b></a></td>
                                            <td><?php echo $x['order_number']; ?></td>
                                            <td><?php echo $x['department_name']; ?></td>
                                            <td><?php echo $x['pic_name']; ?></td>
                                            <td><?php echo $x['orderdate']; ?></td>
                                             <td><?php echo $x['notes']; ?></td>
                                              <td><?php echo $x['create_by']; ?></td>
                                                <td><?php echo $x['create_date']; ?></td>
                                           
                                            <td><span class="<?php echo $statusLabelClass; ?>"><?php echo $x['status_name']; ?></span></td>
        
                                            <td>
                                                <?php if ($x['status'] == '1') { ?>
                                                    <a href="#deleteGI<?php echo $x['id']; ?>" data-toggle="modal"><span class="fa fa-trash"></span></a>
                                                <?php } else { ?>
                                                    <span class="fa fa-trash"></span>
                                                <?php } ?>
                                            </td>
                                            
                                            <div id="deleteGI<?php echo $x['id']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                                       <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                                                      </div>
                                                      <div class="modal-body" align="center">
                                                        
                                                        <p>Are You sure, You want to Delete Goods Issue?</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <a  href="../controller/process.php?id=<?php echo $x['id']; ?>&code=<?php echo $x['good_issue_number']; ?>&actionGI=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
