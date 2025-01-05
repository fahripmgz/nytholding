 <?php if(($_SESSION['SES_LEVEL']==17)OR($_SESSION['SES_LEVEL']==18)OR($_SESSION['SES_LEVEL']==14)) { ?>          
 

  <link href="../css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="../css/switchery/switchery.min.css" />
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=lobf74jp19esj6k8jr89jiykujul466kdjl8sjah1yk0tw9e"></script>

<script>
    tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
    
    
</script>
<?php

$nopo=$_GET['po'];
?>
	 
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
      <script language="JavaScript">
<!--

function enable_text(status)
{
status=!status;	
	document.f1.other_text.disabled = status;
}
//-->
</script>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Purchase Order
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
                  <h2> Purchase Order<small></small></h2>
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
                  <form action="../controller/process.php?actionMRhead=insert" method="post" class="form-horizontal form-label-left input_mask">



                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">PO Number  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php  echo $nopo ?> </label>
                        
                    
                      </div>
                    </div>
                    
                    
                    <?php
                    
                    	$dataSqlmr = "select * from purchase_order a left join master_vendor b on a.to=b.id_vendor left join material_request c on a.mr_number=c.id_mr left join master_user d on a.pic_created=d.id_user where a.number_po='$nopo'";
							$dataQrymr = mysql_query($dataSqlmr) or die ("Gagal Query".mysql_error());
							$xm = mysql_fetch_array($dataQrymr);
                    ?>
                    
                 <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Vendor Name  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                <?php  echo $xm['vendor_name']?>
                      </div>
                    </div>
                    
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Reff Number  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                <?php  echo $xm['reff_number']?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">PIC Request  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <?php  echo $xm['first_name']?>
                      </div>
                    </div>
			
					      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Register  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                    
                          
                      <?php  echo $xm['date_register']?>
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
                
     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">MR Number  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <?php 

$datas = mysql_query("select * from item_purchase_order_tmp where no_po='".$_GET['po']."' group by no_mr");
		while($ds = mysql_fetch_array($datas)){
		    
	   echo $ds['no_mr'];
	   echo ' / ';
		}

 ?>
                      </div>
                    </div>
            <br> <br> <br>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <?php  echo $xm['subject']?>
                      </div>
                    </div>
              <br>
              
                   <?php
                    
                    	$dataSqlsratus = "select * from purchase_order  where number_po='$nopo'";
							$dataQrymrstatus = mysql_query($dataSqlsratus) or die ("Gagal Query".mysql_error());
							$xs = mysql_fetch_array($dataQrymrstatus);
                    ?>
					    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Notes  :</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                         <?php  echo $xs['notes']?>
                      </div>
                    </div><br>
				  <div class="form-group">
				      
				     
                    
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Status  :</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?php if ($xs['status_po']==0){ ?>
                          
                 <span class="label label-warning">Pending</span>
                 
                 <?php }else if($xs['status_po']==1){?>
                   <span class="label label-primary">Created</span>
                  <?php }else if($xs['status_po']==2){?>
                  <span class="label label-success">Approved</span>
                  <?php }else if($xs['status_po']==3){?>
                  <span class="label label-danger">Rejected</span>
                  <?php }else if($xs['status_po']==4){?>
                   <span class="label label-info">PO Created</span>
                  <?php }?>
                  
                      </div>
                    </div>
     
                  

                  </form>
		<div class="form-group">
                      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                       <br><br>
                          <?php if ($xs['status_po']==1) { ?>
								<a  href="#Approve"  data-toggle="modal">  <button  class="btn btn-success">Approve PO</button></a>
                        	  <a  href="#Reject"  data-toggle="modal">  <button  class="btn btn-danger">Reject PO</button></a>
                        	  <a  href="#Revision"  data-toggle="modal">  <button  class="btn btn-warning">Revison PO</button></a>
                        	  <a  href="#Void"  data-toggle="modal">  <button  class="btn btn-danger">Void PO</button></a>
                        	  <?php } ?>
			 <div  id="Approve" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionPOstatus=Approve" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                          <input type="hidden" class="form-control"  value="<?php echo $_GET['po'] ?>" placeholder="Level Name" name="txtPO">
                          <input type="hidden" class="form-control"  value="<?php echo $_SESSION['SES_LOGIN'] ?>" placeholder="Level Name" name="$txtUserApprove">
                               <?php
                          $date=date("Y-m-d");
                          
                          ?>
                          
                           <input type="hidden" class="form-control"  value="<?php echo $date ?>" placeholder="Level Name" name="$txtdateApprove">
                      
                        <p>Are You sure, You want to Approve PO?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Approve PO</button>  </div>
</form>
                    </div>
                  </div>
                </div>
                        
                   	 <div  id="Reject" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionPOstatus=Reject" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        <input type="hidden" class="form-control"  value="<?php echo $_GET['po'] ?>" placeholder="Level Name" name="txtPO">
                          <input type="hidden" class="form-control"  value="<?php echo $_SESSION['SES_LOGIN'] ?>" placeholder="Level Name" name="$txtUserApprove">
                               <?php
                          $date=date("Y-m-d");
                          
                          ?>
                          
                           <input type="hidden" class="form-control"  value="<?php echo $date ?>" placeholder="Level Name" name="$txtdateApprove">
                        <p>Are You sure, You want to Reject PO?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Reject PO</button>  </div>
</form>
                    </div>
                  </div>
                </div>     
					 	 <div  id="Revision" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Revisi PO?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                     <a href="../controller/process.php?actionPOstatus=Revision&po=<?=$_GET['mr']?>"> <button type="submit" class="btn btn-warning">Revision PO</button></a>	
                    </div>
                  </div>
                </div> 	
                      </div>
                      
                            	 <div  id="Void" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionPOstatus=Void" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Void PO?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-danger">Void PO</button>  </div>
</form>
                    </div>
                  </div>
                </div> 
                      
                    </div> 
		          </div>
		    
		    
                </div>
                   <br><br>
              </div>
            </div>
			
		
            <?php include "add_item_po_table.php"?>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2> Purchase Order List<small></small></h2>
                  
                  
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
	      <div class="form-group">
                      <div >
                        
                        
                
                        
               <div class="table-responsive">
                   
                  <table id="datatable-keytable" class="table table-striped responsive-utilities jambo_table bulk_action">
                               <thead>
                            <tr>
                              <th>No</th>
                              <th>From No.MR</th>
                              <th>Item Code</th>
                              <th>Part Number</th>
                               <th>Item Name</th>
                              <th>Specification</th>
                             <th>Qty</th>
                               <th>Maesurement</th>
                                <th>Unit Price</th></th>
                                <th>Total Price</th></th>
                                <th>Notes</th>
                                
                                <?php if ($xs['status_po']==0){ ?>
                               <th>Edit</th>
                              
							     <th>Delete</th>
							  <?php }?>
                            </tr>
                          </thead>


                          <tbody>
                          <?php
        
    
	$no = 1;
	$numberPO=$_GET['po'];
	foreach($db->viewAddItemPO($numberPO) as $xz){
	     $price=$xz['price'];
	 $qty=$xz['qty'];
	 $totalprice=$price*$qty;
	 $grandtotal=$totalprice+$grandtotal;
	  $afterdisc= $grandtotal-$xs['total_discount'];
	 $ppn=$xs['ppn'];
	 
	 if ($ppn=='0'){
	 $afterppn=0;   
	 }else{
	 $afterppn=$afterdisc*$ppn/100;
	 }
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $xz['no_mr']; ?></td>
		<td><?php echo $xz['item_code']; ?></td>
		<td><?php echo $xz['part_number']; ?></td>
		<?php if ($xz['item_code']==''){ ?>
			<td><?php echo $xz['description']; ?></td>
		<td><?php echo $xz['spec']; ?></td>
		<?php }else{?>
		
		
		
		
		<td><?php echo $xz['item_name']; ?></td>
		<td><?php echo $xz['specification']; ?></td>
		<?php }?>
		
			<td><?php echo $xz['qty']; ?></td>
					<td><?php echo $xz['maesurename']; ?></td>
					<td><?php echo  number_format($xz['price'],2) ?></td>
						<td><?php echo  number_format($totalprice,2) ?></td>
			<td><?php echo $xz['notes']; ?></td>
        <?php if ($xs['status_po']==0){ ?>
        <td>
            
        
        <a  href="#UpdateItem<?php echo $xz['id_item_po']; ?>" data-id='"<?php echo $xz['id_item_po'];?>"' data-toggle="modal"><span class="fa fa-edit"></span></a>

			   
		
		
        </td>
		 <div id="UpdateItem<?php echo $xz['id_item_po']; ?>" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
             <form action="../controller/process.php?actionAddItemPO=update" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Update Qty</h4>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty Request </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="hidden" class="form-control"  value="<?php echo $xz['id_item_po']; ?>" placeholder="Level Name" name="id">
					  <input type="hidden" class="form-control"  value="<?php echo 	$_GET['po']; ?>" placeholder="Level Name" name="txtNoPOedit">
                        <input type="hidden" class="form-control"  value="<?php echo $xz['item_code']; ?>" placeholder="Level Name" name="txtItemCode">
                        <input type="number" class="form-control"  value="<?php echo $xz['qty']; ?>" placeholder="Qty" name="txtEditqty">
                      </div>
                    </div>
                         <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Price </label>
                      <div class="col-md-12 col-sm-12 col-xs-12">
					  <input type="number" class="form-control"  value="<?php echo $xz['price']; ?>" placeholder="Price" name="txtEditPrice">
                      </div>
                    </div>
                    
			  	
			     <div class="modal-footer">		
                           <div class="col-md-12 col-sm-12 col-xs-12">
                               	<br><Br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
            </form>
                    </div>
                  </div>
                </div>
        
		<td>
	
	   <a  href="#DeleteItem<?php echo $xz['id_item_po']; ?>" data-id='"<?php echo $xz['id_item_po'];?>"' data-toggle="modal"><span class="fa fa-trash"></span></a>

       		
		</td>
		
			  <?php }?>
		<div  id="DeleteItem<?php echo $xz['id_item_po']; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
 <form action="../controller/process.php?actionAddItemPO=delete" method="post" class="form-horizontal form-label-left input_mask">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                           <input type="hidden" class="form-control"  value="<?php echo $xz['id_item_po']; ?>" placeholder="" name="id">
                          <input type="hidden" class="form-control"  value="<?php echo $_GET['po']; ?>" placeholder="" name="txtNoPODelete">
                        <p>Are You sure, You want to Delete Item?</p>
                      </div> 
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        
                        <button type="submit" class="btn btn-primary">Delete</button>
                        
                       	
                      </div>
</form>
                    </div>
                  </div>
                </div>
		
		
	</tr>
	
	<?php 
	}
	?>
	
	  
                          </tbody>
                      

                  </table>
                  <tr>
                       <?php if ($xs['status_po']==0){ ?>
               
                <a  href="#Deleteall" data-toggle="modal">  <button type="submit" class="btn btn-warning">Clear All Item</button></a>
                   
             
                   </div>       
                          
               
                          <h2 align="right"> Sub Total :<input type="number"  value="<?php echo $grandtotal ?>"  name="txtTotal" readonly></h2>    
                         </tr> 
	       <tr>
                          <h2 align="right">
                 <div class="btn-group open">
                    <button type="button" class="btn btn-danger">PPN % </button>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                      <span class="caret"></span>
                      <span class="sr-only">Please Select</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="../controller/process.php?actionAddItemPO=addPPN&po=<?=$_GET['po']?>">PPN%</a>
                      </li>
                      <li><a href="../controller/process.php?actionAddItemPO=noPPN&po=<?=$_GET['po']?>">Not Use</a>
                      </li>
                      
                      </li>
                    </ul>
                  </div>
                         : <input type="number"  value="<?php echo $afterppn ?>" name="txtTotal" readonly></div>
                       </h2>    
                         </tr> 
                  <tr>
                       <form id="po" action="../controller/process.php?actionAddItemPO=addTransport&po=<?=$_GET['po']?>" method="post" class="form-horizontal form-label-left input_mask">
                           
                          <h2 align="right"> TRANSPORT :<input type="number"  value="<?php echo $xs['transport_price']?>" onclick="saveValue(document.getElementById('po').value);" name="txtTransport"></h2>
                          </form>
                         </tr>
                          <tr>
                       <form id="discpo" action="../controller/process.php?actionAddItemPO=addDiscount&po=<?=$_GET['po']?>" method="post" class="form-horizontal form-label-left input_mask">
                           
                          <h2 align="right"> DISCOUNT :<input type="number"  value="<?php echo $xs['total_discount']?>" onclick="saveValue(document.getElementById('discpo').value);" name="txtDiscount"></h2>
                          </form>
                         </tr>
                         
                          <form action="../controller/process.php?actionAddItemPO=addInfoPO" method="post" class="form-horizontal form-label-left input_mask">


                           <tr>
                          <h2 align="right"> TOTALin :
                          <?php if($xs['total_price']=='0'){?>
                          
                          <input type="number"  value="<?php echo $xs['transport_price']+$afterppn+$grandtotal-$xs['total_discount']; ?>" name="txtTotal"></h2>
                          <?php }else{?>
                           <input type="number"  value="<?php echo $xs['total_price'] ?>" data-toggle="tooltip" title="Original Value Is <?php echo $xs['transport_price']+$afterppn+$grandtotal-$xs['total_discount']; ?>" name="txtTotal"></h2>
                           <?php }?>
                         </tr>
                             
                 
                   <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2> Notes<small></small></h2>
            
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
               

             <input type="hidden" class="form-control"  value="<?php echo $_GET['po']; ?>" placeholder="" name="txtPO">
             
   
             
                        <textarea  name="txtNotes" rows="3"  placeholder='Notes'><?php echo $xs['notes'] ?></textarea>
                      
           
  </div>  </div>
           
                    <div class="ln_solid"></div>
               
                </div>
                       <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2> Term And Condition, Vendor Detail and Payment Term<small></small></h2>
            
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
               

             <input type="hidden" class="form-control"  value="<?php echo $_GET['po']; ?>" placeholder="" name="txtPO">
             
             <?php 
             $mysqlDatainfo = "select * from master_info where id_info='1'";
             $dataQryinfo = mysql_query($mysqlDatainfo) or die ("Gagal Query".mysql_error());
             $xinfo = mysql_fetch_array($dataQryinfo);
             
                       ?>
              <?php if ($xs['info']=='') { ?>
                        <textarea  name="txtInfoPO" placeholder='Term And Condition, Vendor Detail and Payment Term'><?PHP echo $xinfo['info']?></textarea>
                      <?php }else{?>
                      
                      
                      <textarea  name="txtInfoPO" placeholder='Term And Condition, Vendor Detail and Payment Term'><?PHP echo $xs['info']?></textarea><?php } ?>
           
  </div>  </div>
           
                    <div class="ln_solid"></div>
                <button type="submit" class="btn btn-primary">Add Info</button>
                </form>  
                </div>
                
              </div>
            </div>
            
                  <?php } else{?>
                  
                  
                  
                       <tr>
               
                          <h2 align="right"> Sub Total :<?php echo number_format($grandtotal) ?></h2>    
                         </tr> 
	       <tr>
                         
                    <h2 align="right">PPN % 
                         : <?php echo number_format($afterppn) ?></div>
                       </h2>    
                         </tr> 
                  <tr>
                          <h2 align="right"> TRANSPORT :<?php echo number_format($xs['transport_price'])?></h2>
                          </form>
                         </tr>
                         
                         
                           <tr>
                          <h2 align="right"> <b>TOTAL :<?php echo number_format($xs['transport_price']+$afterppn+$grandtotal,2) ?></b></h2>    
                         </tr>
                             
                 
                   <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2> Notes<small></small></h2>
            
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
               

           
                        <?PHP echo $xs['notes']?>
                      
           
  </div>  </div>
           
                    <div class="ln_solid"></div>
               
          
                </div>
                     
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="x_panel">
                <div class="x_title">
                  <h2> Term And Condition, Vendor Detail and Payment Term<small></small></h2>
            
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                 

             
                      <?PHP echo $xs['info']?>
                      
           
           
  </div>  </div>
           
                    <div class="ln_solid"></div>
               
                </div>
             

                
              </div>
            </div>
                  
                  
            
                  
                  
                  <?php }?>
                  <br>
                  <br>
                  <br>
                  
           
                </div>
              </div>
            </div>
            
            
            
                       <div class="form-group">
                    
                                    <div class="form-group">
                 
                 
                       
                        
			<div id="Deleteall" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Delete All Item ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         <a href="../controller/process.php?actionAddItemPO=deleteall&po=<?=$_GET['po']?>"> <button type="submit" class="btn btn-warning">Clear All Item</button></a>	
                      </div>

                    </div>
                  </div>
                </div>	
                    <?php if ($xs['status_po']==0){ ?>
               
                <a  href="#Sendrequest" data-toggle="modal"> <button type="submit" class="btn btn-primary">Send Request</button></a>
	        
               <?php }?>
                        		<div id="Sendrequest" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2" align="center">Notification</h4>
                      </div>
                      <div class="modal-body" align="center">
                        
                        <p>Are You sure, You want to Send Purchase Order ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="../controller/process.php?actionAddItemPO=Updatestatuspo&po=<?=$_GET['po']?>"> <button type="submit" class="btn btn-primary">Send Request</button></a>
			 </div> 

                    </div>
                  </div>
                </div>		
                         <a href="../notes/po.php?po=<?=$_GET['po']?>" target="_BLANK"> <button type="submit" class="btn btn-info">Print</button></a>	     
                         
                    </div>
                    <br><Br>
                     <div class="x_title">
                  <h2><u>Document</u> <small></small></h2>
                </div>
                <br><br>
               <?php  foreach($db->viewDocumentpo($numberPO) as $xd){ ?>
               
               <a href="<?php echo $xd['location']; ?>" download="Doc-<?php echo $xd['doc_name']; ?>">
 <span class="fa fa-file"></span><?php echo $xd['doc_name']; ?>
</a>
             <?php  }?>
               
               
          </div>
 

	 <?php
      include("jscript/datatables.php");
     ?>
	<?php }?>