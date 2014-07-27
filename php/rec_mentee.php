<?php
// Create connection
	session_start();
	require_once 'connection.php';

		$email = $_SESSION['emailid'];
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$mentor_skill = mysql_query("SELECT * FROM mentor_skills");
    $mentee_skill=  mysql_query("SELECT * FROM mentee_skill WHERE emailid = '$email'");
	$flag=0;
	while($row = mysql_fetch_array($mentee_skill)) 
	{
		if($row)
		{
			$msk=$row['skill'];
			$flag=1;
		}
	}
	if($flag)
	{
	$rows = mysql_fetch_array($mentor_skill);
	{
		//echo "came here";
		$m=$rows['skills'];
		$m=explode(',',$m);
		//print_r ($m);
		
		foreach($m as $mi)
		{
			if(strcasecmp($msk,$mi)==0)
			{
				echo $rows['emailid']."!";
			}
		}
}	}
}
?>