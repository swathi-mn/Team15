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
		$role = clean($_POST['role']);
		$phone = clean($_POST['phone']); 
		$address = clean($_POST['address']); 
		
		// Encryption
		$pass = sha1($password);
		if($role == 'e')
		{
			$r = 4;
		}
		else if($role == 'r')
		{
			$r = 3;
		}
		
	
		$query = "INSERT INTO user_info(emailid, first_name, last_name, dob, gender, password, address, phone) VALUES ('$email','$firstname','$lastname','$dob','$gender','$pass', '$address','$phone')";
		$state = mysql_query($query);
		
		$q = "INSERT INTO user_role(emailid, role_value) VALUES ('$email', '$r')";
		mysql_query($q);
	
		if($state)
		{
			$response = 'no_error';
			$_SESSION['emailid'] = $email;
		}
		else
		{
			$response = 'error';
		}
		echo $response;
?>
