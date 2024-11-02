<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (empty($name) || empty($email) || empty($mobile) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    $sql = "INSERT INTO contacts (name, email, mobile, message) VALUES (:name, :email, :mobile, :message)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

        echo "Thank you! Your message has been sent successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
