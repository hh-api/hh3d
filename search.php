<?php
include 'includes/header.php';
$s = $_GET['s'];
$s2  = str_replace(" ", "-", $s);
$trang = $_GET['trang'];
if(!$trang){ $trang = 1; }
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
        <a href="/index.php?type=NB" class="bg-red padding-5-10 border-default">Nhật Bản</a>
        <a href="/index.php?type=TQ" class="bg-blue padding-5-10 border-default">Trung Quốc</a>
    </div>
</div>
<div class="movies-list ah-frame-bg">
<?php 
$sodu_lieu = mysqli_query($apizophim, "SELECT id FROM phim where ten_phim like '%$s%' or slug like '%$s2%' or dien_vien like '%$s%' or ten_goc like '%$s%'");
$sodu_lieu = mysqli_num_rows($sodu_lieu);
$baitren_mottrang = 40;
$sotrang = ceil($sodu_lieu/$baitren_mottrang);
$dau = ($trang-1)*$baitren_mottrang;
$cuoi = $baitren_mottrang;
$result = mysqli_query($apizophim, "SELECT id,ten_phim,ten_goc,quoc_gia,nam_chieu,thumb,slug,trang_thai,thoi_luong,view,bole FROM phim where ten_phim like '%$s%' or slug like '%$s2%' or dien_vien like '%$s%' or ten_goc like '%$s%' order by time DESC limit $dau, $cuoi");
while($qsql4 = mysqli_fetch_array($result)) {
$ten_phim = $qsql4['ten_phim'];
$ten_goc = $qsql4['ten_goc'];
$slug = $qsql4['slug'];
$bole = $qsql4['bole'];
$trang_thai = $qsql4['trang_thai'];
$thoi_luong = $qsql4['thoi_luong'];
$nam_chieu = $qsql4['nam_chieu'];
$quoc_gia = $qsql4['quoc_gia'];
$view = $qsql4['view'];
$thumb = str_replace('.jpg', 'l.jpg', $qsql4['thumb']);
?>    
        <div class="movie-item" id="movie-id-3755">
            <a href="/<?php echo $slug;?>.html" title="<?php echo $ten_phim;?> - <?php echo $ten_goc;?>">
                <div class="episode-latest"> <span><?php echo $trang_thai;?></span></div>
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
<a href="/search.php?s=<?php echo $s; ?>&trang=<?php if ($trang > 1) { echo $trang - 1; } else { echo '1'; }?>">Trước</a>
<a href="#"  class="active_page"><?php if ($trang > 1) { echo $trang; } else { echo '1'; }?></a>
<a href="/search.php?s=<?php echo $s; ?>&trang=<?php if ($trang > 1) { echo $trang + 1; } else { echo '2'; }?>">Sau</a>
</div>
            
<?php
include 'includes/footer.php';
?>
