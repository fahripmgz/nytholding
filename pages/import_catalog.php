 
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>
                    Consumable Catalog | 
                    <small>
                        Update  Consumable 
                    </small>
                </h3>
            </div>

     
          </div>
                   <div class="clearfix"></div>
          <div class="row">
                       <div class="x_panel">
    <div class="container">
        <div class="page-title">
            <h3><b>Import Catalog</b></h3>
        </div>
        <div class="alert alert-warning alert-dismissible" role="alert">
            <strong>Warning!</strong> Please ensure the Excel file follows the specified format.
        </div>
        
        <form action="../controller/process.php?actionImportCatalog=insert" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="excelFile">Upload Excel File:</label>
                <input type="file" id="excelFile" name="excelFile" class="form-control" accept=".xls,.xlsx" required>
            </div>
            <button type="submit" class="btn btn-custom">Import Catalog</button>
        </form>
        
        <div class="mt-4">
            <h4>Note:</h4>
            <p>Please ensure your Excel file contains the following columns:</p>
            <ul>
                <li>Sub Category</li>
                 <li>Item Name</li>
                <li>Part Number</li>
                <li>Specification</li>
                <li>Measurement</li>
                <li>Min Stock</li>
                 <li>Remark</li>
            </ul>
        </div>
    </div>
</div>
 </div>
 </div>