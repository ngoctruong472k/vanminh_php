<div class="content chitietbaiviet">
    <div class="mota_baiviet">
        <h1 class="ten_baiviet"><?=$title_cat?></h1>
        <div class="info_tintuc">
            <span class="ngaytao" style="font-family: arial"><?=_dangboi?>: <b>Admin</b> <?=_luc?> <?=date('h:m - d/m/Y',$row_detail['ngaytao'])?> | <?=_luotxem?>: 
                <?=$row_detail['luotxem']?></span>
        </div>
        <div class="mota" style="display: none;"><?=$row_detail['mota']?></div>
        <?php if(count($hinhthem)>0){?>
        <div class="album_congtrinh" style="padding:20px 0;">
            <div class="fotorama" data-width="900" data-ratio="900/460" data-max-width="100%" data-nav="thumbs" data-allowfullscreen="true" data-fit="contain">
                <?php foreach($hinhthem as $v){?>
                    <img src="<?=_upload_hinhthem_l.$v['photo']?>" alt="<?=$v['ten']?>"/>
                <?php } ?>
            </div>
        </div>
        <?php }?>
    </div>
    <div class="content_text baonoidung clear">
        <?=$row_detail['noidung']?>
    </div>

    <?php if(count($arr_tags)>0) { ?>
    <div class="tags"><span><i class="fa fa-tags"></i> Tags:</span>
        <?php foreach($arr_tags as $k=>$v){
            $tags_sp = Get_Tags('tags','id',$v);
            if($tags_sp['ten']!=''){
        ?>
            <a href="tag/<?=$tags_sp['tenkhongdau']?>-<?=$tags_sp['id']?>" title="<?=$tags_sp['ten']?>"><?=$tags_sp['ten']?></a>
        <?php }} ?>
    </div>
    <?php } ?>
    <div class="clear div_mxh">
        <a class="zalo-share-button zalo_share" data-href="<?=getCurrentPageURL_CANO()?>" data-oaid="3045141640417367223" data-layout="icon-text" data-customize="true"><span class="ti-zalo"></span>Zalo</a>
        <!-- <a class="zalo-follow-only-button zalo_share" data-href="<?=getCurrentPageURL_CANO()?>" data-oaid="579745863508352884" data-layout="icon-text" data-customize="true"><span class="ti-zalo"></span>Quan tâm</a> -->
        <div class="addthis_native_toolbox"></div>
    </div>
    <?php if(count($productth)>0){ ?>
    <div class="w_product">
        <?php foreach($productth as $k=>$v){?>
            <div class="item_sp animated fadeInUp wow delayp<?=$k+1?>">
                <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                    <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
                <?php }?>
                <?php if($v['spbanchay']==1){?>
                    <span class="sale"><img src="images/img/sale.png" alt="<?=$v['ten']?>"></span>
                <?php }?>
                <div class="img">
                    <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                        <img data-src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/440x450/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" />
                    </a>
                </div>
                <h3><a class="ten" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                <p class="gia">
                    <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                    <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                    <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                    <?php } ?>
                </p>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if(count($product) > 0) { ?>
        <div class="othernews">
            <div class="cactinkhac"><?=$title_link?> <?=_lienquan?></div>
            <ul class="khac">
                <?php foreach($product as $v){ ?>
                    <li>
                        <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                            <?=$v['ten']?> <span>(<?=date('d/m/Y',$v['ngaytao'])?>)</span>
                        </a>
                    </li>
                <?php }?>
            </ul>
            <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
        </div>
    <?php }?>
</div>