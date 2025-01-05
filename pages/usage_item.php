
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Usage Item |
                    <small>
                         Usage Item List
                    </small>
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
                              <th>No.Manufacture</th>
                              <th>Item Code</th>
                              <th>Item Name</th>
                               <th>Specifivation</th>
                               <th>Qty</th>
							 <th>From Site</th>
							 <th>FromLocation</th>
							 <th>From Rack</th>
							 <th>Date</th>
					
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewUsage() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
				<td><?php echo $x['no_mnp']; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>
<td><?php echo $x['qty']; ?></td>
	<td><?php echo $x['site_name']; ?></td>
	<td><?php echo $x['location_name']; ?></td>
	<td><?php echo $x['rack_name']; ?></td>
	<td><?php echo $x['date']; ?></td>
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
         
     </script>