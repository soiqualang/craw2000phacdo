<?php
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

include('../lib/simplehtmldom_1_5/simple_html_dom.php');
$domain='http://678.com.vn/';
$url='http://678.com.vn/phac-do.php';
$elgetcontent='div#noidung';
$html = str_get_html(file_get_contents($url));
foreach($html->find($elgetcontent) as $e){
    $divnoidung=$e;
	foreach($divnoidung->find('a') as $e){
		$href=$e->href;
		echo '<b>'.checkurl($href,$domain).'</b><br>';
		if(checkurl($href,$domain)!=''){
			$htmlsub1 = str_get_html(file_get_contents(checkurl($href,$domain)));
			foreach($htmlsub1->find($elgetcontent) as $e){
				$divnoidungsub1=$e;
				foreach($divnoidungsub1->find('a') as $e){
					echo '--'.($e->href).'<br>';
				}
			}
		}
		
		
		/* if($suburl1!='http://678.com.vn/https://www.facebook.com/yhoc.ykhoa/'){
			$htmlsub1 = str_get_html(file_get_contents($suburl1));
			foreach($htmlsub1->find('a') as $e){
				echo '--'.($e->href).'<br>';
			}
		} */
		
	}
}

?>