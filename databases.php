<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$apizophim = mysqli_connect('localhost', 'admin', '123456789', 'hh3d');
$apizophim -> set_charset("utf8");
function curl($url){
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$head[] = "Connection: keep-alive";
		$head[] = "Keep-Alive: 300";
		$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$head[] = "Accept-Language: en-us,en;q=0.5";
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.80 Safari/537.36');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
}
$domain = 'https://hh3d.xyz';
$favicon = 'https://i.imgur.com/C0YwHGhm.png';
$slogan = 'Xem Hoạt Hình 3D Hay, Anime Vietsub, Thuyết Minh Nhanh Nhất';
$description = 'Web xem phim hoạt hình 3D, anime online thuyết minh tiếng việt, phim anime vietsub, tổng hợp phim hoạt hình nhật bản mới nhất, hoạt hình trung quốc việt hoá, hoạt hình 3D';
$root_folder = '/www/wwwroot/hh3d.xyz';
?>
