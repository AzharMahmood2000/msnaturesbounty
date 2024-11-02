<?php
session_start();

if (!isset($_SESSION["order_details"])) {
    header("Location: home.html");
    exit();
}
$order_details = $_SESSION["order_details"];
$fullname = htmlspecialchars($order_details['fullname']);
$address = htmlspecialchars($order_details['address']);
$city = htmlspecialchars($order_details['city']);
$state = htmlspecialchars($order_details['state']);
$zipcode = htmlspecialchars($order_details['zipcode']);
$phone = htmlspecialchars($order_details['phone']);
$payment = htmlspecialchars($order_details['payment']);
$quantity = htmlspecialchars($order_details['quantity']);
$total = htmlspecialchars($order_details['total']);

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional: Link to your CSS file -->
</head>
<body>
    <div class="thank-you-container">
        <h1>Thank You for Your Order!</h1>
        <p>Dear <?php echo $fullname; ?>,</p>
        <p>Your order has been successfully placed.</p>

        <h3>Order Summary</h3>
        <ul>
            <li><strong>Full Name:</strong> <?php echo $fullname; ?></li>
            <li><strong>Address:</strong> <?php echo $address; ?></li>
            <li><strong>City:</strong> <?php echo $city; ?></li>
            <li><strong>State:</strong> <?php echo $state; ?></li>
            <li><strong>Zip Code:</strong> <?php echo $zipcode; ?></li>
            <li><strong>Phone Number:</strong> <?php echo $phone; ?></li>
            <li><strong>Payment Method:</strong> <?php echo $payment; ?></li>
            <li><strong>Item Quantity:</strong> <?php echo $quantity; ?></li>
            <li><strong>Total Amount:</strong> $<?php echo $total; ?></li>
        </ul>

        <p>Thank you for supporting us! We will process your order and get back to you soon.</p>

        <a href="home.html" class="btn">Back to Home</a>
    </div>
</body>
</html>
