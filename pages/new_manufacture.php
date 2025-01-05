<?php
session_start();
?>




<link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />


	 
  <script type="text/javascript">
           $(document).ready(function(){
 
           	  
           	   $("#category").change(function(){
                     var category=$("#category").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_category.php",
           	   	     	data:"category="+category,
           	   	     	success:function(data){
                              $("#subcat").html(data);
           	   	     	}
           	   	     });
           	   });
			   
			    $("#txtsite").change(function(){
                     var txtsite=$("#txtsite").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_location.php",
           	   	     	data:"txtsite="+txtsite,
           	   	     	success:function(data){
                              $("#location").html(data);
           	   	     	}
           	   	     });
           	   });
			   
			   
			       $("#location").change(function(){
                     var location=$("#location").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_rack.php",
           	   	     	data:"location="+location,
           	   	     	success:function(data){
                              $("#rack").html(data);
           	   	     	}
           	   	     });
           	   });
           });
      </script>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                   Manufacturing Planning
                    <small>
                       
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2><small></small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?manufacture=insertmanufacture" method="post" class="form-horizontal form-label-left input_mask">


               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Code</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
							<?php 
							$dataSqlJ = "select substring(code_planning,10,7) as asd from manufacture_planning  order by asd desc limit 1";
							$dataQryJ = mysqli_query($conn,$dataSqlJ) or die ("Gagal Query".mysqli_error());
							$dataRowJ = mysqli_fetch_array($dataQryJ);
							$num=$dataRowJ['asd'];
							$numnow=$num+1;	
							$fzeropadded = sprintf("%07s", $numnow);
							$label="MNP";
							$txtAssetCode = $label.date('ymd').$fzeropadded;
							?>
                        <input type="text" class="form-control"  name="txtNomanu" placeholder="Code" value="<?=$txtAssetCode?>" readonly>
                      </div>
                    </div>
   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtPlanningname"  placeholder="Planning Name" required>
                      </div>
                    </div>
                    
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Manufacture Date</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="single_cal1"  name="txtStartdate" placeholder="Start Date " aria-describedby="inputSuccess2Status" required>
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                            
                              <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                              <input type="text" class="form-control has-feedback-left" id="single_cal3" name="txtFinishdate" placeholder="Finish Date " aria-describedby="inputSuccess2Status" required>
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                      </div>
                    </div>
      
              
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">PIC</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtPICreg" value="<?php  echo $_SESSION['SES_LOGIN']?>" placeholder="PIC Register" readonly>
                      </div>
                    </div>
			
	

           
                    <div class="ln_solid"></div>
               
                </div>
              </div>
            </div>
			
			     <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2><small></small></h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                			  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> Type </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
			<select name="txtLocation"  class="form-control" tabindex="-1" required>
          <option>-select Type -</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_type_material";
                 $hasil = mysqli_query($conn,$query);
                 while ($data2 = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['id_type']."'>".$data2['type_name']."</option>";
 
  	    } ?>
  	    </select>
                      
                      </div>
                    </div><BR><BR>
			  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> Location </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
			<select name="txtLocation"  class="form-control" tabindex="-1" required>
          <option>-select Location-</option>
  	    <?php 
  	 
       $query = "SELECT * FROM master_site";
                 $hasil = mysqli_query($conn,$query);
                 while ($data2 = mysqli_fetch_array($hasil)){
  	    
          echo "<option value='".$data2['site_name']."'>".$data2['site_name']."</option>";
 
  	    } ?>
  	    </select>
                      
                      </div>
                    </div>
                    <br><br>
					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <textarea class="form-control" rows="3" name="txtNotesmn" placeholder='Notes'></textarea>
                      </div>
                    </div>
				
           
          <br>&nbsp;<br>
               
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button  class="btn btn-primary">Cancel</button>
                        
                        	  <a  href="#Request"  data-toggle="modal">  <button  class="btn btn-primary">Create Now</button></a>
			 <div  id="Request" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Create Manufacturing?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Yes</button>  </div>

                    </div>
                  </div>
                </div>
                        
                        
						
                      </div>
                    </div>

                  </form>
		
		    
                </div>
                   <br><br>
              </div>
            </div>
			
			
	
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Planning List<small></small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">

               <div class="table-responsive">
                  <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>No. Manufacture</th>
                              <th>Planning Name</th>
                               <th> Date Start</th>
                                <th>Date Finish</th>
                              <th>PIC</th>
							 
                             <th>Location</th>
                               <th>Notes</th>
                                  <th>Status</th>
                                  
                               <th>Edit</th>
                             
                                <th>View Detail</th>
							     <!--<th>Delete</th>-->
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach((array)$db->viewManufacturingproses() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['code_planning']; ?></td>
		<td><?php echo $x['planning_tittle']; ?></td>
		<td><?php 
		 
					 echo $x['date_start']; ?></td>
		<td><?php echo $x['date_finish']; ?></td>
			<td><?php echo $x['pic']; ?></td>
				<td><?php echo $x['manufacture_location']; ?></td>
			<td><?php echo $x['notes']; ?></td>
			
				
<td><?php if ($x['status']==0){ ?>
                          
                 <span class="label label-warning">Pending</span>
                 
                 <?php }else if($x['status']==1){?>
                   <span class="label label-primary">On Progress</span>
                  <?php }else if($x['status']==2){?>
                  <span class="label label-success">Complated</span>
                  <?php }else if($x['status']==3){?>
                  <span class="label label-danger">Finish</span>
                  <?php }else if($x['status']==4){?>
                   <span class="label label-info">OverTime</span>
                  <?php }?></td>
        <td>
            
        <?php if ($x['status']==0) { ?>    
        <a  href="#updateMRhead<?php echo $x['code_planning']; ?>" data-id='"<?php echo $x['code_planning'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		<?php }else{?>
		<span class="fa fa-edit"></span>
		<?php }?>
			   
		
		
        </td>
        
		 <div id="updateMRhead<?php echo $x['code_planning']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionMRhead=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $x['id_mr']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo $x['no_mr']; ?>" placeholder="Level Name" name="txtnumMR">
                        <textarea class="form-control" rows="3" name="txtNotes" placeholder='Notes'><?php echo $x['notes']; ?></textarea>
                      </div>
                    </div>
		
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
            </form>
                    </div>
                  </div>
                </div>
                	<td>
                
			  <a  href="../pages/index.php?pages=planning_part&mnp=<?php echo $x['code_planning']?>"><span class="fa fa-plus"></span></a>
		
			  
					
		</td>
		<!--<td>
			  <a  href="#DeleteMRhead<?php echo $x['id_mr']; ?>" data-id='"<?php echo $x['id_mr'];?>"' data-toggle="modal"><span class="fa fa-trash"></span></a>
			 <div  id="DeleteMRhead<?php echo $x['id_mr']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete Material Request?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_mr']; ?>&actionMRhead=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>		
		</td>-->
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
          </div>

	 
	 
        </div>
	
		 <script src="../js/select/select2.full.js"></script>
  <!-- form validation -->
  <script type="text/javascript" src="../js/parsley/parsley.min.js"></script>
  <!-- textarea resize -->
  <script src="../js/textarea/autosize.min.js"></script>
  <script>
    autosize($('.resizable_textarea'));
  </script>
  <!-- Autocomplete -->
  <script type="text/javascript" src="../js/autocomplete/countries.js"></script>
  <script src="../js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <!-- daterangepicker -->
  <script type="text/javascript" src="../js/moment/moment.min.js"></script>
  <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>

  <!-- select2 -->
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Select a Sub Category",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
  </script>
  
  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };

      $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

      $('#reportrange_right').daterangepicker(optionSet1, cb);

      $('#reportrange_right').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange_right').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange_right').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange_right').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });

      $('#options1').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
      });

      $('#options2').click(function() {
        $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
      });

      $('#destroy').click(function() {
        $('#reportrange_right').data('daterangepicker').remove();
      });

    });
  </script>
  <!-- datepicker -->
 
  <!-- /datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#single_cal1').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_2"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal3').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
      $('#single_cal4').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
    });
  </script>


 
  <!-- /datepicker -->