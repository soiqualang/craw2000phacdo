<?php
ini_set('max_execution_time', 0);
//header("Content-type: application/vnd.ms-word");
//header("Content-Disposition: attachment; Filename=SaveAsWordDoc.doc");
//header("Content-Disposition: inline; Filename=SaveAsWordDoc.doc");
include('../lib/simplehtmldom_1_5/simple_html_dom.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Saves as a Word Doc</title>
</head>
<body>
<?php
function find_contains($html, $selector1, $keyword1, $keyword2, $index=-1) {
    foreach ($html->find($selector1) as $e) {
        $sec1=strpos($e->innertext, $keyword1);
		$sec2=strpos($e->innertext, $keyword2);
		//http://www.nhaccuatui.com/flash/xml?key2=9023eb26c6a844f981bb612d25e2ba3a
		//https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvPgTSoRTw7Uup90yJ_cJ-5kxF3vMi_DWlZ8qqzo2bNayF45H7TQ
		//echo substr($e->innertext,$sec1,$sec2-$sec1);
		return $fixml=substr($e->innertext,$sec1,$sec2-$sec1);
    }
}

$url='http://678.com.vn/phac-do/nguyen-trai/41.php';
function checkexist($url){
	$file_headers = @get_headers($url);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
		echo 'false';
	}
	else {
		if($file_headers[0] == 'HTTP/1.1 500 Internal Server Error') {
			echo 'false';
		}else{
			echo 'true';
		}
	}
}
checkexist($url);
/* $elgetcontent='div#noidung';
$htmlsub2 = str_get_html(file_get_contents($url));
$k1='<h1 align="center" class="style4">';
$k2='<!-- tren -->
    <div align="center"> <ins class="adsbygoogle"';
$gotta=find_contains($htmlsub2, $elgetcontent, $k1, $k2, $index=0);
echo $gotta; */
?>
</body>
</html>