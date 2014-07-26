<?php
session_start();
require_once 'connection.php';
$pass = $_POST['confirmpassword'];
$user = $_SESSION['username'];
$query = "UPDATE user SET password = (sha1('$pass')) WHERE username = '$user'";
mysql_query($query);
?>
