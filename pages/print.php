<?php
require_once 'WebClientPrint/WebClientPrint.php'; // Include the WebClientPrint SDK

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the item codes and printer name from the POST request
    $itemCodes = isset($_POST['item_codes']) ? $_POST['item_codes'] : [];
    $printerName = isset($_POST['printer_name']) ? $_POST['printer_name'] : '';

    // Check if item codes and printer name are provided
    if (!empty($itemCodes) && !empty($printerName)) {
        // Loop through each item code and send a print job
        foreach ($itemCodes as $itemCode) {
            // Create the content for the label
            $labelContent = "Item Code: " . $itemCode . "\n"; // Customize as needed

            // Create a new print job
            $printJob = new WebClientPrint\PrintJob();
            $printJob->setPrinter($printerName); // Set the printer
            $printJob->addRawData($labelContent); // Add label content

            // Send the print job
            try {
                $result = WebClientPrint::send($printJob);
                if ($result === true) {
                    echo "Print job for $itemCode sent successfully.";
                } else {
                    echo "Failed to send print job for $itemCode.";
                }
            } catch (Exception $e) {
                echo "Error sending print job: " . $e->getMessage();
            }
        }
    } else {
        echo "No item codes or printer name provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
