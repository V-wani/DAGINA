<?php
// Enable strict error reporting (optional but helpful)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database configuration
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "jewellery_db";
$DB_PORT = 3307;

try {
    // Create database connection
    $conn = new mysqli(
        $DB_HOST,
        $DB_USER,
        $DB_PASS,
        $DB_NAME,
        $DB_PORT
    );

    // Set charset (important for products, prices, symbols)
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Stop execution if connection fails
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
