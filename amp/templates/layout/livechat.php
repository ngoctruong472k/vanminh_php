<?php if($check || $check2){?>
<?php }else{?>
<?php if($setting->getSetting("livechat")!=""){?>
<div id="livechat" class="clearfix">
	<?=$setting->getSetting("livechat")?>
</div>
<?php }?>
<?php }?>