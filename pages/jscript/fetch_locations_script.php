<?php
include_once '../../model/config.php';

if (isset($_POST["itemcode"])) {
    $item_code = $_POST["itemcode"];
    
    $query = "SELECT a.item_code,b.id_location,b.location_name FROM stock_location a left join master_location b on a. location=b.id_location WHERE a.item_code=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $item_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $locations = [];
    while ($location = $result->fetch_assoc()) {
        $locations[] = $location;
    }
    
    echo json_encode($locations);
}
?>
