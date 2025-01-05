


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
               Maintenance Detail 
                  
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2>Asset Info<small></small></h2>
                
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form action="../controller/process.php?actionMRhead=insert" method="post" class="form-horizontal form-label-left input_mask">
    <?php
                    
                    	$dataSqlmr = "select A.status as stsasset,A.*,B.*,C.* from master_asset A left join master_site B ON A.site=B.id_site LEFT JOIN master_location C ON A.location=C.id_location   where A.id_asset='$mnp'";
							$dataQrymr = mysqli_query($conn,$dataSqlmr) or die ("Gagal Query".mysqli_error());
							$xm = mysqli_fetch_array($dataQrymr);
                    ?>


                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Code  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php  echo $xm['item_code'] ?> </label>
                        
                    
                      </div>
                    </div>
                    
                    
                
                    
                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Asset Name  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                     <?php  echo $xm['item_name']?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <?php  echo $xm['specification']?>
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Site  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <?php  echo $xm['site_name']?>
                      </div>
                    </div><br>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Location  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <?php  echo $xm['location_name']?>
                      </div>
                    </div><br>
				  <div class="form-group">
				      
				 
                    
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Status  :</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?php if ($xm['stsasset']==1){ ?>
                          
                 <span class="label label-primary">Active</span>
                 
                 <?php }else if($xm['stsasset']==2){?>
                   <span class="label label-primary">Operation</span>
                  <?php }else if($xm['stsasset']==3){?>
                  <span class="label label-success">Maintenace</span>
                  <?php }else if($xm['stsasset']==4){?>
                  <span class="label label-denger">Broken</span>
                  <?php }?>
                  
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
                  <h2><i class="fa fa-align-left"></i> Catalog List <small>For Maintenace Asset</small></h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <!-- start accordion -->
                  
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel">
                        
                       	
                      <a class="panel-heading collapsed" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOnecat" aria-expanded="false" aria-controls="collapseOne">
                       <button type="button" class="btn btn-primary"> <h4 class="panel-title">Open Table Catalog</h4></button>
                      </a>
             
                      <div id="collapseOnecat" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                                 
                        
               <div class="table-responsive">
                            <table id="assettable" class=" table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                              <th>Item Name</th>
						
                           <th>Specification</th>
                              <th>Category</th>
                              <th>Sub Category</th>
							     <th>Manufacture</th>
                              <th>Brand</th>
                            <th>Maesurement</th> 
                             <th>Remark</th>
                            <th>Add To Planning</th>
                            </tr>
                          </thead>

                        </table>  </div>
                        </div>
                      </div>
                    </div>

                  
                  
                  
                  
              </div>
            </div>
             </div> </div>
     
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Component For Maintenace<small></small></h2>
                  
         
                  
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
							  <th>Stock In Warehouse</th>
                              <th>Qty Usage</th>
                                 <th >Notes</th>
                                 <th >Date Maintenace</th>
								  <th >PIC Maintenace</th>
                               
                          
                            </tr>
                          </thead>


                          <tbody>
                          <?php
	$no = 1;
	foreach($db->viewMaintenance($mnp) as $x){
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
      <script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
            
            var oTable1 =
               $('#assettable')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
           
           "processing": true,
                "language": {
        "processing": " Please Wait..." //add a loading image,simply putting <img src="loader.gif" /> tag.
    },
        "bServerSide": true,
 
"sAjaxSource": "serverside_catalog.php",
     
    "ordering": true,
    "searching": true,
    "aoColumns":  [

     { "aaData": null, "bSortable": false },
     { "aaData": "item_code"}, 
     { "aaData": "part_number"},
     { "aaData": "item_name"},
     { "aaData": "spec"},
     { "aaData": "category_name"},
     { "aaData": "sub_catname"},
     { "aaData": "manufacture_name"},
     { "aaData": "brand_name"},
     { "aaData": "maesurename"},
    { "aaData": "remark"},
                   

     {
				"mData": [ 1 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-plus" href="../controller/process.php?addCatalogtomfp=insert&mfp=<?php echo $mnp ?>&code='+data+'"></a>';
		}
	 }
            
      
 
]
					  
					
} );
	
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
			})
		</script>
  