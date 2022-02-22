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
		if (hoi==true) document.location = "index.php?com=giasearch&act=delete_giasearch&listid="+listid+"&id_giasearch=<?=$_REQUEST['id_giasearch']?>";
	});
	});
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();
		if(a=='Tên...') a='';			
		window.location ="index.php?com=giasearch&act=man_giasearch&key="+a+"&id_giasearch=<?=$_REQUEST['id_giasearch']?>&type=<?=$_REQUEST['type']?>";	
		return true;
	}
</script>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=giasearch&act=man_giasearch&type=<?=$_REQUEST['type']?>"><span><?=_gia?></span></a></li>
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
    	<input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=giasearch&act=add_giasearch'" />
        <input type="button" class="blueB" value="<?=_xoa?>" id="xoahet" />
        
    </div>  
</div>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="chonhet" name="titleCheck" />
    </span>
    <h6><?=_chontatca?></h6>
    <div class="timkiem none">
	    <input type="text" value="" name="key" class="key" placeholder="<?=_nhaptukhoatimkiem?> ">
	    <button type="button" class="blueB" onclick="timkiem();"  value=""><?=_timkiem?></button>
    </div>
  </div>

  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td></td> 
        <td class="tb_data_small anmb"><a href="#" class="tipS" style="margin: 5px;">STT</td>
        <td class="sortCol"><div><?=_ten?><span class="span"></span></div></td>
        <td width="200"><?=_thaotac?></td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10"><div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div></td>
      </tr>
    </tfoot>
    <tbody>
    <form name="f" id="f" method="post"  action="index.php?com=giasearch&act=savestt_gia_search<?php if($_REQUEST['id_giasearch']!='') echo'&id_giasearch='.$_REQUEST['id_giasearch'];?><?php if($_REQUEST['type']!='') echo'&type='.$_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
    <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
       <td>
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center" class="anmb">
            <input data-val0="<?=$items[$i]['id']?>" data-val2="table_giasearch" type="text" value="<?=$items[$i]['stt']?>" name="stt<?=$i?>" data-val3="stt" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" onblur="stt(this)" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
        </td>
        <td class="title_name_data">
            <a href="index.php?com=giasearch&act=edit_giasearch&id=<?=$items[$i]['id']?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold">
			<?=$items[$i]['ten']?>
            
            </a>
        </td>    
        <td class="actBtns">
            <a href="index.php?com=giasearch&act=edit_giasearch&id=<?=$items[$i]['id']?><?php if($_REQUEST['id_giasearch']!='') echo'&id_giasearch='. $_REQUEST['id_giasearch'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" title="" class="smallButton tipS" original-title="Sửa hình ảnh"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <a href="index.php?com=giasearch&act=delete_giasearch&id=<?=$items[$i]['id']?><?php if($_REQUEST['id_giasearch']!='') echo'&id_giasearch='. $_REQUEST['id_giasearch'];?><?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa hình ảnh"><img src="./images/icons/dark/close.png" alt=""></a>        </td>
      </tr>
         <?php } ?>
    </form>
    </tbody>
    </table>
</div>
