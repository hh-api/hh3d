<?php
include 'includes/header.php';
$slug = $_GET['slug'];
$get_tap = $_GET['tap'];
$sql = mysqli_query($apizophim, "SELECT * FROM phim where `slug`='".$slug."'");
if (mysqli_num_rows($sql) < 1) {
echo '<script>location.href="/index.php";</script>';    
}
$get_info = mysqli_fetch_array($sql);
$ten_phim = $get_info['ten_phim'];
$ten_goc = $get_info['ten_goc'];
$noi_dung = $get_info['noi_dung'];
$nam_chieu = $get_info['nam_chieu'];
$the_loai = $get_info['the_loai'];
$quoc_gia = $get_info['quoc_gia'];
$dien_vien = $get_info['dien_vien'];
$trang_thai = $get_info['trang_thai'];
$thoi_luong = $get_info['thoi_luong'];
$bole = $get_info['bole'];
if (strpos($thumb, 'imgur.com') == true)  {
$thumb = str_replace('.jpg', 'l.jpg', $get_info['thumb']);
}
$luotxem = $get_info['view'];
$luotxem1 = $luotxem + mt_rand(1,9);
$view_day = $get_info['view_day'];
$view_day1 = $view_day + 1;
$run = mysqli_query($apizophim, "UPDATE phim SET `view`='$luotxem1',`view_day`='$view_day1' where `slug`='".$slug."'");
?>

<title>Xem <?php echo $ten_phim;?> - Tập <?php echo $get_tap;?> Vietsub, Thuyết Minh</title>
<meta name="description" content="Xem <?php echo $ten_phim;?> - Tập <?php echo $get_tap;?>" />
<link rel="canonical" href="###" />
<meta property="og:title" content="Xem <?php echo $ten_phim;?> - Tập <?php echo $get_tap;?>" />
<meta property="og:description" content="Xem <?php echo $ten_phim;?> - Tập <?php echo $get_tap;?>" />
<meta property="og:url" content="###" />
<meta property="og:image" content="<?php echo $thumb;?>" />
  

<div class="ah_content">
<div class="watching-movie">


    <div id="settings-while-watching" class="display-none">

        </div>
        <div class="ah-frame-bg fw-700 margin-10-0 bg-black">
            <a href="/<?php echo $slug;?>.html" class="fs-16 flex flex-hozi-center color-yellow border-style-1"><span class="material-icons-round margin-0-5">movie</span><?php echo $ten_phim;?> - Tập <?php echo $get_tap;?></a>
Lượt Xem : <?php $view = './view/'.$slug.'.php'; echo $view1 = file_get_contents($view) + mt_rand(1, 9); $myfile2 = fopen($view, "w"); fwrite($myfile2, $view1); fclose($myfile2); ?>            
</div>


<?php

$cache_movie = './cache/movie/'.$slug.'.php';
$list = './list/'.$slug.'.php';

