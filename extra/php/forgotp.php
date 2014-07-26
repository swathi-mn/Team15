<?php
	require_once 'connection.php';
	$check = $_POST['emailid'];
    $result = mysql_query('SELECT * FROM user');
	$flag = 0;
    if (!$result)
    {
        die('Invalid query: ' . mysql_error());
    }
    while ($row = mysql_fetch_assoc($result))
    {
        if($check == @$row['email'])
        {
            $flag = 1;
			break;
        }
    }
    if($flag == 1)
    {
        
        $id = $_POST['emailid'];
        $file = fopen("email.txt","w");
        fwrite($file, $_POST['emailid']);
        $new = system("python generate_python.py " ,$re);
		if($new != "")
		{
			mysql_query("UPDATE user SET password = sha1('$new') WHERE email = '$id'");
			echo 'yay';
		}		
    }
    else
    {
        echo "nope";
    }
?>