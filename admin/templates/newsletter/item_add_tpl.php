<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
       		<li><a href="index.php?com=newsletter&act=man&type=<?=$_REQUEST['type']?>"><span><?=_quanly?> email</span></a></li>
            <li class="current"><a href="#" onclick="return false;"><?=_them?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=newsletter&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">
	

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6><?=_nhapdulieu?></h6>
		</div>		

		<ul class="tabs">
           
           <li>
               <a href="#info"><?=_thongtinchung?></a>
           </li>

       </ul>

       <!-- begin: info -->
       <div id="info" class="tab_content">

	       <?php if($item['hoten']!='') { ?>
			<div class="formRow">
				<label>Họ và tên:</label>
				<div class="formRight">
	                <input type="text" disabled="disabled" name="hoten" title="Nhập họ tên" id="hoten" class="tipS" value="<?=@$item['hoten']?>" />
				</div>
				<div class="clear"></div>
			</div>
	       <?php } ?>
        	<?php if($item['email']!='') { ?> 
			<div class="formRow">
				<label>Email:</label>
				<div class="formRight">
	                <input type="text" disabled="disabled" name="email" title="Nhập email" id="email" class="tipS" value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>
        	<?php } ?>
        	<?php if($item['dienthoai']!='') { ?>
	        	<div class="formRow">
					<label>Điện thoại:</label>
					<div class="formRight">
		                <input type="text" disabled="disabled" name="dienthoai" title="Nhập điện thoại" id="dienthoai" class="tipS" value="<?=@$item['dienthoai']?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
        	<?php if($item['diachi']!='') { ?>
	        	<div class="formRow">
					<label>Địa chỉ:</label>
					<div class="formRight">
		                <input type="text" disabled="disabled" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
        	<?php if($item['noidung']!='') { ?>
	        	<div class="formRow">
					<label>Nội dung:</label>
					<div class="formRight">
		                <textarea rows="8" disabled="disabled" cols="" class="tipS" name="noidung" original-title="Nhập nội dung"><?=$item['noidung']?></textarea>
					</div>
					<div class="clear"></div>
				</div>
			<?php } ?>
       </div>

        <!-- end: info -->
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                 <input type="hidden" name="type" id="type" value="<?=@$item['type']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="<?=_hoantat?>" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

