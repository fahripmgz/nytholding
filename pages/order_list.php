<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Order List</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add New Order</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="../controller/process.php?actionOrder=insert" method="post" class="form-horizontal form-label-left input_mask">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Document Number</label>
                                        <div class="col-sm-8">
                                            <input name="txtdocnumber" type="text" id="txtdocnumber" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Department</label>
                                        <div class="col-sm-8">
                                            <select name="txtDepartment" id="txtDepartment" class="mySelect form-control" required>
                                                <option value="">Select Department</option>
                                                <?php
                                                $query = "SELECT * FROM department";
                                                $hasil = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($hasil)) {
                                                    echo "<option value='{$data['id']}'>{$data['department_name']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">PIC</label>
                                        <div class="col-sm-8">
                                            <select name="txtPic" id="txtPic" class="mySelect form-control" required>
                                                <!-- Isi dengan data PIC sesuai dengan kebutuhan -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Order By</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="orderby" class="form-control" value="<?=$_SESSION['SES_LOGIN'];?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Order Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="orderdate" value="<?=date('Y-m-d');?>" readonly>
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
                                        <th>Order Number</th>
                                        <th>Document Number</th>
                                        <th>Department</th>
                                        <th>PIC</th>
                                        <th>Notes</th>
                                        <th>Create Date</th>
                                        <th>Create By</th>
                                        <th>Status</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ((array)$db->viewOrder() as $x) {
                                        // Determine status and label
                                        $statusLabelClass = match($x['status_name']) {
                                            'On Process' => 'label label-warning',
                                            'Created' => 'label label-success',
                                            'Reject' => 'label label-danger',
                                            'Confirm' => 'label label-info',
                                            default => ''
                                        };
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><a href="?pages=detail_order&code=<?php echo $x['order_number']; ?>"><b><?php echo $x['order_number']; ?></b></a></td>
                                            <td><?php echo $x['document_number']; ?></td>
                                            <td><?php echo $x['department_name']; ?></td>
                                            <td><?php echo $x['pic_name']; ?></td>
                                            <td><?php echo $x['notes']; ?></td>
                                            <td><?php echo $x['create_date']; ?></td>
                                            <td><?php echo $x['create_by']; ?></td>
                                            <td><span class="<?php echo $statusLabelClass; ?>"><?php echo $x['status_name']; ?></span></td>
                                            <td>
                                                <?php if ($x['status'] == '1') { ?>
                                                    <a href="#updateOrder<?php echo $x['id']; ?>" data-toggle="modal"><span class="fa fa-edit"></span></a>
                                                <?php } else { ?>
                                                    <span class="fa fa-edit" disabled></span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($x['status'] == '0') { ?>
                                                    <a href="#deleteOrder<?php echo $x['id']; ?>" data-toggle="modal"><span class="fa fa-trash"></span></a>
                                                <?php } else { ?>
                                                    <span class="fa fa-trash"></span>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <!-- Modal for Update -->
<div id="updateOrder<?php echo $x['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../controller/process.php?actionOrder=update" method="post" class="form-horizontal">
                    <input type="hidden" class="form-control" value="<?php echo $x['id']; ?>" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtdocnumber">Document Number</label>
                                <input type="text" name="txtdocnumber" class="form-control" value="<?=$x['document_number']?>" required />
                            </div>
                            <div class="form-group">
                                <label for="txtDepartment">Department</label>
                                <select name="txtDepartment" id="txtDepartment" class=" form-control" style="width: 100%;" required>
                                    <option value="">Select Department</option>
                                    <?php
                                    $query = "SELECT * FROM department";
                                    $hasil = mysqli_query($conn, $query);
                                    while ($data = mysqli_fetch_array($hasil)) {
                                        $selected = ($data['id'] == $x['department']) ? "selected" : ""; // pastikan sesuai dengan kolom department_id
                                        echo "<option value='{$data['id']}' $selected>{$data['department_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtPic">PIC</label>
                                <select name="txtPic" id="txtPic" class=" form-control" style="width: 100%;" required>
                                        <option value="">Select PIC</option>
                                        <?php
                                        $queryPic = "SELECT * FROM master_pic"; // Pastikan nama tabel dan kolom sesuai
                                        $hasilPic = mysqli_query($conn, $queryPic);
                                        if (!$hasilPic) {
                                            die("Query Failed: " . mysqli_error($conn));
                                        }
                                        while ($dataPic = mysqli_fetch_array($hasilPic)) {
                                            $selected = ($dataPic['id'] == $x['pic']) ? "selected" : ""; // Periksa apakah PIC ini adalah PIC yang terpilih
                                            echo "<option value='{$dataPic['id']}' $selected>{$dataPic['pic_name']}</option>";
                                        }
                                        ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="orderby">Order By</label>
                                <input type="text" name="orderby" class="form-control" value="<?=$_SESSION['SES_LOGIN'];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="orderdate">Order Date</label>
                                <input type="date" class="form-control" name="orderdate" value="<?=date('Y-m-d');?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="txtNotes">Notes</label>
                                <textarea class="form-control" name="txtNotes"><?=$x['notes']?></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Now</button>
            </div>
            </form>
        </div>
    </div>
</div>


                              <!-- Modal for Delete -->
<div id="deleteOrder<?php echo $x['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel2">Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p align="center">Are you sure you want to delete this order?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="../controller/process.php?id=<?php echo $x['id']; ?>&actionOrder=delete" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>


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
