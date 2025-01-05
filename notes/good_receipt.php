<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

// Include the TCPDF library
require_once('../tcpdf/tcpdf.php'); // Adjust the path if necessary
include_once "../model/config.php";

$gr_number = isset($_GET['gr_number']) ? mysqli_real_escape_string($conn, $_GET['gr_number']) : '';

// Function to get items
function getItems($gr_number) {
    global $conn; // Use the global connection
    $items = [];

    $query = mysqli_query($conn, "SELECT a.id, a.item_code,a.qty_do,a.qty_receipt,a.notes, b.item_name,b.spec,b.maesurename, a.create_date, a.create_by FROM item_received a LEFT JOIN view_catalog b ON a.item_code = b.item_code WHERE a.gr_number= '$gr_number'");
    
    if (!$query) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $items[] = $row;
    }

    return $items;
}

// Fetch items based on a specific gr_number
$items = getItems($gr_number);

// Create new PDF document in landscape mode
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false); // Correctly specify units and format

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PT. Sarana Gastekindo Utama');
$pdf->SetTitle('Item Received Report');
$pdf->SetSubject('Report');
$pdf->SetKeywords('TCPDF, PDF, report, item received');

// Set default header and footer data
$pdf->SetHeaderData('', 0, 'Item Received Report', "GR Number: $gr_number");
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Create a table for the logo and header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 12, '', 0, 1, 'C'); // Create an empty cell for spacing

// Start the table
$html = '
<table style="width: 100%;">
    <tr>
        <td style="width: 10%; vertical-align: middle; text-align: left;">
            <img src="../images/sgu_logo.jpg" width="80" /> <!-- Update the path to your logo -->
        </td>
        <td style="width: 80%; vertical-align: middle; text-align: left;">
           Goods Receipt Report
        </td>
    </tr>
</table>';

// Output the logo and header HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Add space below the header
$pdf->Ln(5); // Add a line break (5 mm or adjust as necessary)

// Fetch additional details (assuming you have them)
$xm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT a.id, a.receipt_number,a.status, a.delivery_number, a.document_number, a.notes, a.receipt_date, a.receipt_by, b.type_name, c.site_name, d.status_name,e.vendor_name FROM good_receipt a LEFT JOIN receipt_type b ON a.receipt_type = b.id LEFT JOIN master_site c ON a.receipt_at = c.id_site LEFT JOIN master_status_gr d ON a.status = d.id LEFT JOIN master_vendor e on a.vendor=e.id_vendor WHERE a.receipt_number = '$gr_number'")); // Adjust your query accordingly

// Create header HTML content
$headerHtml = '
<table cellspacing="0" cellpadding="2">
    <tr>
        <td width="50%">
            <span style="font-family: Helvetica; font-weight: bold;">Receipt Number : </span> ' . htmlspecialchars($xm['receipt_number']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Delivery Number : </span> ' . htmlspecialchars($xm['delivery_number']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Receipt Type : </span> ' . htmlspecialchars($xm['type_name']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Document Number : </span> ' . htmlspecialchars($xm['document_number']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Vendor Name : </span> ' . htmlspecialchars($xm['vendor_name']) . '<br>
        </td>
        <td width="50%">
            <span style="font-family: Helvetica; font-weight: bold;">Receipt At : </span> ' . htmlspecialchars($xm['site_name']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Receipt By : </span> ' . htmlspecialchars($xm['receipt_by']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Date : </span> ' . htmlspecialchars($xm['receipt_date']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Notes : </span> ' . htmlspecialchars($xm['notes']) . '<br>
        </td>
    </tr>
</table><br>';

// Output the header HTML content with a different font size/style
$pdf->SetFont('helvetica', '', 10); // Set font for the header details
$pdf->writeHTML($headerHtml, true, false, true, false, '');

// Set font for table
$pdf->SetFont('helvetica', '', 9);

// Create table HTML content
$html = '<h2>Item Received Report</h2>
<table border="1" cellspacing="0" cellpadding="4">
    <thead>
        <tr>
            <th style="width: 3%;"><b align="center">No</b></th>
            <th style="width: 10%;"><b align="center">Item Code</b></th>
            <th style="width: 25%;"><b align="center">Item Name</b></th>
            <th style="width: 25%;"><b align="center">Specification</b></th>
            <th style="width: 8%;"><b align="center">QTY D.O.</b></th>
            <th style="width: 9%;"><b align="center">QTY Receipt</b></th>
            <th style="width: 10%;"><b align="center">Measurement</b></th>
            <th style="width: 10%;"><b align="center">Notes</b></th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
foreach ($items as $item) {
    $html .= '<tr>
                <td style="width: 3%;" align="center">' . $no++ . '</td>
                <td style="width: 10%;" align="center">' . htmlspecialchars($item['item_code']) . '</td>
                <td style="width: 25%;">' . htmlspecialchars($item['item_name']) . '</td>
                <td style="width: 25%;">' . htmlspecialchars($item['spec']) . '</td>
                <td style="width: 8%;" align="center">' . htmlspecialchars($item['qty_do']) . '</td>
                <td style="width: 9%;" align="center">' . htmlspecialchars($item['qty_receipt']) . '</td>
                <td style="width: 10%;" align="center">' . htmlspecialchars($item['maesurename']) . '</td>
                <td style="width: 10%;">' . htmlspecialchars($item['notes']) . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Output the table HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Add Assigned By section
$assignedByHtml = '
<div style="text-align: right; margin-top: 10px;">
    <span style="font-family: Helvetica; font-weight: bold;">Signed by By:</span> ' . htmlspecialchars($xm['create_by']) . ' <!-- Adjust this line based on your data -->
</div>';

// Output the Assigned By HTML content
$pdf->writeHTML($assignedByHtml, true, false, true, false, '');

// Clean the output buffer and send the PDF
ob_end_clean();
$pdf->Output('item_received_report.pdf', 'I');
?>
