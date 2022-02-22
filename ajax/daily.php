<?php
    include ("ajax_config.php");

    $d->reset();
    $sql = "select * from #_bando where hienthi=1 order by stt asc,id desc";
    $d->query($sql);
    $daily = $d->result_array();
?>
<p class="tieudedaily">DANH SÁCH ĐẠI LÝ TẠI <?=$company['ten']?></p>
<div class="baodaily">
    <?php if(count($daily)>0){ foreach($daily as $v){ ?> 
        <div class="item_cn">
            <a class="img" href="<?=$v['code_bando']?>" title="<?=$v['ten']?>"><img src="thumb/250x175/1/<?php if($v['photo']!='') echo _upload_khac_l.$v['photo']; else echo 'images/no.png'; ?>" alt="<?=$v['ten']?>"/></a>
            <div class="ttcn">
                <a class="ten" href="<?=$v['code_bando']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a>
                <p class="cn"><i class="fa fa-map-marker" aria-hidden="true"></i><?=$v['diachi']?></p>
                <p class="cn"><i class="fa fa-phone" aria-hidden="true"></i><?=$v['dienthoai']?></p>
                <p class="cn"><i class="fa fa-envelope-o" aria-hidden="true"></i><?=$v['email']?></p>
            </div>
        </div>
    <?php }} ?>
</div>
<style type="text/css">
    .fancybox-slide > div{max-width: 100%;padding: 0 20px;}
    .fancybox-close-small{width: 30px;height: 30px;background: #fff;}
    .fancybox-close-small:after{top: 0px;right: 0px;}
    @media (max-width: 768px){
        .fancybox-slide > div{padding:0 10px;}
    }
</style>