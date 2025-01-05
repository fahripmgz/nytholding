<?php
include_once '../../model/config.php';

if (isset($_POST['itemcode'])) {
    $itemCode = mysqli_real_escape_string($conn, $_POST['itemcode']);
    
    $query = "SELECT total_qty FROM put_away WHERE item_code = '$itemCode'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['total_qty' => (int)$row['total_qty']]);
    } else {
        echo json_encode(['total_qty' => 0]); // No item found
    }
} else {
    echo json_encode(['total_qty' => 0]); // Handle case where no item code is provided
}

?>