<?php
require('connection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


$fullNameErr = $emailErr = $passwordErr = $confirmPasswordErr = $mobileNumberErr = "";
$fullName = $email = $password = $confirmPassword = $mobileNumber = $addr = "";

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullNameErr = $emailErr = $dobErr = $passwordErr = $confirmPasswordErr = $mobileNumberErr = "";

    $fullName = empty($_POST["fullname"]) ? "" : sanitizeInput($_POST["fullname"]);
    $email = empty($_POST["email"]) ? "" : sanitizeInput($_POST["email"]);
    $password = empty($_POST["password"]) ? "" : sanitizeInput($_POST["password"]);
    $confirmPassword = empty($_POST["confirmPassword"]) ? "" : sanitizeInput($_POST["confirmPassword"]);
    $mobileNumber = empty($_POST["mobileNumber"]) ? "" : sanitizeInput($_POST["mobileNumber"]);
    $addr = empty($_POST["addr"]) ? "" : sanitizeInput($_POST["addr"]);

    if (empty($fullName)) {
        $fullNameErr = "Name is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }


    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (empty($confirmPassword)) {
        $confirmPasswordErr = "Confirm Password is required";
    } elseif ($confirmPassword !== $password) {
        $confirmPasswordErr = "Passwords do not match";
    }

    if (empty($mobileNumber)) {
        $mobileNumberErr = "Mobile Number is required";
    } elseif (!validateMobileNumber($mobileNumber)) {
        $mobileNumberErr = "Invalid mobile number format";
    }
}

if (empty($fullNameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($mobileNumberErr)) {
  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO  `users` (`fullname`, `email`,`password`, `mobileNumber`, `addr`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fullName, $email, $hashedPassword, $mobileNumber, $addr);

    if ($stmt->execute()) {
        header("Location:img/success.php/");
        exit(); 
       } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

function validateMobileNumber($mobileNumber) {
    $cleanedNumber = preg_replace('/[^0-9]/', '', $mobileNumber);
    return (strlen($cleanedNumber) === 10);
}
?>
