<?php
ini_set('max_execution_time', 0);
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; Filename=SaveAsWordDoc.doc");

function checkurl($href,$domain){
	if($href!='https://www.facebook.com/yhoc.ykhoa/'){
		$inurl=stripos($href,$domain);
		if($inurl===0){
			return $href;
		}else{
			return $domain.$href;
		}
	}	 
}
function geturl($url){
	$def=explode ('index',$url);
	return $def[0];
}
function find_contains($html, $selector1, $keyword1, $keyword2, $index=-1) {
    foreach ($html->find($selector1) as $e) {
        $sec1=strpos($e->innertext, $keyword1);
		$sec2=strpos($e->innertext, $keyword2);
		return $fixml=substr($e->innertext,$sec1,$sec2-$sec1);
    }
}
function checkexist($url){
	$file_headers = @get_headers($url);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		return false;
	}
	else {
		if($file_headers[0] == 'HTTP/1.1 500 Internal Server Error') {
			return false;
		}else{
			return true;
		}
	}
}

include('../lib/simplehtmldom_1_5/simple_html_dom.php');
$domain='http://678.com.vn/';
$url='http://678.com.vn/phac-do.php';
$elgetcontent='div#noidung';
$i=1;
$k1='<h1 align="center" class="style4">';
$k2='<div id="cssduoi2">';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Crawl 2000 phác đồ trị bệnh</title>
</head>
<body>

<?php
$html = str_get_html(file_get_contents($url));
foreach($html->find($elgetcontent) as $e){
    $divnoidung=$e;
	foreach($divnoidung->find('a') as $e){
		$href=$e->href;
		$txthref=$e->innertext;
		echo '<h1><a href="'.checkurl($href,$domain).'">'.$txthref.'</a></h1><br>';
		if(checkurl($href,$domain)!=''){
			$urlroot=geturl(checkurl($href,$domain));
			$htmlsub1 = str_get_html(file_get_contents(checkurl($href,$domain)));
			foreach($htmlsub1->find($elgetcontent) as $e){
				$divnoidungsub1=$e;
				foreach($divnoidungsub1->find('a') as $e){
					//echo '--'.($e->href).'<br>';
					$hrefsub1=$e->href;
					$txthrefsub1=$e->innertext;
					$fullhrefsub1=str_replace(' ','',$urlroot.$hrefsub1);
					//echo '--'.checkurl($hrefsub1,$domain).'<br>';
					//echo '--'.$hrefsub1.'<br>';
					echo '<h2>'.$i.'/<a href="'.$fullhrefsub1.'">'.$txthrefsub1.'</a></h2><br>';
					if($i==641){
						$i++;
						continue;
					}else{
						if (checkexist($fullhrefsub1) === true) {
							$htmlsub2 = str_get_html(file_get_contents($fullhrefsub1));
							$gotta=find_contains($htmlsub2, $elgetcontent, $k1, $k2, $index=0);
							echo $gotta;
							echo '<br><hr>';
						}
						/* foreach($htmlsub2->find($elgetcontent) as $e){
							echo $e->innertext;
						} */
						$i++;
					}
				}
			}
		}
	}
}

?>

</body>
</html>