<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&curPage=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "man_photo":
		get_photos();
		$template = "slider/photos";
		break;
		
	case "add_photo":		
		$template = "slider/photo_add";
		break;
		
	case "edit_photo":
		get_photo();
		$template = "slider/photo_edit";
		break;
		
	case "save_photo":
		save_photo();
		break;
		
	case "savestt_photo":
		savestt_photo();
		break;
		
	case "delete_photo":
		delete_photo();
		break;			
	default:
		$template = "index";
}

function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_photos(){	
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by stt,id desc";	
	
	$sql="SELECT count(id) AS numrows FROM #_slider where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=10;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select *,ten$lang as ten from #_slider where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=slider&act=man_photo".$urlcu;
}

function get_photo(){
	global $d, $item, $list_cat,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=slider&act=man_photo".$urlcu);
	$d->setTable('slider');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=slider&act=man_photo".$urlcu);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$urlcu;
	
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=slider&act=man_photo".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$file_name = $_FILES['file']['name'];
			$file_nameen = $_FILES['fileen']['name'];
			$file_namecn = $_FILES['filecn']['name'];
			if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name)){
				$data['photo'] = $photo;
				$d->setTable('slider');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo']);
				}
			}
			if($photoen = upload_image("fileen", _format_duoihinh, _upload_hinhanh,$file_nameen)){
				$data['photoen'] = $photoen;
				$d->setTable('slider');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photoen']);
				}
			}
			if($photocn = upload_image("filecn", _format_duoihinh, _upload_hinhanh,$file_namecn)){
				$data['photocn'] = $photocn;
				$d->setTable('slider');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photocn']);
				}
			}
			
			$data['id_slider'] = $_REQUEST['id_slider'];
			$data['type'] = $_REQUEST['type'];
			$data['vitri'] = $_POST['vitri'];
						
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			$data['ten'] = $_POST['ten'];
			$data['mota'] = $_POST['mota'];	
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
			
			$data['tenen'] = $_POST['tenen'];
			$data['tencn'] = $_POST['tencn'];
			$data['motaen'] = $_POST['motaen'];
			$data['motacn'] = $_POST['motacn'];
			$data['mota1'] = $_POST['mota1'];
			$data['mota1en'] = $_POST['mota1en'];
			$data['mota1cn'] = $_POST['mota1cn'];

			$d->reset();
			$d->setTable('slider');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer(_capnhatdulieubiloi, "index.php?com=slider&act=man_photo".$urlcu);
			redirect("index.php?com=slider&act=man_photo".$urlcu);
			
	}
	{ 			
		for($i=0; $i<3; $i++){
				$file_name = $_FILES['file'.$i]['name'];
				$file_nameen = $_FILES['fileen'.$i]['name'];
				$file_namecn = $_FILES['filecn'.$i]['name'];
				if($data['photo'] = upload_image("file".$i, _format_duoihinh, _upload_hinhanh,$file_name))
					{					
						$data['photoen'] = upload_image("fileen".$i, _format_duoihinh, _upload_hinhanh,$file_nameen);	
						$data['photocn'] = upload_image("filecn".$i, _format_duoihinh, _upload_hinhanh,$file_namecn);
						$data['id_slider'] = $_REQUEST['id_slider'];
						$data['type'] = $_REQUEST['type'];
						$data['vitri'] = $_POST['vitri'.$i];
						$data['stt'] = $_POST['stt'.$i];
						$data['ten'] = $_POST['ten'.$i];	
						$data['link'] = $_POST['link'.$i];	
						$data['mota'] = $_POST['mota'.$i];	
						
						$data['tenen'] = $_POST['tenen'.$i];
						$data['tenen'] = $_POST['tencn'.$i];
						$data['motaen'] = $_POST['motaen'.$i];
						$data['motaen'] = $_POST['motacn'.$i];
						$data['mota1'] = $_POST['mota1'.$i];
						$data['mota1en'] = $_POST['mota1en'.$i];
						$data['mota1en'] = $_POST['mota1cn'.$i];
																
						$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;	
						$data['noibat'] = isset($_POST['noibat'.$i]) ? 1 : 0;																	
						$d->setTable('slider');
						if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=slider&act=man_photo".$urlcu);
					}
			}
			redirect("index.php?com=slider&act=man_photo".$urlcu);
	}
}
//===========================================================
function delete_photo(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('slider');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=slider&act=man_photo".$urlcu);
		$row = $d->fetch_array();
		delete_file(_upload_hinhanh.$row['photo']);
		delete_file(_upload_hinhanh.$row['photoen']);
		delete_file(_upload_hinhanh.$row['photocn']);
		if($d->delete())
			redirect("index.php?com=slider&act=man_photo".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=slider&act=man_photo".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_slider where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['photoen']);
				delete_file(_upload_hinhanh.$row['photocn']);
			}
			$sql = "delete from #_slider where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=slider&act=man_photo".$urlcu);} else transfer(_khongnhanduocdulieu, "index.php?com=slider&act=man_photo".$urlcu);
}

?>

	
