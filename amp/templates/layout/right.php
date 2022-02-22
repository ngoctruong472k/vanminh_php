<?php 
	//Dịch vụ môi trường nổi bật
	$sql = "select a.photo,a.link,b.ten from #_photo as a, #_photo_lang as b where a.com='quangcao' and a.id=b.id_photo and b.lang='".$lang."' order by a.stt asc, a.id desc";
	$d->query($sql);
	$quangcaoRight = $d->result_array();
?>
<div id="right" class="clearfix">
	<div class="sub_left clearfix">
		<div class="quangcao_box invi_loading">
			<ul id="scroller">
			<?php foreach ($quangcaoRight as $key => $value) {?>
			<li><a href="<?=$value['link']?>"><img src="thumb/235x200/2/<?=_upload_hinhanh_l.$value['photo']?>" alt="<?=$value['ten']?>" /></a></li>
			<?php }?>
			</ul>
		</div>
	</div>
</div>