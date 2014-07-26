<html>
<head>Admin</head>
<?php
	$link=mysql_connect("localhost","root","123")or die("can not connect");
	mysql_select_db("enable_india",$link) or die("can not select database");
	$p = "select * from  mentor_mentee_list";
	$pes=mysql_query($p,$link) or die("Wrong Query");
	$ter_date=$_POST['termination_date'];
	$x="UPDATE mentor_mentee_list SET end_date=$ter_date WHERE ter_flag='1'";
	
	$xyz=mysql_query($x,$link) or die("Wrong Query");
	echo 'Mentor Mentee sessions details are:';
	echo "<table border='1'>
	<tr>
	<th>Mentor</th>
	<th>Mentee</th>
	<th>Start_date</th>
	<th>End_date</th>
	</tr>";
	echo "<tr>";
	while($row = mysql_fetch_array($pes))
	{
		echo "<td>" . $row['mtr_id'] . "</td>";
		echo "<td>" . $row['mte_id'] . "</td>";
		echo "<td>" . $row['start_date'] . "</td>";
		echo "<td>" . $row['end_date'] . "</td>";
	}										
	echo "</tr>";  
	echo "</table>";
	mysql_close($link);
	echo 'Mentor Mentee review details are:';
	echo "<table border='1'>
	<tr>
	<th>Mentor's review</th>
	<th>Mentee's review</th>
	<th>Review_date</th>
	</tr>";
	echo "<tr>";
	while($row = mysql_fetch_array($pes))
	{
		echo "<td>" . $row['mtr_review'] . "</td>";
		echo "<td>" . $row['mte_review'] . "</td>";
		echo "<td>" . $row['review_date'] . "</td>";
		//echo "<td>" . $row['end_date'] . "</td>";
	}										
	echo "</tr>";  
	echo "</table>";
?>
<script>
