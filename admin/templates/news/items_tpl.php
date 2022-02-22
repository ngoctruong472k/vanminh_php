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
			if (hoi==true) document.location = "index.php?com=news&act=delete&type=<?=$_REQUEST['type']?>&listid=" + listid;
		});
	});
	
	function select_onchange()
	{				
		var a=document.getElementById("id_danhmuc");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value;	
		return true;
	}
	function select_onchange1()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value;	
		return true;
	}
	function select_onchange2()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value;	
		return true;
	}
	function select_onchange3()
	{				
		var a=document.getElementById("id_danhmuc");
		var b=document.getElementById("id_list");
		var c=document.getElementById("id_cat");
		var d=document.getElementById("id_item");
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&id_danhmuc="+a.value+"&id_list="+b.value+"&id_cat="+c.value+"&id_item="+d.value;	
		return true;
	}
	
	$(document).keydown(function(e) {
        if (e.keyCode == 13) {
			timkiem();
	   }
	});
	
	function timkiem()
	{	
		var a = $('input.key').val();	
		if(a=='Tên...') a='';		
		window.location ="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>&key="+a;	
		return true;
	}	
</script>

<?php
function get_main_danhmuc()
	{
		$sql="select * from table_product_danhmuc where type='".$_REQUEST['type']."' order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_danhmuc" name="id_danhmuc" onchange="select_onchange()" class="main_select select_danhmuc">
			<option value="">'._danhmuccap1.'</option>			
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
		$sql="select * from table_product_list where id_danhmuc=".$_REQUEST['id_danhmuc']." order by stt";
		$stmt=mysql_query($sql);
		$str='
			<select id="id_list" name="id_list" onchange="select_onchange1()" class="main_select select_danhmuc">
			<option value="">'._danhmuccap2.'</option>			
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
			<select id="id_cat" name="id_cat" onchange="select_onchange2()" class="main_select select_danhmuc">
			<option value="">'._danhmuccap3.'</option>			
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
			<select id="id_item" name="id_item" onchange="select_onchange3()" class="main_select select_danhmuc">
			<option value="">'._danhmuccap4.'</option>			
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
?>
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=news&act=man&type=<?=$_REQUEST['type']?>"><span><?=_quanly?> <?=$title_main ?></span></a></li>
        	<?php if($_REQUEST['key']!=''){ ?>
				<li class="current"><a href="#" onclick="return false;"><?=_ketquatimkiem?> " <?=$_REQUEST['key']?> " </a></li>
			<?php }  else { ?>
            	<li class="current"><a href="#" onclick="return false;"><?=_tatca?></a></li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<div class="none control_frm" style="margin-bottom:5px; margin-top:0">
  <div class="bc" style="padding:3px 0; margin-top:0">
        <form method="post" action="export_baocao_tuychinh.php">
            <input type="hidden" value="<?=$_REQUEST['keyword']?>" name="keyword_1"  />
            <input type="hidden" value="<?=$_REQUEST['ngaybd']?>" name="ngaybd_1"  />
            <input type="hidden" value="<?=$_REQUEST['ngaykt']?>" name="ngaykt_1"  />
            <input type="hidden" value="<?=$_REQUEST['sotien']?>" name="sotien_1"  />
            <input type="submit" class="blueB" value="Export Excel" id="xuatfile_1" style="float:right; margin-right:3px;" />
        </form>
        <div class="clear"></div>
	</div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<form name="frm" id="frm" method="post" action="index.php?com=news&act=savestt<?php if($_REQUEST['id_danhmuc']!='') echo'&id_danhmuc='.$_REQUEST['id_danhmuc'];?><?php if($_REQUEST['id_list']!='') echo'&id_list='.$_REQUEST['id_list'];?><?php if($_REQUEST['id_cat']!='') echo'&id_cat='.$_REQUEST['id_cat'];?><?php if($_REQUEST['id_item']!='') echo'&id_item='.$_REQUEST['id_item'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>">
<div class="control_frm" style="margin-top:0;">
  	<div style="float:left;">
    	<input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=news&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="<?=_xoa?>" id="xoahet" />
		<?php get_main_danhmuc()?><?php get_main_list()?><?php //get_main_category()?><?php //get_main_item()?>
    </div>  
</div>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="titleCheck" name="titleCheck" />
    </span>
    <h6>Chọn tất cả</h6>
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
        <td class="tb_data_small <?php if($_REQUEST['type']!='tin-tuc1') { ?>none<?php } ?> anmb"><?=get_main_danhmuc()?></td>
        <td class="tb_data_small <?php if($_REQUEST['type']!='tin-tuc2') { ?>none<?php } ?> anmb"><?=get_main_list()?></td>
        <td class="tb_data_small <?php if($_REQUEST['type']!='tin-tuc3') { ?>none<?php } ?> anmb"><?=get_main_category()?></td>
        <td class="tb_data_small <?php if($_REQUEST['type']!='tin-tuc4') { ?>none<?php } ?> anmb"><?=get_main_item()?></td>
        <td class="sortCol"><div><?=_tensanpham?><span class="span"></span></div></td>
        <td width="150" class="anmb"><?=_hinhanh?></td>
        <td class="tb_data_small"><?=_noibat?></td>
        <td class="tb_data_small none">Mới</td>
        <td class="tb_data_small"><?=_anhien?></td>
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
        <td align="center" class="<?php if($_REQUEST['type']!='tin-tuc1') { ?>none<?php } ?> anmb">
			<?php
				$sql_danhmuc="select *,ten$lang as ten from table_product_danhmuc where id='".$items[$i]['id_danhmuc']."'";
				$result=mysql_query($sql_danhmuc);
				$item_danhmuc =mysql_fetch_array($result);
				echo @$item_danhmuc['ten'.$tnn]
			?>      
        </td>
		<td align="center" class="<?php if($_REQUEST['type']!='tin-tuc2') { ?>none<?php } ?> anmb">
			<?php
				$sql = "select *,ten$lang as ten from table_product_list where id='".$items[$i]['id_list']."'";
				$result = mysql_query($sql);
				$item_list = mysql_fetch_array($result);
				echo @$item_list['ten'.$tnn]
			?>      
        </td>
        <td align="center" class=" <?php if($_REQUEST['type']!='tin-tuc3') { ?>none<?php } ?> anmb">
			<?php
				$sql_cat="select *,ten$lang as ten from table_product_cat where id='".$items[$i]['id_cat']."'";
				$result=mysql_query($sql_cat);
				$item_cat =mysql_fetch_array($result);
				echo @$item_cat['ten'.$tnn]
			?>      
        </td>
		<td align="center" class=" <?php if($_REQUEST['type']!='tin-tuc4') { ?>none<?php } ?> anmb">
			<?php
				$sql = "select *,ten$lang as ten from table_product_item where id='".$items[$i]['id_item']."'";
				$result = mysql_query($sql);
				$item_item = mysql_fetch_array($result);
				echo @$item_item['ten'.$tnn]
			?>      
        </td>
        <td class="title_name_data">
            <a href="index.php?com=news&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" class="tipS SC_bold"><?=$items[$i]['ten'.$tnn]?></a>
        </td>
        <td align="center" class="img_sp anmb">
           <img src="<?=_upload_sanpham.$items[$i]['thumb']?>" width="100" height="100" />
        </td>
       
        <td align="center">
        <a data-val2="table_product" rel="<?=$items[$i]['noibat']?>" data-val3="noibat" class="diamondToggle <?=($items[$i]['noibat']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>

         <td align="center" class="none">
        <a data-val2="table_product" rel="<?=$items[$i]['spmoi']?>" data-val3="spmoi" class="diamondToggle <?=($items[$i]['spmoi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
        </td>
       
        <td align="center">
          <a data-val2="table_product" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a>   
        </td>
        <td class="actBtns" class="hienmb">
            <a href="index.php?com=news&act=edit&id_danhmuc=<?=$items[$i]['id_danhmuc']?>&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>&id=<?=$items[$i]['id']?>" title="" class="smallButton tipS" original-title="Sửa sản phẩm"><img src="./images/icons/dark/pencil.png" alt=""></a>

            <a href="index.php?com=news&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&p=<?=$_REQUEST['p']?>" onClick="if(!confirm('Xác nhận xóa')) return false;" title="" class="smallButton tipS" original-title="Xóa sản phẩm"><img src="./images/icons/dark/close.png" alt=""></a>
        </td>
          </tr>
         <?php } ?>
    </tbody>
  </table>
</div>
</form>
<div class="pagination">  <?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>