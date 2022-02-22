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
			if (hoi==true) document.location = "index.php?com=news&act=delete_seoweb&type=<?=$_REQUEST['type']?>&listid=" + listid;
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
		window.location ="index.php?com=news&act=man_seoweb&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}	
</script>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=news&act=man_seoweb&type=<?=$_REQUEST['type']?>"><span><?=_quanly?> <?=$title_main ?></span></a></li>
        	<?php if($_REQUEST['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_REQUEST['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<form name="frm" id="frm" method="post" action="index.php?com=news&act=savestt<?php if($_REQUEST['id_danhmuc']!='') echo'&id_danhmuc='.$_REQUEST['id_danhmuc'];?><?php if($_REQUEST['id_list']!='') echo'&id_list='.$_REQUEST['id_list'];?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='.$_REQUEST['id_cat'];?><?php if($_REQUEST['id_item']!='') echo'&id_item='.$_REQUEST['id_item'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
<?php if($config['quantri']==1){ ?> 
<div class="control_frm an_hien" style="margin-top:0;">
    <div style="float:left;">
      <input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=news&act=add_seoweb<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="<?=_xoa?>" id="xoahet" />
    </div>  
</div>
<?php } ?>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6><?=_chontatca?></h6>
    <div class="timkiem">
	    <input type="text" value="" name="key" class="key"  placeholder="<?=_nhaptukhoatimkiem?> ">
	    <button type="button" class="blueB" onclick="timkiem();" value=""><?=_timkiem?></button>
    </div>
  </div>
  
  <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
      <thead>
      <tr>
        <td class="anmb"></td>
        <td class="tb_data_small anmb"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>     
        <td class="sortCol"><div><?=_ten?><span class="span"></span></div></td>
        <td width="150" class="anmb"><?=_hinhanh?></td>
        <?php if($config['quantri']==1){ ?> 
        <td class="tb_data_small"><?=_anhien?></td>
        <?php } ?>
        <td width="100" class="hienmb"><?=_thaotac?></td>
      </tr>
    </thead>
    <tbody>
    	 <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
          <td class="anmb">
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="chon" />
        </td>
         <td align="center" class="anmb">
            <input data-val0="<?=$items[$i]['id']?>" data-val2="table_product" type="text" value="<?=$items[$i]['stt']?>" name="stt<?=$i?>" data-val3="stt" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText update_stt" onblur="stt(this)" original-title="Nhập số thứ tự sản phẩm" rel="<?=$items[$i]['id']?>" />
        </td> 
        
        <td class="title_name_data">
            <a href="index.php?com=news&act=edit_seoweb&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['title']?></a>
        </td>
        <td align="center" class="img_sp anmb">
           <img src="<?=_upload_sanpham.$items[$i]['thumb']?>" width="100" height="100" />
        </td>
        <?php if($config['quantri']==1){ ?> 
        <td align="center" class="">
          <a data-val2="table_product" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
        <?php } ?>
        <td class="actBtns" class="hienmb">
            <a href="index.php?com=news&act=edit_seoweb&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>
            <?php if($config['quantri']==1){ ?> 
              <a href="index.php?com=news&act=delete_seoweb&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
            <?php } ?>
        </td>
          </tr>
         <?php } ?>
    </tbody>
  </table>
</div>
</form>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>