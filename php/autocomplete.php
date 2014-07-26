<?php
	require_once 'connection.php';
	$sql = "SELECT DISTINCT first_name from user";
    $result = mysql_query($sql);
    $js_array = array();
    
	while($row=mysql_fetch_array($result))
    {
		$f=$row['first_name'];
		$name=$f;
		array_push($js_array, $name); 
    }
    
	$sql1 = "SELECT DISTINCT tag FROM tag";
    $result1 = mysql_query($sql1);
    while($row=mysql_fetch_array($result1))
    {
		$hashtag = $row["tag"];
		array_push($js_array, $hashtag); 
    }
    
	$encodedData = json_encode($js_array);
	echo $encodedData;
?>