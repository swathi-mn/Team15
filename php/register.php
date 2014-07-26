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

		$firstname = clean($_POST['firstname']);
		$lastname = clean($_POST['lastname']);
		$email = clean($_POST['email']);
		$password = clean($_POST['password']);
		$dob = clean($_POST['dob']);
		$gender = clean($_POST['gender']);
		$role = clean($_POST['pin']);
		$phone = clean($_POST['phone']); 
		

		// Encryption
		$pass = sha1($password);
	
		$query = "INSERT INTO user_info(emailid, first_name, last_name, dob, gender, password, pincode) VALUES ('$email','$firstname','$lastname','$dob','$gender','$pass', $pin)";
		$state = mysql_query($query);
	
		if($state)
		{
			$response = 'no_error';
			// Setting up a session variable.
			$_SESSION['username'] = $username;
		}
		else
		{
			$response = 'error';
		}
		echo $response;
?>
