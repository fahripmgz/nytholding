  <?php if(($_SESSION['SES_LEVEL']==18)) { ?>    

<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Master User | 
                    <small>
                       Please insert New User
                    </small>
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div>
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Form Input New User <small></small></h2>
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
                  <form action="../controller/process.php?actionUser=insert" class="form-horizontal form-label-left"   method="post" novalidate>


  
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name *</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtFirstname"  placeholder="First Name" required="required">
                      </div>
                    </div>
                <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtLastname"  placeholder="Last Name" required="required">
                      </div>
                    </div>
					
				 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Email *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="email2" class="form-control"  name="txtEmail"  placeholder="Email" required="required">
                      </div>
                    </div>
				 <div class="item form-group">
                      <label for="password" class="control-label col-md-3">Password</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password2" type="password" name="txtPassword" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
						      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Level *</label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                     
                                         <select name="txtLevel" class="form-control">
          <option>Level</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_level";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_level']."'>".$data['level_name']."</option>";
                 }
          ?>
          </select>
                      </div>
                    </div>
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                     
                                         <select name="txtSite" class="form-control">
          <option>Site</option>
       
          <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_site";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
                    echo "<option value='".$data['id_site']."'>".$data['site_name']."</option>";
                 }
          ?>
          </select>
                      </div>
                    </div>
                   

           
        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Address *</label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="textarea" required="required" name="textAddress" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>
      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number *</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtPhone"  placeholder="Phone Number" required="required">
                      </div>
                    </div>
					   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">HR Code </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtHRcode"  placeholder="HR Code">
                      </div>
                    </div>
                       <div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                           <button type="submit" class="btn btn-primary">Cancel</button>
                      	<button type="submit" class="btn crud-submit btn-success">Submit</button>
                      </div>
                    </div>

                    <div class="ln_solid"></div>
               

    </form>
                
                </div>
              </div>
            </div>
			      
			     
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>User List <small></small></h2>
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

               <div class="table-responsive">
                       <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>First Name</th>
							   <th>Last Name</th>
							    <th>Email</th>
							   <th>Level</th>
							    <th>Site</th>
							   <th>Address</th>
							   <th>Phone Number</th>
							   <th>HR Code</th>
							   <th>Status</th>
							   <th>Date Register</th>
							   
                              <th>Update</th>
							  <th>Delete</th>
                            </tr>
                          </thead>
 <tbody>
                           <?php
	$no = 1;
	foreach($db->viewUser() as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['first_name']; ?></td>
		<td><?php echo $x['last_name']; ?></td>
		<td><?php echo $x['email']; ?></td>
		<td><?php echo $x['level_name']; ?></td>
		<td><?php echo $x['site_name']; ?></td>
		<td><?php echo $x['address']; ?></td>
		<td><?php echo $x['phone_number']; ?></td>
		<td><?php echo $x['hr_code']; ?></td>
		<td><?php echo $x['status_name']; ?></td>
		<td><?php echo $x['date_register']; ?></td>
        <td>
        <a  href="#updateUser<?php echo $x['id_user']; ?>" data-id='"<?php echo $x['id_user'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>
		
			   
		
		
        </td>
		 <div id="updateUser<?php echo $x['id_user']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             
			 
			 
			   <form action="../controller/process.php?actionUser=update" class="form-horizontal form-label-left"   method="post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update</h4>
                      </div>
                      <div class="modal-body">
                         

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
  
               <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name *</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="hidden" class="form-control"  name="id"  value="<?php echo $x['id_user']?>" placeholder="First Name" required="required">
                        <input type="text" class="form-control"  name="txtFirstnameupdate"  value="<?php echo $x['first_name']?>" placeholder="First Name" required="required">
                      </div>
                    </div><br>
					<br>
                <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtLastnameupdate"  value="<?php echo $x['last_name']?>" placeholder="Last Name" required="required">
                      </div>
                    </div>
						<br>	<br>
				 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Email *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="email2" class="form-control"  name="txtEmailupdate" value="<?php echo $x['email']?>"  placeholder="Email" required="required">
                      </div>
                    </div>	<br>	<br>
		 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">New Password *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" class="form-control"  name="txtPassupdate" value=""  placeholder="Password">
                      </div>
                    </div>	<br>	<br>
						      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Level *</label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                     
                                         <select name="txtLevelupdate" class="form-control">
          <option>Level</option>
       
             <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_level";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
					 if ($data['id_level']==$x['id_level']) {
						 $cek="selected";
					 } else { $cek=""; }
                    echo "<option value='".$data['id_level']."' $cek>".$data['level_name']."</option>";
                 }
				 
		 
          ?>
          </select>
                      </div>
                    </div>	<br>	<br>
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                     
                                         <select name="txtSiteupdate" class="form-control">
          <option>Site</option>
       
               <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_site";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
					 if ($data['id_site']==$x['id_site']) {
						 $cek="selected";
					 } else { $cek=""; }
                    echo "<option value='".$data['id_site']."' $cek>".$data['site_name']."</option>";
                 }
				 
		 
          ?>
          </select>
                      </div>
                    </div>	<br>	<br>
                   

           
        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Address *</label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="textareaupdate" required="required" name="textAddressupdate"  class="form-control col-md-7 col-xs-12"><?php echo $x['address']?></textarea>
                      </div>
                    </div>	
					
					<br>	<br>
					<br>	<br>
				
      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number *</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtPhoneupdate"  value="<?php echo $x['phone_number']?>" placeholder="Phone Number" required="required">
                      </div>
                    </div>	<br>	<br>
					   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">HR Code </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control"  name="txtHRcodeupdate"  value="<?php echo $x['hr_code']?>" placeholder="HR Code">
                      </div>
                    </div>	<br>	<br>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site *</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                     
                                         <select name="txtstatusupdate" class="form-control">
          <option>Status</option>
       
               <?php
                 // query untuk menampilkan propinsi
                 $query = "SELECT * FROM master_status";
                 $hasil = mysql_query($query);
                 while ($data = mysql_fetch_array($hasil))
                 {
					 if ($data['id_status']==$x['id_status']) {
						 $cek="selected";
					 } else { $cek=""; }
                    echo "<option value='".$data['id_status']."' $cek>".$data['status_name']."</option>";
                 }
				 
		 
          ?>
          </select>
                      </div>
                    </div>

                    <div class="ln_solid"></div>
               

    
                      </div>
                      <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
            </form>
			 
			 
			 
			 
			 
			 
			 
			 
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
		<td>
			  <a  href="#deleteteUser<?php echo $x['id_user']; ?>" data-toggle="modal" ><span class="fa fa-trash"></span></a>
			
                <div id="deleteteUser<?php echo $x['id_user']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete User?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a  href="../controller/process.php?id=<?php echo $x['id_user']; ?>&actionUser=delete"><button type="button" class="btn btn-primary">Delete</button></a>	
                      </div>

                    </div>
                  </div>
                </div>		
		</td>
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
          </div>
    <?php
      include("jscript/datatables.php");
     ?>
        </div>
		<br>
		<br>
		<br>
		<br>
		 <script src="../js/validator/validator.js"></script>
  <script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>

		<script>
		function myFunction() {
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var ok = true;
    if (pass1 != pass2) {
		
		
        //alert("Passwords Do not match");
        document.getElementById("pass1").style.borderColor = "#E34234";
        document.getElementById("pass2").style.borderColor = "#E34234";
        ok = false;
		alert("Passwords do not match.");
    }
    else {
        alert("Passwords Match!!!");
    }
    return ok;
}

		</script>
	<?php }?>