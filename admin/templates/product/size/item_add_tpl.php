<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=product&act=man_size<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_sanpham?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
		$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=product&act=save_size&p=<?=$_REQUEST['p']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
	

     <div class="widget">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6><?=_nhapdulieu?></h6>
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

       
        <?php foreach ($config['lang'] as $key => $value) {?>

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

        <div class="formRow">
            <div class="formRight">
            	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>

     <div id="info" class="tab_content">
        <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
        
        <div class="formRow">
          <label><?=_hienthi?> : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />

             <label><?=_thutu?>: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('product_size',$_REQUEST['type'])?>" name="stt" style="width:20px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
                <a href="index.php?com=product&act=man_size<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Do you want to exit? ')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
            </div>
            <div class="clear"></div>
        </div>

       </div>
       <!-- End info -->
 

    </div> 
</form> 