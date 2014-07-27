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
	
	while($row = mysqli_fetch_array($mentor_skill)) 
	{
			$msk=$row['skills'];
			//$msk="C,py";
			$msk=explode(',',$msk);
	}
   // echo $msk;
	while($rows = mysqli_fetch_array($mentee_skill)) 
	{
		//echo "came here";
		//echo $rows['skill']." ".$msk;
		foreach($msk as $m)
		{
			//`echo '$m is '.$m.'and skill is '.$rows['skill'].'<br>';
			if(strcasecmp($rows['skill'],$m)==0)
			{
				echo $rows['email'];
				echo '<br>';
			}
		}
	}
}
mysqli_close($con);
?>