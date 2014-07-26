<?php
    session_start();
    require_once 'connection.php';
    $user = $_SESSION['username'];
    $last = $_POST['lastname'];
    $query = "UPDATE user SET last_name = '$last' WHERE username='$user'";
    mysql_query($query);
?>
