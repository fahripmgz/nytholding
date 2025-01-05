<?php  $idtrans=$_GET['code'];
                    
$dataSqlgr = "SELECT a.`id`, a. `good_issue_number`, a.`order_number`, a.`notes`, a.`create_by`,a. `create_date`, e.status_name,a.`status`,b.document_number,b.create_date as orderdate,c.department_name,d.pic_name FROM `good_issue` a LEFT JOIN order_list b on a.order_number=b.order_number LEFT JOIN department c on b. department=c.id 
LEFT JOIN master_pic d on b.pic=d.id LEFT JOIN master_status_gr e on a.status=e.id
WHERE a.good_issue_number='$idtrans'";
$dataQrygr = mysqli_query($conn,$dataSqlgr) or die ("Gagal Query".mysqli_error());
$xm = mysqli_fetch_array($dataQrygr);
$dn=$xm['order_number'];
$statusLabelClassGR = match($xm['status_name']) {
                                            'On Process' => 'label label-warning',
                                            'Created' => 'label label-success',
                                            'Reject' => 'label label-danger',
                                            default => ''
                                        };
                                        

    
                    ?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><b>
                    Outbound</b> |
                <small>
                     Goods Issue Details
                </small>
            </h3>
        </div>
    </div>
         
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_GET['message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>

                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Good Issue Details <small></small></h2>
              
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
<form method="post" class="form-horizontal form-label-left input_mask">
    <div class="col-xs-12">
        <div class="row">
               <h3>Goods Issue Number : <?=$xm['good_issue_number'];?>
        </div>
        <hr>
        <div class="row">
             <h3>Order Detail</h3>
            <div class="col-xs-6">
            
                <div class="form-group">
                    <label for="deliveryNumber" class="col-sm-4 control-label">Order Number</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['order_number'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptType" class="col-sm-4 control-label">Department</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['department_name'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="documentNumber" class="col-sm-4 control-label">PIC</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"> <?=$xm['pic_name'];?>
                    </div>
                </div>
                        <div class="form-group">
                    <label for="receiptBy" class="col-sm-4 control-label">Order By</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_by'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptDate" class="col-sm-4 control-label">Order Date</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_date'];?></p>
                    </div>
                </div>
               
            </div>

            <div class="col-xs-6">
         
                <div class="form-group">
                    <label for="receiptBy" class="col-sm-4 control-label">Create By</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_by'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="receiptDate" class="col-sm-4 control-label">Create Date</label>
                    <div class="col-sm-8">
                       <p class="form-control-static">  <?=$xm['create_date'];?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="notes" class="col-sm-4 control-label">Notes</label>
                    <div class="col-sm-8 ">
                       <p class="form-control-static"> <?=$xm['notes'];?></p>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="notes" class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-8 ">
                      <h2> <span class="<?php echo $statusLabelClassGR; ?>"><?php echo $xm['status_name']; ?></span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
     
            <br>
			     
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if($xm['status']=='1'){?>
              <div class="x_panel">
                <div class="x_title">
                      <h2>Add Item From Order Number<small></small></h2>
                  <div class="clearfix"></div>
                </div>
                    <?php
// Tambahkan tombol Import Item
?>
<div class="text-right">
    <button type="button" class="btn btn-custom" data-toggle="modal" data-target="#importItemModal">Import Item</button>
</div>

<div id="importItemModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Import Item from Order Number</h4>
            </div>
            <div class="modal-body">
                <form id="importForm" class="form-horizontal">
                    <p>Are you sure you want to import items from order number <strong><?= htmlspecialchars($xm['order_number']); ?></strong>?</p>
                    <input type="hidden" id="OrderNumber" name="OrderNumber" value="<?= htmlspecialchars($xm['order_number']); ?>">
                    <input type="hidden" id="goodIssueNumber" name="goodIssueNumber" value="<?= htmlspecialchars($idtrans); ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="importItemsBtn" class="btn btn-primary">Import Items</button>
                </form>
            </div>
        </div>
    </div>
</div>


<hr>
                    
                    
                    
                 <h2>Add Item Order (Additonal)<small></small></h2>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    
          <div class="clearfix">
                  
               
               <br>       
                    
  <form id="addItemForm" action="../controller/process.php?actionItemIssue=insert" method="post" class="form-horizontal form-label-left input_mask">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="text" id="itemcode" name="itemcode" class="form-control" placeholder="Enter Item Code" required>
                        <input type="hidden" class="form-control" value="<?=$idtrans;?>" name="goodIssueNumber">
                        <input type="hidden" class="form-control" value="<?=$xm['order_number'];?>" name="OrderNumber">
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-group" id="measurementGroup" style="display: none;">
                    <div class="col-sm-4">
                        <input type="text" id="item_name" class="form-control" readonly>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" id="measurement" class="form-control" readonly>
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Qty Stock" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="txtQtyorder" placeholder="Qty Order" required>
                </div>
                <div class="col-sm-4">
                    <textarea type="text" class="form-control" id="txtNotes" name="txtNotes" rows="1" placeholder="Remark"></textarea>
                </div>
                <div class="col-sm-2">
                    <button type="button" id="submitItemBtn" class="btn btn-custom">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>

 
  <br>
     <div class="x_title">
                
    </div>
    
</div>
                </div>
                
                 <?php }?>
   <div class="x_title">
                  <h2>List Of Item <small></small></h2>
              
                  <div class="clearfix"></div>
                    <div class="text-right">
        <a href="../notes/order_detail.php?code=<?=$idtrans;?>" target="_BLANK"class="btn btn-custom">Download Item Order Report</a>
    </div>
                </div>

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                               <th>Order Number</th>
							   <th>Item Code</th>
							    <th>Item Name</th>
							     <th>Specification</th>
							       <th>Qty</th>
							        <th>Measurement</th>
							     <th>Remark</th>
							           
							            <?php if($xm['status']=='1'){?>
							  <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach((array)$db->viewIssuedetail($idtrans) as $x){
	  

	?>
	<tr>
		<td><?php echo $no++; ?></td>
			<td><?php echo $x['order_number']; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['spec']; ?></td>
			<td><?php echo $x['qty']; ?></td>
           		<td><?php echo $x['maesurename']; ?></td>
           		<td><?php echo $x['notes']; ?></td>
		
                <?php if($xm['status']=='1'){?>
                	       <td>
                	           
                         <a  href="#deleteItem<?php echo $x['id']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
                      </td> 
		         <?php }?>
			       <div id="deleteItem<?php echo $x['id']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Item?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id']; ?>&code=<?php echo $idtrans; ?>&actionItemIssue=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
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
             <?php if($xm['status']=='1'){?>
              <div class="x_panel">
                   <div class="text-right">
       <a href="../controller/process.php?id=<?php echo $idtrans ?>&actionItemIssue=save" id="saveButton" class="btn btn-custom">Save</a>

    </div>
     </div>
     <?php }?>
     
          </div>
    <?php
      include("jscript/datatables.php");
     ?>
     
     
     
        </div>
		<br>
		<br>
		<br>
		<br>
<script>
$(document).ready(function () {
    $('#saveButton').on('click', function (e) {
    e.preventDefault(); // Prevent the default behavior of the link

    let saveUrl = $(this).attr('href'); // Get the URL from the href attribute

    // Show confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this Good Issue?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Save it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform the action (e.g., AJAX or redirection)
            $.ajax({
                url: saveUrl,
                type: 'GET',
                success: function (response) {
                    console.log("Save Response: ", response); // Log the response for debugging

                    if (response.trim() === "successfully saved") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Saved!',
                            text: 'The Good Issue has been successfully saved.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // Reload the page after success
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Save Failed',
                            text: response,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while saving the Good Issue.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});

    // Event handler for the import button click
   $('#importItemsBtn').on('click', function (e) {
    e.preventDefault(); // Prevent default action

    // Disable button to prevent multiple clicks
    let importButton = $(this);
    importButton.prop('disabled', true);

    // Get values from the form
    let goodIssueNumber = $('#goodIssueNumber').val();
    let OrderNumber = $('#OrderNumber').val();

    // Validate form inputs
    if (!goodIssueNumber || !OrderNumber) {
        Swal.fire({
            icon: 'warning',
            title: 'Input Required',
            text: 'Please fill in all required fields.',
            confirmButtonText: 'OK'
        });
        importButton.prop('disabled', false); // Re-enable button
        return;
    }

    // Send data with AJAX
    $.ajax({
        url: '../controller/process.php?actionItemIssue=import',
        type: 'POST',
        data: {
            goodIssueNumber: goodIssueNumber,
            OrderNumber: OrderNumber
        },
        success: function (response) {
            console.log("Import Response: ", response); // Log the response for debugging
            if (response.trim() === "successfully imported") {
                $('#importItemModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Import Successful',
                    text: 'Items were successfully imported.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload(); // Reload the page after success
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Import Failed',
                    text: response,
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while importing items.',
                confirmButtonText: 'OK'
            });
        },
        complete: function () {
            importButton.prop('disabled', false); // Re-enable button
        }
    });
});
    // Event handler for the Add Item Additional form submission
 $('#submitItemBtn').on('click', function (e) {
    e.preventDefault(); // Prevent default form submission

    let formData = new FormData($('#addItemForm')[0]);

    $.ajax({
        url: $('#addItemForm').attr('action'), // Use form action
        type: 'POST',
        data: formData,
        contentType: false, // Important for FormData
        processData: false, // Important for FormData
        success: function (response) {
            try {
                let res = JSON.parse(response); // Parse the JSON response

                if (res.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload the page after success
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: res.message,
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unexpected response format. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while adding the item.',
                confirmButtonText: 'OK'
            });
        }
    });
});
});
</script>


		
	