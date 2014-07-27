<?php	
	function fetch($topic)
	{
		$name="Java";
		$url = "http://en.wikipedia.org/w/index.php?title=Special:Search&search=".$name."&fulltext=Search&profile=default";
		$u="http://en.wikipedia.org";
		echo $url;
		$html= file_get_contents($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		$xPath = new DOMXPath($dom);
		$array= array();
		$n=$name;
		$output = $xPath->query("//a/@href[contains(/html/body/div[3]/div[3]/div[3]/div[2]/ul/li, $n)]");
		$num=1;
		print_r($output);
	  	foreach($output as $e) 
		{
			
			$toinsert=array();
			if($num)
			{
				//	if(strpos($e->nodeValue,$n) && strpos($e->nodeValue,"wiki"))
						$infourl=$u.($e->nodeValue);
						//echo $infourl;
			}
		}
	}
	fetch("java");
	
	?>