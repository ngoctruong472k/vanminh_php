
<?php	
	function get_main_danhmuc()
	{
		$sql_huyen="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt,id desc ";
		$result=mysql_query($sql_huyen);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" class="main_select select_danhmuc">
			<option value="0">'._chondanhmuc.'</option>
			';
		while ($row_huyen=@mysql_fetch_array($result)) 
		{
			if($row_huyen["id"]==(int)@$_REQUEST["id_danhmuc"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=news&act=man_list<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_danhmuc?></span></a></li>
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
<form name="supplier" id="validate" class="form" action="index.php?com=news&act=save_list<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

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

       
        <?php foreach ($config['lang'] as $key => $value) {
        ?>

       <div id="content_lang_<?=$key?>" class="tab_content">        
        
        <div class="formRow">
            <label><?=_tenbaiviet?></label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nh???p t??n b??i vi???t" id="ten<?=$key?>" class="tipS ten<?=$key?> validate[required]" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div> 

        <?php if($_REQUEST['act']=='edit_list'){?>
        <div class="formRow">
            <label>?????i Url (Khi ?????i t??n mu???n ?????i c??? link url th?? ch???n n??t n??y): <img src="./images/question-button.png" alt="Ch???n lo???i" class="icon_que tipS" original-title=" "> </label>
            <div class="formRight">
            <input type="checkbox" name="checkurl" id="checkurl<?=$key?>" value="0" <?=($checkurl==1)?'checked="checked"':''?> />
          </div>
          <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
            <label>Url (Ch?? ?? n???u link url n??y c?? k?? t??? ?????c bi???t ho???c d???u th?? x??a k?? t??? ?????c bi???t v?? b??? d???u cho nh???ng t??? c?? d???u): </label>
            <div class="formRight baoflex">
                <span class="input-group-text" id="website-link"><?=$http.$config_url?>/</span>
                <input type="text" value="<?=@$item['tenkhongdau'.$key]?>" name="tenkhongdau<?=$key?>" title="Nh???p t??n kh??ng d???u" class="tipS validate[required]" id="tenkhongdau<?=$key?>" style="flex:1 1 auto;width: auto !important;"/>
            </div>
            <div class="clear"></div>
        </div> 

        <div class="formRow none">
            <label><?=_motangan?>:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="Vi???t m?? t??? ng???n b??i vi???t" class="tipS" name="mota<?=$key?>" id="mota<?=$key?>"><?=@$item['mota'.$key]?></textarea>
            </div>
            <div class="clear"></div>
        </div> 

        <div class="formRow">
            <label>Title</label>
            <div class="formRight">
                <input style="margin-bottom: 10px;" type="text" value="<?=@$item['title'.$key]?>" name="title<?=$key?>" title="N???i dung th??? meta Title d??ng ????? SEO" class="tipS title<?=$key?>" onkeyup="countChar('title<?=$key?>')" id="title<?=$key?>" data-min="10" data-max="70"/>
                <b>S??? k?? t??? [10-70]: </b>
                <span class="text-danger" id="count_title<?=$key?>"><?=mb_strlen($item['title'.$key])?></span>
                <span class="<?=(mb_strlen($item['title'.$key])<10 || mb_strlen($item['title'.$key])>70) ? 'text-danger':'text-success'?>" id="status_title<?=$key?>"><?=(mb_strlen($item['title'.$key])<10 || mb_strlen($item['title'.$key])>70) ? _khongtot:_khatot?></span>
            </div>
            <div class="clear"></div>
        </div>
         
        <div class="formRow">
            <label>Keywords</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['keywords'.$key]?>" name="keywords<?=$key?>" title="T??? kh??a ch??nh cho b??i vi???t" class="tipS" />
                <span style="color: #f00; padding-top: 10px;display: block;"><?=_metakey?></span>
            </div>
            
            <div class="clear"></div>
        </div>
        
        <div class="formRow">
            <label>Description:</label>
            <div class="formRight">
                <textarea rows="8" cols="" title="N???i dung th??? meta Description d??ng ????? SEO" class="tipS description<?=$key?>" name="description<?=$key?>" onkeyup="countChar('description<?=$key?>')" id="description<?=$key?>" data-min="160" data-max="300"><?=@$item['description'.$key]?></textarea>
                <b>S??? k?? t??? [160-300]: </b>
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
                 <a href="index.php?com=news&act=man_danhmuc<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('Do you want to exit?')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>
 
      <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id_this_post" value="<?=@$item['id']?>" />
    <div class="formRow">
      <label><?=_chondanhmuc?> 1</label>
      <div class="formRight">
      <?=get_main_danhmuc()?>
      </div>
      <div class="clear"></div>
    </div>
         
        <div class="formRow">
      <label><?=_taihinhanh?>:</label>
      <div class="formRight">
              <input type="file" id="file" name="file" />
        <img src="./images/question-button.png" alt="Upload h??nh" class="icon_question tipS" original-title="T???i h??nh ???nh (???nh JPEG, GIF , JPG , PNG)">
        <div class="note"> Min-width:200px | Min-height:200px  <?=_format_duoihinh_l?> </div>
      </div>
      <div class="clear"></div>
    </div>
         <?php if($_REQUEST['act']=='edit_list'){?>
    <div class="formRow">
      <label><?=_hinhhientai?>:</label>
      <div class="formRight">
      
      <div class="mt10"><img src="<?=_upload_sanpham.$item['photo']?>"  width="100px" alt="NO PHOTO" width="100" /></div>

      </div>
      <div class="clear"></div>
    </div>
    <?php } ?>

    
          <div class="formRow none">
          <label><?=_noibat?> : <img src="./images/question-button.png" alt="Ch???n lo???i" class="icon_que tipS" original-title="B??? ch???n ????? kh??ng hi???n th??? danh m???c n??y ! "> </label>

         <div class="formRight">
            <input type="checkbox" name="noibat" id="check1" <?=($item['noibat']==1)?'checked="checked"':''?> />
            </div>
      <div class="clear"></div>
          </div>
          
        <div class="formRow">
          <label><?=_hienthi?> : <img src="./images/question-button.png" alt="Ch???n lo???i" class="icon_que tipS" original-title="B??? ch???n ????? kh??ng hi???n th??? danh m???c n??y ! "> </label>
          <div class="formRight">
         
            <input type="checkbox" name="hienthi" id="check1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
             <label><?=_thutu?>: </label>
              <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('product_list',$_REQUEST['type'])?>" name="stt" style="width:20px; text-align:center;" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" original-title="S??? th??? t??? c???a danh m???c, ch??? nh???p s???">
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
                <a href="index.php?com=news&act=man_list<?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?>" onClick="if(!confirm('B???n c?? mu???n tho??t kh??ng ? ')) return false;" title="" class="button tipS" original-title="<?=_thoat?>"><?=_thoat?></a>
            </div>
            <div class="clear"></div>
        </div>

       </div>
       <!-- End info -->

    </div>

</form>   
