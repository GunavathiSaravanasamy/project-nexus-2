<?php
session_start();
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$_SESSION = array();

session_destroy();

header("Location: login.php");
exit();
?>
