<?php
   
    require "Mail.php";	
    $conn = mysqli_connect("localhost","root","root","jpmc");
			if (!$conn)
  			{
  				die('Could not connect: ' . mysqli_error());
  			}

	

    $action=$_POST['action'];
    $mentor_id=$_POST['mentor_id'];
    $mentee_id=$_POST['mentee_id'];	
    $mentor_name='';
    $mentee_name='';
    switch($action){
         case 'Approve': 
  		        $start_date = date('Y-m-d');
			$end_date=date('Y-m-d', strtotime("+90 days"));//added 3 months
			$res=mysqli_query($conn,"update mentor_mentee_list set start_date='$start_date', end_date='$end_date' where mtr_id='$mentor_id' and mte_id='$mentee_id'");
			//echo "update mentor_mentee_list set start_date='$start_date', end_date='$end_date' where mtr_id='$mentor_id' and mte_id='$mentee_id'";
			
			/* Retrieve firstname and last name. Taken from the users table*/
			/*$res1=mysqli_query($conn,"select first_name,last_name from user_info where emailid='$mentor_id'");
			$mentor_name = mysqli_fetch_array($res1);
			$mentor_name="$mentor_name['first_name']"."$mentor_name['last_name']";
			$res2=mysqli_query($conn,"select first_name,last_name from user_info where emailid='$mentee_id'");
			$mentee_name = mysqli_fetch_array($res2);
			$mentee_name="$mentee_name['first_name']"."$mentee_name['last_name']";*/
						
			if($res==false)
			  echo "<p>Something went wrong</p>";			 	
			else{
			      echo "<p>Successfully approved</p>";
			      $subject="Your request was approved";
			      $body="Hi, request by $mentor_name to  mentor $mentee_name is approved. Your mentoring will tentatively end by $end_date. Please send your feedback after your session ends in the portal.";					
			    }
			break;
     	 case 'Reject': 
			      $subject="Your request was rejected";	
			      $body="Hi, request by $mentor_name to  mentor $mentee_name is not approved.  was not approved. Please wai try at a later point of time.";					

 			break;
    }


$from = "bangalorejpmc enableindia <jpmc.team15.enableindia@gmail.com>";
$to_mentor = "$mentor_id";
$to_mentee = "$mentee_id";

$host = "smtp.gmail.com";
$port = "587";
$username = "jpmc.team15.enableindia@gmail.com";
$password = "team15@jpmc";

//header for mentor id
$headers = array ('From' => $from,
  'To' => $to_mentor,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to_mentor, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }


//header for mentee id
$headers = array ('From' => $from,
  'To' => $to_mentee,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to_mentee, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }

?>



?>
