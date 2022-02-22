<script>
$(document).ready(function() {
$("#chonhet").click(function(){
	var status=this.checked;
	$("input[name='chon']").each(function(){this.checked=status;})
});

$("#send").click(function(){
	var listid="";
	$("input[name='chon']").each(function(){
		if (this.checked) listid = listid+","+this.value;
    	})
	listid=listid.substr(1);	 //alert(listid);
	if (listid=="") { alert("You have not selected any items"); return false;}
	hoi= confirm("Are you sure you want to delete?");
	if (hoi==true){ document.frm.listid.value=listid; document.frm.submit();}
});
});
$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	function timkiem()
	{				
		var a = $('input.key').val();if(a=='<?=_ten?>...') a='';
		window.location ="index.php?com=newsletter&act=man&key="+a;	
		return true;
	}
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=newsletter&act=man<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_quanly?> <?=$title_main?></span></a></li>
        	<?php if($_REQUEST['keyword']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_REQUEST['keyword']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;"><?=_quanly?> email</a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="frm" method="post"  action="index.php?com=newsletter&act=send" enctype="multipart/form-data" id="f">	
<input type="hidden" name="listid">
<div class="widget">

 <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6><?=_chontatca?></h6>
    <div class="timkiem">
	    <input type="text" value="" name="key" class="key" placeholder="<?=_nhaptukhoatimkiem?> ">
	    <button type="button" class="blueB" onclick="timkiem();" value=""><?=_timkiem?></button>
    </div>
  </div>

<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">

	<tr style="text-align:center">
        <td></td>
        <td>STT</td>
        <?php if($_REQUEST['type']=='dknt'){ ?> 
        	<td class="sortCol"><div>Email<span></span></div></td>
    	<?php } else { ?> 
	        <td class="sortCol"><div>Họ và tên<span></span></div></td>
	        <td class="sortCol"><div>Email<span></span></div></td>
	    <?php } ?>
	    <td class="sortCol"><div><?=_ngaytao?><span></span></div></td>
        <td width="200"><?=_thaotac?></td>
      </tr>
    
	<?php for($i=0, $count=count($items); $i<$count; $i++){?>
	<tr style="text-align:center">
		<td style="width:3%;" align="center"><input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" class="chon" /></td>	
		<td style="width:5%;" align="center">
         <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_REQUEST['com']?>" data-val3="stt" onblur="stt(this)" type="text" value="<?=$items[$i]['stt']?>" name="ordering[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" original-title="Nhập số thứ tự bài viết" rel="<?=$items[$i]['id']?>" />
        </td>		        
        <?php if($_REQUEST['type']=='dknt'){ ?> 	        
	        <td  style="width:70%;" align="center"><b><?=$items[$i]['email']?></b></td>
	    <?php } else { ?> 
	        <td class="" style="width:40%;" align="center">
	        	<b><?=$items[$i]['hoten']?></b> </br>
	        </td>
	        <td class="" style="width:30%;" align="center"><b><?=$items[$i]['email']?></b></td>
	    <?php } ?>
		<td class="" style="width:10%;" align="center"><b><?=date('d/m/Y',$items[$i]['ngaytao'])?></b></td>
		<td style="width:10%;">
			<?php if($_REQUEST['type']!='dknt'){ ?>
			<a href="index.php?com=newsletter&act=edit&id=<?=$items[$i]['id']?>&type=<?=$items[$i]['type']?>" ><img src="./images/icons/dark/pencil.png" alt="" style="margin: 0 5px;"></a>
			<?php } ?>
			<a href="index.php?com=newsletter&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" style="margin: 0 5px;"><img src="./images/icons/dark/close.png" alt=""></a>
		</td>

	</tr>
	<?php	}?>
</table>
</div>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>

	<div class="widget">

		<div class="formRow">
			<label>File:</label>
			<div class="formRight">
            	<input type="file" id="file" name="file" />
				<img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải File (rar|zip|doc|docx|xls|xlsx|ppt|pptx|pdf|png|jpg|jpeg|gif)">
			</div>
			<div class="clear"></div>
		</div>
		
        <div class="formRow form">
			<label><?=_tieude?></label>
			<div class="formRight">
                <input type="text" name="ten" title="Nhập tiêu đề " id="ten" class="tipS validate[required]" value="<?=@$item['ten']?>" />
			</div>
			<div class="clear"></div>
		</div>


		<div class="formRow">
			<label><?=_noidung?></label><br/><br/>
                <textarea class="ck_editor" id="noidung" name="noidung"><?=@$item['noidung']?></textarea>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label></label>
			<div class="clear"></div>
			<input type="button" class="blueB" id="send" value="Gửi mail" />
		</div>
		
	
	</div>  
	
</form> 






