<?php
$outstandingCount = $db->countOutstandingPutAway();
?>
 <!--level
 level 1 superadmin
 level 2 admin warehouse
 level 3 manager warehouse
 level 4 user
 
 !?>

 
 <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
			<br>
             	<br>	<br>	<br>
              <ul class="nav side-menu">
			  
			    <li class="<?php 
					if (($_GET['pages'])=="dashboard") {
						echo "active ";
					}
					?> hover">
                    <a href="?pages=dashboard">
                     <i class="fa fa-home"></i>Dashboard</i>
                   </a>
    
                   <b class="arrow"></b>
                  </li>
      
    			  <li class="<?php 
    					if (($_GET['pages'])=="m_catalog") {
    						echo "active ";
    					}
    					?> hover">
                    <a href="?pages=m_catalog">
                     <i class="fa fa-barcode"></i>Catalog</i>
                   </a>
    
                   <b class="arrow"></b>
                  </li>
                   <li class="<?php 
    					if (($_GET['pages'])=="stock_list") {
    						echo "active ";
    					}
    					?> hover">
                    <a href="?pages=stock_list">
                     <i class="fa fa-plus"></i>Stock List</i>
                   </a>
    
                   <b class="arrow"></b>
                  </li>
                  
              
		  		
				
					 <li><a><i class="fa fa-sign-in"></i>Inbound<span class="fa fa-chevron-down"></span></a>
				 
				 <ul class="nav child_menu" style="display: none">

                 <li class="<?php 
					if (($_GET['pages'])=="good_receive") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=good_receive">Good Receive</a>
                    </li>
                            <li class="<?php 
					if (($_GET['pages'])=="good_receive_report") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=good_receive_report">Good Receive Report</a>
                    </li>
                    <li class="<?php 
					if (($_GET['pages'])=="put_away") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=put_away">Put Away   
                   <?php if ($outstandingCount > 0) { ?>
                    <span class="badge badge-danger" style="background-color:#ff6004;"><?php echo $outstandingCount; ?></span> <!-- Badge Notifikasi -->
                    <?php } ?></a>
                    </li>
                    </li>
					
					</ul>
		
			 <li><a><i class="fa fa-sign-out"></i>Outbound<span class="fa fa-chevron-down"></span></a>
				 
				 <ul class="nav child_menu" style="display: none">

                 <li class="<?php 
					if (($_GET['pages'])=="order_list") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=order_list">Order List</a>
                    </li>
                            <li class="<?php 
					if (($_GET['pages'])=="goods_issue") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=goods_issue">Good Issue List</a>
                    </li>
                    <li class="<?php 
					if (($_GET['pages'])=="ready_pickup") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=ready_pickup">Pickup List</a>
                    </li>
                    </li>
					
					</ul>
		
					
				
				 
			
					
					
				 <li><a><i class="fa fa-bar-chart"></i>Report<span class="fa fa-chevron-down"></span></a>
				 
				 <ul class="nav child_menu" style="display: none">
				     <li class="<?php 
					if (($_GET['pages'])=="receive_item") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=receive_item">Report Item Receive</a>
                    </li>
				     
				       <li class="<?php 
					if (($_GET['pages'])=="usage_item") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=usage_item">Report Item Usage</a>
                    </li>
                
                    </ul>
                    </li>
                  
				 
				 
				 </li>
				
				
                <li><a><i class="fa fa-cogs"></i> Master <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                      <li class="<?php 
					if (($_GET['pages'])=="master_brand") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_brand">Master Brand</a>
                    </li>
                     <li class="<?php 
					if (($_GET['pages'])=="master_category") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_category">Master Category</a>
                    </li>
					  <li class="<?php 
					if (($_GET['pages'])=="master_subcategory") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_subcategory">Master SubCategory</a>
                    </li>
					 <li class="<?php 
					if (($_GET['pages'])=="master_condition") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_condition">Master Condition</a>
                    </li>
					 
					<li class="<?php 
					if (($_GET['pages'])=="master_maesurement") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_maesurement">Master Maesurement</a>
                    </li>
					
					<li class="<?php 
					if (($_GET['pages'])=="master_manufacture") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_manufacture">Master Manufacture</a>
                    </li>
					
					<li class="<?php 
					if (($_GET['pages'])=="master_site") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_site">Master Site</a>
                    </li>
					<li class="<?php 
					if (($_GET['pages'])=="master_location") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_location">Master Location</a>
                    </li>
					<li class="<?php 
					if (($_GET['pages'])=="master_rack") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_rack">Master Rack</a>
                    </li>
					
					 
						<li class="<?php 
					if (($_GET['pages'])=="master_status") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_status">Master Status</a>
                    </li>
					
					 		<li class="<?php 
					if (($_GET['pages'])=="master_type") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_type">Master Type Material</a>
                    </li>
					 		<li class="<?php 
					if (($_GET['pages'])=="master_level") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_level">Master Level</a>
                    </li>
                    		<li class="<?php 
					if (($_GET['pages'])=="master_vendor") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_vendor">Master Vendor</a>
                    </li>
                    		<li class="<?php 
					if (($_GET['pages'])=="master_currency") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_currency">Master Currency</a>
                    </li>
                    					  	<?php
		    if ($_SESSION['SES_LEVEL']==1){
		?>
					 		<li class="<?php 
					if (($_GET['pages'])=="master_user") {
						echo "active ";
					}
					?> hover">
                   <a href="?pages=master_user">Master User</a>
                    </li>
                    <?PHP }?>
                    </li>
                  </ul>
                </li>
              
              </ul>
            </div>
          

          </div>
          
          <!-- /sidebar menu -->