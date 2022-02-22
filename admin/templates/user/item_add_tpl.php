<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.username, "Enter the username")){
		document.frm.username.focus();
		return false;
	}
	<?php if($_REQUEST['act']=='add'){?>
	if(isEmpty(document.frm.oldpassword, "Password not entered.")){
		document.frm.oldpassword.focus();
		return false;
	}
	
	if(document.frm.oldpassword.value.length<5){
		alert("Password must be more than 4 characters.");
		document.frm.oldpassword.focus();
		return false;
	}
	<?php } ?>
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert(<?=_emailkhonghople?>);
		document.frm.email.focus();
		return false;
	}
	if(document.frm.username.value==0){
		alert(<?=_chuachonnhomthanhvien?>);
		document.frm.email.focus();
		return false;
	}
}
</script>
<?php
	
	$d->reset();
	$sql="select ten, id from #_phanquyen where hienthi=1 order by stt,id desc";
	$d->query($sql);
	$rs_group=$d->result_array();
	
?>


<div class="wrapper">

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	<li><a href="index.php?com=user&act=add<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=_themthanhvien?></span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>



<form name="frm"  class="form"  method="post" action="index.php?com=user&act=save" enctype="multipart/form-data" class="nhaplieu" onSubmit="return js_submit();">
<div class="widget">
	<div class="formRow">
		<label><?=_tendangnhap?> :</label>
		<div class="formRight">
        	<input type="text" name="username" id="username" value="<?=$item['username']?>" class="input" <?php if($_REQUEST['act']=='edit'){?> readonly="readonly"<?php } ?>  />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label><?=_matkhau?> :</label>
		<div class="formRight">
        	<input type="password" name="oldpassword" id="oldpassword" value="" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label><?=_nhomthanhvien?> :</label>
		<div class="formRight">
        	<select name="group"  class="main_select select_danhmuc" >
				<option value="0"><?=_chonnhomthanhvien?></option>
				<?php foreach($rs_group as $v){?>
				<option value="<?=$v["id"]?>" <?php if($item["nhom"]==$v["id"]) echo "selected";?> ><?=$v["ten"]?></option>
				<?php }?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Email :</label>
		<div class="formRight">
        	<input type="text" name="email" id="email" value="<?=$item['email']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label><?=_hovaten?> :</label>
		<div class="formRight">
        	<input type="text" name="ten" id="ten" value="<?=$item['ten']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label><?=_dienthoai?> :</label>
		<div class="formRight">
        	<input type="text" name="dienthoai" value="<?=$item['dienthoai']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label><?=_diachi?> :</label>
		<div class="formRight">
        	<input type="text" name="diachi" id="diachi" value="<?=$item['diachi']?>" class="input" />
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label><?=_quyendangnhap?> :</label>
		<div class="formRight">
        	<?php for($i=0;$i<count($quyenhang);$i++){?>
		    <p><label><input type="radio" name="quyen" value="<?=$quyenhang[$i]['id']?>" <?php if($item['quyen'] == $quyenhang[$i]['id']){?> checked="checked"<?php } ?> /> <span style="color:<?=$quyenhang[$i]['mausac']?>"><?=$quyenhang[$i]['ten']?></span></label></p><div class="clear"></div>
		    <?php } ?>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label><?=_thutu?>:</label>
		<div class="formRight">
        	<input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:SoThuTu_ASC('user','')?>" style="width:30px">
		</div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label><?=_hienthi?> :</label>
		<div class="formRight">
        	<input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>>
		</div>
		<div class="clear"></div>
	</div>
       	
	<div class="formRow">
	<label></label>
	<div class="formRight">
		<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
		<input type="submit" value="<?=_luu?>"  class="button blueB" />
		<input type="button" value="<?=_thoat?>" onclick="javascript:window.location='index.php?com=user&act=man'" class="button blueB" />
	</div>
	<div class="clear"></div>
	</div>
</div>
</form>