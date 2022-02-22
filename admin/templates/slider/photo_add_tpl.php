<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_hinhanh?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;"><?=_themhinhanh?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=slider&act=save_photo&id_slider=<?=$_REQUEST['id_slider']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
	
    <div class="widget">
         <div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
            <h6><?=_themhinhanh?></h6>
        </div>
       <ul class="tabs">
           
           <li>
               <a href="#info"><?=_thongtinchung?></a>
           </li>
           <?php foreach ($config['lang'] as $key => $value) { ?>
           <li>
               <a href="#content_lang_<?=$key?>"><?=$value?></a>
           </li>
           <?php } ?>


       </ul>
 	
       <div id="info" class="tab_content">
           <?php for($i=0; $i<3; $i++){?>
            <?php if($_REQUEST['type']=='slider' || $_REQUEST['type']=='doitac' || $_REQUEST['type']=='quangcao' || $_REQUEST['type']=='quangcao1' || $_REQUEST['type']=='quangcao2' || $_REQUEST['type']=='quangcao0') { ?> 
          <div class="formRow">
            <label>Link:</label>
            <div class="formRight">
                <input type="text" id="code_pro" name="link<?=$i?>" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div><?php } ?>
		<div class="formRow">
			<label><?=_hinhanh?> <?=$i+1?>:</label>
			<div class="formRight">
            					<input type="file" id="file" name="file<?=$i?>" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
          <div class="note">  
					   <?php if($_REQUEST['type']=='slider')echo 'Width:1366px - Height:453px '; ?>
             <?php if($_REQUEST['type']=='doitac')echo 'Width:195px - Height:95px '; ?>
             <?php if($_REQUEST['type']=='quangcao')echo 'Width:1366px - Height:95px '; ?>
             <?php if($_REQUEST['type']=='quangcao0')echo 'Width:581px - Height:204px '; ?>
             <?php if($_REQUEST['type']=='quangcao2')echo 'Width:291px - Height:428px '; ?>
					   <?=_format_duoihinh_l?> 
          </div>
			</div>
			<div class="clear"></div>
		</div>
        
        <?php if($_REQUEST['type']=='letruot') { ?> 
        <div class="formRow">           
            <label>Vị trí: </label>      
            <div class="formRight">          
                <select id="vitri" name="vitri<?=$i?>" class="main_select">
                	<option value="left" <?php if($item['vitri']=='left') echo 'selected="selected"' ?>>Bên trái</option>			
                	<option value="right" <?php if($item['vitri']=='right') echo 'selected="selected"' ?>>Bên phải</option>	
                </select>
            <br />
            </div>
            
            <div class="clear"></div>
		</div>
        <?php } ?>
        
        <div class="formRow">
          <label><?=_tuychon?>: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight none">           
            <input type="checkbox" name="noibat<?=$i?>" id="check2" value="0" />
            <label for="check2"><?=_noibat?></label>           
          </div>
          <div class="formRight">           
            <input type="checkbox" name="hienthi<?=$i?>" id="check1" value="1" checked="checked" />
            <label for="check1"><?=_hienthi?></label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label><?=_thutu?>: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=$i+1?>" name="stt<?=$i?>" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
                
        
<?php }?>
       </div>
       
       <!-- End info -->
       
       
		<?php foreach ($config['lang'] as $key => $value) {
        ?>
        
        <div id="content_lang_<?=$key?>" class="tab_content">     
         <?php for($i=0; $i<3; $i++){?>
            <div class="formRow">   
                <label><?=_tenhinhanh?> <?=$i+1?>:</label>
                <div class="formRight">
                    <input type="text" name="ten<?=$key?><?=$i?>" title="Nhập tên hình ảnh <?=$i+1?>" id="ten<?=$key?><?=$i?>" class="tipS" value="" />
                </div>
                <div class="clear"></div>
            </div>
            
            <?php if($_REQUEST['type']=='slider1'){?>
            <div class="formRow">   
                <label><?=_mota?> 1 <?=$i+1?>:</label>
                <div class="formRight">
                    <input type="text" name="mota<?=$key?><?=$i?>" title="Nhập mô tả <?=$i+1?>" id="mota<?=$key?><?=$i?>" class="tipS" value="" />
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="formRow">   
                <label><?=_mota?> 2 <?=$i+1?>:</label>
                <div class="formRight">
                    <input type="text" name="mota1<?=$key?><?=$i?>" title="Nhập mô tả <?=$i+1?>" id="mota1<?=$key?><?=$i?>" class="tipS" value="" />
                </div>
                <div class="clear"></div>
            </div>
        <?php }?>
        <?php }//?>
        </div><!-- End content <?=$key?> -->

        <?php } ?>


	<div class="formRow">
			<div class="formRight">
            	<input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
			</div>
			<div class="clear"></div>
		</div>	
	</div>
   
	
</form>   
