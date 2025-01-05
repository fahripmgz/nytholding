<?php
ob_start();
session_start();
require_once('WebClientPrint.php'); // Memastikan file WebClientPrint.php dari SDK Neodynamic sudah dimuat
use Neodynamic\SDK\Web\WebClientPrint;
use Neodynamic\SDK\Web\Utils;

if (isset($_GET['code'])) {
    $item_code = $_GET['code'];

    // Format ZPL untuk barcode (sesuaikan dengan jenis printer)
    $barcodeCmds = "^XA^FO100,100^BY2^BCN,100,Y,N,N^FD" . $item_code . "^FS^XZ"; 

    // Membuat PrintJob untuk ZPL
    $printJob = new WebClientPrint\PrintJob();
    $printJob->printerCommands = $barcodeCmds;
    $printJob->format = WebClientPrint\PrintJobFormat::ZPL;
    $printJob->clientPrintJobID = uniqid();

    // Kirim perintah print ke client
    WebClientPrint\WebClientPrint::sendToClient($printJob);
}
?>
