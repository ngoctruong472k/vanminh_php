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
		if (hoi==true) document.location = "index.php?com=news&type=<?=$_REQUEST['type']?>&act=delete_danhmuc&listid=" + listid;
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
		window.location ="index.php?com=news&act=man_danhmuc&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}
	
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=news&act=man_danhmuc&type=<?=$_REQUEST['type']?>"><span><?=_danhmuccap1?></span></a></li>
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
    	<input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=news&act=add_danhmuc&type=<?=$_REQUEST['type']?>'" />
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
  
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
      <tr>
        <td class="anmb"></td>
        <td class="tb_data_small anmb"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>       
        <td class="sortCol"><div><?=_tendanhmuc?><span class="span"></span></div></td>
        <td class="tb_data_small noibat1 none"><?=_noibat?></td>
        <td class="tb_data_small"><?=_anhien?></td>
        <td width="200" class="hienmb"><?=_thaotac?></td>
      </tr>
    </thead>
   <tbody>
   <form name="frm" method="post" action="index.php?com=news&act=savestt_danhmuc&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" enctype="multipart/form-data" class="nhaplieu">
   <?php for($i=0, $count=count($items); $i<$count; $i++){?>
   <tr>
   		<td class="anmb">
            <input type="checkbox" name="chon" id="chon" value="<?=$items[$i]['id']?>" class="chon" />
        </td>
   		<td class="anmb" align="center">
            <input data-val0="<?=$items[$i]['id']?>" data-val2="table_product_danhmuc" type="text" value="<?=$items[$i]['stt']?>" data-val3="stt" name="stt<?=$i?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText stt" onblur="stt(this)" id="upstt" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
        </td> 
   		<td class="title_name_data">
            <a href="index.php?com=news&act=edit_danhmuc&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold"><?=$items[$i]['ten'.$tnn]?></a>
        </td>
        
         <td align="center" class="noibat1 none">
        <a data-val2="table_product_danhmuc" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
        <td align="center">
        <a data-val2="table_product_danhmuc" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
        <td class="actBtns" class="hienmb">
            <a href="index.php?com=news&act=edit_danhmuc&type=<?=$_REQUEST['type']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=news&act=delete_danhmuc&type=<?=$_REQUEST['type']?>&id=<?=$items[$i]['id']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" onClick="if(!confirm('Xác nhận xóa: <?=$items[$i]['ten']?>')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
   </tr>
   	
   <?php } ?>
   
   </form>
   </tbody>
  </table>
</div>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>



