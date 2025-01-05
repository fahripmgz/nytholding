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
                  Edit Asset
                    <small>
                       
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                 
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?asset=editasset" method="post" class="form-horizontal form-label-left input_mask" enctype="multipart/form-data">

  <?php	$q=mysqli_query($conn,"SELECT * From master_asset where id_asset='".$_GET['id']."'") or die(mysqli_error());
									$qr=mysqli_fetch_array($q);?>
									
									
									 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Code</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          
                          <input type="hidden" class="form-control" name="id"  value="<?php echo $qr['id_asset']?>" readonly>
                        <input type="text" class="form-control" name="txtassetcode"  placeholder="Asset Name" value="<?php echo $qr['item_code']?>" readonly>
                      </div>
                    </div>
   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Name</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtAssetname"  placeholder="Asset Name" value="<?php echo $qr['item_name']?>" >
                      </div>
                    </div>
           
         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="form-control" rows="3" name="txtSpec" placeholder='Specification'><?php echo $qr['specification']?></textarea>
                     
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Serial Number</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="txtSerialnumber"  placeholder="Serial Number" value="<?php echo $qr['part_number']?>" >
                      </div>
                    </div>
   
       
         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="form-control" rows="3" name="txtRemark" placeholder='Specification'><?php echo $qr['remark']?></textarea>
                     
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="txtSite" id="txtSite" class="select2_single form-control" tabindex="-1" >
          <option>-select Site-</option>

  	       	<?php
						$dataSql21 = "SELECT * FROM master_site ORDER BY site_name ASC";
						$dataQry21 = mysqli_query($conn,$dataSql21) or die ("Gagal Query".mysqli_error());
						while ($dataRow21 = mysqli_fetch_array($dataQry21)) {
						if ($dataRow21['id_site']==$qr['site']) {
						$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow21[id_site]' $cek>$dataRow21[site_name]</option>";
						}
						$sqlData ="";
					?>
  	    </select>
                      </div>
                    </div>
      				  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="txtLocation" id="txtLocation" class="select2_single form-control" tabindex="-1" >
          <option>-select Location-</option>

  	       	<?php
						$dataSql22 = "SELECT * FROM master_location ORDER BY location_name ASC";
						$dataQry22 = mysqli_query($conn,$dataSql22) or die ("Gagal Query".mysqli_error());
						while ($dataRow22 = mysqli_fetch_array($dataQry22)) {
						if ($dataRow22['id_location']==$qr['location']) {
						$cek = " selected";
						} else { $cek=""; }
						echo "<option value='$dataRow22[id_location]' $cek>$dataRow22[location_name]</option>";
						}
						$sqlData ="";
					?>
  	    </select>
                      </div>
                    </div>
                    
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="file" name="picture">
                      <span style="color:red"> * Format Upload JPG & PNG(Name not use Special Character)</span>
                       <br><br>
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="hidden" class="form-control"  value="<?php echo $qr['picture']; ?>"  name="oldpic">
                        <img value="<?php echo $qr['picture']; ?>" class="img-thumbnail" src="<?php 
                        if ($qr['picture']){
                
                        echo $qr['picture'];
                        
                        }else{
                        echo "../images/no-image.png";
                        
                        }?>" align="center">
                        
                    </div></div>
                    
                    
                    <br><br>
			     <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">     <br><br>     <br><br>
                        <button  class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Asset</button>
						
                      </div>
                    </div>
           
                    <div class="ln_solid"></div>
               
                </div>
              </div>
            </div>
			
			     
			
			
	
	
            <div class="clearfix"></div>

        
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