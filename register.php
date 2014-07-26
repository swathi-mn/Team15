<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap-tag.css" rel="stylesheet">
	<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link href="css/bootstrap-tag.less" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/touchTouch.jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
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
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-tag.js"></script>
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- Tab icon -->
	<link rel="icon" href="img/icon.png" type="image/x-icon"/>

	<title>
		Login
	</title>
	</head>
	<body style="background-image:url(img/im1.jpg)">
		<div class="spinner"></div>
		</br>
		</br>
		<h2 style="padding-left:50px; color:white;">Welcome</h2>
		<!-- Begin form-->
		<div class="container-fluid">
            <div class="row-fluid">
				<div class="span6 offset3">
				</br></br>
				
				<form class="form-horizontal" method="POST">
				</br></br>
				
				<div class="control-group">
					<label class="control-label"><b style="color:#ffffff">Email</b></label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<input type="text" class="input-xlarge" id="email" name="email" placeholder="Email" alt="Enter email id" alt="Enter email id">
							
						</div>
					</div>
				</div>
		
           		<div class="control-group">
					<label class="control-label"><b style="color:#ffffff">Password</b></label>
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span>
							<input type="Password" id="password" class="input-xlarge" name="password" placeholder="Password" alt="Enter password">
						</div>
					</div>
				</div>	

				<div class ="control-group">
                    <label class="control-label"><b style="color:#ffffff" alt="Select role as mentor or mentee">Role</b></label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="role" value="e" checked>
                    <b style="color:#ffffff">Mentee</b>
                    &nbsp;&nbsp;
                    <input type="radio" name="role" value="r">
                    <b style="color:#ffffff">Mentor</b>
                </div>				
				
				<ul>
					<font color="red">
					<center>
						<b id="message">
						</b>
					</center>
					</font>
				</ul>

               <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls" style="padding-left:100px;">
                        <b><input type="button" class="btn btn-info" value="Login" onclick="button_click();"/></b>
                    </div>
               </div>
				</form>
				<!--End form-->
				</div>
            </div>
</div>
		</br></br>
	</body>

	<script>
	
		flag = true;
		
		// XMLHttp object for AJAX 
		function getXmlHttpObject()
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {	// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {	// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            } 
			return xmlhttp;
        }
		
	
		function next()
        {
            if(xmlHTTP.readyState===4&& xmlHTTP.status===200)
            {
                  var test=xmlHTTP.responseText;
                  console.log(test);
                  if(test.trim()==='true')
                          window.location.href="home.html";
                  else if(test.trim()==='false')
                      document.getElementById("message").innerHTML = "Please re-enter the details.";
            }
        }
		
		function button_click()
		{
			if(document.getElementById('password').value === "" || document.getElementById('email').value === "")
			{
				alert("Required fields cannot be left empty.");
				return;
			}
			else
			{
				send_to_server();
			}
		}

		var r;
		// Sends information to server via AJAX. 
		function send_to_server()
		{
				var email = document.getElementById('email').value;
				var password = document.getElementById("password").value;
				for (var i = 0, length = role.length; i < length; i++) {
					if (role[i].checked) {
						r = role[i].value;
						break;
					}
				}
				xmlHTTP=getXmlHttpObject();
				xmlHTTP.open("POST","php/login.php",true);
				xmlHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");      
				xmlHTTP.send("email=" + email + "&password=" + password);
				xmlHTTP.onreadystatechange=change;
		}
		
		// Checking for server response
		function change()
		{
			if(xmlHTTP.readyState===4 && xmlHTTP.status===200) 
            {    
                var check=xmlHTTP.responseText;
                console.log(check);    
                if(check.trim() ==='no_error')
				{
                    if(r == "e")
						window.location.href = "mentee_home.html";
					else if(r == "r")
						window.location.href = "mentor_home.html";
				}
                else if(check.trim() ==='error')
                    document.getElementById("message").innerHTML = "Please re-enter the details.";
			}
		}
		
	</script>
	
</html>