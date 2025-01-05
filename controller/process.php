<?php 
session_start();
require '../library/vendor/autoload.php'; // Include the autoload file
include '../model/db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$db = new database();

// IMPORT CATALOG 
$actionImportCatalog = $_GET['actionImportCatalog'] ?? null;

if ($actionImportCatalog === "insert" && isset($_FILES['excelFile'])) {
    // Load the Excel file
    $file = $_FILES['excelFile']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    // Prepare counters for success and errors
    $successCount = 0;
    $errorCount = 0;
    $duplicateItems = []; // Array to store duplicate items

    // Start from row 2 (index 1) to skip header
    foreach (array_slice($sheetData, 1) as $row) { // Skip the first row
        // Extracting data from each row
        $subcat = $row['A'] ?? null; // Adjust based on actual column index
        $txtitemname = $row['B'] ?? '';
        $txtpartnumber = $row['C'] ?? '';
        $txtspec = $row['D'] ?? '';
        $txtmae = $row['E'] ?? '';
        $minstock = $row['F'] ?? 0;
        $txtRemark = $row['G'] ?? '';

        // Check for empty subcategory
        if (empty($subcat)) {
            $errorCount++;
            continue; // Skip this row if subcategory is empty
        }

        // Fetch the prefix
        $dataInitial = "SELECT b.code_type, a.id_subcat, a.id_cat 
                        FROM master_subcat a 
                        LEFT JOIN master_type_material b ON a.sub_catname = b.type_name 
                        WHERE a.sub_catname = '$subcat'";
                        
                        
        $dataMeasurement= "SELECT id_mae 
                        FROM master_maesurement 
                        WHERE maesurename = '$txtmae'";
                        
                        

        $dataQryInitial = mysqli_query($db->koneksi, $dataInitial);
        if (!$dataQryInitial) {
            error_log("Query failed: " . mysqli_error($db->koneksi));
            $errorCount++;
            continue; // Skip this row
        }

        $dataRowInitial = mysqli_fetch_array($dataQryInitial);
        if (!$dataRowInitial) {
            $errorCount++;
            continue; // Skip this row if no data found
        }
        
        
        $dataMeasurement= "SELECT id_mae 
                        FROM master_maesurement 
                        WHERE maesurename = '$txtmae'";
        
         $dataQryMeasurement = mysqli_query($db->koneksi, $dataMeasurement);
        if (!$dataQryMeasurement) {
            error_log("Query failed: " . mysqli_error($db->koneksi));
            $errorCount++;
            continue; // Skip this row
        }

        $dataRowMeasurement = mysqli_fetch_array($dataQryMeasurement);
        if (!$dataRowMeasurement) {
            $errorCount++;
            continue; // Skip this row if no data found
        }

        // Get prefix and IDs
        $label = $dataRowInitial['code_type'];
        $category = $dataRowInitial['id_cat'];
        $subcategory = $dataRowInitial['id_subcat'];
        $measurementname=$dataRowMeasurement['id_mae'];
        
        $prefix = substr($label, 0, 2);

        // Get last item_code
        $dataSqlRm = "SELECT MAX(SUBSTRING(item_code, 3, 7)) AS code 
                       FROM master_catalog 
                       WHERE item_code LIKE '$prefix%'";

        $dataQryRm = mysqli_query($db->koneksi, $dataSqlRm);
        if (!$dataQryRm) {
            error_log("Query failed: " . mysqli_error($db->koneksi));
            $errorCount++;
            continue; // Skip this row
        }

        $dataRowRm = mysqli_fetch_array($dataQryRm);
        $num = $dataRowRm['code'] ? intval($dataRowRm['code']) : 0; 
        $numnow = $num + 1; 
        $fzeropadded = sprintf("%06d", $numnow); // Ensure it stays as 5 digits

        // Create new item_code
        $txtCode = $prefix . $fzeropadded;

        // Check for duplicate item name and specification
        $duplicateCheck = "SELECT COUNT(*) AS count 
                           FROM master_catalog 
                           WHERE item_name = ? AND specification = ?";

        $stmt = $db->koneksi->prepare($duplicateCheck);
        $stmt->bind_param("ss", $txtitemname, $txtspec);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCount = $result->fetch_assoc()['count'];

        if ($rowCount > 0) {
            $duplicateItems[] = "Duplicate found: Item Name: $txtitemname, Specification: $txtspec"; // Store duplicates
            $errorCount++;
            continue; // Skip this row if duplicate found
        }

        // Insert into database using the method from db.php
        if ($db->importCatalog($txtCode, $txtpartnumber, $txtitemname, $txtspec, $measurementname, $minstock, '', '', $category, $subcategory, $txtRemark)) {
            $successCount++;
        } else {
            error_log("Insert failed for item_code: $txtCode "); // Log the specific item that failed
            $errorCount++;
        }
    }

    // Provide feedback on import results
    echo "<html>
            <head>
                <title>Import Results</title>
                <style>
                    body { font-family: Arial, sans-serif; }
                    .result { margin: 20px; padding: 10px; border: 1px solid #ccc; }
                    .success { color: green; }
                    .error { color: red; }
                </style>
            </head>
            <body>
                <div class='result'>
                    <h2>Import completed</h2>
                    <p class='success'>Successfully inserted: $successCount</p>
                    <p class='error'>Failed: $errorCount</p>";

    // Display duplicates if any
    if (!empty($duplicateItems)) {
        echo "<h3>Duplicate items:</h3><ul>";
        foreach ($duplicateItems as $duplicate) {
            echo "<li>$duplicate</li>";
        }
        echo "</ul>";
    }

    echo "    </div>
                <p>Redirecting in 30 seconds...</p>
                <meta http-equiv='refresh' content='30;url=../pages/index.php?pages=import_catalog'>
            </body>
          </html>";
}


//ISSUE
$actionIssue = $_GET['actionGI'] ?? null;

if ($actionIssue == "insert") {
    // Insert new order
    $db->insertGI(
        $_POST['txtOrdernumber'], 
         $_POST['txtNotes'],
        $_POST['createby'], 
        $_POST['createdate'] 
       
    );
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=goods_issue'>";

} elseif ($actionIssue == "update") {
    // Update existing order
    $db->editGI(
        $_POST['id'], 
        $_POST['txtdocnumber'], 
        $_POST['txtDepartment'], 
        $_POST['txtPic'], 
        $_POST['orderby'], 
        $_POST['orderdate'], 
        $_POST['txtNotes']
    );
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=goods_issue'>";
} elseif ($actionIssue == "delete") {
    // Delete order
    $db->deleteGI($_GET['id'],$_GET['code']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=goods_issue'>";

} elseif ($actionIssue == "save") {
    // Save order (mark as completed, or save changes)
    $db->saveGI($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=goods_issue'>";
}



//ORDER
$actionOrder = $_GET['actionOrder'] ?? null;

if ($actionOrder == "insert") {
    // Insert new order
    $db->insertOrder(
        $_POST['txtdocnumber'], 
        $_POST['txtDepartment'], 
        $_POST['txtPic'], 
        $_POST['orderby'], 
        $_POST['orderdate'], 
        $_POST['txtNotes']
    );
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=order_list'>";

} elseif ($actionOrder == "update") {
    // Update existing order
    $db->editOrder(
        $_POST['id'], 
        $_POST['txtdocnumber'], 
        $_POST['txtDepartment'], 
        $_POST['txtPic'], 
        $_POST['orderby'], 
        $_POST['orderdate'], 
        $_POST['txtNotes']
    );
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=order_list'>";
} elseif ($actionOrder == "delete") {
    // Delete order
    $db->deleteOrder($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=order_list'>";

} elseif ($actionOrder == "save") {
    // Save order (mark as completed, or save changes)
    $db->saveOrder($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=order_list'>";
}



$actionItemOrder = $_GET['actionItemOrder'] ?? null;

if ($actionItemOrder == "insert") {
    $db->insertItemOrder($_POST['txtOrder'], $_POST['itemcode'], $_POST['txtQtyorder'], $_POST['txtUserfor'], $_POST['txtNotes']);
    $code = $_POST['txtOrder'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=detail_order&code=$code'>";

} elseif ($actionItemOrder == "delete") {
    $db->deleteItemOrder($_GET['id'], $_GET['code']);
    $code = $_GET['code'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=detail_order&code=$code'>";
} elseif ($actionItemOrder == "save") {
    // Save order (mark as completed, or save changes)
    $db->saveItemOrder($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=order_list'>";
}


$actionItemIssue = $_GET['actionItemIssue'] ?? null;

if ($actionItemIssue == "insert") {
    if (!empty($_POST['goodIssueNumber']) && !empty($_POST['OrderNumber']) && !empty($_POST['itemcode']) && !empty($_POST['txtQtyorder'])) {
        // Insert item issue into the database
        $result = $db->insertItemIssue($_POST['goodIssueNumber'], $_POST['OrderNumber'], $_POST['itemcode'], $_POST['txtQtyorder'], $_POST['txtNotes']);

        if ($result) {
            echo json_encode(["status" => "success", "message" => "Item successfully added."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to add item."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Please fill all required fields."]);
    }
    exit; // Stop further execution
}
 elseif ($actionItemIssue == "delete") {
    $db->deleteItemIssue($_GET['id'], $_GET['code']);
    $code = $_GET['code'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=detail_issue&code=$code'>";

} elseif ($actionItemIssue == "save") {
    // Save order (mark as completed or save changes)
    $idtrans = $_GET['id']; // Get the id from the URL

    if (!empty($idtrans)) {
        // Call the function to save the item issue
        $saveResult = $db->saveItemIssue($idtrans);

        if ($saveResult) {
            echo "successfully saved";
        } else {
            echo "Error: Unable to save the Good Issue.";
        }
    } else {
        echo "Error: Missing Good Issue ID.";
    }
    exit;
}
 elseif (isset($_GET['actionItemIssue']) && $_GET['actionItemIssue'] === 'import') {
    if (!empty($_POST['goodIssueNumber']) && !empty($_POST['OrderNumber'])) {
        $goodIssueNumber = mysqli_real_escape_string($db->koneksi, $_POST['goodIssueNumber']);
        $orderNumber = mysqli_real_escape_string($db->koneksi, $_POST['OrderNumber']);

        $message = $db->importItemIssue($goodIssueNumber, $orderNumber);
        echo trim($message); // Trim and output the message
    } else {
        echo "Error: Missing required fields.";
    }
    exit;
}











// Check if actionGR is set in the GET request
$actionGR = $_GET['actionGR'] ?? null;

if ($actionGR == "insert") {
    $db->insertGR($_POST['txtDO'], $_POST['txtType'], $_POST['txtVendor'], $_POST['txtDN'], $_POST['txtAt'], $_POST['txtreceiptby'], $_POST['txtDate'], $_POST['txtNotes']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=good_receive'>";

} elseif ($actionGR == "update") {
    $db->editGR($_POST['id'], $_POST['txtDO'], $_POST['txtType'], $_POST['txtVendor'], $_POST['txtDN'], $_POST['txtAt']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=good_receive'>";
}  elseif ($actionGR == "delete") {
    $db->deleteGR($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=good_receive'>";
}  elseif ($actionGR == "save") {
    $db->saveGR($_GET['id']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=good_receive'>";
}

// Check if actionItemGR is set in the GET request
$actionItemGR = $_GET['actionItemGR'] ?? null;

if ($actionItemGR == "insert") {
    $db->insertItemGR($_POST['txtGrnumber'], $_POST['itemcode'], $_POST['txtQtyDO'], $_POST['txtQtyReceipt'], $_POST['txtNotes']);
    $code = $_POST['txtGrnumber'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=detail_receive&code=$code'>";

} elseif ($actionItemGR == "delete") {
    $db->deleteItemGR($_GET['id'], $_GET['txtGrnumber']);
    $code = $_GET['txtGrnumber'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=detail_receive&code=$code'>";
}


// Check if Put Away is set in the GET request
$actionPutaway = $_GET['actionPutaway'] ?? null;

if ($actionPutaway == "insert") {
    $db->insertPutaway( $_POST['itemcode'],$_POST['location'], $_POST['rack'], $_POST['qty']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=put_away'>";

} elseif ($actionPutaway == "delete") {
    $db->deletePutaway($_GET['id'], $_GET['txtGrnumber']);
    
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=put_away'>";
}



// Check if asset is set in the GET request
$asset = $_GET['asset'] ?? null;

if ($asset == "insert") {
    $db->insertItem($_POST['txtMR'], $_POST['txtItemCode'], $_POST['txtQtyrequest'], $_POST['txtNotesrequest']);
    $mr = $_POST['txtMR'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";

} elseif ($asset == "delete") {
    $db->deleteItem($_POST['id'], $_POST['txtNoMRDelete']);
    $mr = $_POST['txtNoMRDelete'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";

} elseif ($asset == "editasset") {
    // File upload
    $fileName = $_FILES['picture']['name'] ?? '';  
    $fileSize = $_FILES['picture']['size'] ?? 0;
    $code = $_POST['txtassetcode'];
    $fileError = $_FILES['picture']['error'] ?? 0;

    $location = '';
    if ($fileName) {
        $move = move_uploaded_file($_FILES['picture']['tmp_name'], "../asset_pic/{$code}-{$fileName}");
        $location = "../asset_pic/{$code}-{$fileName}";
    }
    
    $db->editasset($_POST['id'], $_POST['txtAssetname'], $_POST['txtSpec'], $_POST['txtSN'], $_POST['txtSerialnumber'], $_POST['txtRemark'], $_POST['txtSite'], $_POST['txtLocation'], $location);
    $id = $_POST['id'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=edit_asset&id=$id'>";
}

// Check if addCatalogtomfp is set in the GET request
$addCatalogtomfp = $_GET['addCatalogtomfp'] ?? null;

if ($addCatalogtomfp == "insert") {
    $db->insertitem_mfp($_GET['mfp'], $_GET['code']);
    $mfpget = $_GET['mfp'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$mfpget'>";
}

// Check if actionDocument is set in the GET request
$actionDocument = $_GET['actionDocument'] ?? null;

if ($actionDocument == "insert") {
    // File upload
    $fileName = $_FILES['doc']['name'] ?? '';  
    $fileSize = $_FILES['doc']['size'] ?? 0;
    $code = $_POST['txtdocnum'];
    $fileError = $_FILES['doc']['error'] ?? 0;

    if ($fileName) {
        $move = move_uploaded_file($_FILES['doc']['tmp_name'], "../document_po/{$code}-{$fileName}");
        $location = "../document_po/{$code}-{$fileName}";
    }

    $db->insertDocument($_POST['txtdocnum'], $_POST['txtDocname'], $location, $_POST['txtNotes']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=document_po'>";

} elseif ($actionDocument == "delete") {
    $db->deleteDocument($_GET['id'], $_GET['pic']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=document_po'>";
}

// Repeat similar improvements for the remaining sections...


// Material Request Add Item
$actionAddItem = $_GET['actionAddItem'] ?? null;

if ($actionAddItem == "insert") {
    $db->insertItem($_POST['txtMR'], $_POST['txtItemCode'], $_POST['txtQtyrequest'], $_POST['txtNotesrequest']);
    $mr = $_POST['txtMR'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";
} elseif ($actionAddItem == "delete") {
    $db->deleteItem($_POST['id'], $_POST['txtNoMRDelete']);
    $mr = $_POST['txtNoMRDelete'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";
} elseif ($actionAddItem == "update") {
    $db->updateItem($_POST['id'], $_POST['txtEditqty'], $_POST['txtNoMRedit'], $_POST['txtNotesedit']);
    $mr = $_POST['txtNoMRedit'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";
}

// Page Manufacturing
$manufacture = $_GET['manufacture'] ?? null;

if ($manufacture == "insertmanufacture") {
    $db->insertmanufacture($_POST['txtNomanu'], $_POST['txtPlanningname'], $_POST['txtStartdate'], $_POST['txtFinishdate'], $_POST['txtPICreg'], $_POST['txtLocation'], $_POST['txtNotesmn']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_manufacture'>";
}

// Pages Material Request Add Item Asset
$actionAddItemAsset = $_GET['actionAddItemAsset'] ?? null;

if ($actionAddItemAsset == "insertmrAsset") {
    $db->insertItemAsset($_POST['txtMR'], $_POST['txtItemDesc'], $_POST['txtSpecification'], $_POST['txtQty'], $_POST['txtMaesurement'], $_POST['txtNotesmr']);
    $mr = $_POST['txtMR'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request_asset&mr=$mr'>";
} elseif ($actionAddItemAsset == "updateasset") {
    $db->updateItemAsset($_POST['id'], $_POST['txtMR'], $_POST['txtDesc'], $_POST['txtSpec'], $_POST['txtEditqty'], $_POST['txtMaesurement'], $_POST['txtNotesedit']);
    $mr = $_POST['txtMR'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request_asset&mr=$mr'>";
} elseif ($actionAddItemAsset == "delete") {
    $db->deleteItemAsset($_POST['id'], $_POST['txtMR']);
    $mr = $_POST['txtMR'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request_asset&mr=$mr'>";
}

// PO Asset
$actionAddItemPOasset = $_GET['actionAddItemPOasset'] ?? null;

if ($actionAddItemPOasset == "insertother") {
    $db->insertItemPOSET($_POST['id'], $_POST['txtPO'], $_POST['txtMR'], $_POST['txtDesc'], $_POST['txtSpec'], $_POST['txtQty'], $_POST['txtMae'], $_POST['txtPrice'], $_POST['txtNotesrequest']);
    $po = $_POST['txtPO'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
}

if ($actionAddItemAsset == "insert") {
    $db->insertItemPOasset($_POST['id'], $_POST['txtPO'], $_POST['txtMR'], $_POST['txtDesc'], $_POST['txtSpec'], $_POST['txtQty'], $_POST['txtMae'], $_POST['txtPrice'], $_POST['txtNotesrequest']);
    $po = $_POST['txtPO'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif ($actionAddItemAsset == "deleteitem") {
    $db->deleteItemPOassetss($_POST['id'], $_POST['txtNoPODelete']);
    $po = $_POST['txtNoPODelete'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset== "update"){
 	$db->updateItemPOasset($_POST['id'],$_POST['txtEditqty'],$_POST['txtNoPOedit'],$_POST['txtEditPrice']);
  	$po=$_POST['txtNoPOedit'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";

} elseif($actionAddItemAsset == "deleteall"){
 	$db->deleteAllItemPOasset($_GET['po']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "Updatestatuspo"){
 	$db->updatestatusPOsendasset($_GET['po']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_purchase'>";
} elseif($actionAddItemAsset == "addPPN"){
 	$db->addPPNPOasset($_GET['po']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "pph2"){
 	$db->addPPH2asset($_GET['po']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "pph4"){
 	$db->addPPH4asset($_GET['po']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "noPPN"){
 	$db->noPPNPOasset($_GET['po']);
 	$po=$_GET['po'];
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "addTransport"){
 	$db->addTransportPOasset($_GET['po'],$_POST['txtTransport']);
 	$po=$_GET['po'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "addDiscount"){
 	$db->addDiscountPOasset($_GET['po'],$_POST['txtDiscount']);
 	$po=$_GET['po'];
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
} elseif($actionAddItemAsset == "addInfoPO"){
 	$db->addInfoPOasset($_POST['txtPO'],$_POST['txtInfoPO'],$_POST['txtTotal'],$_POST['txtNotes']);
 	$po=$_POST['txtPO'];
    echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";
}
 
 
 


//PO  status
 $actionPOstatus= $_GET['actionPOstatus']?? null;

 if($actionPOstatus == "Approve"){
     	
 	$db->ApprovePO($_POST['txtPO'],$_POST['$txtUserApprove'],$_POST['$txtdateApprove']);
$po=$_POST['txtPO'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";

 }
  elseif($actionPOstatus == "Reject"){ 	
 	$db->RejectPO($_POST['txtPO'],$_POST['$txtUserApprove'],$_POST['$txtdateApprove']);
 $po=$_POST['txtPO'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";
 } elseif($actionPOstatus == "update"){
 	$db->updateCur($_POST['id'],$_POST['txtCur']);
 	 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_currency'>";
 }



//Currency
 $actionCurrency= $_GET['actionCurrency']?? null;

 if($actionCurrency == "insert"){
 	$db->insertCur($_POST['txtCur']);

 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_currency'>";

 }
 elseif($actionCurrency == "delete"){ 	
 	$db->deleteCur($_GET['id']);
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_currency'>";
 }
 elseif($actionCurrency == "update"){
 	$db->updateCur($_POST['id'],$_POST['txtCur']);
 	 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_currency'>";
 }

//Stock
 $actionStocklistusage= $_GET['actionStocklistusage']?? null;

 if($actionStocklistusage == "Usaged"){
 	$db->UsageStockUsage($_POST['id'],$_POST['idcode'],$_POST['txtMnp'],$_POST['txtQtyusage'],$_POST['txtSite'],$_POST['txtLocation'],$_POST['txtRack'],$_POST['txtNotes']);

$noManu=$_POST['txtMnp'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";

 }
 
//project status

 $startProject= $_GET['startProject']?? null;

 if($startProject == "start"){
	 
	 
 	$db->startProject($_GET['mnp']);
 	$noManu=$_GET['mnp'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";
 }
 $startProject= $_GET['startProject']?? null;

 if($startProject == "finish"){
	 
	 
 	$db->finishProject($_GET['mnp']);
 	$noManu=$_GET['mnp'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";
 }
	

//MR
 $sendReq= $_GET['sendReq']?? null;

 if($sendReq == "insert"){
	 
	 
 	$db->sendReq($_GET['mr']);
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_request'>";
 
	

 } elseif($sendReq == "deleteall"){ 	
 	$db->deleteall($_GET['mr']);
	$mr=$_GET['mr'];
 	  echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_request&mr=$mr'>";
 }
 
 
 //Master Vendor
 $actionven= $_GET['actionven']?? null;

 if($actionven == "insert"){
	 
 	$db->insertVen($_POST['txtVendor'],$_POST['txtAddress'],$_POST['txtPhone'],$_POST['txtFax'],$_POST['txtEmail']);
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_vendor'>";
 
 }
 elseif($actionven == "delete"){ 	
 	$db->deleteVen($_GET['id']);
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_vendor'>";
 }
 elseif($actionven == "update"){
 	$db->updateVen($_POST['id'],$_POST['txtVendor'],$_POST['txtAddress'],$_POST['txtPhone'],$_POST['txtFax'],$_POST['txtEmail']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_vendor'>";
 }

 //Asset
 $actionAsset= $_GET['actionAsset']?? null;

 if($actionAsset == "insert"){
	 
//file upload.php  
 $fileName = $_FILES['picture']['name'];  
 $fileSize = $_FILES['picture']['size'];
 $code =$_POST['txtCode'];
 $fileError = $_FILES['picture']['error'];  
 
 $move = move_uploaded_file($_FILES['picture']['tmp_name'], '../catalog_pic/'.$code.'-'.$fileName);  
 $location=('../catalog_pic/'.$code.'-'.$fileName);


$db->finish2Project($_POST['txtpartnumber']);
$db->insertAsset($_POST['txtCode'],$_POST['txtpartnumber'],$_POST['txtitemname'],$_POST['txtspec'],$_POST['txtSN'],$_POST['txtMaesurement'],$_POST['txtmanufacture'],$_POST['txtbrand'],$_POST['category'],$_POST['subcat'],$location,$_POST['txtRemark'],$_POST['cmbSite'],$_POST['cmbLoc']);
	                
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=asset'>";
 
	

 
 }
 
//Catalog
 $actionCatalog= $_GET['actionCatalog']?? null;

 if($actionCatalog == "insert"){
	 
//file upload.php  
 $fileName = $_FILES['picture']['name'];  
 $fileSize = $_FILES['picture']['size'];
 $code =$_POST['txtCode'];
 $fileError = $_FILES['picture']['error'];  
 
 if ($fileName){
 $move = move_uploaded_file($_FILES['picture']['tmp_name'], '../catalog_pic/'.$code.'-'.$fileName); 
 $location=('../catalog_pic/'.$code.'-'.$fileName);
    }else{
    $location='';
    }


$db->insertCatalog($_POST['txtCode'],$_POST['txtpartnumber'],$_POST['txtitemname'],$_POST['txtspec'],$_POST['txtMaesurement'],$_POST['minstock'],$_POST['txtmanufacture'],$_POST['txtbrand'],$_POST['category'],$_POST['subcat'],$location,$_POST['txtRemark']);
	                
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_catalog'>";
 
	

 
 }
 elseif($actionCatalog == "delete"){ 
     

    
 // Delete Catalog
if ($actionCatalog == "delete") {
    if (isset($_GET['id'], $_GET['pic'])) {
        $db->deleteCatalog($_GET['id'], $_GET['pic']);
        echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=catalog'>";
    } else {
        echo "Error: Missing parameters for deletion.";
    }
}

// Update Catalog
}elseif ($actionCatalog == "update") {
    // File upload
    $fileName = $_FILES['picture']['name'];  
    $fileSize = $_FILES['picture']['size'];
    
    // Check if 'txtCode' exists in $_POST
    if (isset($_POST['id'])) {
        $code = $_POST['id'];
    } else {
        echo "Error: 'id' is not set.";
        exit;
    }

    $pic = $_POST['oldpic'];

    if ($fileName == '') {
        // Update without file upload
        $db->updateCatalog(
            $_POST['id'],
            $_POST['txtPartnumbers'],
            $_POST['txtItemname'],
            $_POST['txtSpecification'],
            $_POST['txtbrand'],
            $_POST['txtMaesurement'],
            $_POST['minstock'],
            $_POST['txtRemark']
        );
        echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=m_catalog'>";   
    } else {
        // Handle file upload
        @unlink($pic);  // Remove old picture if it exists

        // Move the uploaded file
        $move = move_uploaded_file($_FILES['picture']['tmp_name'], '../catalog_pic/'.$code.'-'.$fileName);
        
        if ($move) {
            $location = '../catalog_pic/'.$code.'-'.$fileName;

            // Update catalog with new picture
            $db->updateCatalogpic(
                $_POST['id'],
                $_POST['txtPartnumbers'],
                $_POST['txtItemname'],
                $_POST['txtSpecification'],
                $_POST['txtbrand'],
                $_POST['txtMaesurement'],
                $_POST['txtRemark'],
                $location
            );
            echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=m_catalog'>";   
        } else {
            echo "Error: Failed to upload the file.";
        }
    }
}



$actionCatalogs= $_GET['actionCatalogs']?? null;


 if($actionCatalogs == "delete"){ 	
 	$db->deleteCatalogs($_GET['id']);
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_catalog'>";
 }
 
 
 elseif($actionCatalogs == "update"){
 	$db->updateCatalogs($_POST['id'],$_POST['txtPartnumber'],$_POST['txtItemname'],$_POST['txtSpecification']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_catalog'>";
 }



 
 
 //PO Head
 $actionPOhead= $_GET['actionPOhead']?? null;

 if($actionPOhead == "insert"){
 	$db->insertPOhead($_POST['txtnoPO'],$_POST['txtTO'],$_POST['txtReff'],$_POST['txtCur'],$_POST['txtdateReg'],$_POST['txtPIC'],$_POST['txtMR'],$_POST['txtSubject'],$_POST['txtNotes'],$_POST['txtAttn'],$_POST['txtTypereq']);

 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_purchase'>";

 }
 elseif($actionPOhead == "delete"){ 	
 	$db->deletePOhead($_GET['id']);
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_purchase'>";
 }
 elseif($actionPOhead == "update"){
 	$db->updatePOhead($_POST['id'],$_POST['txtnumMR'],$_POST['txtNotes']);
 	 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_purchase'>";
 }

 
  $actionAddItemMnp= $_GET['actionAddItemMnp']?? null;

 if($actionAddItemMnp == "insert"){
 	$db->insertItemMnp($_POST['txtMnp'],$_POST['txtItemCode'],$_POST['txtQtyrequest'],$_POST['txtNotesrequest']);
$noManu=$_POST['txtMnp'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";

 } elseif($actionAddItemMnp == "update"){
 	$db->updateItemMnp($_POST['id'],$_POST['txtEditqty'],$_POST['txtMnp'],$_POST['txtNotes']);
$noManu=$_POST['txtMnp'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";

 }
 elseif($actionAddItemMnp == "delete"){
 	$db->deleteItemMnp($_POST['id'],$_POST['txtNoMNPDelete']);
  	$noManu=$_POST['txtNoMNPDelete'];
  echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=planning_part&mnp=$noManu'>";

 }
 
 
 
 //PO  Add Item
 $actionAddItemPO= $_GET['actionAddItemPO']?? null;

 if($actionAddItemPO == "insert"){
 	$db->insertItemPO($_POST['txtPO'],$_POST['txtNomr'],$_POST['txtItemCode'],$_POST['txtQtyrequest'],$_POST['txtPrice'],$_POST['txtNotesrequest']);
$po=$_POST['txtPO'];
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";

 }
 elseif($actionAddItemPO == "insertother"){ 	
 	$db->insertItemPOotherasset($_POST['txtPO'],$_POST['txtItemdesc'],$_POST['txtSpec'],$_POST['txtQty'],$_POST['txtMae'],$_POST['txtUnitprice'],$_POST['txtNotesrequest']);
 	$po=$_POST['txtPO'];
 	
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po_asset&po=$po'>";

 }
  elseif($actionAddItemPO == "delete"){ 	
 	$db->deleteItemPO($_POST['id'],$_POST['txtNoPODelete']);
 	$po=$_POST['txtNoPODelete'];
 	
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";

 }
 
  elseif($actionAddItemPO == "update"){
 	$db->updateItemPO($_POST['id'],$_POST['txtEditqty'],$_POST['txtNoPOedit'],$_POST['txtEditPrice']);
  	$po=$_POST['txtNoPOedit'];
 	
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";

 }
 
  elseif($actionAddItemPO == "deleteall"){
 	$db->deleteAllItemPO($_GET['po']);
 	$po=$_GET['po'];
 	
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";

 }
 
 elseif($actionAddItemPO == "Updatestatuspo"){
 	$db->updatestatusPOsend($_GET['po']);
 	$po=$_GET['po'];
 	
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_purchase'>";

 }
 
 elseif($actionAddItemPO == "addPPN"){
 	$db->addPPNPO($_GET['po']);
 	$po=$_GET['po'];
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";


 }
  elseif($actionAddItemPO == "noPPN"){
 	$db->noPPNPO($_GET['po']);
 	$po=$_GET['po'];
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";


 }
  elseif($actionAddItemPO == "addTransport"){
 	$db->addTransportPO($_GET['po'],$_POST['txtTransport']);
 	$po=$_GET['po'];
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";


 }
 elseif($actionAddItemPO == "addDiscount"){
 	$db->addDiscountPO($_GET['po'],$_POST['txtDiscount']);
 	$po=$_GET['po'];
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";


 }
   elseif($actionAddItemPO == "addInfoPO"){
 	$db->addInfoPO($_POST['txtPO'],$_POST['txtInfoPO'],$_POST['txtTotal'],$_POST['txtNotes']);
 	$po=$_POST['txtPO'];
 	
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_item_po&po=$po'>";


 }
 
 
 




//Stock
 $actionStock= $_GET['actionStock']?? null;

 if($actionStock == "add"){

     //file upload.php  
 $fileNamePic = $_FILES['picture']['name'];  
 $fileSizePic = $_FILES['picture']['size'];
 $code =$_POST['id'];
 $fileError = $_FILES['picture']['error'];  
 
 if ($fileNamePic){
 $movePic = move_uploaded_file($_FILES['picture']['tmp_name'], '../catalog_pic/'.$code.'-'.$fileNamePic); 
 $locationPic=('../receive_pic/'.$code.'-'.$fileNamePic);
    }else{
    $locationPic='';
    }
    
    
      //file upload.php  
 $fileNameDoc = $_FILES['document']['name'];  
 $fileSize = $_FILES['document']['size'];

    
 if ($fileNameDoc){
 $moveDoc = move_uploaded_file($_FILES['picture']['tmp_name'], '../receive_doc/'.$code.'-'.$fileNameDoc); 
 $locationDoc=('../receive_doc/'.$code.'-'.$fileNameDoc);
    }else{
    $locationDoc='';
    }
    
    
 	$db->insertStock($_POST['id'],$_POST['txtsite'],$_POST['location'],$_POST['rack'],$_POST['txtQty'],$_POST['txtPIC'],$_POST['txtNotes'],$_POST['txtPOnumber'],$locationPic,$locationDoc);

 	 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=add_stock'>";
 }
 elseif($actionStock == "delete"){ 	
 	$db->deleteBrand($_GET['id']);
	header("location:../pages/index.php?pages=master_brand");
 }
 elseif($actionStock == "update"){
 	$db->updateBrand($_POST['id'],$_POST['txtcategory'],$_POST['txtBrand']);
 	header("location:../pages/index.php?pages=master_brand");
 }



//Brand
 $actionBrand= $_GET['actionBrand']?? null;

 if($actionBrand == "insert"){
 	$db->insertBrand($_POST['txtcategory'],$_POST['txtBrand']);

 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_brand'>";

 }
 elseif($actionBrand == "delete"){ 	
 	$db->deleteBrand($_GET['id']);
echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_brand'>";
 }
 elseif($actionBrand == "update"){
 	$db->updateBrand($_POST['id'],$_POST['txtcategory'],$_POST['txtBrand']);
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_brand'>";
 }
 
 //status MR
 $actionMRstatus= $_GET['actionMRstatus']?? null;

 if($actionMRstatus == "Approve"){
 	$db->approveMRstatus($_GET['mr']);

 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=request_list'>";

 }
 elseif($actionMRstatus == "Reject"){ 	
 	$db->rejectMRstatus($_GET['mr'],$_POST['txtNotesReject']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=request_list'>";
 }
 elseif($actionMRstatus == "Voidmr"){
 	$db->voidMRstatus($_GET['mr']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=request_list'>";
 }
  elseif($actionMRstatus == "Revisimr"){
 	$db->revisionMRstatus($_GET['mr'],$_POST['txtNotesRevision']);
 		$mr=$_GET['mr'];
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=mr_request_rev&mr=$mr'>";
 }
 elseif($actionMRstatus == "RevisimrAsset"){
 	$db->revisionMRstatusAsset($_GET['mr'],$_POST['txtNotesRevision']);
 		$mr=$_GET['mr'];
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=mr_request_rev&mr=$mr'>";
 }


//Manufacture
 $actionManu= $_GET['actionManu']?? null;

 if($actionManu == "insert"){
 	$db->insertManu($_POST['txtManufacture'],$_POST['txtManufacturecode']);


 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_manufacture'>";

 }
 elseif($actionManu == "delete"){ 	
 	$db->deleteManu($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_manufacture'>";
 }
 elseif($actionManu == "update"){
 	$db->updateManu($_POST['id'],$_POST['txtManufactureupdate'],$_POST['txtManufacturecodeupdate']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_manufacture'>";
 }


//category
 $actioncategory= $_GET['actioncategory']?? null;

 if($actioncategory == "insert"){
 	$db->insertCat($_POST['txtcategory']);

 
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_category'>";

 }
 elseif($actioncategory == "delete"){ 	
 	$db->deleteCat($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_category'>";
 }
 elseif($actioncategory == "update"){
 	$db->updateCat($_POST['id'],$_POST['txtcategory']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_category'>";
 }

//Subcategory
 $actionSubcategory= $_GET['actionSubcategory']?? null;

 if($actionSubcategory == "insert"){
 	$db->insertSubCat($_POST['txtcategory'],$_POST['txtsubcategory']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_subcategory'>";
 	

 }
 elseif($actionSubcategory == "delete"){ 	
 	$db->deleteSubCat($_GET['id']);
		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_subcategory'>";
 	
 }
 elseif($actionSubcategory == "update"){
 	$db->updateSubCat($_POST['id'],$_POST['txtcategory'],$_POST['txtsubcategory']);
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_subcategory'>";
 	
 }



//maesurement

$actionmaesurement = $_GET['actionmaesurement']?? null;

 if($actionmaesurement == "insert"){
 	$db->insertMae($_POST['txtmaesurement']);
 	
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_maesurement'>";
 	
 }
 elseif($actionmaesurement == "delete"){ 	
 	$db->deleteMae($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_maesurement'>";
 }
 elseif($actionmaesurement == "update"){
 	$db->updateMae($_POST['id'],$_POST['txtmaesurement']);
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_maesurement'>";
 }
 
 
//condition
 $actioncondition = $_GET['actioncondition']?? null;

 if($actioncondition == "insert"){
 	$db->insertCon($_POST['txtcondition']);
 
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_condition'>";
 }
 elseif($actioncondition == "delete"){ 	
 	$db->deleteCon($_GET['id']);
		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_condition'>";
 }
 elseif($actioncondition == "update"){
 	$db->updateCon($_POST['id'],$_POST['txtcondition']);
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_condition'>";
 }
 
 
 //site
 $actionSite = $_GET['actionSite']?? null;

 if($actionSite == "insert"){
 	$db->insertSite($_POST['txtSite'],$_POST['txtcode']);
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_site'>";
 
 }
 elseif($actionSite == "delete"){ 	
 	$db->deleteSite($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_site'>";
 }
 elseif($actionSite == "update"){
 	$db->updateSite($_POST['id'],$_POST['txtSite'],$_POST['txtcode']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_site'>";
 }
  //Location
 $actionLocation = $_GET['actionLocation']?? null;

 if($actionLocation == "insert"){
 	$db->insertLocation($_POST['txtSite'],$_POST['txtlocation']);
 
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_location'>";
 }
 elseif($actionLocation == "delete"){ 	
 	$db->deleteLocation($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_location'>";
 }
 elseif($actionLocation == "update"){
 	$db->updateLocation($_POST['id'],$_POST['txtSite'],$_POST['txtlocation']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_location'>";
 }
 //Rack
 $actionRack = $_GET['actionRack']?? null;

 if($actionRack == "insert"){
 	$db->insertRack($_POST['txtLocation'],$_POST['txtRack']);
 
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_rack'>";
 	
 }
 elseif($actionRack == "delete"){ 	
 	$db->deleteRack($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_rack'>";
 }
 elseif($actionRack == "update"){
 	$db->updateRack($_POST['id'],$_POST['txtLocation'],$_POST['txtRack']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_rack'>";
 }
  //Status
 $actionStatus = $_GET['actionStatus']?? null;

 if($actionStatus == "insert"){
 	$db->insertStatus($_POST['txtStatus']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_status'>";
 	
 }
 elseif($actionStatus == "delete"){ 	
 	$db->deleteStatus($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_status'>";
 }
 elseif($actionStatus == "update"){
 	$db->updateStatus($_POST['id'],$_POST['txtStatus']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_status'>";
 }
 
   //Type
 $actionType= $_GET['actionType']?? null;

 if($actionType == "insert"){
 	$db->insertType($_POST['txtType']);
 		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_type'>";
 	
 }
 elseif($actionType == "delete"){ 	
 	$db->deleteType($_GET['id']);
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_type'>";
 }
 elseif($actionType == "update"){
 	$db->updateType($_POST['id'],$_POST['txtType']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_type'>";
 }
 
   //Level
 $actionLevel= $_GET['actionLevel']?? null;

 if($actionLevel == "insert"){
 	$db->insertLevel($_POST['txtLevel'],$_POST['txtcodLevel2']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_level'>";
 }
 elseif($actionLevel == "delete"){ 	
 	$db->deleteLevel($_GET['id']); 
	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_level'>";
 }
 elseif($actionLevel == "update"){
	 

 	$db->updateLevel($_POST['id'],$_POST['txtLevelupdate'],$_POST['txtcodLevelupdate2']);
}


//Material Request Head
 $actionMRhead= $_GET['actionMRhead']?? null;

 if($actionMRhead == "insertmr"){
   
						
 	$db->insertMRhead($_POST['txtdateReg'],$_POST['txtLocationReq'],$_POST['txtPICreq'],$_POST['txtNotesmr'],$_POST['txtTypereq']);

 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_request'>";

 }
 
 
 elseif($actionMRhead == "delete"){ 	
 	$db->deleteMRhead($_GET['id']);
 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_request'>";
 }
 
 
 elseif($actionMRhead == "update"){
 	$db->updateMRhead($_POST['id'],$_POST['txtnumMR'],$_POST['txtNotes']);
 	 echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=new_request'>";
 }
  

    //User
 $actionUser= $_GET['actionUser']?? null;

 if($actionUser == "insert"){
 	$db->insertUser($_POST['txtFirstname'],$_POST['txtLastname'],$_POST['txtEmail'],$_POST['txtPassword'],$_POST['txtLevel'],$_POST['txtSite'],$_POST['textAddress'],$_POST['txtPhone'],$_POST['txtHRcode']);
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_user'>";
 }
 elseif($actionUser == "delete"){ 	
 	$db->deleteUser($_GET['id']);
	
		echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_user'>";
 }
 elseif($actionUser == "update"){
 	$db->updateUser($_POST['id'],$_POST['txtFirstnameupdate'],$_POST['txtLastnameupdate'],$_POST['txtEmailupdate'],$_POST['txtPassupdate'],$_POST['txtLevelupdate'],$_POST['txtSiteupdate'],$_POST['textAddressupdate'],$_POST['txtPhoneupdate'],$_POST['txtHRcodeupdate'],$_POST['txtstatusupdate']);
	
	
 	echo "<meta http-equiv='refresh' content='0;url=../pages/index.php?pages=master_user'>";
 }
 
 
?>