<div id="wrap_bottom" class="clearfix">
	<div class="section_bottom clearfix">
		<div class="lb_bottom"><?=_thitruongxuatkhau?></div>
		<div class="cont_bottom">
			<a class="hotline_xuatkhau">
			<img src="images/img_xuatkhau.jpg" alt="<?=_thitruongxuatkhau?>" />
			<span><?=$setting->getSetting("dienthoai");?></span>
			</a>
		</div>
	</div>
	<div class="section_bottom clearfix">
		<div class="lb_bottom"><?=_thitruong?></div>
		<div class="cont_bottom">
			<div class="thitruong_box clearfix">
				<ul id="scroller">
				   	<?php foreach ($thitruong_bottom as $key => $value) {?>
			      	<li class="clearfix">
			          	<a href="thi-truong/<?=$value['tenkhongdau']?>.html" class="item_doitac clearfix">
			          	<img src="thumb/120x80/1/<?=_upload_post_l.$value['photo']?>" onerror="src='images/noimage.png'" alt="<?=$value['ten']?>" />
			          	<h3><?=$value['ten']?></h3>
			          	<span><?=$value['mota']?></span>
			          	</a>
			      	</li> 
				   	<?php }?>
				</ul>
			</div>
		</div>
	</div>
	<div class="section_bottom clearfix">
		<div class="lb_bottom"><?=_tintuc?></div>
		<div class="cont_bottom">
			<div id="owl-demo178" class="owl-carousel">
				<?php foreach ($tintuc_bottom as $key => $value) {?>
	            <a href="tin-tuc/<?=$value['tenkhongdau']?>.html" title="<?=$value['ten']?>" class="itt_newsInx">
	                <img src="thumb/380x255/1/<?=_upload_post_l.$value['photo']?>" onerror="src='images/noimage.png'" alt="<?=$value['ten']?>" />
	                <div class="panel_news">
	                	<h3><?=$value['ten']?></h3>
	                	<span><?=_substr($value['mota'],150)?></span>
	                </div>
	            </a>
				<?php }?>
	        </div>
		</div>
	</div>
</div>