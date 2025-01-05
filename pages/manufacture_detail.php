<?php
$mnp=$_GET['mnp'];
?>
	 
  <script type="text/javascript">
           $(document).ready(function(){

			    $("#site").change(function(){
                     var site=$("#site").val();
           	   	     $.ajax({
           	   	     	type:"post",
           	   	     	url:"dropdown_ajax_location.php",
           	   	     	data:"site="+site,
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
               Manufacture 
                  
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Manufacture Info<small></small></h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionMRhead=insert" method="post" class="form-horizontal">


 <div class="form-group row">
     
    <label for="exampleInputEmail1">Manufacture Code  :</label>
     <label for="exampleInputEmail1"><?php  echo $mnp ?> </label>
   
  </div>
                 
                    
                    
                    <?php
                    
                    	$dataSqlmr = "select * from manufacture_planning  where code_planning='$mnp'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xm = mysqli_fetch_array($dataQrymr);
                    ?>
                    
                    <div class="form-group">
    <label for="exampleInputEmail1">Manufacture Name  :</label>
     <label for="exampleInputEmail1"><?php  echo $xm['planning_tittle'] ?> </label>
   
  </div>
                     <div class="form-group">
    <label for="exampleInputEmail1">Manufacture Date  :</label>
     <label for="exampleInputEmail1"><?php  echo $xm['date_finish'] ?> </label>
   
  </div>
     <div class="form-group">
    <label for="exampleInputEmail1">Manufacture PIC  :</label>
     <label for="exampleInputEmail1"><?php  echo $xm['pic'] ?> </label>
   
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
    <label for="exampleInputEmail1">Manufacture Location  :</label>
     <label for="exampleInputEmail1"><?php  echo $xm['manufacture_location'] ?> </label>
   
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Notes  :</label>
     <label for="exampleInputEmail1"><?php  echo $xm['notes'] ?> </label>
   
  </div>
  
   <div class="form-group">
    <label for="exampleInputEmail1">Status  :</label>
     <label for="exampleInputEmail1">
         
         <?php if ($xm['status']==0){ ?>
                          
                 <span class="label label-warning">Preparing</span>
                 
                 <?php }else if($xm['status']==1){?>
                   <span class="label label-primary">On Progress</span>
                  <?php }else if($xm['status']==2){?>
                  <span class="label label-success">Finish</span>
                  <?php }else if($xm['status']==3){?>
                  <span class="label label-info">Asset</span>
                  <?php }?>
     </label>
   
  </div>

					 
           
                  

                  </form>
	
		    
		    
                </div>
                   <br><br>
              </div>
            </div>
			
			


            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Component For Manufacture<small></small></h2>
                  
         
                  
                  <div class="clearfix"></div>
                </div>

                <div class="x_content">
	      <div class="form-group">
                      <div >
                        
                        
                
                        
               <div class="table-responsive">
                   
                  <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                               <th>Item Name</th>
                              <th>Specification</th>
							    
                             <th>Qty Planning</th>
                                
                                 <th >Usage</th>
								  <th >Notes</th>
                               
                          
                            </tr>
                          </thead>


                          <tbody>
                          <?php
        
    
	$no = 1;
	foreach($db->viewAddItemMnp($mnp) as $x){
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $x['item_code']; ?></td>
		<td><?php echo $x['part_number']; ?></td>
		<td><?php echo $x['item_name']; ?></td>
		<td><?php echo $x['specification']; ?></td>

		
			<td bgcolor="#FFFF00"><?php echo $x['qty']; ?></td>
					
		
					<td bgcolor="#FFFF00">
			   <?php 
			   	$dataSqlmnp1 = "select *,SUM(qty) as totalqty from material_usage   where no_mnp='".$_GET['mnp']."' AND item_code='".$x['item_code']."'";
							$dataQrymnp1 = mysqli_query($conn,$dataSqlmnp1) or die ("Gagal Query".mysqli_error());
							$xmnp1 = mysqli_fetch_array($dataQrymnp1);
							
					
					echo $xmnp1['totalqty'];	
			   
			   ?>
			  
			</td>
				<td bgcolor="#FFFF00"><?php echo $x['notes']; ?></td>
		
			

	
                 
	</tr>
	<?php 
	}
	?>
                          </tbody>

                  </table>
                      <div class="form-group">
                      
                    <?php
                    
                    	$dataSqlmr = "select *,status as sts from manufacture_planning  where code_planning='$mnp'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xmss = mysqli_fetch_array($dataQrymr);
                    ?>
                    
                                    <div class="form-group">
            
                  
        
               
                <?php if ($xs['status']==3){ ?>
                         <a href="../notes/mnf.php?mnp=<?=$_GET['mnp']?>" target="_BLANK"> <button type="submit" class="btn btn-info">Print</button></a>	     
                         <?php }?>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
		  
		  
		  
		  
          </div>
          </div>
 

	 <?php
      include("jscript/datatables.php");
     ?>
   