
<?php if ($_REQUEST['act']=='edit') { ?> <h3><?=_suasanpham?></h3> <?php }else{ ?><h3><?=_themsanpham?></h3><?php } ?>
<form name="frm" method="post" action="index.php?com=chitietdonhang&act=save&id_donhang=<?=$_REQUEST['id_donhang']?>&thanhpho_item=<?=$_REQUEST['thanhpho_item']?>&thanhpho=<?=$_REQUEST['thanhpho']?>" enctype="multipart/form-data" class="nhaplieu">
    
    <?php if($act=='edit') { ?> 
    <b><?=_madonhang?></b> <input type="text" name="madonhang" value="<?=@$item['madonhang']?>" class="input" /><br /><br />
    <?php }else { ?>
    <b><?=_madonhang?></b> <input type="text" name="madonhang" value="<?=$_REQUEST['madonhang']?>" class="input" /><br /><br />
    <?php } ?>
    
	<b><?=_tensanpham?></b> <input type="text" name="ten" value="<?=@$item['ten']?>" class="input" /><br /><br />
    
    <b>Size</b> <input type="text" name="size" value="<?=@$item['size']?>" class="input" /><br /><br />
    
    <b><?=_gia?></b> <input type="text" name="gia" value="<?=@$item['gia']?>" class="input" /><br /><br />
    
    <b><?=_soluong?></b> <input type="text" name="soluong" value="<?=@$item['soluong']?>" class="input" /><br /><br />
    
    <!--<b>Tổng giá</b> <input type="text" name="tonggia" value="<?=@$item['tonggia']?>" class="input" /><br /><br />
	
	<b>Số thứ tự</b> <input type="text" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"><br><br/>  -->     
	<b><?=_hienthi?></b> <input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>><br />
		
	<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
	<input type="submit" value="<?=_luu?>" class="btn" />
	<input type="button" value="<?=_thoat?>" onclick="javascript:window.location='index.php?com=chitietdonhang&act=man'" class="btn" />
</form>