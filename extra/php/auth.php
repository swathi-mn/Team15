<?php
	session_start();
	if(!isset($_SESSION['username']) || (trim ($_SESSION['username']) == ''))
    {
		echo "false";
	}
	else
	{
		echo "true";
	}
?>