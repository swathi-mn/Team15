

<?php
	$conn = mysqli_connect("localhost","root","code2014!","jpmc");
			if (!$conn)
  			{
  				die('Could not connect: ' . mysqli_error());
  			}
			//fetch fresh approvals
			$res=mysqli_query($conn,"select * from mentor_mentee_list where start_date is null");
			if(!empty($res))
			   {
 				echo "<ul>";
	   			   while ($row = mysqli_fetch_array($res)) {
					    $mentor_id=$row['mtr_id'];
    					    $mentee_id=$row['mte_id'];	
	
  					echo "<li>";				      
					echo "<form id='approve_reject' action='approve_reject_mentee.php' method='post'>";
						echo $mentor_id." wants to connect with ".$mentee_id;  
						echo "<input type='submit'  name='action' value='Approve'>";
						echo "<input type='submit'  name='action' value='Reject'>";
						echo "<input type='hidden' name='mentor_id' value=$mentor_id>";
						echo "<input type='hidden' name='mentee_id' value=$mentee_id>";	
					echo "</form>";	
					echo "</li>";
				   }
 			 	 echo "</ul>";	
			   }
			else	
			   echo "<p> Currently, there are no pending aprrovals </p>"
?>

