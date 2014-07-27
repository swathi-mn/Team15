<?php
// Create connection
$con=mysqli_connect("localhost","root","","jpmc");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
	$mentor_skill = mysqli_query($con,"SELECT * FROM mentor");
    $mentee_skill=  mysqli_query($con,"SELECT * FROM mentee");
	
	while($row = mysqli_fetch_array($mentee_skill)) 
	{
			$msk=$row['skill'];
	}
   // echo $msk;
	$rows = mysqli_fetch_array($mentor_skill);
	{
		//echo "came here";
		$m=$rows['skills'];
		$m=explode(',',$m);
		
		foreach($m as $mi)
		{
			//`echo '$m is '.$m.'and skill is '.$rows['skill'].'<br>';
			if(strcasecmp($msk,$mi)==0)
			{
				echo $rows['email'];
			//	echo '<br>';
			}
		}
	}
}
mysqli_close($con);
?>