<?php
// Include the database connection file
include 'db_connection.php';

session_start(); // Start a session to store user info after login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to retrieve user info based on email
    $stmt = $conn->prepare("SELECT id, name, password FROM create_account WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with this email exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $user_name, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Store user info in session variables and redirect to home page
                $_SESSION["user_id"] = $user_id;
                $_SESSION["user_name"] = $user_name;
                header("Location: home.html"); // Redirect to home page
                exit();
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "No account found with this email.";
        }

        $stmt->close();
    } else {
        $error_message = "Error in preparing statement: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php if (isset($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>
    <form action="login.php" method="POST">
    </form>
</body>
</html>
