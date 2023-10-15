<?php
include 'includes/header.php';
$slug = $_GET['slug'];
$sql = mysqli_query($apizophim, "SELECT * FROM phim where `slug`='".$slug."'");
if (mysqli_num_rows($sql) < 1) {
echo '<script>location.href="/index.php";</script>';    
}
$get_info = mysqli_fetch_array($sql);
$ten_phim = $get_info['ten_phim'];
$ten_goc = $get_info['ten_goc'];
$noi_dung = $get_info['noi_dung'];
$nam_chieu = $get_info['nam_chieu'];
$quoc_gia = $get_info['quoc_gia'];
$trang_thai = $get_info['trang_thai'];
$thoi_luong = $get_info['thoi_luong'];
$bole = $get_info['bole'];
$thumb = $get_info['thumb'];
if (strpos($thumb, 'imgur.com') == true)  {
$thumb = str_replace('.jpg', 'l.jpg', $get_info['thumb']);
}
?>

<title><?php echo $ten_phim;?> - <?php echo $ten_goc;?> Vietsub, Thuyết Minh</title>
<meta name="description" content="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>" />
<link rel="canonical" href="###" />
<meta property="og:title" content="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>" />
<meta property="og:description" content="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>" />
<meta property="og:url" content="###" />
<meta property="og:image" content="<?php echo $thumb;?>" />
  

<div class="ah_content">
<div class="info-movie">

    <h1 class="heading_movie"><font color="yellow"><?php echo $ten_phim; ?></font></h1>
    <div class="head ah-frame-bg">
        <div class="first">
            <img src="<?php echo $thumb; ?>" alt="<?php echo $ten_phim; ?>" />
        </div>
        <div class="last">
                            <div class="name_other">
                    <div>Tên Khác</div>
                    <div><?php echo $ten_goc; ?></div>
                </div>
            <div class="status">
                <div>Trạng Thái</div>
                <div>Tập <?php echo $trang_thai; ?></div>
            </div>    
            <div class="list_cate">
                <div>Thể Loại</div>
                <div>Updating</div>
            </div>
            <div class="score">
                <div>Điểm</div>
                <div>
                    9.1 || 1906 đánh giá                </div>
            </div>
            <div class="update_time">
                <div>Phát Hành</div>
                <div><?php echo $nam_chieu; ?></div>
            </div>
            <div class="duration">
                <div>Lượt Xem</div>
                <div><?php $view = './view/'.$slug.'.php'; echo $view1 = file_get_contents($view) + mt_rand(1, 9); $myfile2 = fopen($view, "w"); fwrite($myfile2, $view1); fclose($myfile2); ?></div>
            </div>
        </div>
    </div>
    <div class="flex ah-frame-bg flex-wrap">
        <div class="flex flex-wrap flex-1">
            
            <a href="<?php echo '/'.$slug; ?>.html" class="padding-5-15 fs-35 button-default fw-500 fs-15 flex flex-hozi-center bg-lochinvar" title="Xem Ngay"><span class="material-icons-round">play_circle_outline</span></a>
            <a href="javascript:void(0)" id="toggle_follow" class="bg-green padding-5-15 fs-35 button-default fw-500 fs-15 flex flex-hozi-center" title="Theo dõi phim này"><span class="material-icons-round">bookmark_add</span></a>
        </div>
    </div>

        <div class="body">
        <div class="list_episode ah-frame-bg">
            <div class="heading flex flex-space-auto fw-700">
                <span>Danh Sách Tập</span>
                <span id="newest-ep-is-readed" class="fs-13"></span>
            </div>
            <div class="list-item-episode scroll-bar">

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
$get_list = explode('<br/>', $list_sv);
foreach ($get_list as $get_list) {
if (strpos($get_list, '|') == true) {    
$list_tap = explode("|", $get_list)['0'];
echo '<a href="/'.$slug.'/tap-'.$list_tap.'.html" title="Tập '.$list_tap.'"><span>'.$list_tap.'</span></a>';
}}
} else {
$sql10 = mysqli_query($apizophim, "SELECT tap FROM VIP where `slug`='".$slug."' order by ABS(tap)");
while($qsql10 = mysqli_fetch_array($sql10)){
$list_tap = $qsql10['tap'];
echo '<a href="/'.$slug.'/tap-'.$list_tap.'.html" title="Tập '.$list_tap.'"><span>'.$list_tap.'</span></a>';
} }
?>

            </div>
        </div>
        <div class="desc ah-frame-bg">
            <div>
                <h2 class="heading">
                    Nội Dung
                </h2>
            </div>
            <a href="https://hh3d.xyz"><font color="yellow">HH3D.xyz</font></a> giới thiệu bộ phim <?php echo $noi_dung; ?>
        </div>
    </div>


</div>


<script>
localStorage.setItem('<td><a href="/<?php echo $slug; ?>.html"><img width="20px" src="<?php echo $thumb; ?>"/></a></td><td><a href="/<?php echo $slug; ?>.html"><?php echo $ten_phim; ?><br/><?php echo $ten_goc; ?></a></td>', '<?php echo date("l jS F Y h:i:s A"); ?>');  
</script>
<?php
include 'includes/footer.php';
?>
