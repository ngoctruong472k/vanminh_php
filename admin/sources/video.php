<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "video/items";
		break;
	case "add":
		$template = "video/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "video/item_add";
		break;
	case "save":
		save_item();
		break;
	case "savestt":
		savestt_item();
		break;
	case "delete":
		delete_item();
		break;		

	default:
		$template = "index";
}
//===========================================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
//===========================================================
function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by stt,id desc";	
	
	
	$sql="SELECT count(id) AS numrows FROM #_video where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=10;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select *,ten$lang as ten from #_video where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=video&act=man".$urlcu;
}
//===========================================================
function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=video&act=man".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_video where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=video&act=man".$urlcu);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d,$config,$urlcu;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=video&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;
			$d->setTable('video');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_khac.$row['photo']);
			}
		}
		$data['tenkhongdau'] = $_POST['tenkhongdau'];
		$data['link'] = $_POST['link'];
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			
		}

		$d->setTable('video');
		$d->setWhere('id', $id);
		if($d->update($data))			
				redirect("index.php?com=video&act=man".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=video&act=man".$urlcu);
	}else{
		
		if($photo = upload_image("file", _format_duoihinh ,_upload_khac,$file_name)){
			$data['photo'] = $photo;	
		}
		$data['tenkhongdau'] = $_POST['tenkhongdau'];
		$data['link'] = $_POST['link'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			
		}
		
		$d->setTable('video');
		if($d->insert($data))
			redirect("index.php?com=video&act=man".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=video&act=man".$urlcu);
	}
}
//===========================================================
function delete_item(){
	global $d,$urlcu;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_video where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
			}
			$sql = "delete from #_video where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=video&act=man");
		else
			transfer(_xoadulieubiloi, "index.php?com=video&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_video where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
			}
			$sql = "delete from #_video where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=video&act=man");} else transfer(_khongnhanduocdulieu, "index.php?com=video&act=man".$urlcu);
}

?>


