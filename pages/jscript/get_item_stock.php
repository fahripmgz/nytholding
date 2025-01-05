<?php
include_once "../../model/config.php"; // Adjust the path if necessary

if (isset($_POST['item_code'])) {
    $item_code = mysqli_real_escape_string($conn, $_POST['item_code']);

    // Query to get the total stock from the stock_location table
    $queryTotalStock = "
        SELECT SUM(qty) AS total 
        FROM stock_location 
        WHERE item_code = '$item_code' 
        GROUP BY item_code";
    $resultTotalStock = mysqli_query($conn, $queryTotalStock);
    $rowTotalStock = mysqli_fetch_assoc($resultTotalStock);
    $totalStock = $rowTotalStock['total'] ?? 0;

    // Query to get the used stock from the good_issue_items table
    $queryUsedStock = "
        SELECT SUM(qty) AS used 
        FROM good_issue_items 
        WHERE item_code = '$item_code' AND status = '0'
        GROUP BY item_code";
    $resultUsedStock = mysqli_query($conn, $queryUsedStock);
    $rowUsedStock = mysqli_fetch_assoc($resultUsedStock);
    $usedStock = $rowUsedStock['used'] ?? 0;

    // Calculate remaining stock
    $remainingStock = $totalStock - $usedStock;

    // If the remaining stock is negative (for error handling), set it to 0
    if ($remainingStock < 0) {
        $remainingStock = 0;
    }

    // Output the remaining stock formatted to 2 decimal places
    echo number_format($remainingStock, 2, '.', ''); // Ensures it displays as a decimal number
}
?>
