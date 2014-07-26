<?php
session_start();
require_once 'connection.php';
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000))
  {
			move_uploaded_file($_FILES["file"]["tmp_name"],
            "../upload/pics/" . $_FILES["file"]["name"]);
            $path = "upload/pics/" . $_FILES["file"]["name"];
            $user = $_SESSION['username'];
            $query = "UPDATE user SET linktodp = '$path' WHERE username='$user'";
            mysql_query($query);
  }
?>