<?php
	session_start();
    require_once 'connection.php';
    $user = $_SESSION['username'];
    $first = $_POST['firstname'];
    $query = "UPDATE user SET first_name = '$first' WHERE username='$user'";
    mysql_query($query);
?>
