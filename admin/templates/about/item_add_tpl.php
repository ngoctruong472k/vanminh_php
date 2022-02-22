<script type="text/javascript">   
  $(document).ready(function() {
    $('.chonngonngu li a').click(function(event) {
      var lang = $(this).attr('href');
      $('.chonngonngu li a').removeClass('active');
      $(this).addClass('active');
      $('.lang_hidden').removeClass('active');
      $('.lang_'+lang).addClass('active');
      return false;
    });
  });
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
              <li><a href="index.php?com=about&act=capnhat&type=<?=$_REQUEST['type']?>"><span><?=_noidung?></span></a></li>
                <li class="current"><a href="#" onclick="return false;"><?=_capnhat?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">   
  function TreeFilterChanged2(){    
        $('#validate').submit();    
  } 
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=about&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">
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
           <?php if($_REQUEST['type']!='footer' && $_REQUEST['type']!='lienhe1' && $_REQUEST['type'] != "thongtin"){ ?>
           <li>
               <a href="#info"><?=_thongtinchung?></a>
           </li>
           <?php } ?>
       </ul>
       
  
      <?php foreach ($config['lang'] as $key => $value) { ?>

       <div id="content_lang_<?=$key?>" class="tab_content <?php if($_REQUEST['type']!='footer' && $_REQUEST['type']!='lienhe1' && $value=='')echo 'info' ?>">   
         <?php if($_REQUEST['type']=='footer'){ ?>     
            <div class="formRow none">
              <label><?=_tenbaiviet?></label>
              <div class="formRight">
                  <input type="text" name="ten<?=$key?>" title="<?=_tenbaiviet?>" id="ten<?=$key?>" class="tipS ten<?=$key?>" value="<?=@$item['ten'.$key]?>" />
              </div>
              <div class="clear"></div>
          </div> 

          <div class="formRow">
              <label>Mô tả tổng đài 24/7:</label>
              <div class="formRight">
                  <textarea rows="8" cols="" title="<?=_motangan?>" class="ck_editor" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
              </div>
              <div class="clear"></div>
          </div> 
        <?php }?>
          <div class="formRow">
              <label><?=_noidung?>: <img src="./images/question-button.png" alt=""  class="icon_que tipS" original-title="<?=_noidung?>"> </label>
              <div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea></div>
              <div class="clear"></div>
          </div>
          <?php if($_REQUEST['type']!='footer' && $_REQUEST['type']!='lienhe1' && $_REQUEST['type'] != "kmdb" && $_REQUEST['type'] != "thongtin"){ ?>     
          <div class="formRow none">
              <label>Link url </label>
              <div class="formRight">
                  <input type="text" value="<?=@$item['tenkhongdau'.$key]?>" name="tenkhongdau<?=$key?>" title="Nhập tên không dấu" class="tipS" id="tenkhongdau<?=$key?>" />
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
          <?php }?>

        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>
       </div><!-- End content <?=$key?> -->      
     <?php } ?>

     <?php if($_REQUEST['type']!='footer' && $_REQUEST['type']!='lienhe1' && $_REQUEST['type']!='kmdb'){ ?>
     <div id="info" class="tab_content">
     <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />     
     <?php if($_REQUEST['type']!='footer'){ ?>
        <div class="formRow">
            <label><?=_hinhanh?>: </label>
            <div class="formRight">
                    <?php if ($_REQUEST['act']=='capnhat') { ?>
                      <img width="100" src="<?=_upload_hinhanh.@$item['photo']?>"><br>
                    <?php }?>
                    
            <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="(JPEG, GIF , JPG , PNG)">
               <div class="note"> 
                <?php if($_REQUEST['type']=='about'){ ?>
                  Width: 280px | Height:280px 
                <?php } else { ?>
                  Width: 280px | Height:280px 
                <?php } ?>
                  <?=_format_duoihinh_l?> </div>                
            </div>
            <div class="clear"></div>
        </div>
     <?php } ?>
        
        <div class="formRow">
          <?php if($_REQUEST['type']=='about'){ ?>
          <label><?=_tuychon?>: <img src="./images/question-button.png" alt="" class="icon_que tipS" original-title=""> </label>
          <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1"><?=_hienthi?> trang chủ</label>           
          </div>
          <?php } ?>
          <div class="formRow">
            <div class="formRight">
             <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                  <input type="hidden" name="type" id="type" value="<?=@$item['type']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
            </div>
            <div class="clear"></div>
        </div>
        
          <div class="clear"></div>
        </div>       
        
    
       </div>
       <?php } ?>
        
         <!-- End info -->    
  </div>
</form>   




