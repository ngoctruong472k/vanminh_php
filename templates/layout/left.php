<div class="danhmucct">
    <div class="tieude"><?=_danhmucsanpham?></div>
    <?php if(count($product_danhmuc)>0){?>
    <div class="danhmucl danhmuc">
        <?php if(count($product_danhmuc)>0){?>
            <ul id="accordion-1">
                <?php foreach($product_danhmuc as $v){ 
                    $product_list = List_DanhMucCap2("product_list","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$v['type'],$v['id']);
                ?>
                <li>
                    <a href="<?=$v['tenkhongdau']?>" >
                        <?=$v['ten']?>
                    </a>
                    <?php if(count($product_list)>0){?>
                    <span class="clickht"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <?php }?>
                    <?php if(count($product_list)>0){?>
                    <ul>
                        <?php foreach($product_list as $k){ 
                            $product_cat = List_DanhMucCap3("product_cat","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$k['type'],$k['id']);
                        ?>
                            <li>
                                <a href="<?=$k['tenkhongdau']?>" >
                                    <?=$k['ten']?>
                                </a>
                                <?php if(count($product_cat)>0){?>
                                <span class="clickht"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                <?php }?>
                                <?php if(count($product_cat)>0){?>
                                    
                                    <ul>
                                        <?php foreach($product_cat as $val){ ?>
                                            <li>
                                                <a href="<?=$val['tenkhongdau']?>">
                                                    <?=$val['ten']?>
                                                </a>
                                            </li>
                                        <?php }//?>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php }?>
                </li>
                <?php } ?>
            </ul>
        <?php }?>
    </div>
    <?php }?>
</div>
<?php if(count($productm)>0){ ?>
<div class="danhmucct">
    <div class="tieude"><?php if($template=='product_detail' || $template=='product') { ?>Sản phẩm bán chạy <?php } else { ?><?=$title_link?> <?=_noibat?><?php } ?></div>
    <div <?php if(count($productm)>4){ ?> id="tinmoi" <?php } else { ?> id="tinmoi1" <?php } ?>>
        <?php foreach($productm as $v){ ?>
            <div class="item_ttnb">
                <a class="img" href="<?=$v['tenkhongdau']?>"><img src="thumb/100x80/1/<?=_upload_sanpham_l.$v['thumb']?>" onerror="this.src='//placehold.it/100x80';" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" /></a>
                <div class="tttt">
                    <a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a>
                    <?php if($template=='product_detail' || $template=='product') { ?>
                        <p class="gia">
                            <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                            <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                            <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                            <?php } ?>
                        </p>
                    <?php } else { ?> 
                        <p class="mota text_catchuoi"><?=$v['mota']?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if(count($productbc)>0){ ?>
<div class="danhmucct">
    <div class="tieude">KHUYẾN MÃI HOT</div>
    <div <?php if(count($productbc)>4){ ?> id="tinmoi" <?php } else { ?> id="tinmoi1" <?php } ?>>
        <?php foreach($productbc as $v){ ?>
            <div class="item_ttnb">
                <a class="img" href="<?=$v['tenkhongdau']?>"><img src="thumb/100x80/1/<?=_upload_sanpham_l.$v['thumb']?>" onerror="this.src='//placehold.it/100x80';" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" /></a>
                <div class="tttt">
                    <a class="ten text_catchuoi" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a>
                    <p class="gia">
                        <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                        <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                        <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                        <?php } ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php if(count($quangcao2)>0){ ?>
<div class="danhmucct danhmucctqc">
    <?php foreach($quangcao2 as $v){ ?>
        <a class="hinhqc" href="<?=$v['link']?>"><img src="<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" /></a>
    <?php } ?>
</div>
<?php } ?>