<script type="text/javascript">	
	
	function TreeFilterChanged2(){
		
				$('#validate').submit();
		
	}
</script>
<div class="wrapper">
<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
       		<li><a href="index.php?com=contact&act=man&type=<?=$_REQUEST['type']?>"><span>Liên hệ</span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=contact&act=save&type=<?=$_REQUEST['type']?>" method="post" enctype="multipart/form-data">
	

	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>		

		<ul class="tabs">
           
           <li>
               <a href="#info">Thông tin chung</a>
           </li>

       </ul>

       <!-- begin: info -->
       <div id="info" class="tab_content">
       		
       		<div class="formRow">
				<label>Tiêu đề</label>
				<div class="formRight">
	                <input type="text" name="tieude" title="Nhập tiêu đề" id="tieude" class="tipS" value="<?=@$item['tieude']?>" />
				</div>
				<div class="clear"></div>
			</div>

	        <div class="formRow">
				<label>Họ tên</label>
				<div class="formRight">
	                <input type="text" name="hovaten" title="Nhập họ và tên" id="hovaten" class="tipS" value="<?=@$item['hovaten']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Điện thoại</label>
				<div class="formRight">
	                <input type="text" name="dienthoai" title="Nhập điện thoại" id="dienthoai" class="tipS" value="<?=@$item['dienthoai']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Địa chỉ</label>
				<div class="formRight">
	                <input type="text" name="diachi" title="Nhập địa chỉ" id="diachi" class="tipS" value="<?=@$item['diachi']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Email:</label>
				<div class="formRight">
	                <input type="text" name="email" title="Nhập email" id="email" class="tipS" value="<?=@$item['email']?>" />
				</div>
				<div class="clear"></div>
			</div>

			<div class="formRow">
				<label>Nội dung:</label>
				<div class="formRight">
					<textarea rows="8" cols="" title="Nội dung" class="tipS description_input" name="noidung"><?=@$item['noidung']?></textarea>
				</div>
				<div class="clear"></div>
			</div>
	       
       </div>
        <!-- end: info -->
		
		<div class="formRow">
			<div class="formRight">
                 <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
            	<input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
			</div>
			<div class="clear"></div>
		</div>
		
	</div>  
	
</form>        </div>

