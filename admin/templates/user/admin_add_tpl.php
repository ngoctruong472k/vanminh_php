<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=setting&act=capnhat"><span><?=_thongtintaikhoan?></span></a></li>
                                    <li class="current"><a href="#" onclick="return false;"></a><?=_capnhatthongtin?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=user&act=admin_edit" method="post" enctype="multipart/form-data">	        
    <div class="widget">
		<div class="title"><img src="./images/icons/dark/pencil.png" alt="" class="titleIcon" />
			<h6><?=_thongtintaikhoan?></h6>
		</div>			
		<div class="formRow">
			<label><?=_tendangnhap?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['username']?>" name="username" title="Tên đăng nhập quản trị" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
			<label><?=_matkhau?></label>
			<div class="formRight">
				<input type="password" value="" name="oldpassword" title="Nhập mật khẩu hiện tại" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
         <div class="formRow">
			<label><?=_matkhaumoi?></label>
			<div class="formRight">
				<input type="password" value="" name="new_pass" title="Nhập mật khẩu mới" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
         <div class="formRow">
			<label><?=_nhaplaimatkhaumoi?></label>
			<div class="formRight">
				<input type="password" value="" name="renew_pass" title="Nhập lại mật khẩu mới" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label><?=_hovaten?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['ten']?>" name="ten" title="Nhập họ tên của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label>Email</label>
			<div class="formRight">
				<input type="text" value="<?=@$item['email']?>" name="email" title="Nhập email của bạn" class="tipS" />
			</div>
			<div class="clear"></div>
		</div>
        
        <div class="formRow">
			<label><?=_dienthoai?></label>
			<div class="formRight">
				<input type="text" value="<?=@$item['dienthoai']?>" name="dienthoai" title="Nhập điện thoại của bạn" class="tipS" />
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
    
      
</form>   