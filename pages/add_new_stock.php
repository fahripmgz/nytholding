  
<script src="../dist/jquery-1.11.1.min.js"></script>

<script src="../dist/jquery.bootgrid.min.js"></script>
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
                      

                      <table id="employee_grid" class="table table-striped table-bordered" width="60%" cellspacing="0" data-toggle="bootgrid">
		
                     <thead>
                            <tr>
                              <th data-column-id="icat">ID</th>
                              <th data-column-id="item_code" >Item Code</th>
                              <th data-column-id="part_number">Part Number</th>
                              <th data-column-id="item_name">Item Name</th>
							   <th data-column-id="specification">Specification</th>
                              <th data-column-id="maesurename">Maesurement</th>
                              <th data-column-id="totalqty">Qty Stock</th>
                               <th data-column-id="commands" data-formatter="commands" data-sortable="false">View Stock | Add Stock</th>


							 
							  
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
  <script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#employee_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "serverside/stock.php",
		formatters: {
		 
		        "commands": function(column, row)
		        {
		            return "<a href=\"?pages=stock_list&id=" + row.item_code + "\"><span class=\"glyphicon glyphicon-search\"></span>View</a>&nbsp;&nbsp;"+ 
		            "&nbsp;&nbsp;<a href=\"?pages=add_stock_location&id=" + row.item_code + "\"><span class=\"glyphicon glyphicon-plus\"></span>Add</a>";
		        }
		        
		        
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
  
   grid.find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){
                                $.post('serverside/stock.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#employee_grid").bootgrid('reload');
                                }); 
								//$(this).parent('tr').remove();
								//$("#employee_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    });
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "serverside/stock.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#employee_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
});
</script>
