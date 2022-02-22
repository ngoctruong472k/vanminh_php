<?php 
	include ("ajax_lib.php");
	
	if (isset($_POST["level"])) {
		 $level = $_POST["level"];
		$id=$_POST["id"];
		 $type = $_POST["type"];
		switch ($level) {
			case '0':{
				echo $sql="select * from table_product_list where id_danhmuc=".$id." and type='".$type."'  order by stt ";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn danh mục cấp 2</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$id_select)
						$selected="selected";
					else 
						$selected="";

					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo  $str;
				break;
			}
			case '1':{
				$sql="select * from table_product_cat where id_list=".$id." and  type='".$type."' order by stt";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn danh mục cấp 3</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$_REQUEST["id_cat"])
						$selected="selected";
					else 
						$selected="";
					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo $str;
				break;
			}
			case '2':{
				echo $sql="select * from table_product_item where id_cat=".$id." and  type='".$type."' order by stt";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn danh mục cấp 4</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$_REQUEST["id_cat"])
						$selected="selected";
					else 
						$selected="";
					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo $str;
				break;
			}
			case '4':{
				$sql="select * from table_place_dist where id_city=".$id." order by stt asc, id asc";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn Quận/Huyện</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$id_select)
						$selected="selected";
					else 
						$selected="";

					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo  $str;
				break;
			}
			case '5':{
				$sql="select * from table_place_ward where id_dist=".$id." order by stt asc, id asc";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn Phường/Xã</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$id_select)
						$selected="selected";
					else 
						$selected="";

					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo  $str;
				break;
			}
			case '6':{
				$sql="select * from table_product where type=".$type." order by stt asc, id asc";
				$stmt=mysql_query($sql);
				$str='
					<option value="0">Chọn Phường/Xã</option>			
					';
				while ($row=@mysql_fetch_array($stmt)) 
				{
					if($row["id"]==(int)@$id_select)
						$selected="selected";
					else 
						$selected="";

					$str.='<option value='.$row["id"].' '.$selected.'>'.$row['ten'.$tnn].'</option>';			
				}
				echo  $str;
				break;
			}
			default:
				echo 'error ajax';
				break;
		}
		
	}
?>
