<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=video&act=man"><span>Video</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
	
	function youtube_parser(url){
		var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
		var match = url.match(regExp);
		return (match&&match[7].length==11)? match[7] : false;
	}
	
	
	$().ready(function(e) {
        $("#code_pro").change(function(){
			var url = youtube_parser($(this).val());
			$("#load_video").attr("src","//www.youtube.com/embed/"+url).css("height", "200px");
		})
    });
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=video&act=save<?php if($_REQUEST['curPage']!='') echo'&curPage='.$_REQUEST['curPage'];?>" method="post" enctype="multipart/form-data">
	

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
            <label><?=_ten?> Video</label>
            <div class="formRight">
                <input type="text" name="ten<?=$key?>" title="Nh???p t??n Video" id="ten<?=$key?>" class="tipS ten_vi" value="<?=@$item['ten'.$key]?>" />
            </div>
            <div class="clear"></div>
        </div>  
        
        <div class="formRow">
            <div class="formRight">
                
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
            </div>
            <div class="clear"></div>
        </div>

       </div><!-- End content <?=$key?> -->
      
     <?php } ?>

     <div id="info" class="tab_content">
          <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            
        <div class="formRow none">
            <label>Alias</label>
            <div class="formRight">
                <input type="text" value="<?=@$item['tenkhongdau']?>" name="tenkhongdau" title="Nh???p t??n kh??ng d???u" class="tipS" id="tenkhongdau" />
            </div>
            <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Link:</label>
            <div class="formRight">
                <input type="text" name="link" value="<?=@$item['link']?>"  title="Nh???p link Youtube" class="tipS" />
            </div>
            <div class="clear"></div>
            <div class="formRight" style="margin-top:10px; margin-bottom:10px;">
                <iframe id="load_video" width="314" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl(@$item['link'])?>" frameborder="0" <?php if(@$item["link"] == "") echo "height='0'"; else echo "height='200'";?> allowfullscreen></iframe>
            </div>
            <div class="clear"></div>
        </div>
        
        
         
        <div class="formRow none">
            <label><?=_hinhanhdaidien?>: </label>
            <div class="formRight">
                                 <?php if ($_REQUEST['act']=='edit') { ?>
                                  <img width="100" src="<?=_upload_khac.$item['photo']?>"><br />
                    <br>
                    <?php }?>
                    
                                <input type="file" id="file" name="file" /><img src="./images/question-button.png" alt="Upload h??nh" class="icon_question tipS" original-title="T???i h??nh ?????i di???n cho Video (???nh JPEG, GIF , JPG , PNG)">
                              <div class="note"> 
                              Min-width:1366px | Min-height:450px 
                              <?=_format_duoihinh_l?> </div>
                               
            </div>
            <div class="clear"></div>
        </div>

                
           <div class="formRow">
          <label><?=_tuychon?>: <img src="./images/question-button.png" alt="Ch???n lo???i" class="icon_que tipS" original-title="Check v??o nh???ng t??y ch???n "> </label>
          <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1"><?=_hienthi?></label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label><?=_thutu?>: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('video','')?>" name="stt" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="S??? th??? t??? c???a Video, ch??? nh???p s???">
            </div>
            <div class="clear"></div>
        </div>

        <div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
            </div>
            <div class="clear"></div>
        </div>

       </div>
       <!-- End info -->
 

    </div>

</form>   
