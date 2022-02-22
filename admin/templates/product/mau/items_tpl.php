<script language="javascript" type="text/javascript">

    $(document).ready(function() {
    $("#chonhet").click(function(){
        var status=this.checked;
        $("input[name='chon']").each(function(){this.checked=status;})
    });
    
    $("#xoahet").click(function(){
        var listid="";
        var type = "<?=$_REQUEST['type']?>";
        $("input[name='chon']").each(function(){
            if (this.checked) listid = listid+","+this.value;
            })
        listid=listid.substr(1);     //alert(listid);
        if (listid=="") { alert("You have not selected any items"); return false;}
        hoi= confirm("Are you sure you want to delete?");
        if (hoi==true) document.location = "index.php?com=product&act=delete_mau&listid=" + listid+"&type="+type;
    });
    });
    
    $(document).keydown(function(e) {
        if (e.keyCode == 13) {
            timkiem();
       }
    });
    
    function timkiem()
    {   
        var a = $('input.key').val();   if(a=='Tên...') a='';       
        window.location ="index.php?com=product&act=man_mau&key="+a;   
        return true;
    }
    function select_onchange()
    {               
        var a=document.getElementById("id_product");
        window.location ="index.php?com=product&act=man_mau&type=<?=$_REQUEST['type']?>&id_product="+a.value;   
        return true;
    }
</script>

<?php
function get_main_product()
    {
        $sql="select *, ten$lang as ten from table_product where type='".$_REQUEST['type']."' order by stt";
        $stmt=mysql_query($sql);
        $str='
            <select id="id_product" name="id_product" onchange="select_onchange()" class="main_select select_danhmuc">
            <option value="">'._danhmucsanpham.'</option>            
            ';
        while ($row=@mysql_fetch_array($stmt)) 
        {
            if($row["id"]==(int)@$_REQUEST["id_product"])
                $selected="selected";
            else 
                $selected="";
            $str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';            
        }
        $str.='</select>';
        return $str;
    }
?>

<div class="control_frm" style="margin-top:25px;">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=product&act=man"><span><?=_quanlymausac?></span></a></li>
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
        <input type="button" class="blueB" value="<?=_them?>" onclick="location.href='index.php?com=product&act=add_mau<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>'" />
        <input type="button" class="blueB" value="<?=_xoa?>" id="xoahet" />
        
    </div>  
</div>
<div class="widget">
  <div class="title"><span class="titleIcon">
    <input type="checkbox" id="chonhet" name="titleCheck" />
    </span>
    <h6><?=_chontatca?></h6>
    
  </div>
 <table cellpadding="0" cellspacing="0" width="100%" class="sTable sTable1 withCheck mTable" id="checkAll">
    <thead>
      <tr>
        <td class="anmb"></td>
        <td class="tb_data_small anmb"><a href="#" class="tipS" style="margin: 5px;"><?=_thutu?></a></td>
         <td class="tb_data_small none anmb"><?=get_main_product()?></td>
        <td class="sortCol"><div><?=_ten?><span class="span"></span></div></td>
        <td class="tb_data_small"><?=_anhien?></td>
        <td width="200" class="hienmb"><?=_thaotac?></td>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="10">
       </td>
      </tr>
    </tfoot>
    <tbody>
     <?php for($i=0, $count=count($items); $i<$count; $i++){?>
          <tr>
        <td class="anmb">
            <input type="checkbox" name="chon" value="<?=$items[$i]['id']?>" id="check<?=$i?>" />
        </td>
        <td align="center" class="anmb">
             <input data-val0="<?=$items[$i]['id']?>" data-val2="table_<?=$_REQUEST['com']?>_mau" type="text" value="<?=$items[$i]['stt']?>" data-val3="stt" name="stt<?=$i?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="tipS smallText stt" onblur="stt(this)" id="upstt" original-title="Nhập số thứ tự " rel="<?=$items[$i]['id']?>" />
        </td>
        <td align="center" class="anmb none">
            <?php
                $sql_danhmuc="select ten from table_product where id='".$items[$i]['id_product']."'";
                $result=mysql_query($sql_danhmuc);
                $id_product =mysql_fetch_array($result);
                echo @$id_product['ten']
            ?>      
        </td>       
        <td>
            <a href="index.php?com=product&act=edit_mau&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?>&id_product=<?=$items[$i]['id_product']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" class="tipS SC_bold">
             <?=$items[$i]['ten']?>
            </a>
        </td>
        
        <td align="center">
         <a data-val2="table_<?=$_REQUEST['com']?>_mau" rel="<?=$items[$i]['hienthi']?>" data-val3="hienthi" class="diamondToggle <?=($items[$i]['hienthi']==1)?"diamondToggleOff":""?>" data-val0="<?=$items[$i]['id']?>" ></a> 
         
        </td>
        
        <td class="actBtns" class="hienmb">
            <a href="index.php?com=product&act=edit_mau&id=<?=$items[$i]['id']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" title="" class="smallButton tipS" original-title="Sửa danh mục"><img src="./images/icons/dark/pencil.png" alt=""></a>
           <a href="index.php?com=product&act=delete_mau&id=<?=$items[$i]['id']?>&id_product=<?=$items[$i]['id_product']?>&type=<?=$_REQUEST['type']?><?php if($_REQUEST['p']!='') echo'&p='.$_REQUEST['p'];?>" onClick="if(!confirm('Xác nhận xóa <?=$items[$i]['ten']?>')) return false;" title="" class="smallButton tipS" original-title="Xóa bài viết"><img src="./images/icons/dark/close.png" alt=""></a> 
        </td>
      </tr>
           <?php } ?> 
    </tbody>
    </table>
</div>
