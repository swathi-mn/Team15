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
	
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$role = clean($_POST['role']);
	
	// Decryption
	$pass = sha1($password);
	
	$check = mysql_query("SELECT * FROM user_info WHERE emailid = '$email' AND password = '$pass'");
	$num = mysql_num_rows($check);
	
	$c = mysql_query("SELECT * FROM roles WHERE role_name = '$role'");
	$r = mysql_fetch_array($c);
	$v = $r['role_value'];
	
	
	// Error in either email id or password
	if($num === 0)
	{
		$response = 'error';
	}
	else
	{
		$q = "SELECT * FROM user_role WHERE emailid = '$email'";
		$result = mysql_query($q);            
		while($row = mysql_fetch_array($result))
		{  
			$value = $row['role_value']; 
			if($value == $v)
			{
				// Setting up a session variable.
				$_SESSION['emailid'] = $email;
				$response = 'no_error';
			}
			else
			{			
				$response = 'error';
			}
		}
	}
	echo $response;
?>