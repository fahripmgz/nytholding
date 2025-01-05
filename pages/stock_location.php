<?php
$code = $_GET['code'];
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <a href="?pages=add_stock">Stock</a> |
                <small>Stock On Location</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br><br>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr>
            <th>No</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Specification</th>
            <th>Qty</th>
            <th>Measurement</th>
            <th>Site</th>
            <th>Location</th>
            <th>Rack</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $totalQty = 0; // Initialize total quantity variable
        
        foreach ((array)$db->viewStockloc($code) as $x) {
            $q = mysqli_query($conn, "SELECT a.item_name, a.specification, a.part_number, b.maesurename, a.picture FROM master_catalog a LEFT JOIN master_maesurement b ON a.maesurement = b.id_mae WHERE a.item_code='" . mysqli_real_escape_string($conn, $x['icode']) . "'") or die(mysqli_error($conn));
            $qr = mysqli_fetch_array($q);

            // Accumulate the total quantity
            $totalQty += $x['qty'] ?? 0;
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($x['icode'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($qr['item_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($qr['specification'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($x['qty'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($qr['maesurename'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($x['site_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($x['location_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($x['rack_name'] ?? ''); ?></td>
        </tr>

	
        <?php 
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align:right;"><strong>Total:</strong></td>
            <td><?php echo $totalQty; ?></td>
            <td colspan="4"></td> <!-- Adjust the colspan as necessary -->
        </tr>
    </tfoot>
</table>

                            </div>
                            
                     
                                <h2>Inbound</h2>
                                <button type="button" class="btn btn-custom" data-toggle="collapse" data-target="#goodReceiptSection" aria-controls="goodReceiptSection">Good Receipt</button>
                                <button  type="button" class="btn btn-custom" data-toggle="collapse" data-target="#outstandingSection" aria-controls="outstandingSection"> Outstanding</button>
                                <button  type="button" class="btn btn-custom" data-toggle="collapse" data-target="#Storagehistory" aria-controls="Storagehistory"> Storage history</button>
                            <!-- Collapsible Good Receipt Section -->
                            <div class="card-box table-responsive">
                                
                                <div id="goodReceiptSection" class="collapse">
                                    <h3><small>Good Receipt</small></h3>
                                    <table id="gr" class="table table-striped responsive-utilities jambo_table bulk_action">
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
                                            $totalQtyReceipt = 0; // Initialize total quantity variable
                                            $status='2';

                                            foreach((array)$db->viewReceiveitem($code) as $x) {
                                                $qtyDo = $x['qty_do'];
                                                $qtyReceipt = $x['qty_receipt'];
                                                $totalQtyReceipt += $qtyReceipt; // Accumulate total receipt quantity
                                                
                                                // Determine status
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
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align:right;"><strong>Total Receipt:</strong></td>
                                                <td><?php echo $totalQtyReceipt; ?></td>
                                                <td colspan="5"></td> <!-- Adjust columns as needed -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Collapsible Outstanding Section -->
                            <div class="card-box table-responsive">
                                
                                <div id="outstandingSection" class="collapse">
                                    <h3><small>Out Standing</small></h3>
                                    
                                    <table id="outstanding" class="table table-striped responsive-utilities jambo_table bulk_action">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Item Code</th>
                                                <th>Item Name</th>
                                                <th>Specification</th>
                                                <th>Total Qty</th>
                                                <th>Measurement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $totalQty = 0; // Initialize total quantity variable

                                            foreach ((array)$db->viewPutAwayinstock($code) as $x) {
                                                $totalQty += $x['total_qty']; // Accumulate total quantity
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($x['item_code']); ?></td>
                                                <td><?php echo htmlspecialchars($x['item_name']); ?></td>
                                                <td><?php echo htmlspecialchars($x['spec']); ?></td>
                                                <td><?php echo htmlspecialchars($x['total_qty']); ?></td>
                                                <td><?php echo htmlspecialchars($x['maesurename']); ?></td>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" style="text-align:right;"><strong>Total Qty:</strong></td>
                                                <td><?php echo $totalQty; ?></td>
                                                <td></td> <!-- Adjust columns as needed -->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            
                            
                             <!-- Collapsible Outstanding Section -->
                            <div class="card-box table-responsive">
                                
                                <div id="Storagehistory" class="collapse">
                                    <h3><small>Storage History</small></h3>
                                    
                                  <table id="storagehistory" class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr>
            <th>No</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Specification</th>
            <th>Old Qty</th>
            <th>Qty</th>
            <th>Measurement</th>
            <th>Description</th>
            <th>Location</th>
            <th>Rack</th>
            <th>Date</th>
            <th>Create By</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $totalQty = 0; // Initialize total quantity variable

        foreach ((array)$db->viewStorageHistory($code) as $x) {
            $totalQty += $x['qty']; // Accumulate total quantity of current 'qty' field
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($x['code']); ?></td>
            <td><?php echo htmlspecialchars($x['item_name']); ?></td>
            <td><?php echo htmlspecialchars($x['spec']); ?></td>
            <td><?php echo htmlspecialchars($x['old_stock']); ?></td>
            <td><?php echo htmlspecialchars($x['qty']); ?></td>
            <td><?php echo htmlspecialchars($x['maesurename']); ?></td>
            <td><?php echo htmlspecialchars($x['desc']); ?></td>
            <td><?php echo htmlspecialchars($x['location_name']); ?></td>
            <td><?php echo htmlspecialchars($x['rack_name']); ?></td>
            <td><?php echo htmlspecialchars($x['create_date']); ?></td>
            <td><?php echo htmlspecialchars($x['create_by']); ?></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align:right;"><strong>Total Qty:</strong></td>
            <td><?php echo $totalQty; ?></td>
            <td colspan="6"></td> <!-- Adjust for remaining columns -->
        </tr>
    </tfoot>
</table>

                                </div>
                            </div>
                            
                            <h2>Outbound</h2>
                                <button class="btn btn-custom" data-toggle="collapse"  data-target="#goodrelease">Good Release</button>
                                <button class="btn btn-custom" data-toggle="collapse" data-target="#outstandingusage"> Outstanding</button>
                                <button class="btn btn-custom" data-toggle="collapse" data-target="#usagehistory"> Usage history</button>
                            <!-- History Usage -->
                              <!-- Collapsible Outstanding Section -->
                            <div class="card-box table-responsive">
                                
                                <div id="goodrelease" class="collapse">
                                <h3><small>History Usage</small></h3>
                                <table id="example4" class="table table-striped responsive-utilities jambo_table bulk_action">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Qty</th>
                                            <th>Site</th>
                                            <th>Location</th>
                                            <th>PIC</th>
                                            <th>Release Number</th>
                                            <th>Date Usage</th>
                                            <th>Photo & Document</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ((array)$db->viewUsageitem($code) as $x) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($x['item_code']); ?></td>
                                            <td><?php echo htmlspecialchars($x['item_name']); ?></td>
                                            <td><?php echo htmlspecialchars($x['qty']); ?></td>
                                            <td><?php echo htmlspecialchars($x['site_name']); ?></td>
                                            <td><?php echo htmlspecialchars($x['location_name']); ?></td>
                                            <td><?php echo htmlspecialchars($x['first_name']); ?></td>
                                            <td><?php echo htmlspecialchars($x['no_po']); ?></td>
                                            <td><?php echo htmlspecialchars($x['date']); ?></td>
                                            <td>
                                                <a href="#usagePicture<?php echo htmlspecialchars($x['id_receive']); ?>" data-toggle="modal"><span class="fa fa-image"></span></a>
                                            </td>
                                        </tr>

                                        <!-- Modal for Usage Picture -->
                                        <div id="usagePicture<?php echo htmlspecialchars($x['id_receive']); ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        <h4 class="modal-title" align="center">Picture</h4>
                                                    </div>
                                                    <div class="modal-body" align="center">
                                                        <img src="<?php echo htmlspecialchars($x['pic']); ?>" alt="Usage Item Picture">
                                                        <br>
                                                        <a href="<?php echo htmlspecialchars($x['document']); ?>" target="_blank"><h5>View Document</h5></a>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>	
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("jscript/datatables.php"); ?>
    
    <script>
        var handleDataTableButtons = function() {
            "use strict";
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    buttons: [
                        { extend: "copy", className: "btn-sm" },
                        { extend: "csv", className: "btn-sm" },
                        { extend: "excel", className: "btn-sm" },
                        { extend: "pdf", className: "btn-sm" },
                        { extend: "print", className: "btn-sm" }
                    ],
                    responsive: true
                });
            }
        };

        $(document).ready(function() {
            handleDataTableButtons();
            $('#gr').DataTable();
            $('#outstanding').DataTable();
            $('#storagehistory').DataTable();
        });
    </script>
</div>
