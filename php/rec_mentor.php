<?php
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
	$mentor_skill = mysql_query("SELECT * FROM mentor_skills WHERE emailid = '$email'");
    $mentee_skill=  mysql_query("SELECT * FROM mentee_skill");
	
	while($row = mysql_fetch_array($mentor_skill)) 
	{
			$msk=$row['skills'];
			//echo $msk;
			$mski=explode(',',$msk);
		
	}

	while($rows = mysql_fetch_array($mentee_skill)) 
	{
		//echo "came here";
		//echo $rows['skill']." ".$msk;
		foreach($mski as $m)
		{
			//`echo '$m is '.$m.'and skill is '.$rows['skill'].'<br>';
			if(strcasecmp($rows['skill'],$m)==0)
			{
				echo $rows['emailid']."==>".$rows['skill']."!";
			}
		}
	}
}
?>