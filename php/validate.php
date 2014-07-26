<?php
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
	
	$username = clean($_POST['username']);
	$check = mysql_query("SELECT * FROM user WHERE username = '$username'");
	$num = mysql_num_rows($check);
	
	// Username available
	if($num === 0)
	{
		$response = 'valid';
	}
	else
	{
		$response = 'invalid';
	}
	echo $response;
?>