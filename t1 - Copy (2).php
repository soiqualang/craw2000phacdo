<?php
ini_set('max_execution_time', 0);

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
/*
1-http://678.com.vn/phac-do/tu-du/14.php
2-http://678.com.vn/phac-do/tu-du-2/48.php
3-http://678.com.vn/phac-do/tai-mui-hong/24.php
4-http://678.com.vn/phac-do/binh-dan/17.php
5-http://678.com.vn/phac-do/da-lieu/17.php
6-http://678.com.vn/phac-do/pham-ngoc-thach/45.php
---
http://678.com.vn/phac-do/index.php
http://678.com.vn/phac-do/hung-vuong-san-phu/77.php

http://678.com.vn/phac-do/gia-dinh/index.php
http://678.com.vn/phac-do/gia-dinh/ngoai-khoa/87.php

http://678.com.vn/phac-do/gia-dinh/index-2.php
http://678.com.vn/phac-do/gia-dinh/nhan-khoa/15.php
http://678.com.vn/phac-do/gia-dinh/rang-ham-mat/150.php
*/

include('../lib/simplehtmldom_1_5/simple_html_dom.php');
$domain='http://678.com.vn/';
$url='http://678.com.vn/phac-do.php';
$elgetcontent='div#noidung';
$i=1;

$html = str_get_html(file_get_contents($url));
foreach($html->find($elgetcontent) as $e){
    $divnoidung=$e;
	foreach($divnoidung->find('a') as $e){
		$href=$e->href;
		echo '<b>'.checkurl($href,$domain).'</b><br>';		
		if(checkurl($href,$domain)!=''){
			$urlroot=geturl(checkurl($href,$domain));
			$htmlsub1 = str_get_html(file_get_contents(checkurl($href,$domain)));
			foreach($htmlsub1->find($elgetcontent) as $e){
				$divnoidungsub1=$e;
				foreach($divnoidungsub1->find('a') as $e){
					//echo '--'.($e->href).'<br>';
					$hrefsub1=$e->href;
					$txthrefsub1=$e->innertext;
					//echo '--'.checkurl($hrefsub1,$domain).'<br>';
					//echo '--'.$hrefsub1.'<br>';
					echo '--'.$i.'/'.$urlroot.$hrefsub1.'-'.$txthrefsub1.'<br>';
					$i++;
				}
			}
		}
	}
}

?>