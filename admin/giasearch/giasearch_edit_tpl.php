<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
        	            <li><a href="index.php?com=giasearch&act=man_giasearcg"><span>Hình ảnh</span></a></li>
                        <li class="current"><a href="#" onclick="return false;">Sửa hình ảnh</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=giasearch&act=save_giasearch&id=<?=$_REQUEST['id'];?><?php if($_REQUEST['id_giasearch']!='') echo'&id_giasearch='. $_REQUEST['id_giasearch'];?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Sửa hình ảnh</h6>
		</div>		
        <ul class="tabs">
           <li>
               <a href="#info">Thông tin chung</a>
           </li>
       </ul>
       <div id="info" class="tab_content">         
        	<div class="formRow">
            	<label>Tên: </label>
            	<div class="formRight">
                <input type="text" id="ten" name="ten" value="<?=@$item['ten']?>"  title="Nhập tên" class="tipS" />
            	</div>
            <div class="clear"></div>
        	</div>
            <div class="formRow">
            	<label>Giá Từ: </label>
            	<div class="formRight">
                <input type="text" id="giatu" name="giatu" value="<?=@$item['giatu']?>"  title="Nhập giá từ" class="tipS" />
            	</div>
            <div class="clear"></div>
        	</div>   
            <div class="formRow">
            	<label>Giá đến: </label>
            	<div class="formRight">
                <input type="text" id="giaden" name="giaden" value="<?=@$item['giaden']?>"  title="Nhập giá đến" class="tipS" />
            	</div>
            <div class="clear"></div>
        	</div>                                    
       <!-- End info -->
			
			<div class="formRow">
				<div class="formRight">
                    <input type="hidden" name="type" id="type" value="<?=$_REQUEST['type']?>" />
                    <input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
                    <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
				</div>
			<div class="clear"></div>
			</div>     
		</div>
</div>  
</form>   
