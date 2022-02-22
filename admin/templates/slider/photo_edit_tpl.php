<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=slider&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_hinhanh?></span></a></li>
                        <li class="current"><a href="#" onclick="return false;"><?=_suahinhanh?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=slider&act=save_photo&id=<?=$_REQUEST['id'];?><?php if($_REQUEST['id_slider']!='') echo'&id_slider='. $_REQUEST['id_slider'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6><?=_suahinhanh?></h6>
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
			
        	<?php if($_REQUEST['type']=='slider' || $_REQUEST['type']=='doitac' || $_REQUEST['type']=='quangcao' || $_REQUEST['type']=='quangcao1' || $_REQUEST['type']=='quangcao2' || $_REQUEST['type']=='quangcao0') { ?>         
        <div class="formRow">
            <label>Link: </label>
            <div class="formRight">
                <input type="text" id="price" name="link" value="<?=@$item['link']?>"  title="Nhập link liên kết cho hình ảnh" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>    <?php } ?>          
		<div class="formRow">
			<label>Upload <?=_hinhanh?>:</label>
			<div class="formRight">
            					<input type="file" id="file" name="file" />
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
          
        <div class="formRow">           
            <label><?=_hinhanhhientai?>: </label>      
            <div class="formRight">          
            <img src="<?=_upload_hinhanh.$item['photo']?>"  alt="NO PHOTO" style="max-height:100px; max-width:800px;" />
            <br />
            </div>
            
            <div class="clear"></div>
		</div>
       
       <?php if($_REQUEST['type']=='letruot') { ?> 
        <div class="formRow">           
            <label>Vị trí: </label>      
            <div class="formRight">          
                <select id="vitri" name="vitri" class="main_select">
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
            <input type="checkbox" name="noibat" id="check2" <?=($item['noibat']==1)?'checked="checked"':''?> />
            <label for="check2"><?=_noibat?></label>           
          </div>
          <div class="formRight">           
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />

            <label for="check1"><?=_hienthi?></label>           
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label><?=_thutu?>: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của hình ảnh, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
        
        </div>
       
       <!-- End info -->
       
       <?php foreach ($config['lang'] as $key => $value) {
        ?>
        
        <div id="content_lang_<?=$key?>" class="tab_content">     
        
        	<div class="formRow">   
            <label><?=_tenhinhanh?></label>
                <div class="formRight">
                    <input type="text" name="ten<?=$key?>" title="Nhập tên hình ảnh ( <?=$key?> )" id="ten<?=$key?>" class="tipS validate[required]" value="<?=@$item['ten'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            
            <?php if($_REQUEST['type']=='slider1'){?>
            <div class="formRow">   
            <label><?=_mota?> 1</label>
                <div class="formRight">
                    <input type="text" name="mota<?=$key?>" title="Nhập <?=_mota?> ( <?=$key?> )" id="mota<?=$key?>" class="tipS validate[required]" value="<?=@$item['mota'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="formRow">   
            <label><?=_mota?> 2</label>
                <div class="formRight">
                    <input type="text" name="mota1<?=$key?>" title="Nhập <?=_mota?> ( <?=$key?> )" id="mota1<?=$key?>" class="tipS validate[required]" value="<?=@$item['mota1'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
        	<?php }//?>
        
        </div><!-- End content <?=$key?> -->
        
        <?php } ?>

			
	<div class="formRow">
			<div class="formRight">
            <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
                <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
			</div>
			<div class="clear"></div>
		</div>     
		
	</div>
   
</form>   
