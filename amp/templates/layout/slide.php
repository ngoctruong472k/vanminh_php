 
<amp-carousel width="1366" height="690" layout="responsive" delay="3000" autoplay type="slides">
<?php foreach ($slider as $key => $value) {?>
<amp-img srcset="thumb/1920x637/1/<?=_upload_hinhanh_l.$value['photo']?>" width="1920" height="637" layout="responsive"></amp-img>
<?php }?>
</amp-carousel>

