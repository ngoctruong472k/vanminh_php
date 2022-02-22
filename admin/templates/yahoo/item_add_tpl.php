<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=yahoo&act=man"><span><?=_hotrotructuyen?></span></a></li>
                        <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=yahoo&act=save<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
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

        <!-- begin: Content -->
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
       <!-- end: Content -->

       <?php } ?>

       <!-- begin: info -->
       <div id="info" class="tab_content">

	        <div class="formRow">
				<label><?=_dienthoai?></label>
				<div class="formRight">
	                <input type="text" name="dienthoai" title="Nhập số điện thoại" id="dienthoai" class="tipS " value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow">
				<label>Email</label>
				<div class="formRight">
	                <input type="text" name="email" title="Nhập địa chỉ email" id="email" class="tipS " value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow none">
				<label>Yahoo</label>
				<div class="formRight">
	                <input type="text" name="yahoo" title="Nhập nick chat yahoo" id="yahoo" class="tipS " value="<?=@$item['yahoo']?>" />
				</div>
				<div class="clear"></div>
			</div>
	        <div class="formRow none">
				<label>Skype</label>
				<div class="formRight">
	                <input type="text" name="skype" title="Nhập nick chat skype" id="skype" class="tipS " value="<?=@$item['skype']?>" />
				</div>
				<div class="clear"></div>
			</div>
            
            <div class="formRow none">
				<label>Messenger</label>
				<div class="formRight">
	                <input type="text" name="facebook" title="Nhập số điện thoại messenger" id="facebook" class="tipS " value="<?=@$item['facebook']?>" />
				</div>
				<div class="clear"></div>
			</div>
			     
	        
			
	        <div class="formRow">
	          <label><?=_tuychon?>: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
	          <div class="formRight">
	           
	            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
	            <label for="check1"><?=_hienthi?></label>            
	          </div>
	          <div class="clear"></div>
	        </div>
	        <div class="formRow">
	            <label><?=_thutu?>: </label>
	            <div class="formRight">
	                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('yahoo','')?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
	            </div>
	            <div class="clear"></div>
	        </div>
       </div>
        <!-- end: info -->
		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
                <a href="index.php?com=yahoo&act=man<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Do you want to exit? ')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

