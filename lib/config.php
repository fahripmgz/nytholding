<?php
// Konfigurasi database
define("BASE_FOLDER", "coresystems");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "coresystems");

// URL dasar
$base_url = "/" . BASE_FOLDER;

// Koneksi ke database
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Periksa koneksi
if (!$con) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Path folder upload
$path_folder = $_SERVER['DOCUMENT_ROOT'] . "/" . BASE_FOLDER . "/uploads/";

// Pesan sukses koneksi
echo "Koneksi berhasil ke database: " . DB_NAME;
?>
