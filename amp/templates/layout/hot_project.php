<?php 
	$d->reset();
	$sql= "select a.id,a.photo,l.ten,l.tenkhongdau from #_post as a, #_post_lang as l where a.hienthi=1 and a.noibat<>0 and a.type='du-an' and a.id=l.id_post and l.lang='".$lang."' order by stt asc, id desc";
	$d->query($sql);
	$hotProject = $d->result_array();
?>
<?php if(count($hotProject)!=0){?>
<style>
	.owl-theme .owl-controls {
	    width: 100%;
	}
	.owl-theme .owl-controls .owl-nav .owl-prev {
		position: absolute!important;
		top: 50%;
		margin-top: -14px!important;
		left: -30px;
		background: url('images/arrow_left.png') no-repeat left top !important;
		width: 21px!important;
		height: 37px!important;
		text-indent: -999px!important;
		overflow: hidden!important;
		padding: 0px!important;
	}
	.owl-theme .owl-controls .owl-nav .owl-next {
		position: absolute!important;
		top: 50%;
		margin-top: -14px!important;
		right: -30px;
		background: url('images/arrow_right.png') no-repeat left top !important;
		width: 21px!important;
		height: 37px!important;
		text-indent: -999px!important;
		overflow: hidden!important;
		padding: 0px!important;
	}
</style>
<div id="doitac_box" class="clearfix">
	<h3><?=_duantieubieu?></h3>
	<div id="wrap_carorl" class="clearfix">
		<div id="caroul2" class="owl-carousel">
		<?php foreach ($hotProject as $key => $value) {?>
		<div class="item_partner clearfix">
	      	<a href="du-an/<?=$value['tenkhongdau']?>.html" class="img_product">
	      		<img src="thumb/280x250/1/<?=_upload_post_l.$value['photo']?>" onerror="src='images/noimage.png'" alt="<?=$value['ten']?>" />
	      	</a>
	      	<a href="du-an/<?=$value['tenkhongdau']?>.html" class="label_product">
	      		<?=$value['ten']?>
	      	</a>
	        <a href="du-an/<?=$value['tenkhongdau']?>.html" class="btn_detail transfor"><?=_chitiet?> <i class="fa fa-caret-right"></i></a>
	    </div>
		<?php }?>
		</div>
	</div>
</div>
<?php }?>