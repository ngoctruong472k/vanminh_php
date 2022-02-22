<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
                      <li><a href="index.php?com=tags&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Tags</span></a></li>
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
<form name="supplier" id="validate" class="form" action="index.php?com=tags&act=save&p=<?=$_REQUEST['p']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
  

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
            <label>Tên dự án</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS ten<?=$key?> validate[required]" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div> 

        <?php if($_REQUEST['act']=='edit'){?>
        <div class="formRow">
            <label>Đổi Url: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title=" "> </label>
            <div class="formRight">
            <input type="checkbox" name="checkurl" id="checkurl<?=$key?>" value="0" <?=($checkurl==1)?'checked="checked"':''?> />
          </div>
          <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Tên không dấu: </label>
            <div class="formRight baoflex">
                <input type="text" value="<?=@$item['tenkhongdau'.$key]?>" name="tenkhongdau<?=$key?>" title="Nhập tên không dấu" class="tipS validate[required]" id="tenkhongdau<?=$key?>" style="flex:1 1 auto;width: auto !important;"  />
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
        <div class="formRow">
            <div class="formRight">
              <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
            </div>
            <div class="clear"></div>
        </div>
      </div>
     <?php } ?>
 
       <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
          <div class="formRow">
            <label><?=_hinhanh?>: </label>
            <div class="formRight">
                    <?php if ($_REQUEST['act']=='edit') { ?>
                      <img width="100" src="<?=_upload_hinhanh.@$item['photo']?>"><br>
                    <?php }?>
                    
            <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="(JPEG, GIF , JPG , PNG)">
               <div class="note"> Width: 300px | Height:200px <?=_format_duoihinh_l?> </div>                
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
          <label><?=_hienthi?> : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight none">
         
            <input type="checkbox" name="noibat" id="check2" <?=($item['noibat']==1)?'checked="checked"':''?> />
          </div>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />

             <label><?=_thutu?>: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('tags',$_REQUEST['type'])?>" name="stt" style="width:20px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
                <a href="index.php?com=tags&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
            </div>
            <div class="clear"></div>
        </div>

       </div>

    </div> 
</form> 