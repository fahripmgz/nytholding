<?php
//$itemcode=$_GET['id'];
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Stock |
                <small>Stock List</small>
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
                                <table id="datatable-buttons" class="table table-striped responsive-utilities jambo_table bulk_action">
    <thead>
        <tr>
            <th>No</th>
            <th>Item Code</th>
            <th>Part Number</th>
            <th>Item Name</th>
            <th>Specification</th>
            <th>Min Stock</th>
            <th>Stock</th>
            <th>Booked</th>
            <th>Measurement</th>
        </tr>
    </thead>
   <tbody>
    <?php
    $no = 1;
    foreach ($db->viewStocklist() as $x) {
        // Query to calculate total request per item
        $item_code = $x['item_code'];
        
        // Query to calculate total request from item_request table
        $query_request = "SELECT SUM(qty) AS total_request FROM item_request WHERE item_code = '$item_code' and status='2'";
        $result_request = mysqli_query($conn, $query_request);
        $data_request = mysqli_fetch_assoc($result_request);
        $total_request = $data_request['total_request'] ?? 0;
        
        // Query to calculate total booked from good_issue_items table
        $query_booked = "SELECT SUM(qty) AS total_booked FROM good_issue_items WHERE item_code = '$item_code' and status='1'";
        $result_booked = mysqli_query($conn, $query_booked);
        $data_booked = mysqli_fetch_assoc($result_booked);
        $total_booked = $data_booked['total_booked'] ?? 0;

        // Calculate remaining stock
        $remaining_stock = $x['total_qty'] - $total_booked;

        // Check if min stock is greater than or equal to remaining stock
        $flagged = $x['min_stock'] >= $remaining_stock ? 'danger' : '';
    ?>
    <tr class="<?php echo $flagged; ?>"> <!-- Add a class if the item is flagged -->
        <td><?php echo $no++; ?></td>
        <td><?php echo $x['item_code']; ?></td>
        <td><?php echo $x['part_number']; ?></td>
        <td><?php echo $x['item_name']; ?></td>
        <td><?php echo $x['specification']; ?></td>
        <td><?php echo $x['min_stock']; ?></td>
        <td><a href="?pages=stock_location&code=<?php echo $x['item_code']; ?>"><?php echo $x['total_qty']; ?></a></td>
        <td><a href="?pages=booked_items&code=<?php echo $x['item_code']; ?>"><?php echo $total_booked; ?></a></td> <!-- Column "Booked" with total booked -->
        <td><?php echo $x['maesurename']; ?></td>
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
    <script>
        var handleDataTableButtons = function() {
            "use strict";
            0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdf",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
                responsive: !0
            })
        },
        TableManageButtons = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTableButtons()
                }
            }
        }();
    </script>
</div>
