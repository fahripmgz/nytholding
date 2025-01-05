
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><b>
                    Inbound</b> |
                <small>
                    Good Receive Report
                </small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br>

    <div class="row">
        <div class="col-md-12">

            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="x_panel">
                              <br>
                            <div class="card-box ">
 <div class="row">
    <div class="col-md-3">
        <input type="text" id="itemCodeFilter" class="form-control" placeholder="Filter by Item Code">
    </div>
    <div class="col-md-3">
        <input type="text" id="itemNameFilter" class="form-control" placeholder="Filter by Item Name">
    </div>
    <div class="col-md-3">
        <input type="text" id="receiptDateRange" class="form-control" placeholder="Filter by Receipt Date">
    </div>
</div>

<br>

<div class="table-responsive">
    <table id="example2" class="table table-striped responsive-utilities jambo_table bulk_action">
        <thead>
        <tr>
            <th>No</th>
            <th>Good Receipt</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Specification</th>
            <th>Qty D.0</th>
            <th>Qty Receipt</th>
            <th>UoM</th>
            <th>Notes</th>
            <th>Receipt by</th>
            <th>Receipt Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $status='2';
        foreach((array)$db->viewGoodreceiptdetailall($status) as $x){
            $qtyDo = $x['qty_do'];
            $qtyReceipt = $x['qty_receipt'];
            if ($qtyReceipt == 0) {
                $statusLabelClass = 'label label-danger';
                $statusText = 'Pending Receipt';
            } elseif ($qtyReceipt == $qtyDo) {
                $statusLabelClass = 'label label-success';
                $statusText = 'Receipts Matched';
            } elseif ($qtyReceipt < $qtyDo) {
                $statusLabelClass = 'label label-warning';
                $statusText = 'Partial Receipt';
            }
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $x['gr_number']; ?></td>
            <td><?php echo $x['item_code']; ?></td>
            <td><?php echo $x['item_name']; ?></td>
            <td><?php echo $x['spec']; ?></td>
            <td><?php echo $qtyDo; ?> (<?php echo $qtyDo - $qtyReceipt; ?>)</td>
            <td><?php echo $qtyReceipt; ?></td>
            <td><?php echo $x['maesurename']; ?></td>
            <td><?php echo $x['notes']; ?></td>
            <td><?php echo $x['create_by']; ?></td>
            <td><?php echo $x['create_date']; ?></td>
            <td><span class="<?php echo $statusLabelClass; ?>"><?php echo $statusText; ?></span></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
				  	 
                <!-- Small modal -->
                

         
                <!-- /modals -->
                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Small modal -->
            </div>
        </div>
    </div>
</div>


