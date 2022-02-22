<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
      <li><a href="index.php?com=meta&act=capnhat"><span><?=_catnhatmetachowebsite?></span></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="frm" class="form" action="index.php?com=meta&act=save" method="post" enctype="multipart/form-data">
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
                <label>Alt images</label>
                <div class="formRight">
                    <input type="text" name="alt<?=$key?>" title="Nhập alt cho hình ảnh" id="alt<?=$key?>" class="tipS" value="<?=@$item['alt'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>H1</label>
                <div class="formRight">
                    <input type="text" name="h1<?=$key?>" title="Nhập h1" id="h1<?=$key?>" class="tipS" value="<?=@$item['h1'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>H2</label>
                <div class="formRight">
                    <input type="text" name="h2<?=$key?>" title="Nhập h2" id="h2<?=$key?>" class="tipS" value="<?=@$item['h2'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
                <label>H3</label>
                <div class="formRight">
                    <input type="text" name="h3<?=$key?>" title="Nhập h3" id="h3<?=$key?>" class="tipS" value="<?=@$item['h3'.$key]?>" />
                </div>
                <div class="clear"></div>
            </div>
            <div class="formRow">
            <label>Title</label>
            <div class="formRight">
                <input style="margin-bottom: 10px;" type="text" value="<?=@$item['title'.$key]?>" name="title<?=$key?>" title="Nội dung thẻ meta Title dùng để SEO" class="tipS title<?=$key?>" onkeyup="countChar('title<?=$key?>')" id="title<?=$key?>" data-min="10" data-max="70"/>
                <b>Số ký tự [10-70]: </b>
                <span class="text-danger" id="count_title<?=$key?>"><?=mb_strlen($item['title'.$key])?></span>
                <span class="<?=(mb_strlen($item['title'.$key])<10 || mb_strlen($item['title'.$key])>70) ? 'text-danger':'text-success'?>" id="status_title<?=$key?>"><?=(mb_strlen($item['title'.$key])<10 || mb_strlen($item['title'.$key])>70) ? _khongtot:_khatot?></span>
            </div>
            <div class="clear"></div>
        </div>
         
        <div class="formRow">
            <label>Keywords</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['keywords'.$key]?>" name="keywords<?=$key?>" title="Từ khóa chính cho bài viết" class="tipS" />
                <span style="color: #f00; padding-top: 10px;display: block;"><?=_metakey?></span>
            </div>
            
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Nội dung thẻ meta Description dùng để SEO" class="tipS description<?=$key?>" name="description<?=$key?>" onkeyup="countChar('description<?=$key?>')" id="description<?=$key?>" data-min="160" data-max="300"><?=@$item['description'.$key]?></textarea>
                <b>Số ký tự [160-300]: </b>
                <span class="text-danger" id="count_description<?=$key?>"><?=mb_strlen($item['description'.$key])?></span>
                <span class="<?=(mb_strlen($item['description'.$key])<160 || mb_strlen($item['description'.$key])>300) ? 'text-danger':'text-success'?>" id="status_description<?=$key?>"><?=(mb_strlen($item['description'.$key])<160 || mb_strlen($item['description'.$key])>300) ? _khongtot:_khatot?></span>
            </div>
            <div class="clear"></div>
        </div>
        </div><!-- tab_content -->
    <?php }?>
    <div id="info" class="tab_content">
        <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
     	<div class="formRow">
            <label><?=_hinhanhdaidien?>: </label>
            <div class="formRight">
    		<?php if ($_REQUEST['act']=='capnhat') { ?>
                <img src="<?=_upload_hinhanh.@$item['thumb']?>"><br>
            <?php }?>
                    
            <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình đại diện cho sản phẩm (ảnh JPEG, GIF , JPG , PNG)">
               <div class="note"> Width: 400px | Height:240px <?=_format_duoihinh_l?> </div>                
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>ID facebook</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['api_facebook']?>" name="api_facebook" title="ID facebook" class="tipS" />
            </div>
            <div class="clear"></div>
        </div>
    </div>
 	
   <div class="formRow">
        <div class="formRight">
            <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            <input type="submit" class="blueB"  value="Hoàn tất" />
            <a href="index.php?com=meta&act=capnhat" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="Thoát">Thoát</a>
           
        </div>
        <div class="clear"></div>
    </div>        
</div>
</form>



