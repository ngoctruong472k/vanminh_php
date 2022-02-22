<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['id_danhmuc'])) ? "&id_danhmuc=".addslashes($_REQUEST['id_danhmuc']) : "";
	$urlcu .= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
	$urlcu .= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
	$urlcu .= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
	$urlcu .= (isset($_REQUEST['type'])) ? "&type=".addslashes($_REQUEST['type']) : "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

switch($act){

	case "man":
		get_items();
		$template = "tags/items";
		break;		
	case "add":				
		$template = "tags/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "tags/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	
	default:
		$template = "index";
}
#====================================
function fns_Rand_digit($min,$max,$num){
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}
function get_items()
{
	global $d, $items;
	$type=$_REQUEST['type'];

	$sql = "select *,ten$lang as ten from #_tags where id<>0";
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (ten LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=tags&act=man&type=".$type."");	
	$sql = "select *,ten$lang as ten from #_tags where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=tags&act=man&type=".$type."");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d,$config,$urlcu;

	$type=$_REQUEST['type'];
	$file_name = $_FILES['file']['name'];

	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=tags&act=man&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		$id =  themdau($_POST['id']);		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);	
			$data['title'.$key] = magic_quote($_POST['title'.$key]);
			$data['keywords'.$key] = magic_quote($_POST['keywords'.$key]);
			$data['description'.$key] = magic_quote($_POST['description'.$key]);
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}

		if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 300, 200, _upload_hinhanh,$file_name,1);
			$d->setTable('about');	
			$d->setWhere('type', $_REQUEST['type']);		
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);
			}
		}				
		$data['stt'] = $_POST['stt'];
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('tags');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data))

		{
			redirect("index.php?com=tags&act=man".$urlcu."");
		}
		else
			transfer(_capnhatdulieubiloi, "index.php?com=tags&act=man".$urlcu."");
	}
	else
	{	
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);	
			$data['title'.$key] = magic_quote($_POST['title'.$key]);
			$data['keywords'.$key] = magic_quote($_POST['keywords'.$key]);
			$data['description'.$key] = magic_quote($_POST['description'.$key]);
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}	

		if($photo = upload_image("file", _format_duoihinh, _upload_hinhanh,$file_name))
		{
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 300, 2000, _upload_hinhanh,$file_name,1);	
		} 
		$data['type'] = $type;
		$data['stt'] = $_POST['stt'];
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('tags');
		if($d->insert($data))
		{		
			redirect("index.php?com=tags&act=man&type=".$type."");
		}
		else
			transfer(_luudulieubiloi, "index.php?com=tags&act=man&type=".$type."");
	}
}

function delete_item()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_tags where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);
				delete_file(_upload_hinhanh.$row['thumb']);			
			}
			$sql = "delete from #_tags where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=tags&act=man&type=".$type."");
		}
		else
			transfer(_xoadulieubiloi, "index.php?com=tags&act=man&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_tags where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_hinhanh.$row['photo']);
					delete_file(_upload_hinhanh.$row['thumb']);			
				}
				$sql = "delete from #_tags where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=tags&act=man&type=".$type."");
	} 
	else transfer(_khongnhanduocdulieu, "index.php?com=tags&act=man&type=".$type."");
}
?>