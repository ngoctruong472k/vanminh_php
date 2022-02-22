<div class="sub_main clearfix">
  <div class="lb_main clearfix">
    <h3><?=$title_detail?></h3>
  </div>
  <div class="cont_main clearfix">
    <?php if(count($tintuc)!=0){?>
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
  <?php }else{?>
    <p><?=_updating?></p>
  <?php }?>

  </div>
</div>
<?php if($paging['paging']!=""){?>
 <div align="center" ><div class="paging"><?=$paging?></div></div>
<?php }?>