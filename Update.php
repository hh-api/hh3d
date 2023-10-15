<?php
include 'databases.php';
$time = time();
$page = $_GET['page'];
if($page == "") { $page= 1; } else { $pagenext = $page + 1; }
$html = curl('https://www.blogger.com/feeds/2539836325185027744/posts/default/-/Anime?max-results=50&start-index='.(50*($page - 1) + 1));
$no = 1;
$all_links = explode('</published><updated>', $html);
foreach ($all_links as $all_links) {
if (strpos($all_links, ".html") == true) {
$slug = explode(".html", explode("2023/01/", $all_links)['1'])['0'];
$thumb = explode('"', explode('img width="60px" src="', $all_links)['1'])['0'];
$ten_phim = explode('&lt;/font', explode('font color="limegreen"&gt;', $all_links)['1'])['0'];
$ten_goc = explode('&lt;/td', explode('/font&gt;&lt;/b&gt;&lt;br/&gt;', $all_links)['1'])['0'];
$nam_chieu = explode('&lt;/td', explode('name="nam_chieu" width="10%"&gt;', $all_links)['1'])['0'];
$trang_thai = explode('&lt;/td', explode('name="trang_thai" width="10%"&gt;', $all_links)['1'])['0'];
$thoi_luong = explode('&lt;/td', explode('name="thoi_luong" width="10%"&gt;', $all_links)['1'])['0'];
$quoc_gia = explode('&lt;/td', explode('name="quoc_gia" width="10%"&gt;', $all_links)['1'])['0'];
$the_loai = explode('&lt;/td', explode('name="the_loai" width="10%"&gt;', $all_links)['1'])['0'];
$noi_dung = explode('&lt;/td', explode('Nội Dung:&lt;/b&gt;&lt;/font&gt; ', $all_links)['1'])['0'];
$dien_vien = explode('&lt;/td', explode('Diễn Viên:&lt;/b&gt;&lt;/font&gt; ', $all_links)['1'])['0'];
if (strpos($all_links, "term='Series'") == true) { $bole = '1'; }
elseif (strpos($all_links, "term='Movie'") == true) { $bole = '2'; } else { $bole = '0'; }

$sql2 = mysqli_query($apizophim, "SELECT id FROM phim where `slug`='".$slug."'");
$check = mysqli_num_rows($sql2);
if($check > 0) {
$run = mysqli_query($apizophim,"UPDATE phim SET `ten_phim`='".$ten_phim."',`ten_goc`='".$ten_goc."',`trang_thai`='".$trang_thai."',`time`='".($time-$no)."' where slug='".$slug."'");
echo '<br/>--- Update : '.$ten_phim;
} else {
$az = mysqli_query($apizophim, "INSERT INTO `phim` (`slug`,`ten_phim`,`ten_goc`,`thumb`,`bole`,`nam_chieu`,`trang_thai`,`thoi_luong`,`quoc_gia`,`the_loai`,`dien_vien`,`noi_dung`,`view`,`view_day`,`time`) VALUES ('".$slug."','".$ten_phim."','".$ten_goc."','".$thumb."','".$bole."','".$nam_chieu."','".$trang_thai."','".$thoi_luong."','".$quoc_gia."','".$the_loai."','".$dien_vien."','".$noi_dung."','0','0','".($time-$no)."')");

echo '<br/>--- Insert : '.$ten_phim;
}
$no = $no + 1;
}
}

if ($pagenext) {
echo '<meta http-equiv="refresh" content="10; /Update.php?page='.$pagenext.'" />';
}

?>
