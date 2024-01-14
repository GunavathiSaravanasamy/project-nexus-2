<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


 
// Include database connection and validation functions
 require('connection.php'); // Include your database connection script
 require('validate_functions.php'); // Include your validation functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize user input (similar to registration process)

    // Check user credentials in the database
    $stmt = $conn->prepare("SELECT `id`, `fullname`, `password` FROM `users` WHERE `email` = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $fullName, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $fullName;

        header("Location: dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password";
    }

    $stmt->close();
}

$conn->close();
include('login.php');
?>
