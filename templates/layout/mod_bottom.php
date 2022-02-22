<div class="mod_bottom khung flexwb">
    <div class="content_tintuc">
        <h2 class="tieude_tintuc"><?=_tintuc?></h2>
        <div class="flexwb">
            <?php if(count($row_tintuc)>0){ foreach($row_tintuc as $v){?>
                <div class="tintuc_1">
                    <a class="img" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><img src="thumb/360x198/1/<?php if($v['photo']!='') echo _upload_sanpham_l.$v['photo']; else echo 'images/no.png'; ?>" alt="<?=$v['ten']?>"/></a>
                    <h3><a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                    <p class="mota text_catchuoi"><?=$v['mota']?></p>
                    <a class="xemthem" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=_xemthem?></a>
                </div>
            <?php break; }}?>
            <div class="tintuc_conlai">
            <?php if(count($row_tintuc)>0){
                foreach($row_tintuc as $k=>$v){
                if($k>0){
            ?>
                <div class="item_ttcl clear">
                    <a class="img" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><img src="thumb/150x110/1/<?php if($v['photo']!='') echo _upload_sanpham_l.$v['photo']; else echo 'images/no.png'; ?>" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" /></a>
                    <h3><a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                    <p class="mota text_catchuoi"><?=$v['mota']?></p>
                </div>
            <?php }}} ?>
            </div>
        </div>
    </div>

	<div class="mod_video">
        <h2 class="tieude_tintuc">Video clip</h2>
        <div id="video"></div>
    </div>
</div>