if (file_exists($cache_movie)) { $time_cache = filemtime($cache_movie);
if (time() > ($time_cache + 3600)) { $cache = '0'; } } 
if ((!file_exists($cache_movie)) or ($cache == '0')) { 
$html = curl('https://api-zophim.blogspot.com/2023/01/'.$slug.'.html');    
if (strpos($html, 'class="ALL"') == true)  {
$list_all = explode('</td>', explode('<td style="vertical-align: top;" class="ALL">', $html)['1'])['0'];
$list_all = preg_replace('/\R+/', "\n", trim($list_all));
if ($list_all) {
$myfile = fopen($list, "w");
fwrite($myfile, '<?php $list_sv="
'.$list_all.';" ?>');
fclose($myfile);
}
file_put_contents($cache_movie, '');
}
}

if (file_exists($list)) {
include 'list/'.$slug.'.php';
$get_auto = explode('<br/>', explode("\n".$get_tap.'|', $list_sv)['1'])['0'];
$vs = explode('|', $get_auto)['0'];
$tm = explode('|', $get_auto)['1'];
if ($tm!='-'){
$auto = 'https://zophim.net/s/'.$tm.'.html'; $ahihi = 'zotm';    
} elseif ($vs!='-'){
$auto = 'https://zophim.net/s/'.$vs.'.html'; $ahihi = 'zovs';    
} else {
$auto = 'https://ssplay.net/loading.php';    
}
} else {
$sql = mysqli_query($apizophim, "SELECT * FROM VIP where `slug`='".$slug."' and tap ='$get_tap'");
$mysql = mysqli_fetch_array($sql);    
$vs = $mysql['vs'];
$tm = $mysql['tm'];
if ($tm){ 
$auto = 'https://zophim.net/s/'.$tm.'.html'; $ahihi = 'zotm';
} elseif ($vs){
if (strpos($vs, 'ssplay') == true) {    
$auto = $vs; $ahihi = 'ssvs';
} else {
$auto = 'https://zophim.net/s/'.$vs.'.html'; $ahihi = 'zovs';
}
} else {
$auto = 'https://ssplay.net/loading.php';  
}
} //End If 1;
?>


    <div id="list_sv" class="flex flex-ver-center margin-10">
<?php if (($tm) and ($tm!='-')) { ?>
<button class="yellow" onclick="document.getElementById('hh3d').src = 'https://zophim.net/s/<?php echo $tm; ?>.html'">Z-TM</button>
<?php } ?>

<?php if (($tm) and ($tm!='-')) { ?>
<button class="green" onclick="document.getElementById('hh3d').src = 'https://ssplay.net/v/<?php echo $tm; ?>.html'">S-TM</button>
<?php } ?>

<?php if (($vs) and ($vs!='-')) { ?>
<button class="<?php if ($tm) { echo 'green'; } else { echo 'yellow'; }?>" onclick="document.getElementById('hh3d').src = 'https://zophim.net/s/<?php echo $vs; ?>.html'">Z-VS</button>
<?php } ?>

<?php if (($vs) and ($vs!='-')) { ?>
<button class="green" onclick="document.getElementById('hh3d').src = 'https://ssplay.net/v/<?php echo $vs; ?>.html'">S-VS</button>
<?php } ?>

    </div>
<style>
.green{
    background-color: #3a79af;
    color:white;
    padding: 5px;
    border-radius: 3px;
    border: none;
    font-size: 15px;
    margin-left: 5px;
}
.yellow {
    background-color: #b73a3a;
    color:white;
    padding: 5px;
    border-radius: 3px;
    border: none;
    font-size: 15px;
    margin-left: 5px;
}
</style>
<script type="text/javascript">
function go(loc) {
    document.getElementById('hh3d').src = loc;
     }
var buttons = $('button').click(function(){
  buttons.not(this).addClass('green');
  buttons.not(this).removeClass('yellow');
  $(this).addClass('yellow');
});
</script> 

    <div id="video-player">
<iframe id="hh3d" width="100%" height="450px" src="<?php echo $auto; ?>" frameborder="0" scrolling="0" allowfullscreen></iframe>        
    </div>
    
<div class="flex flex-ver-center margin-10">

<a href="<?php if ($get_tap > 1) { echo '/'.$slug.'/tap-'.($get_tap-1).'.html'; } else { echo '#'; } ?>" class="button-default padding-10-20 flex flex-hozi-center fw-700" style="background-color: #3a79af;"><< Trước</a>
<a href="#" class="button-default padding-10-20 flex flex-hozi-center fw-700" style="background-color: #b73a3a;">Đang Xem - Tập <?php echo $get_tap; ?></a>
<a href="<?php if ($get_tap > 0 ) { echo '/'.$slug.'/tap-'.($get_tap+1).'.html'; } else { echo '#'; } ?>" class="button-default padding-10-20 flex flex-hozi-center fw-700" style="background-color: #25867d;">Sau >></a>

</div>
    
    
                <div class="ah-frame-bg">
            <div class="heading flex flex-hozi-center fw-700 color-red-2">
                <span class="material-icons-round margin-0-5">
    note
</span>Nội Dung
            </div>
            <div><a href="https://hh3d.xyz"><font color="yellow">HH3D.xyz</font></a> giới thiệu bộ phim <?php echo $noi_dung; ?></div>
        </div>
        <div class="list_episode ah-frame-bg" id="list-episode">
        <div class="heading flex flex-space-auto fw-700">
            <span>Danh Sách Tập</span>
            <span id="newest-ep-is-readed" class="fs-13"></span>
        </div>
        <div class="list-item-episode scroll-bar" style="justify-content: left;">
<?php
$cache_movie = './cache/movie/'.$slug.'.php';
$list = './list/'.$slug.'.php';

if (file_exists($cache_movie)) { $time_cache = filemtime($cache_movie);
if (time() > ($time_cache + 1800)) { $cache = '0'; } } 
if ((!file_exists($cache_movie)) or ($cache == '0')) { 
$html = curl('https://api-zophim.blogspot.com/2023/01/'.$slug.'.html');    
if (strpos($html, 'class="ALL"') == true)  {
$list_all = explode('</td>', explode('<td style="vertical-align: top;" class="ALL">', $html)['1'])['0'];
$list_all = preg_replace('/\R+/', "\n", trim($list_all));
if ($list_all) {
$myfile = fopen($list, "w");
fwrite($myfile, '<?php $list_sv="
'.$list_all.';" ?>');
fclose($myfile);
}
file_put_contents($cache_movie, '');
}
}

if (file_exists($list)) {
include 'list/'.$slug.'.php';
$get_list = explode('<br/>', $list_sv);
foreach ($get_list as $get_list) {
if (strpos($get_list, '|') == true) {    
$list_tap = explode("|", $get_list)['0'];
if ($get_tap == $list_tap) { $class = 'class="active"'; } else { $class = ''; }
echo '<a href="/'.$slug.'/tap-'.$list_tap.'.html" title="Tập '.$list_tap.'"  '.$class.'>'.$list_tap.'</a>';
}}
} else {
$sql10 = mysqli_query($apizophim, "SELECT tap FROM VIP where `slug`='".$slug."' order by ABS(tap)");
while($qsql10 = mysqli_fetch_array($sql10)){
$list_tap = $qsql10['tap'];
if ($get_tap == $list_tap) { $class = 'class="active"'; } else { $class = ''; }
echo '<a href="/'.$slug.'/tap-'.$list_tap.'.html" title="Tập '.$list_tap.'"  '.$class.'>'.$list_tap.'</a>';
} }
?>

                    </div>
    </div>
<script>
$(document).ready(function(){
    $(this).scrollTop(130);
});
</script>    
<?php
include 'includes/footer.php';
?>
