<?php
include_once '../../model/config.php';
if (isset($_POST['itemcode'])) {
    $itemcode = mysqli_real_escape_string($conn, $_POST['itemcode']);
    $query = "SELECT a.rack,a.qty, b.rack_name,c.location_name FROM stock_location a 
              LEFT JOIN master_rack b ON a.rack = b.id_rack  LEFT JOIN master_location c on a.location=c.id_location
              WHERE a.item_code = '$itemcode'";
    $result = mysqli_query($conn, $query);

    $locations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $locations[] = $row;
    }

    echo json_encode($locations);
}
?>
