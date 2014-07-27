<?php
	set_time_limit(0);
	error_reporting(E_ERROR | E_PARSE);
	require_once 'connection.php';
	session_start();
	
	function fetch($topic)
	{
		$name=$topic;
		$url = "http://en.wikipedia.org/w/index.php?title=Special:Search&search=".$name."&fulltext=Search&profile=default";
		$u="http://en.wikipedia.org";
		$html= file_get_contents($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		$xPath = new DOMXPath($dom);
		$array= array();
		$n=$name;
		$output = $xPath->query("//a/@href[contains(/html/body/div[3]/div[3]/div[3]/div[2]/ul/li, $n)]");
		$num=1;
	  	foreach($output as $e) 
		{
			$toinsert=array();
			if($num)
			{
					if(strpos($e->nodeValue,$n) && strpos($e->nodeValue,"wiki"))
					{
						$infourl = $u . $e->nodeValue;
						 return $infourl;
					}
						 
			}
		}
	}
	
	$email = $_SESSION['emailid'];
	$q = "SELECT mte_id, topic FROM mentor_mentee_list WHERE mtr_id = '$email'";
	
	$a=mysql_query($q);
	$n = mysql_num_rows($a);
	if($n > 0){
	while($row = mysql_fetch_array($a))
	{
		
		$mail = @$row['mte_id'];
		$topic = @$row['topic'];
		$t = fetch($topic);
	
?>
	
		<table class="table table-striped table-bordered table-condensed">
		<tr>
			<th style="color:black;">Email</th>
			<th style="color:black;">Topic</th>
			<th style="color:black;">Links</th>												  
		</tr>
		<tr>
			<td style="background-color:#ff9900"><b><?php echo $mail ?></b></td>
			<td style="background-color:#ff9900"><b><?php echo $topic ?></b></td>
			<td style="background-color:#ff9900;"><a style="color:black;"><?php echo $t ?></a></td>
		</tr>													
	</table>

<?php
		}
	}
	else
	{
?>
	<center><b style="font-size:20px; color: white;">Select students.</b></center>
<?php
	}
?>
