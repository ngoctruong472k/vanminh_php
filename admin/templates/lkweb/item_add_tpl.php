<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=lkweb&act=man&type=<?=$_REQUEST['type']?>"><span><?=_lienketweb?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=lkweb&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">
	

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
        <?php if($_REQUEST['type']=='social3') { ?>
        <div class="formRow">
            <label><?=_mota?></label>
            <div class="formRight">
                <input type="text" name="mota<?=$key?>" title="" id="mota<?=$key?>" class="tipS mota<?=$key?>" value="<?=@$item['mota'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div> 
        <?php } ?>
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
          <?php if($_REQUEST['type']!='social1') { ?>
       		<!-- hinh anh -->
            <div class="formRow">
                <label><?=_taihinhanh?>:</label>
                <div class="formRight">
                    <input type="file" id="file" name="file" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                    <div class="note">
                      <?php if($_REQUEST['type']=='social') { ?> 
                        Width: 40px | Height: 40px 
                      <?php } else { ?>
                         Width: 52px | Height: 45px  
                      <?php } ?>
                      <?=_format_duoihinh_l?> 
                    </div>
                </div>
                <div class="clear"></div>
            </div>
             <?php if($_REQUEST['act']=='edit'){?>
            <div class="formRow">
                <label><?=_hinhhientai?> :</label>
                <div class="formRight">
                
                <div class="mt10"><img src="<?=_upload_khac.$item['photo']?>" style="max-width: 100%;" alt="NO PHOTO" /></div>
    
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <!-- end hinh anh -->
            <?php if($_REQUEST['type']!='social3') { ?>
	        <div class="formRow">
				<label>Link</label>
				<div class="formRight">
	                <input type="text" name="link" title="Nhập link website" id="link" class="tipS" value="<?=@$item['link']?>" />
				</div>
				<div class="clear"></div>
			</div>
	       <?php }} ?>
	        
			
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
	                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('lkweb',$_REQUEST['type'])?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
	            </div>
	            <div class="clear"></div>
	        </div>
			
       </div>
        <!-- end: info -->


		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

