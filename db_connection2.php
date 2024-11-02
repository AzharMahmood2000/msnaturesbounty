<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "veg_shop";

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: message for successful connection (useful for debugging)
    echo "Connected successfully";
} catch (PDOException $e) {
    // Show error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
?>  
