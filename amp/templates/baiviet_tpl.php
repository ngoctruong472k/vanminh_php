<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3><?=$title_cat?></h3>
  </div>
  <div class="cont_main clearfix">
    <?php if(count($baiviet)!=0){?>
    <?php foreach ($baiviet as $key => $value) {?>
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
  <?php }else{?>
    <p><?=_dangcapnhat?></p>
  <?php }?>

  </div>
</div>
<?php if($paging['paging']!=""){?>
<div class="wrap_paging">
    <div class="paging clearfix"><?=$paging['paging']?></div>
</div>
<?php }?>