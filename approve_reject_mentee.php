<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap-tag.css" rel="stylesheet">
	<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link href="css/bootstrap-tag.less" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/touchTouch.jquery.js"></script>
	
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");}</script>

	<script>		
		jQuery(window).load(function() {	
		$x = $(window).width();		
		if($x > 1024)
		{			
			jQuery("#content .row").preloader();    
		}	
		jQuery('.magnifier').touchTouch();			
		jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});	
  		}); 		 
	</script>	
	<script>
		

	
	function sendmail(company)
		{
			
            xmlHTTP=getXmlHttpObject();
			xmlHTTP.open("POST","php/mail_all.php",true);
            xmlHTTP.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			document.getElementById("wait").innerHTML = "Sending mail. Wait...";
            xmlHTTP.send("company=" + company); 
            xmlHTTP.onreadystatechange=boo;
		}
		
		function boo()
		{
			if(xmlHTTP.readyState===4 && xmlHTTP.status===200)
            {
				document.getElementById("wait").innerHTML = "Sent!";
				window.location.href = "admin_home.html";
            }
		}	
		
	
	
	</script>
	
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-tag.js"></script>
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- Tab icon -->
	<link rel="icon" href="img/icon.jpg" type="image/x-icon"/>
	<title>
		Welcome
	</title>
	</head>	
	<body style="background-image:url(img/bleh.jpg)">
		<div class="spinner"></div>
		<!-- Navbar -->
		<div class="span12">
			<div class="navbar navbar-inverse navbar-fixed-top left">
				<div class="navbar-inner">
					<div class="container">
						<div class="nav">
							<ul class="nav pull-left">
								<li><img src="img/icon.jpg" height="25" width="25" style="margin:8px;"/></li>
							</ul>
							<li>
								<a class="brand" href="admin_home.html"><b style="font-size:20px;"></b></a>
							</li>
							<ul class="nav pull-right" style="padding-left:450px;">							
								<li><a href="search_student.html">Student profiles</a></li>	
								<li><a href="search_company.html">Company profiles</a></li>	
								<li>
									<a href="index.html"><b>&nbsp;Log out</b>&nbsp;</a>
								</li>						
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Navbar -->	
		
		</br></br></br>
		<div class="well span7 offset3">
			<div id="myTabContent" class="tab-content">		   	
				<div class="jumbotron">
				  <h1 style="color: #118bc1">Welcome</h1>  
				  <hr>
				  <br>
						<div class="panel-group" id="accordion" style="width:210"> 
							<div class="panel panel-default"> 
								<div class="panel-heading"> 
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"></a> <b id="wait" style="color:green;"></b>
								</h4> 
							</div>
						</div>
					</div>
							<div id="collapseTwo" class="panel-collapse collapse in" style="width:1000"> 
								<div class="panel-body" id="here">
									<?php
   
    require "Mail.php";//For sending email notification	
    $conn = mysqli_connect("localhost","root","code2014!","jpmc");
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
  		        $start_date = date('Y-m-d');//get current date of approval
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

//mail params
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


								</div> 							
								<br>
							</div>						
					</div>	
					</div>
				   <hr>
				</div>
	</body>	
</html>

