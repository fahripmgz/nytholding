<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering
ob_start();

// Include the TCPDF library
require_once('../tcpdf/tcpdf.php'); // Adjust the path if necessary
include_once "../model/config.php";

$order_number = isset($_GET['code']) ? mysqli_real_escape_string($conn, $_GET['code']) : '';

// Function to get items
function getItems($order_number) {
    global $conn; // Use the global connection
    $items = [];

    $query = mysqli_query($conn, "SELECT a.id, a.item_code, a.status, a.qty, a.notes, b.item_name, b.spec, b.maesurename,c.project_name FROM item_request a 
                LEFT JOIN view_catalog b ON a.item_code = b.item_code
                LEFT JOIN master_project c ON a.project=c.id
                
                WHERE a.order_number='$order_number' ORDER BY a.id DESC;");
    
    if (!$query) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        $items[] = $row;
    }

    return $items;
}

// Fetch items based on a specific gr_number
$items = getItems($order_number);

// Create new PDF document in landscape mode
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false); // Correctly specify units and format

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PT. Sarana Gastekindo Utama');
$pdf->SetTitle('Order Report');
$pdf->SetSubject('Report');
$pdf->SetKeywords('TCPDF, PDF, report, item received');

// Set default header and footer data
$pdf->SetHeaderData('', 0, 'Item Order Report', "Order Number: $order_number");
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
           Order Report
        </td>
    </tr>
</table>';

// Output the logo and header HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Add space below the header
$pdf->Ln(5); // Add a line break (5 mm or adjust as necessary)

// Fetch additional details (assuming you have them)
$xm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT a.`id`, a.`order_number`, a.`document_number`,a.department, a.pic,a.`notes`,a.approval_1,a. `create_date`, a.`create_by`, a.`status` ,b.department_name,c.pic_name,d.pic_name AS approval1,d.pic_name AS approval2,f.status_name FROM `order_list` a LEFT JOIN department b on a.department=b.id
LEFT JOIN master_pic c on a.pic=c.id
LEFT JOIN master_pic d on a.approval_1=d.id
LEFT JOIN master_pic e on a.approval_2=d.id
LEFT JOIN master_status_gr f on a.status=f.id
WHERE a.order_number='$order_number'")); // Adjust your query accordingly

// Create header HTML content
$headerHtml = '
<table cellspacing="0" cellpadding="2">
    <tr>
        <td width="50%">
        
            <span style="font-family: Helvetica; font-weight: bold;">Order Number : </span> ' . htmlspecialchars($xm['order_number']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Document Number : </span> ' . htmlspecialchars($xm['document_number']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Department : </span> ' . htmlspecialchars($xm['department_name']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">PIC : </span> ' . htmlspecialchars($xm['pic_name']) . '<br>
           
        </td>
        <td width="50%">
            <span style="font-family: Helvetica; font-weight: bold;">Order By : </span> ' . htmlspecialchars($xm['create_by']) . '<br>
            <span style="font-family: Helvetica; font-weight: bold;">Create Date : </span> ' . htmlspecialchars($xm['create_date']) . '<br>
             <span style="font-family: Helvetica; font-weight: bold;">Approval : </span> <br>
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
            <th style="width: 7%;"><b align="center">QTY</b></th>
            <th style="width: 10%;"><b align="center">Measurement</b></th>
             <th style="width: 10%;"><b align="center">Project/Use For</b></th>
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
                <td style="width: 7%;" align="center">' . htmlspecialchars($item['qty']) . '</td>
                <td style="width: 10%;" align="center">' . htmlspecialchars($item['maesurename']) . '</td>
                <td style="width: 10%;" align="center">' . htmlspecialchars($item['project_name']) . '</td>
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
