<?php if($com=='tim-kiem'){ ?>
<h1 class="tieude_giua"><?=_timkiemchotukhoa?> <span style="text-transform: none;">'<?=$tukhoa?>'</span></h1>
<?php } else { ?>
<h1 class="tieude_giua"><?=$title_cat?></h1>
<?php } ?>
<div class="w_product">
    <?php if(count($product)>0){ foreach($product as $k=>$v){?>
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
    <?php }} ?>
</div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>