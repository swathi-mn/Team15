<?php
error_reporting(E_ERROR | E_PARSE);
$name="Java";
 $url = "http://en.wikipedia.org/w/index.php?title=Special:Search&search=".$name."&fulltext=Search&profile=default";
	  echo "<br>".$url;
	  $u="http://en.wikipedia.org";
      $html= file_get_contents($url);
	  $dom = new DOMDocument();
      @$dom->loadHTML($html);
      $xPath = new DOMXPath($dom);
	  $array= array();
		$n=$name;
	  echo "n is".$n;
	 $output = $xPath->query("//a/@href[contains(/html/body/div[3]/div[3]/div[3]/div[2]/ul/li, $n)]");
		$num=1;
		$infourl;
	  	foreach($output as $e) 
		{
			if($num)
			{
					
					if(strpos($e->nodeValue,$n) && strpos($e->nodeValue,"wiki"))
						$infourl = $u.$e->nodeValue;
						echo $infourl;
				}
			}
	
?>