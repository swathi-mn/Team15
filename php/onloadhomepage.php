<?php
	session_start();
	require_once 'connection.php';
    $user = $_SESSION["username"];
    
    $sql="SELECT first_name,last_name,linktodp FROM user WHERE username='$user'";
    $result=mysql_query($sql);  
    $js_array = array();   
    while($row = mysql_fetch_array($result)){   
		$f = @$row["first_name"];  
		$l = @$row["last_name"];
		$link = @$row["linktodp"];
		$data = array( 
		'firstname' => ucfirst($f),
		'lastname' => ucfirst($l),
		'linktodp' => $link,    
		); 
	array_push($js_array, $data); 
	} 
	
	$encodedData = json_encode($js_array);
	echo $encodedData;
?>