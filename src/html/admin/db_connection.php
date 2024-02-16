<?php
// Database configuration
$servername = "localhost"; // XAMPP uses localhost as the database server hostname
$username = "root"; // Default username for XAMPP's MySQL is root
$password = ""; // Default password is empty for XAMPP
$dbname = "liabilitymanager"; // Change this to your database name if different

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
