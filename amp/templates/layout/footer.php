<div class="baotieuchi">
    <div class="row_tieuchi khung flexwba">
        <?php if(count($mxh_ft3)>0){ foreach($mxh_ft3 as $k => $v){ if($k<4){ ?>
        <div class="item_tc">
            <p class="img">
            	<amp-img width="52" height="45" layout="responsive"  src="/<?php if($v['photo']!='') echo _upload_khac_l.$v['photo']; else echo 'thumb/52x45/1/images/no.png'; ?>" alt="<?=$v['ten']?>" class="lazy" ></amp-img>
 
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
<footer id="wrap_footer" class="clearfix">
	<div class="noidung_ft clearfix">
		<div id="content_footer">
			 <?=ampify($row_footer['noidung'])?>
			  
		</div>
		<div class="">
			 <?=ampify($row_footer['mota'])?>
			<ul class="info_">
				<?php foreach ((array)$cs as $key => $value) {?>
				<li><a href="/<?=$v['tenkhongdau']?>"><?=$v['ten']?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="">
			 <p class="copy">Copyright © <?=date('Y',time())?> <span><?=$company['yahoo']?></span>. All rights reserved. Design by <a href="https://nina.vn/">NiNa Co., Ltd</a></p>

			 <p class="tk"><?=_dangonline?>: <b><?php $count=count_online();echo $tong_xem=$count['dangxem'];?></b><span>|</span><?=_ngay?>: <b><?=$homnay;?></b><span>|</span><?=_thang?>: <b><?=$trongthang;?></b><span>|</span><?=_tongtruycap?>: <b><?php $count=count_online();echo $tong_xem=$count['daxem'];?></b></p>

		</div>
	</div>
</footer>

<div class="hotline-phone-ring-wrap">
  <div class="hotline-phone-ring">
    <div class="hotline-phone-ring-circle"></div>
    <div class="hotline-phone-ring-circle-fill"></div>
    <div class="hotline-phone-ring-img-circle">
      <a href="tel:<?=preg_replace('/[^0-9]/','',$company['dienthoai'])?>" class="pps-btn-img">
        <amp-img width="20" height="20"  src="/images/calls.png"  ></amp-img>
      </a>
    </div>
  </div>
  <div class="hotline-bar">
    <a href="tel:<?=preg_replace('/[^0-9]/','',$company['dienthoai'])?>">
      <span class="text-hotline"><?=$company['dienthoai']?></span>
    </a>
  </div>
</div>