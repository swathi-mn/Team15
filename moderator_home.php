<?php session_start(); ?>

<?php
	$conn = mysql_connect("localhost","root","root");
			if (!$conn)
  			{
  				die('Could not connect: ' . mysql_error());
  			}
			mysql_select_db("jpmc", $conn);
			$res=mysql_query("select * from mentor_mentee_list where start_date is null");
			if(!empty($res))
			   {
 				echo "<ul>";
	   			   while ($row = mysql_fetch_array($res)) {
  					echo "<li>";				      
					echo "<form action='approve_reject_mentee.php' method='post'>";
						echo $row['mtr_id']." wants to connect with ".$row['mte_id'];  
						echo "<input type='submit' value='Approve'>";
						echo "<input type='submit' value='Reject'>";
						echo "<input type='hidden' value='$row'>";	
					echo "</form>";	
					echo "</li>";
				   }
 			 	 echo "</ul>";	
			   }
			else	
			   echo "<p> Currently, there are no pending aprrovals </p>"
?>

