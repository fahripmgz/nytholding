<?php
include_once "../../model/config.php"; // Adjust the path if necessary

if (isset($_POST['item_code'])) {
    $item_code = mysqli_real_escape_string($conn, $_POST['item_code']);
    
    $query = "SELECT maesurename FROM view_catalog WHERE item_code = '$item_code'";
    $result = mysqli_query($conn, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        echo htmlspecialchars($row['maesurename']); // Output the measurement
    } else {
        echo "No measurement found"; // Message if no measurement exists
    }
}
?>
