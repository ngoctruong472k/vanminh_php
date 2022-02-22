<?php 
	$d->reset();
	$sql= "select a.id,a.photo,a.link,l.ten from #_photo as a, #_photo_lang as l where a.hienthi=1 and a.com='doitac' and a.id=l.id_photo and l.lang='".$lang."' order by stt asc, id desc";
	$d->query($sql);
	$partner = $d->result_array();
?>
<?php if(count($partner)!=0){?>
<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3>Đối tác</h3>
  </div>
  <div class="cont_main clearfix">
    <amp-carousel  id="caroul2" height="115" layout="fixed-height" type="carousel">
    <?php foreach ($partner as $key => $value) {?>
    	<a href="<?=$value['link']?>" target="_blank" rel="nofollow">
	    <amp-img src="thumb/125x115/2/<?=_upload_hinhanh_l.$value['photo']?>" width="125" height="115"></amp-img>
	    </a>
	<?php }?>
	</amp-carousel>
  </div>
</div>
<?php }?>
<a class="hotline_bot clearfix" href="tel:<?=$setting->getSetting("hotline")?>"><i class="fa fa-phone"></i> Gọi ngay : <?=$setting->getSetting("hotline")?></a>