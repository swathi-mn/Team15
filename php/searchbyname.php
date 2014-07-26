<?php
	session_start();
	require_once 'connection.php';
	$user = $_POST["search"];
	$me = $_SESSION['username'];
    $sql="SELECT * from user where first_name = '$user'";
	$result= mysql_query($sql); 
    $num =mysql_num_rows($result);
	if($num != 0){
    while($row=mysql_fetch_array($result)){  
		$un = @$row["username"]; 
		$f = @$row["first_name"]; 
		$l = @$row["last_name"]; 
		$link = @$row["linktodp"];
		$name = ucfirst($f)." ".ucfirst($l);
?>
		<div class="row-fluid">
			<div class="span1">
				<div style="padding-top:15px; padding-left:5px;">
<?php
	if($un == $me)
	{
?>          
					<a href="myprofile.html" id="myprofile">
						<img class="thumbnail" id="userpic" alt="Profile Picture" src="<?php echo $link ?>" height="90" width="90">			
					</a>
<?php
	}
	else
	{
?>					
					<a href="othersprofile.html?un=<?php echo $un ?>" id="<?php echo $un ?>">
						<img class="thumbnail" id="userpic" alt="Profile Picture" src="<?php echo $link ?>" height="90" width="90">			
					</a>
<?php
	}
?>					
				</div>
			</div>
			<div class="offset1" style="padding-top:50px; padding-left:15px;">	
<?php
	if($un == $me)
	{
?>  			
				<a href="myprofile.html"><b style="color:white; font-size:20px;"><?php echo $name ?></b></a>				
<?php
	}
	else
	{
?>	
				<a href="othersprofile.html?un=<?php echo $un ?>"><b style="color:white; font-size:20px;"><?php echo $name ?></b></a>	
<?php
	}
?>
			</div>
		</div>	
<?php
		}
   }
   else
   {
?>
	<center><b style="color:white; font-size:20px;">No users found.</b></center>
<?php
   }
?>

