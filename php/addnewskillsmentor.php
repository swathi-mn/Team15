<?php
	require_once 'connection.php';
	session_start();
	$email = $_SESSION['emailid'];
	$skill = $_POST['skill'];
	$result = mysql_query("SELECT * FROM mentor_skills WHERE emailid = '$email'");
	$row = mysql_fetch_array($result);
	if($row['skill']===NULL)
		$skill += $row['skills'];
	else
		$skill = $row['skills'];
	$q = "INSERT INTO mentor_skills(emailid, skill) VALUES ('$email', '$skill')";
	mysql_query($q);
?>