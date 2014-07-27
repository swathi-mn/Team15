<?php
	require_once 'connection.php';
	session_start();
	$email = $_SESSION['emailid'];
	$skill = $_POST['skill'];
	$q = "INSERT INTO mentee_skill(emailid, skill) VALUES ('$email', '$skill')";
	mysql_query($q);
?>