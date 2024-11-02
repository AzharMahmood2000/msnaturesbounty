<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password
    $id_number = $_POST['id_number'];
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("INSERT INTO create_account (name, email, password, id_number, phone) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssss", $name, $email, $password, $id_number, $phone);

        if ($stmt->execute()) {
            echo "Account created successfully!";
            header("Location: login.html"); // Redirect to login page
            exit();
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
