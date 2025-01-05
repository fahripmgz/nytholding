
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Receive Item |
                    <small>
                         Receive Item List
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
                              <th>Item Code</th>
                              <th>Item Name</th>
                               <th>Specification</th>
                               <th>Qty</th>
                              <th>Old Stock</th>
							 <th>Site</th>
							 <th>Location</th>
							 <th>Rack</th>
							 <th>PIC</th>
							  <th>Notes</th>
							  <th>From PO/MMO</th>
							 <th>Date</th>
				         	<th>Photo & Document</th>
				         	
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach((array)$db->viewReceive() as $x){
	        $nomr=$x['no_po'];
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
			<td><?php echo $x['specification']; ?></td>
<td><?php echo $x['qty']; ?></td>
<td><?php echo $x['old_stock']; ?></td>
	<td><?php echo $x['site_name']; ?></td>
	<td><?php echo $x['location_name']; ?></td>
	<td><?php echo $x['rack_name']; ?></td>
	<td><?php echo $x['first_name']; ?></td>
		<td><?php echo $x['notes']; ?></td>
	<td><a href="?pages=add_item_request_asset&mr=<?php echo $nomr ?>" target="_BLANK"><?php echo $nomr; ?></a></td>
	<td><?php echo $x['date']; ?></td>
		 <td>
        <a  href="#picture<?php echo $x['id_receive']; ?>" data-id='"<?php echo $x['id_receive'];?>"' data-toggle="modal"><span class="fa fa-image"></span></a>
        </td>
	
         <div id="picture<?php echo $x['id_receive']; ?>" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Picture</h4>
                      </div>
                      <div class="modal-body" align="center">
                       
                       <img src="<?php echo $x['pic'] ?>">
                     <br>
                       
                         <a href="<?php echo $x['document']?>" TARGET="_blank"><h5>View Document</h5></A>
                      </div>
                 
                      
                      
                      
                      <div class="modal-footer">
                  	
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