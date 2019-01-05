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
$url='http://678.com.vn/phac-do/gia-dinh/khac/10.php';
$elgetcontent='div#noidung';
$htmlsub2 = str_get_html(file_get_contents($url));
foreach($htmlsub2->find($elgetcontent) as $e){
	echo $e->innertext;
}
?>
</body>
</html>