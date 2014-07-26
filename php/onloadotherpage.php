<?php
	session_start();
	require_once 'connection.php';
    $other = $_POST['other'];
    $sql = "SELECT first_name,last_name,linktodp, linktocover, email, dob FROM user WHERE username='$other'";
    $result=mysql_query($sql);  
	$q = "SELECT * FROM upload WHERE username = '$other' AND privacy = 0";
	$num = mysql_num_rows(mysql_query($q));
    $js_array = array();   
    while($row = mysql_fetch_array($result)){   
		$f = @$row["first_name"];  
		$l = @$row["last_name"];
		$link = @$row["linktodp"];
		$cover = @$row["linktocover"];
		$dob = @$row["dob"];
		$email = @$row["email"];
		$data = array( 
		'firstname' => ucfirst($f),
		'lastname' => ucfirst($l),
		'linktodp' => $link, 
		'linktocover' => $cover, 
		'mail' => $email, 
		'bday' => $dob, 
		'number' => $num 
		); 
	array_push($js_array, $data); 
	} 
	
	$encodedData = json_encode($js_array);
	echo $encodedData;
?>