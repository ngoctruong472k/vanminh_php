<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3>
      <?=$row_detail['ten_'.$lang]?>
    </h3>
  </div>
  <div class="cont_main clearfix">
    <?php /*
	  <h3 class="label_postDetail clearfix"><?=$row_postDetail['ten_'.$lang]?></h3>
		<div class="des_postDetail clearfix"><?=$row_postDetail['mota']?></div>
    */?>
		<div class="cont_postDetail clearfix"><?=check_ssl_content(ampify($row_detail["noidung_$lang"]))?></div>
		<div id="social">
            <amp-social-share type="twitter" width="30" height="22"></amp-social-share>
            <amp-social-share type="facebook" width="30" height="22" data-attribution=254325784911610></amp-social-share>
            <amp-social-share type="gplus" width="30" height="22"></amp-social-share>
            <amp-social-share type="email" width="30" height="22"></amp-social-share>
        </div>
		 
  </div>
</div>
<?php if(count($tintuc)!=0){?>
<div class="sub_main clearfix">
    <div class="lb_main clearfix">
        <h3>Bài viết cùng danh mục</h3>
    </div>
    <div class="cont_main clearfix">
        <?php foreach ($tintuc as $key => $value) {?>
          <div class="item_post clearfix">
            <a href="/amp/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="img_post">
              <amp-img srcset="/<?=_upload_baiviet_l?>360x330x1/<?=$value['thumb']?>" width="75" height="75"></amp-img>
            </a>
            <div class="des_post clearfix">
                <a href="/amp/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="label_post transfor"><?=$value['ten_'.$lang]?></a>
                <p><?=catchuoi($value["mota_vi"],100)?></p>
                <a href="/amp/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="btn_post"><?=$lang_arr["xemthem"]?></a>
            </div>
          </div>
        <?php }?>
    </div>
</div>
<?php }?>