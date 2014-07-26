<?php
	session_start();
	require_once 'connection.php';
	$user = $_SESSION['username'];
	$tag = $_POST['tags'];
	$query = "SELECT MAX(uploadid) as uploadid
			  FROM upload
			  WHERE username = '$user'";
	$uid = mysql_query($query);
	while($row=mysql_fetch_assoc($uid))
	{   
		$uploadid = $row["uploadid"];
	}
	$hash = explode(", ", $tag);
	foreach ($hash as $value)
	{
		$qry = "INSERT INTO tag VALUES('$uploadid','$value')";
		mysql_query($qry);
	}
?>