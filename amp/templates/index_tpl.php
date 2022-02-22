<?php
	 
?>

<?php if(count($product)>0){ ?>
<div id="info">
	<div id="sanpham">
		<div class="flexwba baotieude">  <h2> KHUYẾN MÃI HOT </h2> </div>
		 
		<div class="box_sanpham">
			<?php foreach($product as $k=>$v){ if($k<10){?>
			    <div class="item_sp">
			        <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
			            <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
			        <?php }?>
			        <?php if($v['spbanchay']==1){?>
			            <span class="sale"><amp-img width="78" height="25"  src="/images/img/sale.png"  ></amp-img></span>
			        <?php }?>
			        <div class="img">
			            <a href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
			                <amp-img width="440" height="450" layout="responsive"  src="/<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/440x450/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" ></amp-img>
			            </a>
			        </div>
			        <h3><a class="ten" href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
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

<?php if(count($productdm)>0){ foreach($productdm as $k => $val){
		 

		$pro_danhmuc = List_SanPhamTheoDanhMuc("*,ten$lang as ten,mota$lang as mota, tenkhongdau$lang as tenkhongdau",$val['type'],$val['id']);
?>
<div id="info">
	<div id="sanpham">
		<div class="flexwba baotieude">  <h2> <?=$val['ten']?> </h2> </div>
		 
		<div class="box_sanpham">
			<?php if(count($pro_danhmuc)>0){ foreach($pro_danhmuc as $k=>$v){ if($k<8){ ?>
			    <div class="item_sp">
			        <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
			            <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
			        <?php }?>
			        <?php if($v['spbanchay']==1){?>
			            <span class="sale"><amp-img width="78" height="25"  src="/images/img/sale.png"  ></amp-img> </span>
			        <?php }?>
			        <div class="img">
			            <a href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
			                <amp-img width="440" height="450" layout="responsive"  src="/<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/440x450/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" ></amp-img>
			            </a>
			        </div>
			        <h3><a class="ten" href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
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
<!-- info -->
<?php }} ?>
 