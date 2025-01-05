<?php
// Debugging: Output current directory and check if the file exists
echo "Current working directory: " . getcwd() . "\n";
echo "Checking if WebClientPrint.php exists: " . (file_exists('WebClientPrint/WebClientPrint.php') ? 'Yes' : 'No') . "\n";

require_once 'WebClientPrint/WebClientPrint.php'; // Adjust the path if necessary

// Check if the class exists
if (!class_exists('WebClientPrint')) {
    die("WebClientPrint class not found. Please check your installation.");
}

// Your code to fetch and return printers
$printers = [
    ['name' => 'Printer 1'],
    ['name' => 'Printer 2'],
    ['name' => 'Printer 3']
];

header('Content-Type: application/json');
echo json_encode($printers);
?>