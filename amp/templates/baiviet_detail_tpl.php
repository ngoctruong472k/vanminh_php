<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3>
      <?php if ($_GET["com"]=="tin-tuc") {?>  
        <?=$lang_arr["tintucnb"];?>
      <?php } else {?>  
        <?=$title_cat;?>
      <?php }?>
    </h3>
  </div>
  <div class="cont_main clearfix">
    <?php /*
	  <h3 class="label_postDetail clearfix"><?=$row_postDetail['ten']?></h3>
		<div class="des_postDetail clearfix"><?=$row_postDetail['mota']?></div>
    */?>
		<div class="cont_postDetail clearfix"><?=ampify($row_detail["noidung_$lang"])?></div>
		<div id="social">
            <amp-social-share type="twitter" width="30" height="22"></amp-social-share>
            <amp-social-share type="facebook" width="30" height="22" data-attribution=254325784911610></amp-social-share>
            <amp-social-share type="gplus" width="30" height="22"></amp-social-share>
            <amp-social-share type="email" width="30" height="22"></amp-social-share>
        </div>
		<!-- <div class="comment_box clearfix">
      <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-colorscheme="light" data-width="100%" ></div>
                <style>.fb-comments, .fb-comments iframe[style], .fb-like-box, .fb-like-box iframe[style] {width: 100% !important;}
                .fb-comments span, .fb-comments iframe span[style], .fb-like-box span, .fb-like-box iframe span[style] {width: 100% !important;}
                </style>
    </div> -->
  </div>
</div>
<?php if(count($baiviet_khac)!=0){?>
<div class="sub_main clearfix">
    <div class="lb_main clearfix">
        <h3><?=$lang_arr["cacbaivietkhac"]?></h3>
    </div>
    <div class="cont_main clearfix">
        <?php foreach ($baiviet_khac as $key => $value) {?>
          <div class="item_post clearfix">
            <a href="/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="img_post">
              <amp-img srcset="/<?=_upload_baiviet_l.$value['thumb']?>" width="75" height="75"></amp-img>
            </a>
            <div class="des_post clearfix">
                <a href="/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="label_post transfor"><?=$value['ten']?></a>
                <p><?=catchuoi($value["mota"],100)?></p>
                <a href="/<?=$com?>/<?=$value["tenkhongdau"]?>.html" class="btn_post"><?=$lang_arr["xemthem"]?></a>
            </div>
          </div>
        <?php }?>
    </div>
</div>
<?php }?>