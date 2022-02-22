<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=giasearch&act=add_giasearch"><span><?=_gia?></span></a></li>
                        <li class="current"><a href="#" onclick="return false;"><?=_sua?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=giasearch&act=save_giasearch<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6><?=_sua?></h6>
		</div>		
        <ul class="tabs">
            <?php foreach ($config['lang'] as $key => $value) { ?>
            <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
            </li>
            <?php } ?>
            <li>
               <a href="#info"><?=_thongtinchung?></a>
            </li>
       </ul>
       <?php foreach ($config['lang'] as $key => $value) {
        ?>

        <div id="content_lang_<?=$key?>" class="tab_content"> 
            <div class="formRow">
                <label><?=_tenbaiviet?></label>
                <div class="formRight">
                    <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS ten<?=$key?>" value="<?=@$item['ten'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div> 

            <div class="formRow none">
                <label>Tên không dấu </label>
                <div class="formRight">
                    <input type="text" value="<?=@$item['tenkhongdau'.$key]?>" name="tenkhongdau<?=$key?>" title="Nhập tên không dấu" class="tipS" id="tenkhongdau<?=$key?>" />
                </div>
                <div class="clear"></div>
            </div>

        </div>
        <?php }?>
       <div id="info" class="tab_content">
            <div class="formRow">
                <label><?=_giatu?>: </label>
                <div class="formRight">
                    <input type="text" id="giatu" name="giatu" value="<?=@$item['giatu']?>"  title="Nhập giá" class="tipS conso" onkeypress="return OnlyNumber(event)" />
                </div>
                <div class="clear"></div>
            </div>    
            
             <div class="formRow">
                <label><?=_giaden?>: </label>
                <div class="formRight">
                    <input type="text" id="giaden" name="giaden" value="<?=@$item['giaden']?>"  title="Nhập giá" class="tipS conso" onkeypress="return OnlyNumber(event)" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
              <label><?=_hienthi?> : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
              <div class="formRight">
             
                <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                 
              </div>
              <div class="clear"></div>
            </div>                                  
       <!-- End info -->
			
			<div class="formRow">
				<div class="formRight">
                    <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
                    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                    <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
				</div>
			<div class="clear"></div>
			</div>     
		</div>
</div>  
</form>   
