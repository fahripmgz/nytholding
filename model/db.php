<?php 
//error_reporting(E_ALL);
//require '../includes/mailer.php';
//require '../includes/class.phpmailer.php';
//require '../includes/class.smtp.php';

class database
{

	//CONNECT DATABASE//

	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "coresystems";
	var $koneksi = "";
	function __construct()
	{
		$this->koneksi = mysqli_connect($this->host, $this->uname, $this->pass, $this->db);
		if (mysqli_connect_errno()) {
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
	}
	public $var = 'a default value';




// Fungsi untuk menghitung jumlah Put Away yang outstanding
	 function countOutstandingPutAway()
	{
		$query = mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM put_away WHERE total_qty!='0'");
		$result = mysqli_fetch_assoc($query);
		return $result['total']; // Kembalikan jumlah outstanding Put Away
	}

function importCatalog($txtCode, $txtPartNumber, $txtItemName, $txtSpec, $txtMae, $minStock, $manufacture, $brand, $category, $subcategory, $txtRemark) {
    // Prepare your SQL query
    $query = "INSERT INTO `master_catalog` (`item_code`, `part_number`, `item_name`, `specification`, `maesurement`, `min_stock`, `manufacture`, `brand`, `category`, `sub_category`, `remark`, `date_register`, `picture`, `status`) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), '', '0')";

    // Use prepared statements to avoid SQL injection
    $stmt = $this->koneksi->prepare($query);
    
    // Check if prepare was successful
    if ($stmt === false) {
        error_log("Prepare failed: " . htmlspecialchars($this->koneksi->error));
        return false;
    }

    // Bind parameters
    if (!$stmt->bind_param("sssssssssss", $txtCode, $txtPartNumber, $txtItemName, $txtSpec, $txtMae, $minStock, $manufacture, $brand, $category, $subcategory, $txtRemark)) {
        error_log("Binding parameters failed: " . htmlspecialchars($stmt->error));
        return false;
    }

    // Execute the statement and check for success
    if ($stmt->execute()) {
        return true; // Successfully inserted
    } else {
        error_log("Error inserting catalog: " . $stmt->error);
        return false; // Failed to insert
    }
}


//ORDER LIST


	function viewOrder()
	{
		$data = mysqli_query($this->koneksi, "SELECT a.`id`, a.`order_number`, a.`document_number`,a.department, a.pic,a.`notes`,a. `create_date`, a.`create_by`, a.`status` ,b.department_name,c.pic_name,d.pic_name AS approval1,d.pic_name AS approval2,f.status_name FROM `order_list` a LEFT JOIN department b on a.department=b.id
LEFT JOIN master_pic c on a.pic=c.id
LEFT JOIN master_pic d on a.approval_1=d.id
LEFT JOIN master_pic e on a.approval_2=d.id
LEFT JOIN master_status_gr f on a.status=f.id
WHERE a.status!=5 ORDER BY a.id DESC;");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	
	
	 function viewOrderdetail($idtrans)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT a.id, a.item_code, a.status, a.qty, a.notes, b.item_name, b.spec, b.maesurename,c.project_name FROM item_request a 
                LEFT JOIN view_catalog b ON a.item_code = b.item_code
                LEFT JOIN master_project c ON a.project=c.id
                
                WHERE a.order_number='$idtrans' ORDER BY a.id DESC;");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
            
            
            
   
         function insertItemOrder($txtOrder, $itemcode, $txtQtyorder, $txtUserfor, $txtNotes)
            {
                // Check if the item_code already exists
                $query = mysqli_query($this->koneksi, "SELECT qty FROM `item_request` WHERE `order_number` = '$txtOrder' AND project='$txtUserfor' AND `item_code` = '$itemcode'");
                
                if (mysqli_num_rows($query) > 0) {
                    // If the item already exists, update the qty_receipt
                    $existingItem = mysqli_fetch_assoc($query);
                    $newQtyReceipt = $existingItem['qty'] + $txtQtyorder; // Add new qty_receipt to the existing one
                    
                    $updateQuery = mysqli_query($this->koneksi, "UPDATE `item_request` SET 
                        `qty` = '$newQtyReceipt', 
                        `notes` = '$txtNotes', 
                        `create_by` = '" . $_SESSION['SES_LOGIN'] . "', 
                        `create_date` = '" . date('Y-m-d') . "' 
                        WHERE `order_number` = '$txtOrder' AND `item_code` = '$itemcode'");
                } else {
                    
      
                    // If the item does not exist, insert a new record
                    $insertQuery = mysqli_query($this->koneksi, "INSERT INTO `item_request`(`id`, `order_number`, `item_code`, `qty`, `project`, `notes`, `status`) VALUES
                    ('','$txtOrder','$itemcode','$txtQtyorder','$txtUserfor','$txtNotes','1')");
                }
            }
            
                // Fungsi untuk delete Order
     function deleteItemOrder($id,$code)
    {
        $query = "DELETE FROM item_request WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    // Fungsi untuk save Order (mark as completed or save changes)
     function saveItemOrder($id)
    {
        $query = "UPDATE order_list SET status = '2' WHERE order_number = '$id'";
        mysqli_query($this->koneksi, $query);
    }
    
    
 


//GOOD ISSUE DETAIL

	 function viewIssuedetail($idtrans)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                 
                $data = mysqli_query($this->koneksi, "SELECT a.id,a.good_issue_number, a.order_number,a.item_code, a.status, a.qty,a.notes, b.item_name, b.spec, b.maesurename FROM good_issue_items a 
                LEFT JOIN view_catalog b ON a.item_code = b.item_code
                WHERE a.good_issue_number='$idtrans' ORDER BY a.id DESC;");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
      	 function viewIssuedetailinorder($code)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                 
                $data = mysqli_query($this->koneksi, "SELECT a.id,a.good_issue_number, a.order_number,a.item_code, a.status, a.qty,a.notes, b.item_name, b.spec, b.maesurename FROM good_issue_items a 
                LEFT JOIN view_catalog b ON a.item_code = b.item_code
                WHERE a.item_code='$code' and a.status='1' ORDER BY a.id DESC;");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
            
         function insertItemIssue($goodIssueNumber, $OrderNumber, $itemcode, $txtQtyorder, $txtNotes) {
    // Check if the item_code already exists
    $query = mysqli_query($this->koneksi, "SELECT qty FROM `good_issue_items` WHERE `good_issue_number` = '$goodIssueNumber' AND order_number='$OrderNumber' AND `item_code` = '$itemcode'");

    if (mysqli_num_rows($query) > 0) {
        // If the item already exists, update the qty
        $existingItem = mysqli_fetch_assoc($query);
        $newQtyReceipt = $existingItem['qty'] + $txtQtyorder;

        $updateQuery = mysqli_query($this->koneksi, "UPDATE `good_issue_items` SET 
            `qty` = '$newQtyReceipt', 
            `notes` = '$txtNotes'
            WHERE `good_issue_number` = '$goodIssueNumber' AND order_number='$OrderNumber' AND `item_code` = '$itemcode'");

        return $updateQuery; // Return success/failure of the update
    } else {
        // Insert a new record
        $insertQuery = mysqli_query($this->koneksi, "INSERT INTO `good_issue_items`(`good_issue_number`, `order_number`, `item_code`, `qty`, `notes`, `status`) 
                            VALUES ('$goodIssueNumber', '$OrderNumber', '$itemcode', '$txtQtyorder', '$txtNotes', '0')");

        return $insertQuery; // Return success/failure of the insert
    }
}

                      // Fungsi untuk delete Order
     function deleteItemIssue($id,$code)
    {
        $query = "DELETE FROM good_issue_items WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    // Fungsi untuk save Order (mark as completed or save changes)
   function saveItemIssue($id)
{
    // Sanitize the good_issue_number
    $id = mysqli_real_escape_string($this->koneksi, $id);

    // Query to get the order_number from the good_issue_items table based on good_issue_number
    $query_order_number = "SELECT order_number FROM good_issue_items WHERE good_issue_number = '$id' LIMIT 1";
    $result_order_number = mysqli_query($this->koneksi, $query_order_number);

    if (mysqli_num_rows($result_order_number) > 0) {
        // Fetch the order_number from the result
        $order_row = mysqli_fetch_assoc($result_order_number);
        $order_number = $order_row['order_number'];

        // Sanitize the order_number
        $order_number = mysqli_real_escape_string($this->koneksi, $order_number);

        // Update query for good_issue table
        $query = "UPDATE good_issue SET status = '2' WHERE good_issue_number = '$id'";

        // Update query for good_issue_items table
        $query2 = "UPDATE good_issue_items SET status = '1' WHERE good_issue_number = '$id'";

        // Update query for order_list table
        $query3 = "UPDATE order_list SET status = '6' WHERE order_number = '$order_number'";

        // Execute the queries
        if (mysqli_query($this->koneksi, $query)) {
            // If the first query was successful, execute the second one
            if (mysqli_query($this->koneksi, $query2)) {
                // If the second query was successful, execute the third one
                if (mysqli_query($this->koneksi, $query3)) {
                    return true; // Return true if all updates are successful
                } else {
                    return false; // Return false if the third query fails
                }
            } else {
                return false; // Return false if the second query fails
            }
        } else {
            return false; // Return false if the first query fails
        }
    } else {
        return false; // Return false if the order_number is not found in good_issue_items
    }
}




    
    
    
function importItemIssue($goodIssueNumber, $orderNumber) {
    $goodIssueNumber = mysqli_real_escape_string($this->koneksi, $goodIssueNumber);
    $orderNumber = mysqli_real_escape_string($this->koneksi, $orderNumber);

    // Check for duplicate imports
    $checkExistingImport = mysqli_query($this->koneksi, "SELECT 1 FROM `good_issue_items` WHERE `good_issue_number` = '$goodIssueNumber' AND `order_number` = '$orderNumber'");
    if (!$checkExistingImport) {
        return "Database error: " . mysqli_error($this->koneksi);
    }

    if (mysqli_num_rows($checkExistingImport) > 0) {
        return "Items from Order Number $orderNumber have already been imported into Good Issue $goodIssueNumber.";
    }

    // Fetch items to import
    $queryItems = mysqli_query($this->koneksi, "SELECT `item_code`, `qty`, `notes` FROM `item_request` WHERE `order_number` = '$orderNumber'");
    if (!$queryItems) {
        return "Database error: " . mysqli_error($this->koneksi);
    }

    if (mysqli_num_rows($queryItems) === 0) {
        return "No items found for Order Number $orderNumber.";
    }

    // Prepare bulk insert
    $values = [];
    while ($item = mysqli_fetch_assoc($queryItems)) {
        $values[] = "('$goodIssueNumber', '$orderNumber', '{$item['item_code']}', '{$item['qty']}', 'From Order Request', '0')";
    }

    if (!empty($values)) {
        $insertQuery = "INSERT INTO `good_issue_items` (`good_issue_number`, `order_number`, `item_code`, `qty`, `notes`, `status`) VALUES " . implode(",", $values);
        $insertResult = mysqli_query($this->koneksi, $insertQuery);

        if (!$insertResult) {
            return "Error inserting items: " . mysqli_error($this->koneksi);
        }
    }

    return "successfully imported";
}

        
//GOOD ISSUE

	function viewGoodsIssue()
	{
		$data = mysqli_query($this->koneksi, "SELECT a.`id`, a. `good_issue_number`, a.`order_number`, a.`notes`, a.`create_by`,a. `create_date`, e.status_name,a.`status`,b.document_number,b.create_date as orderdate,c.department_name,d.pic_name FROM `good_issue` a LEFT JOIN order_list b on a.order_number=b.order_number LEFT JOIN department c on b. department=c.id LEFT JOIN master_pic d on b.pic=d.id LEFT JOIN master_status_gr e on a.status=e.id;");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
     // Fungsi untuk insert Order
   public function insertGI($txtOrdernumber, $notes, $createBy,$createdate)
    {
        // Default nilai approval dan status
        $approval_1 = '0';
        $approval_2 = '0';
        $status = '1';

        // Generate order number otomatis
        $currentDate = date('d');   // Day
        $currentMonth = date('m');  // Month
        $currentYear = date('y');   // Last two digits of the year

        // Label untuk order number
        $label = "GI-";
        $baseOrderNumber = $label . $currentDate . $currentMonth . $currentYear . '-';

        // Cek apakah ada order existing di tahun ini untuk menentukan running number
        $dataSqlJ = "SELECT COUNT(*) AS count 
                     FROM good_issue 
                     WHERE YEAR(create_date) = YEAR(CURDATE()) 
                     AND good_issue_number LIKE '$label$currentDate$currentMonth$currentYear-%'";

        $dataQryJ = mysqli_query($this->koneksi, $dataSqlJ) or die("Gagal Query" . mysqli_error($this->koneksi));
        $dataRowJ = mysqli_fetch_array($dataQryJ);

        // Hitung nomor urut
        $count = intval($dataRowJ['count']);
        if ($count > 0) {
            // Jika sudah ada order sebelumnya, tambahkan nomor urut
            $numnow = $count + 1;
        } else {
            // Mulai dari 1 jika belum ada order
            $numnow = 1;
        }

        // Zero padding untuk membuat nomor urut 4 digit
        $fzeropadded = sprintf("%04d", $numnow); // Menggunakan 4 digit

        // Nomor order final
        $orderNumber = $baseOrderNumber . $fzeropadded;

        // Tanggal sekarang untuk create_date
        $createDate = date('Y-m-d');

        // Query insert ke tabel order_list
        $query = "INSERT INTO `good_issue` (`id`, `good_issue_number`, `order_number`, `notes`, `create_by`, `create_date`, `status`) 
                  VALUES ('', '$orderNumber', '$txtOrdernumber', '$notes', '$createBy', '$createDate',  '$status')";

        // Eksekusi query
        mysqli_query($this->koneksi, $query) or die("Gagal Insert" . mysqli_error($this->koneksi));

        // Kembalikan nilai order number
        return $orderNumber;
    }    
    
    
     // Fungsi untuk update Order
     function editGI($id, $docNumber, $department, $pic, $orderBy, $orderDate, $notes)
    {
        $query = "UPDATE good_issue SET good_issue_number = '$docNumber', department = '$department', pic = '$pic' 
                  WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    // Fungsi untuk delete Order
     function deleteGI($id,$code)
    {
        $query = "DELETE FROM good_issue WHERE id = '$id'";

        mysqli_query($this->koneksi, $query);
   
         $query2 = "DELETE FROM good_issue_items WHERE good_issue_number = '$code'";
        mysqli_query($this->koneksi, $query2);
    }

    // Fungsi untuk save Order (mark as completed or save changes)
     function saveGI($id)
    {
        $query = "UPDATE good_issue SET status = '1' WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    
    //PUT AWAY (USED)

 function viewPickuplist()
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "
                SELECT a.id,a.good_issue_number, a.order_number,a.item_code, a.status, a.qty,a.notes, b.item_name, b.spec, b.maesurename,d.department_name FROM good_issue_items a 
                LEFT JOIN view_catalog b ON a.item_code = b.item_code LEFT JOIN order_list c on a.order_number=c.order_number LEFT JOIN department d on c.department=d.id
                WHERE a.qty!='0' ORDER BY a.id DESC;
                
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
            
       

// Fungsi untuk insert Order
public function insertOrder($docNumber, $department, $pic, $notes, $createBy)
{
    // Default approval and status values
    $approval_1 = '0';
    $approval_2 = '0';
    $status = '1';

    // Current date components
    $currentDate = date('d');   // Day
    $currentMonth = date('m');  // Month
    $currentYear = date('y');   // Last two digits of the year

    // Base label for order number
    $label = "ORD-";
    $baseOrderNumber = $label . $currentDate . $currentMonth . $currentYear . '-';

    // Query to check the current year's highest running number
    $dataSqlJ = "SELECT MAX(order_number) AS max_order 
                 FROM order_list 
                 WHERE YEAR(create_date) = YEAR(CURDATE()) 
                 AND order_number LIKE '$label$currentDate$currentMonth$currentYear-%'";

    $dataQryJ = mysqli_query($this->koneksi, $dataSqlJ) or die("Gagal Query: " . mysqli_error($this->koneksi));
    $dataRowJ = mysqli_fetch_array($dataQryJ);

    // Extract the highest running number from the order number
    $maxOrder = $dataRowJ['max_order'];
    if ($maxOrder) {
        // Extract the numeric part and increment it
        $lastNumber = intval(substr($maxOrder, -4)); // Get last 4 digits
        $numnow = $lastNumber + 1;
    } else {
        // Start from 1 if no orders exist for the current year
        $numnow = 1;
    }

    // Zero padding for the running number
    $fzeropadded = sprintf("%04d", $numnow); // Ensures 4 digits

    // Final order number
    $orderNumber = $baseOrderNumber . $fzeropadded;

    // Current date for `create_date`
    $createDate = date('Y-m-d');

    // Insert query for order_list table
    $query = "INSERT INTO `order_list` 
              (`id`, `order_number`, `document_number`, `department`, `pic`, `notes`, `create_date`, `create_by`, `approval_1`, `approval_2`, `status`) 
              VALUES ('', '$orderNumber', '$docNumber', '$department', '$pic', '$notes', '$createDate', '$createBy', '$approval_1', '$approval_2', '$status')";

    // Execute the insert query
    mysqli_query($this->koneksi, $query) or die("Gagal Insert: " . mysqli_error($this->koneksi));

    // Return the generated order number
    return $orderNumber;
}



    // Fungsi untuk update Order
     function editOrder($id, $docNumber, $department, $pic, $orderBy, $orderDate, $notes)
    {
        $query = "UPDATE order_list SET document_number = '$docNumber', department = '$department', pic = '$pic' 
                  WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    // Fungsi untuk delete Order
     function deleteOrder($id)
    {
        $query = "DELETE FROM order_list WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }

    // Fungsi untuk save Order (mark as completed or save changes)
     function saveOrder($id)
    {
        $query = "UPDATE order_list SET status = '1' WHERE id = '$id'";
        mysqli_query($this->koneksi, $query);
    }






//GOOD RECEIPT (USED)


	function viewGoodreceipt()
	{
		$data = mysqli_query($this->koneksi, "SELECT a.id,a.status, a.receipt_number,a.status, a.delivery_number, a.document_number, a.notes, a.receipt_date, a.receipt_by, b.type_name, c.site_name, d.status_name,e.vendor_name FROM good_receipt a LEFT JOIN receipt_type b ON a.receipt_type = b.id LEFT JOIN master_site c ON a.receipt_at = c.id_site LEFT JOIN master_status_gr d ON a.status = d.id LEFT JOIN master_vendor e on a.vendor=e.id_vendor ORDER BY a.id DESC;");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	
	function insertGR($txtDO, $txtType, $txtVendor, $txtDN, $txtAt, $txtreceiptby,$txtDate, $txtNotes)
	{
		if ($txtType) {
			$txtTypeI = $txtType;
		} else {
			$txtTypeI = '0';
		}
		if ($txtAt) {
			$txtAtI = $txtAt;
		} else {
			$txtAtI = '0';
		}
	
            // Get the current date in the desired format
            $currentDate = date('d');  // Day
            $currentMonth = date('m');  // Month
            $currentYear = date('y');   // Last two digits of the year
            
            // Generate the base receipt number
            $label = "GR-";
            $baseReceiptNumber = $label . $currentDate . $currentMonth . $currentYear . '-';
            
            // Create the new receipt number starting with 00001
            $txtReceiptnumber = $baseReceiptNumber . '00001';
            
            // Check if there are existing receipts for the current year to adjust the number
            $dataSqlJ = "SELECT COUNT(*) AS count 
                          FROM good_receipt 
                          WHERE YEAR(receipt_date) = YEAR(CURDATE()) 
                          AND receipt_number LIKE '$label$currentDate$currentMonth$currentYear-%'";
            
            $dataQryJ = mysqli_query($this->koneksi, $dataSqlJ) or die("Gagal Query" . mysqli_error($this->koneksi));
            $dataRowJ = mysqli_fetch_array($dataQryJ);
            
            // Calculate the new running number
            $count = intval($dataRowJ['count']);
            if ($count > 0) {
                // If there are existing receipts for this year, increment the number
                $numnow = $count + 1; // Start from 1 if there are existing receipts
            } else {
                $numnow = 1; // Start at 1 if there are no existing receipts
            }
            // Zero pad to ensure it is 5 digits
            $fzeropadded = sprintf("%05d", $numnow);
            // Final receipt number
            $txtReceiptnumber = $baseReceiptNumber . $fzeropadded;
            $txtReceiptnumber; // Display the generated receipt number

    		mysqli_query($this->koneksi, "INSERT INTO `good_receipt`(`id`, `receipt_number`, `delivery_number`, `receipt_type`, `document_number`, `vendor`, `receipt_at`, `notes`, `receipt_date`, `receipt_by`, `status`) VALUES
    		('','$txtReceiptnumber','$txtDO','$txtTypeI','$txtDN','$txtVendor','$txtAtI','$txtNotes','$txtDate','$txtreceiptby','1')");
        	}
     function saveGR($id)
{ 
    // Ambil data item berdasarkan gr_number 
    $data = mysqli_query($this->koneksi, "SELECT item_code, qty_receipt FROM item_received WHERE gr_number='$id'");
    
    while ($d = mysqli_fetch_array($data)) {
        $itemcodes = $d['item_code']; // Ubah 'itemcode' ke 'item_code' sesuai dengan nama kolom
        $qtyreceipt = $d['qty_receipt'];

        // Cek jika item_code sudah ada
        $query = mysqli_query($this->koneksi, "SELECT item_code, total_qty FROM put_away WHERE item_code = '$itemcodes'");
        
        if (mysqli_num_rows($query) > 0) {
            // Jika item sudah ada, update qty_receipt
            $existingItem = mysqli_fetch_assoc($query);
            $newQtyReceipt = $existingItem['total_qty'] + $qtyreceipt; // Tambah qty_receipt baru ke yang ada
            
            $updateQuery = mysqli_query($this->koneksi, "UPDATE put_away SET total_qty = '$newQtyReceipt' WHERE item_code = '$itemcodes'");
        } else {
            // Jika item tidak ada, insert record baru
            $insertQuery = mysqli_query($this->koneksi, "INSERT INTO put_away (id, item_code, total_qty, status) VALUES ('', '$itemcodes', '$qtyreceipt', '1')");
        }
    }
    
    // Update status good receipt
    mysqli_query($this->koneksi, "UPDATE good_receipt SET status='2' WHERE receipt_number='$id'");
}

        		function editGR($id,$txtDO,$txtType,$txtVendor,$txtDN,$txtAt)
        	{
        		mysqli_query($this->koneksi, "update good_receipt set delivery_number='$txtDO',document_number='$txtDN', receipt_type='$txtType',vendor='$txtVendor',receipt_at='$txtAt'  where id='$id'");
        	}
        		function deleteGR($id)
        	{
        		mysqli_query($this->koneksi, "delete from good_receipt where id='$id'");
        	}

//GOOD RECEIPT ITEMS/DETAIL (USED)

             function viewGoodreceiptdetail($idtrans)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT a.id, a.item_code, a.qty_do, a.qty_receipt, a.notes, b.item_name, b.spec, b.maesurename, a.create_date, a.create_by FROM item_received a LEFT JOIN view_catalog b ON a.item_code = b.item_code WHERE a.gr_number='$idtrans' ORDER BY a.id DESC;");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
            
            
        	
            function insertItemGR($txtGrnumber, $itemcode, $txtQtyDO, $txtQtyReceipt, $txtNotes)
            {
                // Check if the item_code already exists
                $query = mysqli_query($this->koneksi, "SELECT qty_receipt FROM `item_received` WHERE `gr_number` = '$txtGrnumber' AND `item_code` = '$itemcode'");
                
                if (mysqli_num_rows($query) > 0) {
                    // If the item already exists, update the qty_receipt
                    $existingItem = mysqli_fetch_assoc($query);
                    $newQtyReceipt = $existingItem['qty_receipt'] + $txtQtyReceipt; // Add new qty_receipt to the existing one
                    
                    $updateQuery = mysqli_query($this->koneksi, "UPDATE `item_received` SET 
                        `qty_receipt` = '$newQtyReceipt', 
                        `notes` = '$txtNotes', 
                        `create_by` = '" . $_SESSION['SES_LOGIN'] . "', 
                        `create_date` = '" . date('Y-m-d') . "' 
                        WHERE `gr_number` = '$txtGrnumber' AND `item_code` = '$itemcode'");
                } else {
                    
      
                    // If the item does not exist, insert a new record
                    $insertQuery = mysqli_query($this->koneksi, "INSERT INTO `item_received`(`id`, `gr_number`, `item_code`, `qty_do`, `qty_receipt`, `notes`, `create_by`, `create_date`, `status`) VALUES
                    ('','$txtGrnumber','$itemcode','$txtQtyDO','$txtQtyReceipt','$txtNotes','" . $_SESSION['SES_LOGIN'] . "','" . date('Y-m-d') . "','1')");
                }
            }

    		function editItemGR($id, $txtDO, $txtType, $txtVendor,$txtDN,$txtAt)
        	{
    		mysqli_query($this->koneksi, "update good_receipt set delivery_number='$txtDO',document_number='$txtDN',receipt_type='$txtType',vendor='$txtVendor',receipt_at='$txtAt'  where id='$id'");
            }
	
        	function deleteItemGR($id, $txtGrnumber)
        	{
        
        		$code = $_POST['$txtGrnumber'];
        
        
        		mysqli_query($this->koneksi, "delete from item_received where id='$id'");
        	}

        function viewGoodreceiptdetailall($status)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT 
                        a.id,
                        a.gr_number,
                        a.item_code,
                        a.qty_do,
                        a.qty_receipt,
                        a.notes,
                        b.item_name,
                        b.spec,
                        b.maesurename,
                        a.create_date,
                        a.create_by,
                        c.status 
                    FROM 
                        item_received a 
                    LEFT JOIN 
                        view_catalog b ON a.item_code = b.item_code 
                    LEFT JOIN 
                        good_receipt c ON a.gr_number = c.receipt_number 
                    WHERE 
                        c.status = '$status' 
                    ORDER BY 
                        a.id DESC;
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }


//PUT AWAY (USED)

 function viewPutAway()
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT 
                        a.id,
                        a.item_code,
                        a.total_qty,
                        a.status,
                        b.item_name,
                        b.spec,
                        b.maesurename
                 
                    FROM 
                        put_away a 
                    LEFT JOIN 
                        view_catalog b ON a.item_code = b.item_code WHERE a.total_qty!='0'
                    
                    ORDER BY 
                        a.id DESC;
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }


function viewStorageHistory($code)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT 
                        a.id_trans,
                        a.code,
                        a.old_stock,
                        a.qty,
                        a.desc,
                        a.create_date,
                        a.create_by,
                        b.item_name,
                        b.spec,
                        b.maesurename,
                        c.location_name,
                        d.rack_name
                 
                    FROM 
                        transaction_history a 
                    LEFT JOIN 
                        view_catalog b ON a.code = b.item_code 
                    LEFT JOIN
                        master_location c ON a.location=c.id_location
                    LEFT JOIN
                        master_rack d ON a.rack=d.id_rack
                        
                    WHERE a.code='$code' 
                    
                    ORDER BY 
                        a.id_trans DESC;
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }

function viewPutAwayinstock($code)
            {
                // Initialize $hasil as an empty array
                $hasil = []; 
                
                $data = mysqli_query($this->koneksi, "SELECT 
                        a.id,
                        a.item_code,
                        a.total_qty,
                        a.status,
                        b.item_name,
                        b.spec,
                        b.maesurename
                 
                    FROM 
                        put_away a 
                    LEFT JOIN 
                        view_catalog b ON a.item_code = b.item_code 
                    WHERE a.item_code='$code' AND a.total_qty!='0'
                    
                    ORDER BY 
                        a.id DESC;
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }
//PUT AWAY

function insertPutaway($itemcode, $location, $rack, $qty)
            {
                // Check if the item_code already exists
                $query = mysqli_query($this->koneksi, "SELECT item_code,qty FROM `stock_location` WHERE `item_code` = '$itemcode' AND `location` = '$location' AND `rack` = '$rack'");
                
                if (mysqli_num_rows($query) > 0) {
                    // If the item already exists, update the qty_receipt
                    $existingItem = mysqli_fetch_assoc($query);
                    $qtyold=$existingItem['qty'];
                    $create_by = $_SESSION['SES_LOGIN'];
                    $create_date = date('Y-m-d H:i:s');
                    $newQtyReceipt = $existingItem['qty'] + $qty; // Add new qty_receipt to the existing one
                    
                    $updateQuery = mysqli_query($this->koneksi, "UPDATE `stock_location` SET 
                        `qty` = '$newQtyReceipt' WHERE `item_code` = '$itemcode' AND `location` = '$location' AND `rack` = '$rack'");
                
                    
                     $insertQueryhistory = mysqli_query($this->koneksi, "INSERT INTO `transaction_history`(`id_trans`, `code`, `type_transaction`, `old_stock`, `qty`, `desc`, `site`, `location`, `rack`, `create_date`, `create_by`, `status`) 
                     VALUES ('','$itemcode','2','$qtyold','$qty','Add New Stock','','$location','$rack','$create_date','$create_by','1')");
                    
                       // Check if the item_code already exists
                      $query = mysqli_query($this->koneksi, "SELECT item_code,total_qty FROM `put_away` WHERE `item_code` = '$itemcode'");
                
                          if (mysqli_num_rows($query) > 0) {
                    // If the item already exists, update the qty_receipt
                         $existingItem2 = mysqli_fetch_assoc($query);
                         $newQtyReceipt2 = $existingItem2['total_qty'] - $qty;
                          $updateQuery2 = mysqli_query($this->koneksi, "UPDATE `put_away` SET `total_qty` = '$newQtyReceipt2' WHERE `item_code` = '$itemcode'");
                  
                           }
                        
                } else {
                    
                    $create_by = $_SESSION['SES_LOGIN'];
                    $create_date = date('Y-m-d H:i:s');
                    
                       // Check if the item_code already exists
                      $query = mysqli_query($this->koneksi, "SELECT item_code,total_qty FROM `put_away` WHERE `item_code` = '$itemcode'");
                
                          if (mysqli_num_rows($query) > 0) {
                    // If the item already exists, update the qty_receipt
                    $existingItem2 = mysqli_fetch_assoc($query);
                       $newQtyReceipt2 = $existingItem2['total_qty'] - $qty;
                    $updateQuery2 = mysqli_query($this->koneksi, "UPDATE `put_away` SET `total_qty` = '$newQtyReceipt2' WHERE `item_code` = '$itemcode'");
                 
                           }
      
      
                   $insertQueryhistory = mysqli_query($this->koneksi, "INSERT INTO `transaction_history`(`id_trans`, `code`, `type_transaction`, `old_stock`, `qty`, `desc`, `site`, `location`, `rack`, `create_date`, `create_by`, `status`) 
                   VALUES ('','$itemcode','2','0','$qty','Add New Stock','','$location','$rack','$create_date','$create_by','1')");
                    
      
      
                    // If the item does not exist, insert a new record
                    $insertQuery = mysqli_query($this->koneksi, "INSERT INTO `stock_location`(`id_stock_loc`, `item_code`, `site`, `location`, `rack`, `qty`, `status`) 
                    VALUES ('','$itemcode','','$location','$rack','$qty','0')");
                    
                    
                }
            }










    	function editasset($id, $txtAssetname, $txtSpec, $txtSN, $txtSerialnumber, $txtRemark, $txtSite, $txtLocation, $location)
        	{
    
    		if (isset($location)) {
    			mysqli_query($this->koneksi, "update master_asset set item_name='$txtAssetname',part_number='$txtSerialnumber',specification='$txtSpec',serial_number='$txtSN',picture='$location',site='$txtSite',location='$txtLocation',remark='$txtRemark'  where id_asset='$id'");
    		} else {
    
    			mysqli_query($this->koneksi, "update master_asset set item_name='$txtAssetname',part_number='$txtSerialnumber',specification='$txtSpec',serial_number='$txtSN',site='$txtSite',location='$txtLocation',remark='$txtRemark'  where id_asset='$id'");
    		}
        	}




	//ADD ITEM TO MANUFACTURE
	function insertitem_mfp($mfp, $code)
	{
		$mfpget = $_GET['mfp'];


		mysqli_query($this->koneksi, "insert into  item_manufacture (`no_mnp`, `item_code`, `qty`, `notes`, `status`) values('$mfp','$code','0','','0')");
	}



	
	
	
	
	
	
	
		//GOODRECEIPT




	







	//MAINTENANCE
	function viewMaintenance($mnp)
	{
		$data = mysqli_query($this->koneksi, "select * from item_maintenance a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_mnp='" . $mnp . "'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	//Usage


	function viewUsage()
	{
		//	$data = mysqli_query($this->koneksi,"select * from material_usage a left join master_catalog b on a.item_code=b.item_code left join master_site c on a.from_site=c.id_site left join master_location d on a.from_location=d.id_location left join master_rack e on a.from_rack=e.id_rack WHERE  YEAR(date) = YEAR(CURDATE()) order by a.id_usage DESC");
		$data = mysqli_query($this->koneksi, "select * from material_usage a left join master_catalog b on a.item_code=b.item_code left join master_site c on a.from_site=c.id_site left join master_location d on a.from_location=d.id_location left join master_rack e on a.from_rack=e.id_rack order by a.id_usage DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewUsageitem($code)
	{
		$data = mysqli_query($this->koneksi, "select * from material_usage a left join master_catalog b on a.item_code=b.item_code left join master_site c on a.from_site=c.id_site left join master_location d on a.from_location=d.id_location left join master_rack e on a.from_rack=e.id_rack where a.item_code='$code' order by a.id_usage DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	//Receive


	function viewReceive()
	{
		//$data = mysqli_query($this->koneksi,"select *,a.picture as pic from receive_item a left join master_user b on a.pic=b.first_name left join master_catalog c on a.item_code=c.item_code left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_rack   WHERE  YEAR(date) = YEAR(CURDATE()) order by a.id_receive DESC");
		$data = mysqli_query($this->koneksi, "select *,a.picture as pic from receive_item a left join master_user b on a.pic=b.first_name left join master_catalog c on a.item_code=c.item_code left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_rack   order by a.id_receive DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	//Receive


function viewReceiveitem($code)
 {
                // Initialize $hasil as an empty array
                $hasil = []; 
                 $status='2';
                $data = mysqli_query($this->koneksi, "SELECT 
                        a.id,
                        a.gr_number,
                        a.item_code,
                        a.qty_do,
                        a.qty_receipt,
                        a.notes,
                        b.item_name,
                        b.spec,
                        b.maesurename,
                        a.create_date,
                        a.create_by,
                        c.status 
                    FROM 
                        item_received a 
                    LEFT JOIN 
                        view_catalog b ON a.item_code = b.item_code 
                    LEFT JOIN 
                        good_receipt c ON a.gr_number = c.receipt_number 
                    WHERE 
                        c.status = '$status' AND a.item_code='$code' 
                    ORDER BY 
                        a.id DESC;
                    ");
            
                while ($d = mysqli_fetch_array($data)) {
                    $hasil[] = $d;
                }
            
                return $hasil; // Return the results (empty array if no results were found)
            }


	//history


	function viewHistory()
	{
		$data = mysqli_query($this->koneksi, "select * from history a left join master_user b on a.pic=b.first_name  order by a.id_history ASC LIMIT 20");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}








	//purchase order add item asset



	function viewAddItemPOasset($numberPO)
	{
		$data = mysqli_query($this->koneksi, "select * from purchase_order_asset_tmp a left join master_maesurement b on a.maesurement=b.id_mae where a.no_po='$numberPO'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertItemPOasset($id, $txtPO, $txtMR, $txtDesc, $txtSpec, $txtQty, $txtMae, $txtPrice, $txtNotesrequest)
	{

		$spec = mysql_real_escape_string($txtSpec);

		mysqli_query($this->koneksi, "insert into  purchase_order_asset_tmp values('','$txtPO','$id','$txtMR','$txtDesc','$spec','$txtQty','$txtMae','$txtPrice','$txtNotesrequest','0')");
	}

	function updateItemPOasset($id, $txtEditqty, $txtNoPOedit, $txtEditPrice)
	{
		$po = $_POST['$txtNoPOedit'];




		mysqli_query($this->koneksi, "update purchase_order_asset_tmp set qty='$txtEditqty',price='$txtEditPrice'  where id_item_po='$id'");
	}
	function deleteItemPOassetss($id, $xtNoPODelete)
	{

		$po = $_POST['txtNoPODelete'];


		mysqli_query($this->koneksi, "delete from purchase_order_asset_tmp where id_item_po='$id'");
	}

	function deleteAllItemPOasset($po)
	{

		$po = $_GET['po'];

		mysqli_query($this->koneksi, "delete from purchase_order_asset_tmp where no_po='$po'");
	}


	function updatestatusPOsendasset($po)
	{

		mysqli_query($this->koneksi, "update purchase_order set status_po='1'  where number_po='$po'");

		mysqli_query($this->koneksi, "insert into history values('','PO','NEW PURCHASE','Create New Purchase Number $po ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$dataSqlPOcheck = "select * from purchase_order a left join master_user b on a.pic_created=b.id_user   where a.number_po='$po'";
		$dataQryPOCheck = mysqli_query($this->koneksi, $dataSqlPOcheck) or die("Gagal Query" . mysqli_error());
		$checkPO = mysqli_fetch_array($dataQryPOCheck);
		$txtnoPO = $checkPO['number_po'];
		$txtPICreqPO = $checkPO['first_name'];
		$txtNotesPO = $checkPO['notes'];
		$txtStatusPO = "NEW PURCHASE ORDER";
		$datereqPO = date('Y-m-d');
		require "../pages/email_format/email_po.php";

		AddNewPO($txtnoPO, $datereqPO, $messagePO);





	}

	function addPPNPOasset($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='10'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addPPH2asset($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='2'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addPPH4asset($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='4'  where number_po='$po'");
		$po = $_GET['po'];
	}

	function noPPNPOasset($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='0'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addTransportPOasset($po, $txtTransport)
	{

		mysqli_query($this->koneksi, "update purchase_order set transport_price='$txtTransport'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addDiscountPOasset($po, $txtDiscount)
	{

		mysqli_query($this->koneksi, "update purchase_order set total_discount='$txtDiscount'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addInfoPOasset($txtPO, $txtInfoPO, $txtTotal, $txtNotes)
	{

		mysqli_query($this->koneksi, "update purchase_order set info='$txtInfoPO',total_price='$txtTotal',notes='$txtNotes'  where number_po='$txtPO'");
		$po = $_POST['txtPO'];
	}



	//Document
	function viewDocumentpo($numberPO)
	{
		$data = mysqli_query($this->koneksi, "select * from document where doc_number='$numberPO' ORDER by id_doc");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function viewDocument()
	{
		$data = mysqli_query($this->koneksi, "select * from document");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertDocument($txtdocnum, $txtDocname, $location, $txtNotes)
	{


		mysqli_query($this->koneksi, "insert into document values('','$txtdocnum','$txtDocname','$location','$txtNotes','')");
	}

	function deleteDocument($id, $pic)
	{

		@unlink($pic);

		mysqli_query($this->koneksi, "delete from document where id_doc='$id'");
	}




	//Manufacturing

	function viewManufacturing()
	{
		$data = mysqli_query($this->koneksi, "select * from manufacture_planning where status!='0' order by code_planning DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewManufacturingproses()
	{
		$data = mysqli_query($this->koneksi, "select * from manufacture_planning where status='0' order by code_planning DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertmanufacture($txtNomanu, $txtPlanningname, $txtStartdate, $txtFinishdate, $txtPICreg, $txtLocation, $txtNotesmn)
	{


		$txtStartdatetmp = str_replace('.', '-', $txtStartdate);
		$txtStartdatefix = date('Y-m-d', strtotime($txtStartdatetmp));


		$txtFinishdatetmp = str_replace('.', '-', $txtFinishdate);
		$txtFinishdatefix = date('Y-m-d', strtotime($txtFinishdatetmp));




		mysqli_query($this->koneksi, "insert into manufacture_planning values(null,'$txtNomanu','$txtPlanningname','$txtStartdatefix','$txtFinishdatefix','$txtPICreg','$txtLocation','$txtNotesmn',0)");
	}










	//Stocklist


	function viewStoclist($itemcode)
	{
		$data = mysqli_query($this->koneksi, "select a.id_stock_loc,a.item_code,a.site,a.location,a.rack,a.qty,a.status,b.item_name,b.part_number,b.item_name,b.specification,b.maesurement,b.brand,c.maesurename,d.site_name,e.location_name,f.rack_name,g.manufacture_name,g.manufacture_code,h.brand_name from stock_location a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_Rack left join master_manufacture g on b.manufacture=g.id_manu left join master_brand h on b.brand=h.id_brand where a.item_code='$itemcode'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function viewStoclistAll()
	{
		$data = mysqli_query($this->koneksi, "select *,SUM(qty) as totalqty from stock a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_Rack left join master_manufacture g on b.manufacture=g.id_manu left join master_brand h on b.brand=h.id_brand group by a.rack,a.item_code");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function viewStoclistManufacture()
	{
		$data = mysqli_query($this->koneksi, "select * from stock a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_Rack left join master_manufacture g on b.manufacture=g.id_manu left join master_brand h on b.brand=h.id_brand where  a.site=d.id_site AND a.location=e.id_location");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}



	//Update Status PO



	function ApprovePO($txtPO, $txtUserApprove, $txtdateApprove)
	{
		mysqli_query($this->koneksi, "update purchase_order set status1='$txtUserApprove',date_status1='$txtdateApprove',status_po='2' where number_po='$txtPO'");
		$po = $_POST['txtPO'];
	}


	function RejectPO($txtPO, $txtUserApprove, $txtdateApprove)
	{
		mysqli_query($this->koneksi, "update purchase_order set status1='$txtUserApprove',date_status1='$txtdateApprove',status_po='3' where number_po='$txtPO'");
		$po = $_POST['txtPO'];
	}

	function VoidPO($id)
	{
		mysqli_query($this->koneksi, "delete from master_vendor where id_vendor='$id'");
	}


	//USAGE


	function UsageStockUsage($id, $idcode, $txtMnp, $txtQtyusage, $txtSite, $txtLocation, $txtRack, $txtNotes)
	{
		if ($txtRack) {
			$rak = $txtRack;
		} else {
			$rak = "0";
		}



		mysqli_query($this->koneksi, "insert into material_usage (`no_mnp`, `item_code`, `qty`, `from_site`, `from_location`, `from_rack`, `status`, `notes`, `date`) values ('$txtMnp','$idcode','$txtQtyusage','$txtSite','$txtLocation','$rak','0','$txtNotes','" . date('Y-m-d') . "')");
		$dataSqlUsage = "select * from stock_location  where  id_stock_loc='$id'";
		$dataQryUsage = mysqli_query($this->koneksi, $dataSqlUsage) or die("Gagal Query" . mysqli_error());
		$checkUsage = mysqli_fetch_array($dataQryUsage);
		$txtQty = $checkUsage['qty'] - $txtQtyusage;

		mysqli_query($this->koneksi, "update stock_location set qty='$txtQty' where  id_stock_loc='$id'");


		$noManu = $_POST['txtMnp'];
	}





	//Master Vendor

	function viewVen()
	{
		$data = mysqli_query($this->koneksi, "select * from master_vendor");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertVen($txtVendor, $txtAddress, $txtPhone, $txtFax, $txtEmail)
	{
		mysqli_query($this->koneksi, "insert into master_vendor (`vendor_name`, `address`, `phone`, `fax`, `email`, `status`) values('$txtVendor','$txtAddress','$txtPhone','$txtFax','$txtEmail','0')");
	}
	function updateVen($id, $txtVendor, $txtAddress, $txtPhone, $txtFax, $txtEmail)
	{
		mysqli_query($this->koneksi, "update master_vendor set vendor_name='$txtVendor',address='$txtAddress',phone='$txtPhone',fax='$txtFax',email='$txtEmail'  where id_vendor='$id'");
	}

	function DeleteVen($id)
	{
		mysqli_query($this->koneksi, "delete from master_vendor where id_vendor='$id'");
	}




	//Master currency

	function viewCur()
	{
		$data = mysqli_query($this->koneksi, "select * from master_currency");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertCur($txtCur)
	{
		mysqli_query($this->koneksi, "insert into master_currency (`currency_name`, `status`) values('$txtCur','0')");
	}
	function updateCur($id, $txtCur)
	{
		mysqli_query($this->koneksi, "update master_currency set currency_name='$txtCur'  where id_cur='$id'");
	}

	function DeleteCur($id)
	{
		mysqli_query($this->koneksi, "delete from master_currency where id_cur='$id'");
	}


	//Material Request Head
	function viewMRheadpending()
	{
		$data = mysqli_query($this->koneksi, "select * from material_request a left join master_type_material b on a.type_mr=b.id_type where a.status=0 and YEAR(a.date_register) = YEAR(CURDATE()) order by no_mr Desc");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}


		return $hasil;
	}
	function viewMRhead()
	{
		$data = mysqli_query($this->koneksi, "select * from material_request order by no_mr Desc");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewMRheadlist()
	{
		$data = mysqli_query($this->koneksi, "select a.*,b.type_name from material_request a left join master_type_material b on a. type_mr=b.id_type where a.status!='0' order by a.no_mr Desc");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewMRheadItem($actionNomr)
	{
		$data = mysqli_query($this->koneksi, "select * from item_material_request where no_mr='$actionNomr'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function viewMRlistforPO($numbermr)
	{
		$data = mysqli_query($this->koneksi, "select * from item_material_request_tmp a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join material_request d on a.no_mr=d.no_mr where d.status=2");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}




	function insertMRhead($txtdateReg, $txtLocationReq, $txtPICreq, $txtNotesmr, $txtTypereq)
	{
		$dataSqlJ = "select substring(no_mr,9,7) as asd from material_request where YEAR(date_register) = YEAR(CURDATE()) order by asd desc limit 1";
		$dataQryJ = mysqli_query($this->koneksi, $dataSqlJ) or die("Gagal Query" . mysqli_error());
		$dataRowJ = mysqli_fetch_array($dataQryJ);
		$num = $dataRowJ['asd'];
		$numnow = $num + 1;
		$fzeropadded = sprintf("%07s", $numnow);
		$label = "MR";
		$txtAssetCode = $label . date('ymd') . $fzeropadded;


		mysqli_query($this->koneksi, "insert into material_request (`no_mr`, `date_register`, `location_request`, `pic_request`, `notes`, `type_mr`, `status`, `status_mr1`, `date_mr1`, `status_mr2`, `date_mr2`) values('$txtAssetCode','$txtdateReg','$txtLocationReq','$txtPICreq','$txtNotesmr','$txtTypereq','0','','0','','0')");
		mysqli_query($this->koneksi, "insert into history ( `type_history`, `action`, `history`, `date`, `pic`) values('MR','Insert','Insterted MR $txtnoMR','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");






	}


	//project

	function startProject($mnp)
	{
		mysqli_query($this->koneksi, "update manufacture_planning set status='1'  where code_planning='$mnp'");
		mysqli_query($this->koneksi, "insert into history values('','Manufacture','Start','Start Project Number $mnp','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$noManu = $_GET['$mnp'];
	}
	function finishProject($mnp)
	{
		mysqli_query($this->koneksi, "update manufacture_planning set status='2'  where code_planning='$mnp'");
		mysqli_query($this->koneksi, "insert into history values('','Manufacture','Finish','Finish Project Number $mnp','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$noManu = $_GET['$mnp'];
	}
	function finish2Project($mnp)
	{
		mysqli_query($this->koneksi, "update manufacture_planning set status='3'  where code_planning='$mnp'");
		mysqli_query($this->koneksi, "insert into history values('','Manufacture','Finish','Created Asset Manufacture Number $mnp','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$noManu = $mnp;
	}




	function updateMRhead($id, $txtnumMR, $txtNotes)
	{
		mysqli_query($this->koneksi, "update material_request set notes='$txtNotes'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into history values('','MR','Update','Updated MR $txtnumMR ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
	}

	function DeleteMRhead($id)
	{
		mysqli_query($this->koneksi, "delete from material_request where id_mr='$id'");
		mysqli_query($this->koneksi, "insert into history values('','MR','Delete','Deleted MR $txtnumMR ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
	}

	//Material Request Status
	function approveMRstatus($txtnumMR)
	{
		mysqli_query($this->koneksi, "update material_request set status='2'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into history values('','MR','Approve','Approved MR $txtnumMR ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$dataSqlMrcheck = "select * from material_request  where no_mr='$txtnumMR'";
		$dataQrymrCheck = mysqli_query($this->koneksi, $dataSqlMrcheck) or die("Gagal Query" . mysqli_error());
		$checkmr = mysqli_fetch_array($dataQrymrCheck);
		$txtnoMR = $checkmr['no_mr'];
		$txtPICreqmr = $checkmr['pic_request'];
		$txtNotesmr = $checkmr['notes'];
		$txtStatusmr = "APPROVED";

		require "../pages/email_format/email_mr.php";



		AddNewMR($txtnoMR, $datereqmr, $messagemr);



	}
	function rejectMRstatus($txtnumMR, $txtNotesReject)
	{
		mysqli_query($this->koneksi, "insert into  material_request_reject values('','$txtnumMR','$txtNotesReject','')");

		mysqli_query($this->koneksi, "update material_request set status='3'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into history values('','MR','Reject','Rejected MR $txtnumMR ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");

		$dataSqlMrcheck = "select * from material_request  where no_mr='$txtnumMR'";
		$dataQrymrCheck = mysqli_query($this->koneksi, $dataSqlMrcheck) or die("Gagal Query" . mysqli_error());
		$checkmr = mysqli_fetch_array($dataQrymrCheck);
		$txtnoMR = $checkmr['no_mr'];
		$txtPICreqmr = $checkmr['pic_request'];
		$txtNotesmr = $checkmr['notes'];
		$txtStatusmr = "REJECT";

		require "../pages/email_format/email_mr.php";



		AddNewMR($txtnoMR, $datereqmr, $messagemr);



	}
	function voidMRstatus($txtnumMR)
	{
		mysqli_query($this->koneksi, "update material_request set status='5'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into history values('','MR','Void','Void MR $txtnumMR ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");

		$dataSqlMrcheck = "select * from material_request  where no_mr='$txtnumMR'";
		$dataQrymrCheck = mysqli_query($this->koneksi, $dataSqlMrcheck) or die("Gagal Query" . mysqli_error());
		$checkmr = mysqli_fetch_array($dataQrymrCheck);
		$txtnoMR = $checkmr['no_mr'];
		$txtPICreqmr = $checkmr['pic_request'];
		$txtNotesmr = $checkmr['notes'];
		$txtStatusmr = "VOID";

		require "../pages/email_format/email_mr.php";



		AddNewMR($txtnoMR, $datereqmr, $messagemr);



	}

	function revisionMRstatus($txtnumMR, $txtNotesRevision)
	{
		$nomr = substr($txtnumMR, 0, 15);
		mysqli_query($this->koneksi, "update material_request set status='6'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into  material_request_revision values('','$txtnumMR','$txtNotesRevision','')");

		$dataSqlRevision = "Select COUNT(id_mr_act) as asd from material_request_revision where substring(no_mr,1,15)='$nomr'";
		$dataQrymrRevision = mysqli_query($this->koneksi, $dataSqlRevision) or die("Gagal Query" . mysqli_error());
		$rev = mysqli_fetch_array($dataQrymrRevision);
		$num = $rev['asd'];
		$txtRevmr = $num;
		$label = "REV-";
		$txtRevmrfix = $nomr . '-' . $label . $txtRevmr;



		$dataSqlCheckRev = "select * from material_request  where no_mr='$txtnumMR'";
		$dataQrymrCheckRevision = mysqli_query($this->koneksi, $dataSqlCheckRev) or die("Gagal Query" . mysqli_error());
		$Crev = mysqli_fetch_array($dataQrymrCheckRevision);



		mysqli_query($this->koneksi, "insert into material_request values('','$txtRevmrfix','" . date('Y-m-d') . "','" . $Crev['location_request'] . "','" . $Crev['pic_request'] . "','" . $Crev['notes'] . "','" . $Crev['type_mr'] . "','0','','0','','0')");
		mysqli_query($this->koneksi, "insert into history values('','MR','Revision','Revision MR $txtnumMR ','" . date('Y-m-d') . "','" . $Crev['pic_request'] . "')");

		$data2 = mysqli_query($this->koneksi, "select * from item_material_request_tmp where no_mr='$txtnumMR'");
		while ($d2 = mysqli_fetch_array($data2)) {

			mysqli_query($this->koneksi, "insert into  item_material_request_tmp values('','$txtRevmrfix','" . $d2['item_code'] . "','" . $d2['qty'] . "','" . $d2['notes'] . "','0')");

		}



	}


	function revisionMRstatusAsset($txtnumMR, $txtNotesRevision)
	{
		$nomr = substr($txtnumMR, 0, 15);
		mysqli_query($this->koneksi, "update material_request set status='6'  where no_mr='$txtnumMR'");
		mysqli_query($this->koneksi, "insert into  material_request_revision values('','$txtnumMR','$txtNotesRevision','')");

		$dataSqlRevision = "Select COUNT(id_mr_act) as asd from material_request_revision where substring(no_mr,1,15)='$nomr'";
		$dataQrymrRevision = mysqli_query($this->koneksi, $dataSqlRevision) or die("Gagal Query" . mysqli_error());
		$rev = mysqli_fetch_array($dataQrymrRevision);
		$num = $rev['asd'];
		$txtRevmr = $num;
		$label = "REV-";
		$txtRevmrfix = $nomr . '-' . $label . $txtRevmr;



		$dataSqlCheckRev = "select * from material_request  where no_mr='$txtnumMR'";
		$dataQrymrCheckRevision = mysqli_query($this->koneksi, $dataSqlCheckRev) or die("Gagal Query" . mysqli_error());
		$Crev = mysqli_fetch_array($dataQrymrCheckRevision);



		mysqli_query($this->koneksi, "insert into material_request values('','$txtRevmrfix','" . date('Y-m-d') . "','" . $Crev['location_request'] . "','" . $Crev['pic_request'] . "','" . $Crev['notes'] . "','" . $Crev['type_mr'] . "','0','','0','','0')");
		mysqli_query($this->koneksi, "insert into history values('','MR','Revision','Revision MR $txtnumMR ','" . date('Y-m-d') . "','" . $Crev['pic_request'] . "')");

		$data2 = mysqli_query($this->koneksi, "select * from add_asset_request where no_mr_asset='$txtnumMR'");
		while ($d2 = mysqli_fetch_array($data2)) {

			mysqli_query($this->koneksi, "insert into  add_asset_request values('','$txtRevmrfix','" . $d2['item_description'] . "','" . $d2['specification'] . "','" . $d2['qty'] . "','" . $d2['maesurment'] . "','" . $d2['notes'] . "','0')");

		}



	}


	//Material Purchase Head
	function viewPOhead()
	{
		$data = mysqli_query($this->koneksi, "select * from purchase_order a left join master_vendor b on a.to=b.id_vendor left join material_request c on a.mr_number=c.id_mr left join master_user d on a.pic_created=d.id_user where a.type_req!=0 order by a.number_po DESC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewPOheadlist()
	{
		$data = mysqli_query($this->koneksi, "select * from purchase_order where status!='0'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewPOheadItem($actionNomr)
	{
		$data = mysqli_query($this->koneksi, "select * from purchase_order where no_po='$actionNomr'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function insertPOhead($txtnoPO, $txtTO, $txtReff, $txtCur, $txtdateReg, $txtPIC, $txtMR, $txtSubject, $txtNotes, $txtAttn, $txtTypereq)
	{
		mysqli_query($this->koneksi, "insert into purchase_order `(`number_po`, `to`, `reff_number`, `date_po`, `currency`, `subject`, `mr_number`, `pic_created`, `notes`, `info`, `status1`, `date_status1`, `status_po`, `ppn`, `total_price`, `transport_price`, `total_discount`, `attn`, `type_req`) 
		values('$txtnoPO','$txtTO','$txtReff','$txtdateReg','$txtCur','$txtSubject','$txtMR','$txtPIC','$txtNotes','','','','0','0','','','','$txtAttn','$txtTypereq')");


		mysqli_query($this->koneksi, "insert into history values('','PO','Insert','Insert PO $txtnoPO ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");


	}
	function updatePOhead($id, $txtnumMR, $txtNotes)
	{
		mysqli_query($this->koneksi, "update purchase_order set notes='$txtNotes'  where no_mr='$txtnumMR'");
	}

	function DeletePOhead($id)
	{
		mysqli_query($this->koneksi, "delete from purchase_order where id_mr='$id'");
	}





	//Add item Manufacture


	function viewAddItemMnp($mnp)
	{
		$data = mysqli_query($this->koneksi, "select * from item_manufacture a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_mnp='$mnp'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function insertItemMnp($txtMnp, $txtItemCode, $txtQtyrequest, $txtNotesrequest)
	{

		mysqli_query($this->koneksi, "insert into  item_manufacture values('','$txtMnp','$txtItemCode','$txtQtyrequest','$txtNotesrequest','0')");

		$noManu = $_POST['txtMnp'];
	}
	function updateItemMnp($id, $txtEditqty, $txtMnp, $txtNotes)
	{
		$noManu = $_POST['id'];

		mysqli_query($this->koneksi, "update item_manufacture set qty='$txtEditqty',notes='$txtNotes'  where id_item_mnp='$id'");
	}
	function deleteItemMnp($id, $txtNoMNPDelete)
	{
		$noManu = $_POST['txtNoMNPDelete'];

		mysqli_query($this->koneksi, "delete from item_manufacture where id_item_mnp='$id'");
	}





	//purchase order add item



	function viewAddItemPO($numberPO)
	{
		$data = mysqli_query($this->koneksi, "select * from item_purchase_order_tmp a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_po='$numberPO' ORDER BY a.id_item_po ASC");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertItemPO($txtPO, $txtNomr, $txtItemCode, $txtQtyrequest, $txtPrice, $txtNotesrequest)
	{
		$po = $_POST['txtPO'];
		mysqli_query($this->koneksi, "insert into  item_purchase_order_tmp values('','$txtPO','$txtNomr','$txtItemCode','','','$txtQtyrequest','$txtPrice','$txtNotesrequest','0')");
	}



	function insertItemPOother($txtPO, $txtItemdesc, $txtSpec, $txtQty, $txtUnitprice, $txtNotesrequest)
	{
		$po = $_POST['txtPO'];
		mysqli_query($this->koneksi, "insert into  item_purchase_order_tmp values('','$txtPO','','','$txtItemdesc','$txtSpec','$txtQty','$txtUnitprice','$txtNotesrequest','0')");
	}

	function insertItemPOSET($id, $txtPO, $txtMR, $txtDesc, $txtSpec, $txtQty, $txtMae, $txtPrice, $txtNotesrequest)
	{

		$po = $_POST['txtPO'];

		mysqli_query($this->koneksi, "insert into  purchase_order_asset_tmp values('','$po','','','$txtDesc','$txtSpec','$txtQty','$txtMae','$txtPrice','$txtNotesrequest','0')");

	}
	function updateItemPO($id, $txtEditqty, $txtNoPOedit, $txtEditPrice)
	{
		$po = $_POST['$txtNoPOedit'];
		mysqli_query($this->koneksi, "update item_purchase_order_tmp set qty='$txtEditqty',price='$txtEditPrice'  where id_item_po='$id'");
	}
	function deleteItemPO($id, $txtNoPOedit)
	{

		$po = $_POST['$txtNoPOedit'];


		mysqli_query($this->koneksi, "delete from item_purchase_order_tmp where id_item_po='$id'");
	}

	function deleteAllItemPO($po)
	{

		$po = $_GET['po'];

		mysqli_query($this->koneksi, "delete from item_purchase_order_tmp where no_po='$po'");
	}


	function updatestatusPOsend($po)
	{

		mysqli_query($this->koneksi, "update purchase_order set status_po='1'  where number_po='$po'");

		mysqli_query($this->koneksi, "insert into history values('','PO','NEW PURCHASE','Create New Purchase Number $po ','" . date('Y-m-d') . "','" . $_SESSION['SES_LOGIN'] . "')");
		$dataSqlPOcheck = "select * from purchase_order a left join master_user b on a.pic_created=b.id_user   where a.number_po='$po'";
		$dataQryPOCheck = mysqli_query($this->koneksi, $dataSqlPOcheck) or die("Gagal Query" . mysqli_error());
		$checkPO = mysqli_fetch_array($dataQryPOCheck);
		$txtnoPO = $checkPO['number_po'];
		$txtPICreqPO = $checkPO['first_name'];
		$txtNotesPO = $checkPO['notes'];
		$txtStatusPO = "NEW PURCHASE ORDER";
		$datereqPO = date('Y-m-d');
		require "../pages/email_format/email_po.php";

		AddNewPO($txtnoPO, $datereqPO, $messagePO);


	}

	function addPPNPO($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='10'  where number_po='$po'");
		$po = $_GET['po'];
	}

	function noPPNPO($po)
	{
		mysqli_query($this->koneksi, "update purchase_order set ppn='0'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addTransportPO($po, $txtTransport)
	{

		mysqli_query($this->koneksi, "update purchase_order set transport_price='$txtTransport'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addDiscountPO($po, $txtDiscount)
	{

		mysqli_query($this->koneksi, "update purchase_order set total_discount='$txtDiscount'  where number_po='$po'");
		$po = $_GET['po'];
	}
	function addInfoPO($txtPO, $txtInfoPO, $txtTotal, $txtNotes)
	{

		mysqli_query($this->koneksi, "update purchase_order set info='$txtInfoPO',total_price='$txtTotal',notes='$txtNotes'  where number_po='$txtPO'");
		$po = $_POST['txtPO'];
	}




	//Material Add Item


	function viewAddItem($actionNomr)
	{
		$data = mysqli_query($this->koneksi, "select * from item_material_request_tmp a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae where a.no_mr='$actionNomr'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function sendReq($txtMR)
	{
		mysqli_query($this->koneksi, "update material_request set status='1'  where no_mr='$txtMR'");

		$dataSqlMrcheck = "select * from material_request  where no_mr='$txtMR'";
		$dataQrymrCheck = mysqli_query($this->koneksi, $dataSqlMrcheck) or die("Gagal Query" . mysqli_error());
		$checkmr = mysqli_fetch_array($dataQrymrCheck);
		$txtnoMR = $checkmr['no_mr'];
		$txtPICreqmr = $checkmr['pic_request'];
		$txtNotesmr = $checkmr['notes'];
		$txtStatusmr = "CREATED";

		require "../pages/email_format/email_mr.php";



		AddNewMR($txtnoMR, $datereqmr, $messagemr);



	}


	function insertItem($txtMR, $txtItemCode, $txtQtyrequest, $txtNotesrequest)
	{
		$mr = $_POST['txtMR'];
		mysqli_query($this->koneksi, "insert into  item_material_request_tmp values('','$txtMR','$txtItemCode','$txtQtyrequest','$txtNotesrequest','0')");
	}

	function updateItem($id, $txtEditqty, $txtNoMRedit, $txtNotesedit)
	{
		$mr = $_POST['txtNoMRedit'];
		mysqli_query($this->koneksi, "update item_material_request_tmp set qty='$txtEditqty',notes='$txtNotesedit'  where id_item='$id'");
	}
	function deleteItem($id, $txtNoMRDelete)
	{

		$mr = $_POST['txtNoMRDelete'];


		mysqli_query($this->koneksi, "delete from item_material_request_tmp where id_item='$id'");
	}

	function deleteall($mr)
	{


		mysqli_query($this->koneksi, "delete from item_material_request_tmp where no_mr='$mr'");
	}


	//mr asset

	function insertItemAsset($txtMR, $txtItemDesc, $txtSpecification, $txtQty, $txtMaesurement, $txtNotesmr)
	{
		$mr = $_POST['txtMR'];
		mysqli_query($this->koneksi, "insert into  add_asset_request values('','$txtMR','$txtItemDesc','$txtSpecification','$txtQty','$txtMaesurement','$txtNotesmr','0')");
	}

	function viewAddItemAsset($nomr)
	{
		$data = mysqli_query($this->koneksi, "select *,a.notes as note from add_asset_request a  left join master_maesurement b on a.maesurement=b.id_mae left join material_request c on a.no_mr_asset=c.no_mr where c.no_mr='$nomr'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function viewAddItemAssetall()
	{
		$data = mysqli_query($this->koneksi, "select * from add_asset_request a  left join master_maesurement b on a.maesurement=b.id_mae left join material_request c on a.no_mr_asset=c.no_mr where c.status='2'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function updateItemAsset($id, $txtMR, $txtDesc, $txtSpec, $txtEditqty, $txtMaesurement, $txtNotesedit)
	{

		mysqli_query($this->koneksi, "update add_asset_request set qty='$txtEditqty',item_description='$txtDesc',specification='$txtSpec',maesurement='$txtMaesurement',notes='$txtNotesedit'  where id_asset_req='$id'");
		$mr = $_POST['txtMR'];
	}
	function deleteItemAsset($id, $txtMR)
	{
		mysqli_query($this->koneksi, "delete from add_asset_request where id_asset_req='$id'");
		$mr = $_POST['txtMR'];
	}






	//Maesurement
	function viewMee()
	{
		$data = mysqli_query($this->koneksi, "select * from master_maesurement");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertMae($txtmaesurement)
	{
		mysqli_query($this->koneksi, "insert into master_maesurement (`maesurename`) values('$txtmaesurement')");
	}
	function updateMae($id, $txtmaesurement)
	{
		mysqli_query($this->koneksi, "update master_maesurement set maesurename='$txtmaesurement'  where id_mae='$id'");
	}

	function DeleteMae($id)
	{
		mysqli_query($this->koneksi, "delete from master_maesurement where id_mae='$id'");
	}



	//Condition

	function viewCon()
	{
		$data = mysqli_query($this->koneksi, "select * from master_condition");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertCon($txtcondition)
	{
		mysqli_query($this->koneksi, "insert into master_condition (`condition_name`)  values('$txtcondition')");
	}
	function updateCon($id, $txtcondition)
	{
		mysqli_query($this->koneksi, "update master_condition set condition_name='$txtcondition'  where id_condition='$id'");
	}

	function DeleteCon($id)
	{
		mysqli_query($this->koneksi, "delete from master_condition where id_condition='$id'");
	}


	//category

	function viewCat()
	{
		$data = mysqli_query($this->koneksi, "select * from master_category");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertCat($txtcategory)
	{
		mysqli_query($this->koneksi, "insert into master_category (`category_name`) values('$txtcategory')");
	}
	function updateCat($id, $txtcategory)
	{
		mysqli_query($this->koneksi, "update master_category set category_name='$txtcategory'  where id_cat='$id'");
	}

	function DeleteCat($id)
	{
		mysqli_query($this->koneksi, "delete from master_category where id_cat='$id'");
	}

	//subcategory

	function viewSubCat()
	{
		$data = mysqli_query($this->koneksi, "select a.id_subcat,a.sub_catname,b.category_name,b.id_cat,c.code_type from master_subcat a left join master_category b on a.id_cat=b.id_cat LEFT JOIN master_type_material c on a.sub_catname=c.type_name");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertSubCat($txtcategory, $txtsubcategory)
	{
		mysqli_query($this->koneksi, "insert into master_subcat (`id_cat`, `sub_catname`) values('$txtcategory','$txtsubcategory')");
	}
	function updateSubCat($id, $txtcategory, $txtsubcategory)
	{
		mysqli_query($this->koneksi, "update master_subcat set sub_catname='$txtsubcategory',id_cat='$txtcategory'  where id_subcat='$id'");
	}

	function deleteSubCat($id)
	{
		mysqli_query($this->koneksi, "delete from master_subcat where id_subcat='$id'");
	}

	//brand

	function viewBrand()
	{
		$data = mysqli_query($this->koneksi, "select a.id_brand,a.brand_name,b.category_name,b.id_cat from master_brand a left join master_category b on a.id_cat=b.id_cat");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertBrand($txtcategory, $txtBrand)
	{
		mysqli_query($this->koneksi, "insert into master_brand (`id_cat`, `brand_name`) values('$txtcategory','$txtBrand')");
	}
	function updateBrand($id, $txtcategory, $txtBrand)
	{
		mysqli_query($this->koneksi, "update master_brand set brand_name='$txtBrand',id_cat='$txtcategory'  where id_brand='$id'");
	}

	function deleteBrand($id)
	{
		mysqli_query($this->koneksi, "delete from master_brand where id_brand='$id'");
	}


	//site

	function viewSite()
	{
		$data = mysqli_query($this->koneksi, "select * from master_site");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertSite($txtSite, $txtcode)
	{
		mysqli_query($this->koneksi, "insert into master_site (`site_name`, `code_site`, `status`) values('$txtSite','$txtcode','0')");
	}
	function updateSite($id, $txtSite, $txtcode)
	{
		mysqli_query($this->koneksi, "update master_site set site_name='$txtSite',code_site='$txtcode'  where id_site='$id'");
	}

	function deleteSite($id)
	{
		mysqli_query($this->koneksi, "delete from master_site where id_site='$id'");
	}

	//Location

	function viewLocation()
	{
		$data = mysqli_query($this->koneksi, "select a.id_location,a.location_name,b.id_site,b.site_name from master_location a left join master_site b on a.id_site=b.id_site ");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertLocation($txtSite, $txtlocation)
	{
		mysqli_query($this->koneksi, "insert into master_location (`id_site`, `location_name`, `status`) values('$txtSite','$txtlocation','0')");
	}
	function updateLocation($id, $txtSite, $txtlocation)
	{
		mysqli_query($this->koneksi, "update master_location set id_site='$txtSite',location_name='$txtlocation'  where id_location='$id'");
	}

	function deleteLocation($id)
	{
		mysqli_query($this->koneksi, "delete from master_location where id_location='$id'");
	}


	//Rack

	function viewRack()
	{
		$data = mysqli_query($this->koneksi, "select a.id_rack,a.id_location,a.rack_name,b.id_location,b.location_name from master_rack a left join master_location b on a.id_location=b.id_location ");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertRack($txtLocation, $txtRack)
	{
		mysqli_query($this->koneksi, "insert into master_rack (`id_location`, `rack_name`, `status`) values('$txtLocation','$txtRack','0')");
	}
	function updateRack($id, $txtLocation, $txtRack)
	{
		mysqli_query($this->koneksi, "update master_rack set id_location='$txtLocation',rack_name='$txtRack'  where id_rack='$id'");
	}

	function deleteRack($id)
	{
		mysqli_query($this->koneksi, "delete from master_rack where id_rack='$id'");
	}


	//Status

	function viewStatus()
	{
		$data = mysqli_query($this->koneksi, "select * from master_status");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertStatus($txtStatus)
	{
		mysqli_query($this->koneksi, "insert into master_status (`status_name`) values('$txtStatus')");
	}
	function updateStatus($id, $txtStatus)
	{
		mysqli_query($this->koneksi, "update master_status set status_name='$txtStatus'  where id_status='$id'");
	}

	function deleteStatus($id)
	{
		mysqli_query($this->koneksi, "delete from master_status where id_status='$id'");
	}


	//Level

	function viewLevel()
	{
		$data = mysqli_query($this->koneksi, "select * from master_level");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function insertLevel($txtLevel, $txtcodLevel2)
	{



		mysqli_query($this->koneksi, "insert into master_level  (`level_name`,`code_level`)  values('$txtLevel','$txtcodLevel2')");
	}


	function updateLevel($id, $txtLevelupdate, $txtcodLevelupdate2)
	{



		mysqli_query($this->koneksi, "update master_level set level_name='$txtLevelupdate',code_level='$txtcodLevelupdate2'  where id_level='$id'");
	}

	function deleteLevel($id)
	{
		mysqli_query($this->koneksi, "delete from master_level where id_level='$id'");
	}

	//Type

	function viewType()
	{
		$data = mysqli_query($this->koneksi, "select * from master_type_material");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertType($txtType)
	{
		mysqli_query($this->koneksi, "insert into master_type_material (`type_name`) values ('$txtType')");
	}
	function updateType($id, $txtType)
	{
		mysqli_query($this->koneksi, "update master_type_material set type_name='$txtType'  where id_type='$id'");
	}

	function deleteType($id)
	{
		mysqli_query($this->koneksi, "delete from master_type_material where id_type='$id'");
	}

	//Manufacture

	function viewManu()
	{
		$data = mysqli_query($this->koneksi, "select * from master_manufacture");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertManu($txtManufacture, $txtManufacturecode)
	{
		mysqli_query($this->koneksi, "insert into master_manufacture values('','$txtManufacture','$txtManufacturecode',1)");
	}
	function updateManu($id, $txtManufacture, $txtManufacturecode)
	{
		mysqli_query($this->koneksi, "update master_manufacture set manufacture_name='$txtManufacture',manufacture_code='$txtManufacturecode'  where id_manu='$id'");
	}

	function deleteManu($id)
	{
		mysqli_query($this->koneksi, "delete from master_manufacture where id_manu='$id'");
	}


	//User

	function viewUser()
	{
		$data = mysqli_query($this->koneksi, "select * from master_user a left join master_level b on a.level=b.id_level left join master_site c on a.site=c.id_site left join master_status d on a.status=d.id_status");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function insertUser($txtFirstname, $txtLastname, $txtEmail, $txtPassword, $txtLevel, $txtSite, $textAddress, $txtPhone, $txtHRcode)
	{


		$pengacak = "AJWKXLAJSCLWLW";
		$passEnkrip = md5($pengacak . md5($txtPassword) . $pengacak);


		if (count($message) == 0) {
			mysqli_query($this->koneksi, "insert into master_user values('','$txtFirstname','$txtLastname','$txtEmail','$passEnkrip','$txtLevel','$txtSite','$textAddress','$txtPhone','$txtHRcode','1','" . date('Y-m-d') . "')");

		}

	}
	function updateUser($id, $txtFirstnameupdate, $txtLastnameupdate, $txtEmailupdate, $txtPassupdate, $txtLevelupdate, $txtSiteupdate, $textAddressupdate, $txtPhoneupdate, $txtHRcodeupdate, $txtstatusupdate)
	{

		if ($txtPassupdate) {


			$pengacak = "AJWKXLAJSCLWLW";
			$passEnkrip = md5($pengacak . md5($txtPassupdate) . $pengacak);

			mysqli_query($this->koneksi, "update master_user set first_name='$txtFirstnameupdate',last_name='$txtLastnameupdate',email='$txtEmailupdate',password='$passEnkrip',level='$txtLevelupdate',site='$txtSiteupdate',address='$textAddressupdate',phone_number='$txtPhoneupdate',hr_code='$txtHRcodeupdate',status='$txtstatusupdate' where id_user='$id'");
		} else {
			mysqli_query($this->koneksi, "update master_user set first_name='$txtFirstnameupdate',last_name='$txtLastnameupdate',email='$txtEmailupdate',level='$txtLevelupdate',site='$txtSiteupdate',address='$textAddressupdate',phone_number='$txtPhoneupdate',hr_code='$txtHRcodeupdate',status='$txtstatusupdate' where id_user='$id'");

		}
	}

	function deleteUser($id)
	{
		mysqli_query($this->koneksi, "delete from master_user where id_user='$id'");
	}



	//Stock

	function viewStock()
	{
		$data = mysqli_query($this->koneksi, "select * from master_material_stock A LEFT JOIN master_category B ON A.category=B.id_cat LEFT JOIN master_subcat C ON A.sub_cat=C.id_subcat LEFT JOIN master_manufacture D");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function viewStockloc($code)
	{
		$data = mysqli_query($this->koneksi, "select a.qty, a.item_code as icode,a.site,a.location,a.rack,b.site_name,c.location_name,d.rack_name from stock_location a   left join master_site b on a.site=b.id_site left join master_location c on a.location=c.id_location left join master_rack d on a.rack=d.id_rack where a.item_code='$code'");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}



	function insertStock($id, $txtSite, $location, $rack, $txtQty, $txtPIC, $txtNotes, $txtPOnumber, $locationPic, $locationDoc)
	{


		if ($rack) {

			$racks = $rack;
		} else {
			$racks = "0";
		}

		mysqli_query($this->koneksi, "insert into stock (`item_code`, `site`, `location`, `rack`, `qty`, `status`) values('$id','$txtSite','$location','$racks','$txtQty','1')");

		//jumlahin total qty di setiap lokasi
		$dataSqlStocklist = mysqli_query($this->koneksi, "select * from stock_location  where site='$txtSite' and location='$location' and item_code='$id'") or die(mysqli_error());

		$qrstock = mysqli_fetch_array($dataSqlStocklist);

		$txtQtystock = $qrstock['qty'];

		$totalstockreceive = $qrstock['qty'] + $txtQty;





		//cek stock location
		$dataSqlStockCheck = "select count(*) as asd from stock_location  where site='$txtSite' and location='$location' and rack='$racks' and item_code='$id'";
		$dataQryStockCheck = mysqli_query($this->koneksi, $dataSqlStockCheck) or die("Gagal Query" . mysqli_error());
		$checkStockCheck = mysqli_fetch_array($dataQryStockCheck);


		if ($checkStockCheck['asd'] == 0) {
			mysqli_query($this->koneksi, "insert into stock_location ( `item_code`, `site`, `location`, `rack`, `qty`, `status`) values('$id','$txtSite','$location','$racks','$txtQty','1')");
			mysqli_query($this->koneksi, "insert into receive_item (`item_code`, `qty`, `old_stock`, `date`, `pic`, `site`, `location`, `rack`, `notes`, `no_po`, `picture`, `document`)  values('$id','$txtQty','0','" . date('Y-m-d') . "','$txtPIC','$txtSite','$location','$racks','$txtNotes','$txtPOnumber','$locationPic','$locationDoc')");


		} else {
			$datastocklocation = "select qty from stock_location  where site='$txtSite' and location='$location' and item_code='$id'";
			$d = mysqli_query($this->koneksi, $datastocklocation) or die("Gagal Query" . mysqli_error());
			$dsa = mysqli_fetch_array($d);

			$ds = $dsa['qty'];

			mysqli_query($this->koneksi, "insert into receive_item (`item_code`, `qty`, `old_stock`, `date`, `pic`, `site`, `location`, `rack`, `notes`, `no_po`, `picture`, `document`)  values('$id','$txtQty','$ds','" . date('Y-m-d') . "','$txtPIC','$txtSite','$location','$racks','$txtNotes','$txtPOnumber','$locationPic','$locationDoc')");
			mysqli_query($this->koneksi, "update stock_location set qty='$totalstockreceive' where item_code='$id' and site='$txtSite' and location='$location' and rack='$racks'");

		}






		mysqli_query($this->koneksi, "insert into history values('','Stock','Receive','Received item Code $id with total QTY $txtQty from Number Purchase Order $txtPOnumber','" . date('Y-m-d') . "','$txtPIC')");






	}



	function updateStock($id, $txtType)
	{
		mysqli_query($this->koneksi, "update master_type_material set type_name='$txtType'  where id_type='$id'");



	}

	function deleteStock($id)
	{
		mysqli_query($this->koneksi, "delete from master_type_material where id_type='$id'");
	}

	//Catalog

	function viewCatalog()
	{
		$data = mysqli_query($this->koneksi, "select * from master_catalog A LEFT JOIN master_category B ON A.category=B.id_cat LEFT JOIN master_subcat C ON A.sub_category=C.id_subcat LEFT JOIN master_manufacture D ON A.manufacture=D.id_manu LEFT JOIN master_brand E ON A.brand=E.id_brand LEFT JOIN  master_maesurement F ON A.maesurement=F.id_mae ");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}

	function viewStocklist()
	{
		$data = mysqli_query($this->koneksi, "SELECT 
    a.item_code,
    SUM(a.qty) AS total_qty,
    b.part_number,
    b.item_name,
    b.specification,
    b.min_stock,
    c.site_name,
    d.location_name,
    e.rack_name,
    f.maesurename 
FROM 
    stock_location a 
LEFT JOIN 
    master_catalog b ON a.item_code = b.item_code 
LEFT JOIN 
    master_site c ON a.site = c.id_site
LEFT JOIN 
    master_location d ON a.location = d.id_location 
LEFT JOIN 
    master_rack e ON a.rack = e.id_rack 
LEFT JOIN  
    master_maesurement f ON b.maesurement = f.id_mae
GROUP BY 
    a.item_code ");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}


	function viewCatalog2()
	{
		$data = mysqli_query($this->koneksi, "select * from master_catalog A LEFT JOIN master_category B ON A.category=B.id_cat LEFT JOIN master_subcat C ON A.sub_category=C.id_subcat LEFT JOIN master_manufacture D ON A.manufacture=D.id_manu LEFT JOIN master_brand E ON A.brand=E.id_brand LEFT JOIN  master_maesurement F ON A.maesurement=F.id_mae order by A.item_code DESC limit 10");
		while ($d = mysqli_fetch_array($data)) {
			$hasil[] = $d;
		}
		return $hasil;
	}
	function insertCatalog($txtCode, $txtpartnumber, $txtitemname, $txtspec, $txtMaesurement,$minstock, $txtmanufacture, $txtbrand, $category, $subcat, $location, $txtRemark)
	{
		if ($txtMaesurement) {
			$txtmae = $txtMaesurement;
		} else {
			$txtmae = '0';
		}
		if ($txtmanufacture) {
			$txtmnf = $txtmanufacture;
		} else {
			$txtmnf = '0';
		}
		if ($txtbrand) {
			$txtbrd = $txtbrand;
		} else {
			$txtbrd = '0';
		}
		if ($category) {
			$txtcat = $category;
		} else {
			$txtcat = '0';
		}
		if ($subcat) {
			$txtsub = $subcat;
		} else {
			$txtsub = '0';
		}

		// Ambil code_type dari master_subcat
		// Ambil code_type dari master_subcat
		$dataInitial = "SELECT b.code_type 
                FROM master_subcat a 
                LEFT JOIN master_type_material b ON a.sub_catname = b.type_name 
                WHERE a.id_subcat = '$subcat'";
		$dataQryInitial = mysqli_query($this->koneksi, $dataInitial) or die("Gagal Query: " . mysqli_error($this->koneksi));
		$dataRowInitial = mysqli_fetch_array($dataQryInitial);

		// Ambil prefix dari code_type (2 karakter)
		$label = $dataRowInitial['code_type'];
		$prefix = substr($label, 0, 2); // Ambil 2 karakter pertama dari label

		// Ambil kode dari master_catalog berdasarkan sub_category dan prefix
		$dataSqlRm = "SELECT SUBSTRING(item_code, 3, 7) AS code 
               FROM master_catalog 
               WHERE sub_category = '$subcat' AND item_code LIKE '$prefix%' 
               ORDER BY code DESC 
               LIMIT 1";
		$dataQryRm = mysqli_query($this->koneksi, $dataSqlRm) or die("Gagal Query: " . mysqli_error($this->koneksi));
		$dataRowRm = mysqli_fetch_array($dataQryRm);

		// Cek apakah ada kode ditemukan
		if (!$dataRowRm) {
			$num = 0; // Jika tidak ada kode sebelumnya, mulai dari 0
		} else {
			// Menghitung nomor selanjutnya
			$num = $dataRowRm['code'] ? intval($dataRowRm['code']) : 0; // Menghindari null
		}

		$numnow = $num + 1; // Menambahkan 1 untuk nomor selanjutnya
		$fzeropadded = sprintf("%06d", $numnow); // Pastikan 6 digit

		// Gabungkan prefix dan angka
		$txtCode = $prefix . $fzeropadded;






		mysqli_query($this->koneksi, "insert into master_catalog (`item_code`, `part_number`, `item_name`, `specification`, `maesurement`, `manufacture`, `brand`, `category`, `sub_category`, `remark`, `date_register`, `picture`, `status`) 
		values ('$txtCode','$txtpartnumber','$txtitemname','$txtspec','$txtmae','$txtmnf','$txtbrd','$txtcat','$txtsub','$txtRemark','" . date('Y-m-d') . "','$location','0')");
	}

	function insertAsset($txtCode, $txtpartnumber, $txtitemname, $txtspec, $txtSN, $txtMaesurement, $txtmanufacture, $txtbrand, $category, $subcat, $location, $txtRemark, $cmbSite, $cmbLoc)
	{
		if ($txtMaesurement) {
			$txtmae = $txtMaesurement;
		} else {
			$txtmae = '0';
		}
		if ($txtmanufacture) {
			$txtmnf = $txtmanufacture;
		} else {
			$txtmnf = '0';
		}
		if ($txtbrand) {
			$txtbrd = $txtbrand;
		} else {
			$txtbrd = '0';
		}
		if ($category) {
			$txtcat = $category;
		} else {
			$txtcat = '0';
		}
		if ($subcat) {
			$txtsub = $subcat;
		} else {
			$txtsub = '0';
		}

		mysqli_query($this->koneksi, "insert into master_asset (`item_code`, `part_number`, `item_name`, `specification`, `serial_number`, `maesurement`, `manufacture`, `brand`, `category`, `sub_category`, `remark`, `date_register`, `picture`, `status`, `site`, `location`) 
		values('$txtCode','$txtpartnumber','$txtitemname','$txtspec','$txtSN','$txtmae','$txtmnf','$txtbrd','$txtcat','$txtsub','$txtRemark','','$location','1','$cmbSite','$cmbLoc')");
	}


	function updateCatalog($id, $txtPartnumbers, $txtItemname, $txtSpecification, $txtbrand, $txtMaesurement,$minstock, $txtRemark)
	{




		mysqli_query($this->koneksi, "update master_catalog set item_name='$txtItemname',part_number='$txtPartnumbers',specification='$txtSpecification',brand='$txtbrand',maesurement='$txtMaesurement',remark='$txtRemark',min_stock='$minstock'  where item_code='$id'");
	
	   
	}


	function updateCatalogpic($id, $txtPartnumbers, $txtItemname, $txtSpecification, $txtbrand, $txtMaesurement,$minstock, $txtRemark, $location)
	{


		mysqli_query($this->koneksi, "update master_catalog set item_name='$txtItemname',part_number='$txtPartnumbers',specification='$txtSpecification',brand='$txtbrand',maesurement='$txtMaesurement',remark='$txtRemark',picture='$location',min_stock='$minstock'  where item_code='$id'");
	}

	function updateCatalogs($id, $txtPartnumber, $txtItemname, $txtSpecification, $txtRemark)
	{


		mysqli_query($this->koneksi, "update master_catalog set item_name='$txtItemname',part_number='$txtPartnumber',specification='$txtSpecification',remark='$txtRemark',min_stock='$minstock'   where item_code='$id'");
	}

	function deleteCatalog($id, $pic)
	{

		@unlink($pic);

		mysqli_query($this->koneksi, "delete from master_catalog where item_code='$id'");
	}
	function deleteCatalogs($id)
	{
		mysqli_query($this->koneksi, "delete from master_catalog where item_code='$id'");
	}
}





?>