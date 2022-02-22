<h1 class="tieude_giua"><?=$title_cat?></h1>
<?php if($type=='thuong-hieu'){ ?>
<div class="baothuong">
<?php if(count($thuonghieu)>0){ foreach($thuonghieu as $k=>$v){ ?>
    <div class="item_th">
        <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
            <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/185x90/1/images/no_img.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>"/>
        </a>
    </div>
<?php }} ?>
</div>
<?php } else { ?>
<div class="content_tt">
        <?php if(count($row_tintuc)>0){ foreach($row_tintuc as $v){?>
            <div class="item_tt" >
                <a class="img" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                    <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/286x247/1/images/no.png'; ?>" alt="<?=$v['ten']?>" />
                </a>
                <h3><a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                <p class="ngay">
                    <span class="n"><?=make_date($v['ngaytao'],' / ','vi',true)?></span>
                    <span class="l"><?=$v['luotxem']?> Views</span>
                </p>
                <div class="mota text_catchuoi"><?=$v['mota']?></div>
                <a href="<?=$v['tenkhongdau']?>" class="them">Xem thêm >></a>
            </div>
        <?php }} ?>
    </div>
<?php } ?>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>