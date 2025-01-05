<?php
include_once '../../model/config.php';
if (isset($_POST['itemcode'])) {
    $itemcode = mysqli_real_escape_string($conn, $_POST['itemcode']);
    $query = "SELECT a.item_code,b.item_name,a.total_qty,b.spec,b.maesurename FROM put_away a left join view_catalog b on a.item_code=b.item_code WHERE a.item_code = '$itemcode'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $itemDetails = mysqli_fetch_assoc($result);
        echo json_encode($itemDetails);
    } else {
        echo json_encode(null);
    }
}
?>
