<?php
	session_start();
	require_once 'connection.php';
	
	// Prevent SQL Injection.
	function clean($str) 
    {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
        {
			$str = stripslashes($str);
        }
		return mysql_real_escape_string($str);
	}
	
	$username = clean($_POST['emailid']);
	$password = clean($_POST['password']);
	
	// Decryption
	$pass = sha1($password);
	
	$check = mysql_query("SELECT * FROM user WHERE emailid = '$username' AND password = '$pass'");
	$num = mysql_num_rows($check);
	
	// Error in either username or password
	if($num === 0)
	{
		$response = 'error';
	}
	else
	{
		// Setting up a session variable.
		$_SESSION['username'] = $username;
		$response = 'no_error';
	}
	echo $response;
?>