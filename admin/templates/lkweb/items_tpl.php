<script language="javascript" type="text/javascript">

	$(document).ready(function() {
	$("#chonhet").click(function(){
		var status=this.checked;
		$("input[name='chon']").each(function(){this.checked=status;})
	});
	
	$("#xoahet").click(function(){
		var listid="";
		$("input[name='chon']").each(function(){
			if (this.checked) listid = listid+","+this.value;
			})
		listid=listid.substr(1);	 //alert(listid);
		if (listid=="") { alert("You have not selected any items"); return false;}
		hoi= confirm("Are you sure you want to delete?");
		if (hoi==true) document.location = "index.php?com=lkweb&act=delete&listid=" + listid + "&type=<?=$_REQUEST['type']?>";
	});
	});
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();	if(a=='Tên...') a='';		
		window.location ="index.php?com=lkweb&act=man&key="+a+ "&type=<?=$_REQUEST['type']?>";	
		return true;
	}
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=lkweb&act=man&type=<?=$_REQUEST['type']?>"><span><?=_lienketweb?></span></a></li>
        	<?php if($_REQUEST['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_REQUEST['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>


<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=lkweb&act=add&type=<?=$_REQUEST['type']?>'" />
        <input type="button" class="blueB" value="<?=_xoa?>" id="xoahet" />
        
    </div>  
</div>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="chonhet" name="titleCheck" />
    </span>
    <h6><?=_chontatca?></h6>
    <div class="timkiem">
	    <input type="text" value="" name="key" class="key" placeholder="<?=_nhaptukhoatimkiem?> ">
	    <button type="button" class="blueB" onclick="timkiem();"  value=""><?=_timkiem?></button>
    </div>
  </div>
 <table cellpadding="0" cellspacing="0" width="100%" class="sTable sTable1 withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td class="anmb"></td>
        <td class="tb_data_small anmb"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>
        <td width="200"><div><?=_ten?><span></span></div></td>
        <?php if($_REQUEST['type']=='social') { ?>
        <td class="sortCol links"><div>Link<span></span></div></td>
        <?php } ?>
        <td class="sortCol icons none"><div>Icon<span></span></div></td>
        <td class="tb_data_small"><?=_anhien?></td>
        <td width="200" class="hienmb"><?=_thaotac?></td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10">
       </td>
      </tr>
    </tfoot>
	<tbody>
     <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
        <td class="anmb">
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td class="anmb" align="center">
             <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_REQUEST['com']?>" type="text" value="<?=$items[$i]['stt']?>" data-val3="stt" name="stt<?=$i?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText stt" onblur="stt(this)" id="upstt" original-title="Nhập số thứ tự " rel="<?=$items[$i]['id']?>" />
        </td>       
        <td>
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$_REQUEST['type']?>" class="tipS SC_bold">
             <?=$items[$i]['ten']?>
            </a>
        </td>
        <?php if($_REQUEST['type']=='social') { ?>
         <td class="title_name_data links">
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$_REQUEST['type']?>" class="tipS SC_bold"><?=$items[$i]['link']?></a>
        </td>
      <?php } ?>
         <td class="title_name_data icons none">
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$_REQUEST['type']?>" class="tipS SC_bold">
              <img src="<?=_upload_khac.$items[$i]['photo']?>"  alt="NO PHOTO" />
            </a>
        </td>
        
        <td align="center">
         <a data-val2="table_<?=$_REQUEST['com']?>" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
         
        </td>
        
        <td class="actBtns" class="hienmb">
            <a href="index.php?com=lkweb&act=edit&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$_REQUEST['type']?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
           <a href="index.php?com=lkweb&act=delete&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>&type=<?=$_REQUEST['type']?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a> 
        </td>
      </tr>
           <?php } ?> 
    </tbody>
    </table>
</div>
