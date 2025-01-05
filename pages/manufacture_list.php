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
                   Manufacture List
                    <small>
                       
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
          			
			    			
			
	
	
            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Manufacturing Planning List <small></small></h2>
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
                              <th>No. Manufacture</th>
                              <th>Planning Name</th>
                               <th>Start Date</th>
							   <th>Finish Date</th>
                              <th>PIC</th>
							 
                             <th>Location</th>
                               <th>Notes</th>
                                  <th>Status</th>
                    
                                <th>Item</th>
							     <!--<th>Delete</th>-->
							  
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewManufacturing() as $x){
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
                  <span class="label label-success">Completed</span>
                  <?php }else if($x['status']==3){?>
                  <span class="label label-danger">Finish</span>
                  <?php }else if($x['status']==4){?>
                   <span class="label label-info">OverTime</span>
                  <?php }?></td>
      
        
		
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
	
  <?php
      include("jscript/datatables.php");
     ?>
  

 
  <!-- /datepicker -->