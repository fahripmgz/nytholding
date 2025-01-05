
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Catalog |
                    <small>
                         Asset And Material Consumable 
                    </small>
                </h3>
            </div>

 
          </div>
          <div class="clearfix"></div>
 <br><br>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Catalog List <small></small></h2>
                  <a href="?pages=master_catalog"> <button type="button" class="btn btn-primary btn-md">Add New Catalog</button></a>
                   <a href="?pages=import_catalog"> <button type="button" class="btn btn-primary btn-md">Import</button></a>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                        
                      <div class="card-box table-responsive">
                      

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
                            <th>Detail</th>
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
     ?> "></script>

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
     { "aaData": "specification"},
     { "aaData": "category_name"},
     { "aaData": "sub_catname"},
     { "aaData": "manufacture_name"},
     { "aaData": "brand_name"},
     { "aaData": "maesurename"},
    { "aaData": "remark"},
                   

     {
				"mData": [ 1 ], <!-- Ini adalah untuk Link ID urutan kolom seperti table mulai dari 0 untuk data pertama -->
				"mRender": function ( data, type, full ) {
	
                return '<a  align="center" class="glyphicon glyphicon-list-alt" href="?page=history&code='+data+'"></a>';
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