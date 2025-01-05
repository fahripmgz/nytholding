  <style>
      
      .not-active {
   pointer-events: none;
   cursor: default;
}
      
  </style>
<script src="../dist/jquery-1.11.1.min.js"></script>

<script src="../dist/jquery.bootgrid.min.js"></script>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Asset Data
                 
                </h3>
            </div>

 
          </div>
          <div class="clearfix"></div>
 <br><br>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                        
                      <div class="card-box table-responsive">
                      

<table id="assettable" class=" table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                            <tr>
                              <th>No</th>
                              <th>Asset Code</th>
                              <th>Manufacture Number</th>
                              <th>Asset Name</th>
                           <th>Specification</th>
                              <th>Category</th>
                              <th>Sub Category</th>
							     <th>Manufacture</th>
                              <th>Brand</th>
                            <th>Measurement</th> 
                             <th>Remark</th>
							 <th>Site</th>
							 <th>Location</th>
							 <th>Status</th>
                            <th>Edit</th>
							<th>View Manufacture</th>
                             <th>View Maintenance</th>
                            </tr>
                          </thead>

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
     
     
     <?php if($_SESSION['SES_LEVEL']=='16'){?>
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
 
"sAjaxSource": "serverside_asset.php",
     
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
	{ "aaData": "site_name"},
	{ "aaData": "location_name"},
	{ "aaData": "status_name"},
                   
   {
				"mData": [ 0 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-edit" href="?pages=edit_asset&id='+data+'"></a>';
		}
	 },
	 {
				"mData": [ 2 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-list" href="?pages=manufacture_detail&mnp='+data+'"></a>';
		}
	 },
     {
				"mData": [ 0 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-wrench" href="?pages=maintenance_detail&mnp='+data+'"></a>';
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
		</script>'
		<?php }else{?>
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
 
"sAjaxSource": "serverside_asset.php",
     
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
	{ "aaData": "site_name"},
	{ "aaData": "location_name"},
	{ "aaData": "status_name"},
                   
   {
				"mData": [ 0 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-ban-circle" href="#"></a>';
		}
	 },
	 {
				"mData": [ 2 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-list" href="?pages=manufacture_detail&mnp='+data+'"></a>';
		}
	 },
     {
				"mData": [ 0 ],
				<!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-wrench" href="?pages=maintenance_detail&mnp='+data+'"></a>';
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
		
		<?php }?>