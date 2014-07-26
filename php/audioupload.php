<?php
session_start();
require_once 'connection.php';
if((($_FILES["file"]["type"] == "audio/mpeg")
	|| ($_FILES["file"]["type"] == "audio/x-mpeg")
	|| ($_FILES["file"]["type"] == "audio/mp3")
	|| ($_FILES["file"]["type"] == "audio/x-mp3")
	|| ($_FILES["file"]["type"] == "audio/mpeg3")
	|| ($_FILES["file"]["type"] == "audio/x-mpeg3")
	|| ($_FILES["file"]["type"] == "audio/mpg")
	|| ($_FILES["file"]["type"] == "audio/x-mpg")
	|| ($_FILES["file"]["type"] == "audio/x-mpegaudio"))
	&& ($_FILES["file"]["size"] < 20000000))
	{
		move_uploaded_file($_FILES["file"]["tmp_name"],
        "../upload/audio/" . $_FILES["file"]["name"]);
        $path = "upload/audio/" . $_FILES["file"]["name"];
        $user = $_SESSION['username'];
        $query = "UPDATE upload SET path = '$path' WHERE username='$user' ORDER BY uploadid DESC LIMIT 1";
        mysql_query($query);
        $reply = "true";
		echo $reply;
	}
	else
	{
		$reply = "false";
		echo $reply;
	}
?>