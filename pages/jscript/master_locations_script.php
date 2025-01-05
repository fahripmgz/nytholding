<?php
include_once '../../model/config.php';

$query = "SELECT id_location, location_name FROM master_location";
$result = mysqli_query($conn, $query);

$locations = [];
while ($location = mysqli_fetch_assoc($result)) {
    $locations[] = $location;
}

echo json_encode($locations);
?>
