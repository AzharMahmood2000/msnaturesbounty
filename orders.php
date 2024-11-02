<?php
include 'db_connection1.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting data from the POST request
    $fullname = $_POST['fullname'] ?? null;
    $address = $_POST['address'] ?? null;
    $city = $_POST['city'] ?? null;
    $state = $_POST['state'] ?? null;
    $zipcode = $_POST['zipcode'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $payment = $_POST['payment'] ?? null;
    $quantity = $_POST['quantity'] ?? null;
    $total = $_POST['total'] ?? null;

    if (!$fullname || !$address || !$city || !$state || !$zipcode || !$phone || !$payment || !$quantity || $total === null) {
        die("All fields are required.");
    }

    $stmt = $conn->prepare("INSERT INTO orders (fullname, address, city, state, zipcode, phone, payment, quantity, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssssss", $fullname, $address, $city, $state, $zipcode, $phone, $payment, $quantity, $total);

        if ($stmt->execute()) {
            echo "Order placed successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
