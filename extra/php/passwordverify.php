<?php
    session_start();
	require_once 'connection.php';
    $pass = $_POST['password'];
    $user = $_SESSION['username'];
    $query = "SELECT * from user WHERE password = sha1('$pass') AND username='$user'";
    $number = mysql_num_rows(mysql_query($query));
    if($number!=1)
    {
        $response = 'false';
		echo $response;
    }
?>
