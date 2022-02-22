<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
       		<li><a href="index.php?com=baihat&act=man"><span>Bài hát</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=baihat&act=save" method="post" enctype="multipart/form-data">
	

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		



		<ul class="tabs">
           
           
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>
           <li>
               <a href="#info">Thông tin chung</a>
           </li>


       </ul>

       <?php foreach ($config['lang'] as $key => $value) {?>

        <!-- begin: Content -->
       <div id="content_lang_<?=$key?>" class="tab_content">  
       		<div class="formRow">
            <label>Tên bài viết</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS ten<?=$key?>" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div> 
        <div class="formRow">
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

          <!-- hinh anh -->
            <div class="formRow">
                <label>Tải Bài hát:</label>
                <div class="formRight">
                    <input type="file" id="file" name="file" />
                    <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải bài hát (mp3, MP3)">
                    <div class="note"> Type: .mp3 </div>
                </div>
                <div class="clear"></div>
            </div>
             <?php if($_REQUEST['act']=='edit'){?>
            <div class="formRow">
                <label>Bài hát Hiện Tại :</label>
                <div class="formRight">
                
                <div class="mt10">
                  <?php if($item['photo']!=''){?>
                    <audio controls="">
                        <source src="<?=_upload_khac.$item['photo']?>" type="audio/mpeg"> 
                    </audio>
                    <?php }else echo 'NO FILE'?>
                </div>
    
                </div>
                <div class="clear"></div>
            </div>
            <?php } ?>
            <!-- end hinh anh -->
      
          <div class="formRow">
            <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
            <div class="formRight">
             
              <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
              <label for="check1">Hiển thị</label>            
            </div>
            <div class="clear"></div>
          </div>
          <div class="formRow">
              <label>Số thứ tự: </label>
              <div class="formRight">
                  <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
              </div>
              <div class="clear"></div>
          </div>
      
       </div>
        <!-- end: info -->


		
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

