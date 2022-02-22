<?php
function get_main_danhmuc()
  {
    $sql="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt";
    
    $stmt=mysql_query($sql);
    $str='
      <select id="id_danhmuc" name="id_danhmuc" class="main_select select_danhmuc select_dmbaiviet" data-level="0" data-type="'.$_REQUEST['type'].'" data-child="id_list">
      <option value="0">'._chondanhmuc.'</option>     
      ';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_danhmuc"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }

function get_main_list()
  {
    $sql="select * from table_product_list where id_danhmuc=".$_REQUEST['id_danhmuc']."  order by stt";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_list" name="id_list" class="main_select select_danhmuc select_dmbaiviet" data-level="1" data-type="'.$_REQUEST['type'].'" data-child="id_cat">
      <option value="0">'._chondanhmuc.'</option>     
      ';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_list"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
  
function get_main_category()
  {
    $sql="select * from table_product_cat where id_list=".$_REQUEST['id_list']." order by stt";
    $stmt=mysql_query($sql);
    $str='
      <select id="id_cat" name="id_cat" class="main_select select_danhmuc select_dmbaiviet" data-level="2" data-type="'.$_REQUEST['type'].'" data-child="id_item">
      <option value="0">'._chondanhmuc.'</option>     
      ';
    while ($row=@mysql_fetch_array($stmt)) 
    {
      if($row["id"]==(int)@$_REQUEST["id_cat"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
  
  
function get_main_item()
  {
    $sql_huyen="select * from table_product_item where id_cat=".$_REQUEST['id_cat']." order by id desc ";
    $result=mysql_query($sql_huyen);
    $str='
      <select id="id_item" name="id_item" class="main_select select_danhmuc">
      <option value="0">'._chondanhmuc.'</option>     
      ';
    while ($row_huyen=@mysql_fetch_array($result)) 
    {
      if($row_huyen["id"]==(int)@$_REQUEST["id_item"])
        $selected="selected";
      else 
        $selected="";
      $str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';      
    }
    $str.='</select>';
    return $str;
  }
  $d->reset();
  $sql_images="select * from #_hinhanh where id_hinhanh='".$item['id']."' and type='".$_REQUEST['type']."' order by stt, id desc ";
  $d->query($sql_images);
  $ds_photo=$d->result_array();
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
                      <li><a href="index.php?com=news&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_sanpham?></span></a></li>
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

<form name="supplier" id="validate" class="form" action="index.php?com=news&act=save&p=<?=$_REQUEST['p']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
  

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
                <input type="text" name="ten<?=$key?>" title="Nhập tên bài viết" id="ten<?=$key?>" class="tipS ten<?=$key?> validate[required]" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div> 

        <?php if($_REQUEST['act']=='edit'){?>
        <div class="formRow">
            <label>Đổi Url (Khi đổi tên muốn đối cả link url thì chọn nút này): <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title=" "> </label>
            <div class="formRight">
            <input type="checkbox" name="checkurl" id="checkurl<?=$key?>" value="0" <?=($checkurl==1)?'checked="checked"':''?> />
          </div>
          <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Url (Chú ý nếu link url này có kí tự đặc biệt hoặc dấu thì xóa kí tự đặc biệt và bỏ dấu cho những từ có dấu): </label>
            <div class="formRight baoflex">
                <span class="input-group-text" id="website-link"><?=$http.$config_url?>/</span>
                <input type="text" value="<?=@$item['tenkhongdau'.$key]?>" name="tenkhongdau<?=$key?>" title="Nhập tên không dấu" class="tipS validate[required]" id="tenkhongdau<?=$key?>" style="flex:1 1 auto;width: auto !important;"/>
            </div>
            <div class="clear"></div>
        </div> 

        <div class="formRow">
            <label><?=_motangan?>:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Viết mô tả ngắn bài viết" class="tipS" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div>  

        <div class="formRow">
          <label><?=_noidung?>: <img src="./images/question-button.png" alt="Chọn loại"  class="icon_que tipS" original-title="Viết nội dung chính"> </label>
          <div class="formRight"><textarea class="ck_editor" name="noidung<?=$key?>" id="noidung<?=$key?>" rows="8" cols="60"><?=@$item['noidung'.$key]?></textarea></div>
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
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>
    
  <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
    <div class="formRow <?php if($_REQUEST['type']!='tin-tuc1') { ?>none<?php } ?>">
      <label><?=_chondanhmuc?> 1</label>
      <div class="formRight">
      <?=get_main_danhmuc()?>
      </div>
      <div class="clear"></div>
    </div>
        <div class="formRow <?php if($_REQUEST['type']!='tin-tuc2') { ?>none<?php } ?>">
      <label><?=_chondanhmuc?> 2</label>
      <div class="formRight">
      <?=get_main_list()?>
      </div>
      <div class="clear"></div>
    </div>
        <div class="formRow <?php if($_REQUEST['type']!='tin-tuc3') { ?>none<?php } ?>">
      <label><?=_chondanhmuc?> 3</label>
      <div class="formRight">
      <?=get_main_category()?>
      </div>
      <div class="clear"></div>
    </div>
        <div class="formRow <?php if($_REQUEST['type']!='tin-tuc4') { ?>none<?php } ?>">
      <label><?=_chondanhmuc?> 4</label>
      <div class="formRight">
      <?=get_main_item()?>
      </div>
      <div class="clear"></div>
    </div>
      <!-- chonh tags -->
        <?php
          $d->reset();
      $sql="select id from table_tags where type='".$_REQUEST['type']."'";
      $d->query($sql);
      $row_tags = $d->result_array();
      if(count($row_tags)>0) { ?>
      <div class="formRow">
        <?php 
          $d->reset();
          $sql = "select ten$lang as ten,id,tenkhongdau from #_tags where hienthi=1 and type='".$_REQUEST['type']."' order by stt,id desc";
          $d->query($sql);
          $list_tags = $d->result_array();
        ?>
          <label><?=_chontags?></label>
          <?php $tach_tags = explode(',', @$item['id_tags']) ?>
          <div class="formRight">
              <select name="list_tags[]" multiple class="chosen-select input form-control" placeholder="Chọn tags">
                <?php foreach ($list_tags as $key => $value) { ?>
                    <?php if (count($tach_tags)>0 && $tach_tags!="") { ?>
                        <?php $selected=""; ?>
                        <?php foreach ($tach_tags as $key => $check) { ?>
                            <?php if ($check == $value['id']) { ?>
                                <?php $selected = "selected"; break; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <option value="<?=$value['id']?>" <?=$selected?> ><?=$value['ten']?></option>
                <?php } ?>
              </select>
          </div>
          <div class="clear"></div>
        </div> 
        <!-- end chon tags -->
      <?php } ?>
        <div class="formRow">
      <label><?=_taihinhanh?>:</label>
      <div class="formRight">
              <input type="file" id="file" name="file" />
        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
        <div class="note"> 
          <?php if($_REQUEST['type']=='thuong-hieu') { ?>
          Width:185px | Height:90px 
          <?php } else { ?>
          Width:286px | Height:247px 
          <?php } ?>

          <?=_format_duoihinh_l?> </div>
      </div>
      <div class="clear"></div>
    </div>
         <?php if($_REQUEST['act']=='edit'){?>
    <div class="formRow">
      <label><?=_hinhhientai?> :</label>
      <div class="formRight">
      
      <div class="mt10"><img src="<?=_upload_sanpham.$item['thumb']?>"  width="100px" alt="NO PHOTO" /></div>

      </div>
      <div class="clear"></div>
    </div>
    <?php } ?>

        <?php if($_REQUEST['type']=='cong-trinh' || $_REQUEST['type']=='hinh-anh' || $_REQUEST['type']=='album' || $_REQUEST['type']=='khong-gian-quan'){?>
            <div class="formRow">
              <label><?=_hinhkemtheo?>: </label>
               <?php if($act=='edit'){?>
               <div class="formRight">
              <?php if(count($ds_photo)!=0){?>       
                    <?php for($i=0;$i<count($ds_photo);$i++){?>
                      <div class="img_trich2 trich<?=$ds_photo[$i]['id']?>" id="<?=md5($ds_photo[$i]['id'])?>">
                         <img class="img_trich1" width="150px" height="120px" src="<?=_upload_hinhthem.$ds_photo[$i]['photo']?>" />
                       <input placeholder="Tên alt hình" data-val0="<?=$ds_photo[$i]['id']?>" data-val2="table_hinhanh" data-val3="ten" onblur="stt1(this);" type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['ten']?>" class="update_stt tipS themstt1" />
                       <input placeholder="Số thứ tự hình" data-val0="<?=$ds_photo[$i]['id']?>" data-val2="table_hinhanh" data-val3="stt" onblur="stt(this);" type="text" rel="<?=$ds_photo[$i]['id']?>" value="<?=$ds_photo[$i]['stt']?>" class="update_stt tipS themstt" />
                       <a style="cursor:pointer" class="remove_images" data-id="<?=$ds_photo[$i]['id']?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                    <?php }?>
                
              <?php }?>
            </div>
            <?php }?>
              <div class="formRight">
                  <a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif">
                    <i class="fa fa-paperclip"></i> <?=_themanh?></a>                
                </div>
                <div class="clear"></div>
            </div>
        <?php }?>

        
        
        <div class="formRow">
          <label><?=_noibat?>: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

         <div class="formRight">
            <input type="checkbox" name="noibat" id="check1" <?=( $item['noibat']==1)?'checked="checked"':''?> />
            </div>
      <div class="clear"></div>
          </div>
        <div class="formRow none">
          <label>Mới: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>

         <div class="formRight">
            <input type="checkbox" name="spmoi" id="check2" <?=( $item['spmoi']==1)?'checked="checked"':''?> />
            </div>
      <div class="clear"></div>
          </div>
          
        <div class="formRow">
          <label><?=_hienthi?> : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label><?=_thutu?>: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('product',$_REQUEST['type'])?>" name="stt" style="width:20px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="Số thứ tự của danh mục, chỉ nhập số">
          </div>
          <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
                <a href="index.php?com=news&act=man<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Do you want to exit? ')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
            </div>
            <div class="clear"></div>
        </div>

       </div>
       <!-- End info -->

    </div> 
</form> 

<script type="text/javascript">
    $('.remove_images').click(function(){
      var id=$(this).data("id");
      $.ajax({
        type: "POST",
        url: "ajax/xuly_admin_dn.php",
        data: {id:id, act: 'remove_image'},
        success:function(data){
          $jdata = $.parseJSON(data);         
          $("#"+$jdata.md5).fadeOut(500);
          setTimeout(function(){
            $("#"+$jdata.md5).remove();
          }, 1000)
        }
      })
    })
  
</script>
<style type="text/css">
    .jFiler-item .jFiler-item-container{width: 150px;}
    .img_trich1{width: 100% !important; max-width: 150px !important;height: 120px !important; max-height: 120px !important;}
    .img_trich2{width: 100% !important; max-width: 160px !important;
        background: #fff none repeat scroll 0 0;
        border: 1px solid #E0E0E0;
        border-radius: 5px;
        box-sizing: border-box;
        float: left;
        margin-bottom: 7px;
        margin-right: 7px;
        padding: 5px;
        position: relative;
    }
    .img_trich2 input{width: 100% !important;box-sizing: border-box;}
</style>
<script>
  $(document).ready(function() {
    $('.file_input').filer({
            showThumbs: true,
            templates: {
                box: '<ul class="jFiler-item-list"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input width="100%" type="text" placeholder="Tên alt hình" name="tensp[]" class="ten" />\<input width="100%" type="text" placeholder="Số thứ tự hình" name="stthinh[]" class="ten" />\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\<input width="100%" type="text" placeholder="Tên alt hình" name="tensp[]" class="ten" />\<input width="100%" type="text" placeholder="Số thứ tự hình" name="stthinh[]" class="ten" />\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true
        });
  });
</script>