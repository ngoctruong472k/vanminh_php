<?php if(count($quangc0)>0){ ?>
<div class="quangc0">
    <div class="khung_chay khung">
        <div class="baoqc">
        <?php foreach($quangc0 as $k=>$v){?>
            <div class="item_qc" onclick="window.location.href='<?=$v['link']?>'">
                <a class="img hieuung" title="<?=$v['ten']?>">
                    <img data-src="thumb/581x204/1/<?php if($v['photo']!='') echo _upload_hinhanh_l.$v['photo']; else echo 'images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" />
                </a>
                <a class="ten" title="<?=$v['ten']?>"><?=$v['ten']?><span></span></a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if(count($product_danhmuc)>0){ ?>
<div class="danhmucht khung_chay">
    <div class="khung">
        <h2 class="tieude_giua">Danh mục sản phẩm</h2>
        <div class="product_run">
        <?php foreach($product_danhmuc as $k=>$v){ ?>
            <div class="item_dm">
                <div class="img">
                    <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                        <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/250x250/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" />
                    </a>
                </div>
                <h3><a class="ten" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
            </div>
        <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if(count($product)>0){ ?>
<div class="spnoibat khung_chay">
    <div class="khung">
        <div class="flexwba baotieude">
            <h2><a href="khuyen-mai-hot">KHUYẾN MÃI HOT</a></h2>
            <a href="khuyen-mai-hot" class="them">Xem thêm >></a>
        </div>
        <div class="w_product">
        <?php foreach($product as $k=>$v){ if($k<10){?>
            <div class="item_sp">
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
        <?php }} ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if($row_banner1['photo']!='' && $row_banner2['photo']!='') { ?>
    <div class="khung baoqctc flexwb">
        <a href="<?=$row_banner1['link']?>" class="banner1 hieuung" title="<?=$seo['alt']?>">
            <img src="thumb/590x206/1/<?=_upload_hinhanh_l.$row_banner1['photo'];?>" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>" />
        </a>
        <a href="<?=$row_banner2['link']?>" class="banner1 hieuung" title="<?=$seo['alt']?>">
            <img src="thumb/590x206/1/<?=_upload_hinhanh_l.$row_banner2['photo'];?>" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>" />
        </a>
    </div>
<?php } ?>
<?php if(!isGoogleSpeed()){?>
    <div class="baosp clear">
    <?php if(count($productdm)>0){ foreach($productdm as $k => $val){
        $pro_danhmuc = List_SanPhamTheoDanhMuc("*,ten$lang as ten,mota$lang as mota, tenkhongdau$lang as tenkhongdau",$val['type'],$val['id']);
    ?>
    <div class="danhmucsp">
        <div class="khung khung_chay">
            <div class="flexwba baotieude">
                <h2><a href="<?=$val['tenkhongdau']?>"><?=$val['ten']?></a></h2>
                <a href="<?=$val['tenkhongdau']?>" class="them">Xem thêm >></a>
            </div>
            <div class="flexwb baokhungdm">
                <div class="baohinhdm">
                    <a href="<?=$val['link']?>" class="hinhdm hieuung" title="<?=$v['ten']?>">
                        <img src="thumb/230x313/1/<?php if($val['photo1']!='') echo _upload_sanpham_l.$val['photo1']; else echo 'images/no.png';?>" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" />
                    </a>
                    <a href="<?=$val['link']?>" class="hinhdm hieuung" title="<?=$v['ten']?>">
                        <img src="thumb/230x313/1/<?php if($val['photo2']!='') echo _upload_sanpham_l.$val['photo2']; else echo 'images/no.png';?>" alt="<?=$v['ten']?>" title="<?=$v['ten']?>" />
                    </a>
                </div>
                <div class="baospdm">
                    <div class="w_product">
                        <?php if(count($pro_danhmuc)>0){ foreach($pro_danhmuc as $k=>$v){ if($k<8){ ?>
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
                        <?php }}} ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }}?>
    </div>
    <div class="row_thuonghieu khung">
        <h2 class="tieudetc">THƯƠNG HIỆU SẢN PHẨM PHÂN PHỐI</h2>
        <p class="sltc"><?=$company['slogan1']?></p>
        <div class="chayth">
        <?php if(count($thuonghieu)>0){ foreach($thuonghieu as $k=>$v){ ?>
            <div class="item_th">
                <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                    <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/185x90/1/images/no_img.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>"/>
                </a>
            </div>
        <?php }} ?>
        </div>
    </div>
    <div class="row_tintuc khung khung_chay">
        <h2 class="tieudetc">KIẾN THỨC THỂ THAO</h2>
        <p class="sltc"><?=$company['slogan2']?></p>
        <div class="tintuc_run">
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
    </div>
    <div class="baotieuchi">
        <div class="row_tieuchi khung flexwba">
            <?php if(count($mxh_ft3)>0){ foreach($mxh_ft3 as $k => $v){ if($k<4){ ?>
            <div class="item_tc">
                <p class="img">
                    <img src="<?php if($v['photo']!='') echo _upload_khac_l.$v['photo']; else echo 'thumb/52x45/1/images/no.png'; ?>" alt="<?=$v['ten']?>" />
                </p>
                <p class="tttc">
                    <span class="ten"><?=$v['ten']?></span>
                    <span class="mota"><?=$v['mota']?></span>
                </p>
            </div>
            <span class="cachtc"></span>
            <?php }}} ?>
        </div>
    </div>
<?php } ?>