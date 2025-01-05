<?php
// No spaces or new lines before this line

// Database connection settings
$servername = "localhost";
$username = "root"; // Change to your actual username
$password = ""; // Change to your actual password
$database = "coresystems"; // Change to your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
