<?php
	session_start();
    require_once 'connection.php';
    $privacy = $_POST['privacy'];
	$desc = $_POST['description'];
    $user = $_SESSION['username'];
    $value;
    if($privacy==='true')
        $value = 1;
    else if($privacy==='false')
        $value = 0;
    $query = "INSERT INTO upload(username, description, privacy) VALUES('$user','$desc','$value')";
    mysql_query($query);
?>