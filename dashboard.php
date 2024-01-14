<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Dashboard</title>
</head>
<style>

    p{
        padding :10px 15px;
        background-color: antiquewhite;
        color:purple;
        font-size: 14px;
        display: block;
    }
   .divcenter a{
        color: rgb(255, 255, 255);
        background-color: rgba(224, 242, 88, 0.6);
        font-size: 13px;
        text-align: center;
        border: none;
        padding: 10px 15px;
        font-weight: 600;
        display: block;
    }
</style>
<body>
    <div class="heading">
        <h3>Welcome <?php echo $userName?> !</h3>
    </div>
    <div class="divcenter">
        <p>This is your dashboard, Make your day special by ordering our food</p><br>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
