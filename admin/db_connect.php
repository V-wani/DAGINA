<?php
$servername = "localhost";
$username = "root";
$password = "kaliparrot";
$dbname = "jewellery_db"; // Change this to your actual DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>