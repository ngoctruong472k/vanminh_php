<div class="khung_chay khung">
    <div class="tintuc_run content_tt">
        <?php if(count($row_tintuc)>0){ foreach($row_tintuc as $v){?>
            <div class="item_tt" >
        		<a class="img" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                    <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/280x200/1/images/no.png'; ?>" alt="<?=$v['ten']?>" />
                </a>
        		<h3><a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
        		<div class="mota text_catchuoi"><?=$v['mota']?></div>
            </div>
        <?php }} ?>
    </div>
</div>