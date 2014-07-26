<?php
	session_start();
	require_once 'connection.php';
    $user = $_SESSION["username"];
	$tag = $_POST['search'];
	$sql = "SELECT temp.uploadid,temp.username,temp.first_name,temp.last_name,temp.linktodp,temp.description,temp.path,temp.timestamp,temp.privacy
          FROM
          (
				SELECT UP.uploadid as uploadid,US.username as username,US.first_name as first_name,US.last_name as last_name,US.linktodp as linktodp,UP.description as description,UP.path as path,UP.timestamp as timestamp,UP.privacy as privacy, T.tag as tag FROM user US,upload UP, tag T WHERE US.username = UP.username AND privacy = 0 AND UP.uploadid = T.uploadid AND T.tag = '$tag' 
          ) 
		  AS temp 
		  ORDER BY uploadid DESC LIMIT 10";  
	$result= mysql_query($sql);  
	$num = mysql_num_rows($result);
	if($num != 0){
    while($row = mysql_fetch_array($result))
	{  
        $flag = false;
		$id = @$row["uploadid"];
		$un = @$row["username"]; 
		if($un === $user)
		{
			$flag = true;
		}
		$f = @$row["first_name"]; 
		$l = @$row["last_name"]; 
		$link = @$row["linktodp"];
		$description = @$row["description"];
		$path = @$row["path"];
		$timestamp = @$row["timestamp"];
		$time = explode(" ", $timestamp);
		$day = $time[0];
		$time = $time[1];
		$privacy = @$row["privacy"];
		$name = ucfirst($f)." ".ucfirst($l);
		$sql2 = "SELECT tag FROM tag WHERE uploadid='$id'";
		$result2 = mysql_query($sql2);
?>
		<div class="container-fluid">
			<div class="row-fluid">
                <div class="span12">
					<div class="row-fluid">														
						<div class="span7">
							<?php
								if($flag)
								{
							?>
								<h4><strong><a href="myprofile.html" id=<?php echo $un ?>><b style="color:white; font-size:20px;"><?php echo $name ?></b></a></strong></h4>
							<?php
								}
								else
								{
							?>
								<h4><strong><a href="othersprofile.html?un=<?php echo $un ?>" id=<?php echo $un ?>><b style="color:white; font-size:20px;"><?php echo $name ?></b></a></strong></h4>
							<?php
								}
							?>
						</div>						
					</div>		
					<div class="row-fluid">
						<div class="span2">
							<?php
								if($flag)
								{
							?>
								<a href="myprofile.html"  id=<?php echo $un ?>>
							<?php
								}
								else
								{
							?>
								<a href="othersprofile.html?un=<?php echo $un ?>"  id=<?php echo $un ?>>
							<?php
								}
							?>
									<img class="thumbnail" src= <?php echo $link ?> alt="Profile Picture" height="100" width="100"/>
							</a>
						</div>
						<div class="span10">      
							<p style="color:white;">
								<b><?php echo $description ?></b>
							</p>
							<audio controls preload=none>												
								<source src= "<?php echo $path ?>" type="audio/mpeg">
							</audio>						
						</div>						
					</div>
					<div class="row fluid">
						<div class="span12">
							<p style="padding-left:32px;">
								<i class="glyphicon glyphicon-calendar white"></i>&nbsp;<b style="color:white; font-size:12px;"><?php echo $day?> at <?php echo $time?></b>
								<?php
									if($privacy == 0)
									{
								?>
								<span class="white">|</span>  <i class="glyphicon glyphicon-globe white"></i>
								<?php
									}
									else
									{
								?>
								<span class="white">|</span>  <i class="glyphicon glyphicon-lock white"></i>
								<?php
									}
								?>
								<span class="white">|</span>  <i class="glyphicon glyphicon-tags white"></i><b style="color:white; font-size:12px;">&nbsp; Tags : </b>
								<?php
									while($row=mysql_fetch_array($result2))
									{
										$hs = @$row["tag"];  
								?>
								<a href="search.html?query=<?php echo $hs ?>"><span class="label label-info"><?php echo $hs?></span></a> 
								<?php
									}
								?>
							</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<hr>
<?php
		} 
	}
	else
	{
?>
	<center><b style="color:white; font-size:20px;">No public results found.</b></center>
<?php
	}
?>
