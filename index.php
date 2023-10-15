<?php
include 'includes/header.php';
header('Cache-Control: max-age=600');
$type = $_GET['type'];
if ($type == 'TQ') { $quoc_gia = 'Trung';}
if ($type == 'NB') { $quoc_gia = 'Nhật';}
if ($type == 'AM') { $quoc_gia = 'Mỹ';}
$page = $_GET['page'];
if(!$page){ $page = 1; }
?>
<title><?php echo $slogan;?></title>
<meta name="description" content="<?php echo $description;?>" />
<link rel="canonical" href="###" />
<meta property="og:title" content="<?php echo $slogan;?>" />
<meta property="og:description" content="<?php echo $description;?>" />
<meta property="og:url" content="###" />
<meta property="og:image" content="https://media.discordapp.net/attachments/924155580124385280/1072038465899859999/zuighe4.png" />
    
<div class="ah_content">
<div class="margin-10-0 bg-gray-2 flex flex-space-auto">
    <div class="fs-17 fw-700 padding-0-20 color-gray inline-flex height-40 flex-hozi-center bg-black border-l-t">
        Mới cập nhật
    </div>
    <div class="margin-r-5 fw-500">
        <a href="/index.php?type=TQ" class="bg-blue padding-5-10 border-default">Trung Quốc</a>
        <a href="/index.php?type=NB" class="bg-red padding-5-10 border-default">Nhật Bản</a>
        <a href="/index.php?type=AM" class="bg-green padding-5-10 border-default">Âu Mỹ</a>
    </div>
</div>
<div class="movies-list ah-frame-bg">
<?php 
$sodu_lieu = mysqli_query($apizophim, "SELECT * FROM phim WHERE `quoc_gia` like '%$quoc_gia%'");
$sodu_lieu = mysqli_num_rows($sodu_lieu);
$baitren_mottrang = 30;
$sotrang = ceil($sodu_lieu/$baitren_mottrang);
$dau = ($page-1)*$baitren_mottrang;
$cuoi = $baitren_mottrang;
$result = mysqli_query($apizophim, "SELECT * FROM phim WHERE `quoc_gia` like '%$quoc_gia%' order by time DESC limit  $dau, $cuoi");
while($qsql4 = mysqli_fetch_array($result)) {
$ten_phim = $qsql4['ten_phim'];
$ten_goc = $qsql4['ten_goc'];
$slug = $qsql4['slug'];
$trang_thai = $qsql4['trang_thai'];
$nam_chieu = $qsql4['nam_chieu'];
$quoc_gia = $qsql4['quoc_gia'];
$view = $qsql4['view'];
$thumb = str_replace('.jpg', 'l.jpg', $qsql4['thumb']);
?>    
        <div class="movie-item">
            <a href="/<?php echo $slug;?>.html" title="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>">
                <div class="episode-latest"> <span><?php echo $trang_thai;?></span>
                </div>
                <div>
                    <img src="<?php echo $thumb;?>" alt="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>" />
                </div>
                <div class="score"><?php $view = './view/'.$slug.'.php'; echo number_format(file_get_contents($view), 0, '', '.'); ?></div>
                <div class="name-movie"><?php echo $ten_phim;?></div>
            </a>
        </div>
<?php } ?>            
</div>

<div class="pagination">
<a href="/index.php">Đầu</a>
<a href="/index.php?page=<?php if ($page > 1) { echo $page - 1; } else { echo '1'; }?>&type=<?php echo $type; ?>">Trước</a>
<a href="#"  class="active_page"><?php if ($page > 1) { echo $page; } else { echo '1'; }?></a>
<a href="/index.php?page=<?php if ($page > 1) { echo $page + 1; } else { echo '2'; }?>&type=<?php echo $type; ?>">Sau</a>
</div>
            
<?php
include 'includes/footer.php';
?>
