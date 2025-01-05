<?php
$code=$_GET['code'];
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                Good Issue |
                <small>Booked Items</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <br><br>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Items in order <small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                               <th>Order Number</th>
                                <th>Good Issue Number</th>
							   <th>Item Code</th>
							    <th>Item Name</th>
							     <th>Specification</th>
							       <th>Qty</th>
							        <th>Measurement</th>
							     <th>Remark</th>
							           
							  
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach((array)$db->viewIssuedetailinorder($code) as $x){
	  

	?>
	<tr>
		<td><?php echo $no++; ?></td>
			<td><a href="?pages=detail_order&code=<?php echo $x['order_number']; ?>"><?php echo $x['order_number']; ?></a></td>
			<td><a href="?pages=detail_issue&code=<?php echo $x['good_issue_number']; ?>"><?php echo $x['good_issue_number']; ?></a></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['spec']; ?></td>
			<td><?php echo $x['qty']; ?></td>
           		<td><?php echo $x['maesurename']; ?></td>
           		<td><?php echo $x['notes']; ?></td>
		
                
			   	
	
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
