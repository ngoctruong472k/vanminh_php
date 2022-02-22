<script>
    function select_onchangedc()
    {  
        var a=document.getElementById("id_city");
        window.location ="index.php?com=place&act=<?php if($_REQUEST['act']=='edit_street') echo 'edit_street'; else echo 'add_street';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_city="+a.value;   
        return true;
    }
    function select_onchangedc1()
    {   
        var a=document.getElementById("id_city");
        var b=document.getElementById("id_dist");
        window.location ="index.php?com=place&act=<?php if($_REQUEST['act']=='edit_street') echo 'edit_street'; else echo 'add_street';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_city="+a.value+"&id_dist="+b.value;   
        return true;
    }
    function select_onchangedc2()
    {   
        var a=document.getElementById("id_city");
        var b=document.getElementById("id_dist");
        var c=document.getElementById("id_street");
        window.location ="index.php?com=place&act=<?php if($_REQUEST['act']=='edit_street') echo 'edit_street'; else echo 'add_street';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&id_city="+a.value+"&id_dist="+b.value+"&id_street="+f.value;   
        return true;
    }
</script>
<?php

function get_main_city()
    {
        $sql_huyen="select * from table_place_city where hienthi=1 order by stt,id asc";
        $result=mysql_query($sql_huyen);
        $str='
            <select id="id_city" name="id_city" onchange="select_onchangedc()" class="main_select">
            <option value="0">Chọn tỉnh thành</option>   
            ';
        while ($row_huyen=@mysql_fetch_array($result)) 
        {
            if($row_huyen["id"]==(int)@$_REQUEST["id_city"] || $row_huyen["id"]==(int)@$id_city)
                $selected="selected";
            else 
                $selected="";
            $str.='<option value='.$row_huyen["id"].' '.$selected.'>'.$row_huyen["ten"].'</option>';            
        }
        $str.='</select>';
        return $str;
    }
  function get_main_dist()
  {
    $sql_huyen="select * from table_place_dist where id_city='".$_REQUEST['id_city']."' order by stt,id asc";
    $result=mysql_query($sql_huyen);
    $str='
      <select id="id_dist" name="id_dist" onchange="select_onchangedc1()" class="main_select">
      <option value="0">Chọn quận/huyện</option> 
      ';
    while ($row_huyen=@mysql_fetch_array($result)) 
    {
      if($row_huyen["id"]==(int)@$_REQUEST["id_dist"])
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
        	            <li><a href="index.php?com=place&act=mam_street"><span>Đường</span></a></li>
                                    <li class="current"><a href="#" onclick="return false;">Thêm</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}
	
</script>
<form name="supplier" id="validate" class="form" action="index.php?com=place&act=save_street&curPage=<?=$_REQUEST['curPage']?>" method="post" enctype="multipart/form-data">
	<div class="widget">
		<div class="title"><img src="./images/icons/dark/list.png" alt="" class="titleIcon" />
			<h6>Nhập dữ liệu</h6>
		</div>
		<div class="formRow">
			<label>Tỉnh thành</label>
			<div class="formRight">
            	<div class="selector">
				<?=get_main_city(@$item['id_city'])?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
        <div class="formRow">
            <label>Quận huyện</label>
            <div class="formRight">
                <div class="selector">
                <?=get_main_dist(@$item['id_dist'])?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Tên</label>
			<div class="formRight">
                <input type="text" name="name" title="Nhập tên tỉnh thành" id="name" class="tipS validate[required]" value="<?=@$item['ten']?>" />
			</div>
			<div class="clear"></div>
		</div>		        
             
      
    
        <div class="formRow">
          <label>Tùy chọn: <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Check vào những tùy chọn "> </label>
          <div class="formRight">
            <input type="checkbox" name="active" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
            <label for="check1">Hiển thị</label>           
          </div>
          <div class="clear"></div>
        </div>
        <div class="formRow">
            <label>Số thứ tự: </label>
            <div class="formRight">
                <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="num" style="width:20px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự, chỉ nhập số">
            </div>
            <div class="clear"></div>
        </div>
		
	<div class="formRow">
            <div class="formRight">
                <input type="hidden" name="id" id="id_this_place" value="<?=@$item['id']?>" />
                <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            </div>
            <div class="clear"></div>
        </div>	
	</div>
   
	
</form>   