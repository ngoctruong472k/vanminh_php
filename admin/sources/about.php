<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_item();
		$template = "about/item_add";
		break;
		
	case "save":
		save_item();
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

function get_item(){
	global $d, $item;

	$sql = "select *,ten$lang as ten, mota$lang as mota, noidung$lang as noidung from #_about where type='".$_REQUEST['type']."' limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0)
	{
		$data['hienthi'] = '1';
		$data['ngaytao'] = time();
		$data['type'] = $_REQUEST['type'];
		
		$d->setTable('about');
		if($d->insert($data))
			transfer(_dulieukhoitao,"index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
		else
			transfer(_dulieukhoitaoloi,"index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	}
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config;
	
	$file_name = $_FILES['file']['name'];
	$file_name1 = $_FILES['file1']['name1'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	
	if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_hinhanh,$file_name,2);
			$d->setTable('about');	
			$d->setWhere('type', $_REQUEST['type']);		
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo']);
				//delete_file(_upload_hinhanh.$row['thumb']);
			}
		}
	if($photo1 = upload_image("file1", _format_duoihinh,_upload_hinhanh,$file_name1)){
			$data['photo1'] = $photo1;
			//$data['thumb'] = create_thumb($data['photo'], 170, 130, _upload_hinhanh,$file_name,2);
			$d->setTable('about');	
			$d->setWhere('type', $_REQUEST['type']);		
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo1']);
				//delete_file(_upload_hinhanh.$row['thumb']);
			}
		}

	$data['tenkhongdau'] = $_POST['tenkhongdau'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['ngaysua'] = time();
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);		
			$data['title'.$key] = magic_quote($_POST['title'.$key]);
			$data['keywords'.$key] = magic_quote($_POST['keywords'.$key]);
			$data['description'.$key] = magic_quote($_POST['description'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}		
		}
		
	$d->reset();
	$d->setTable('about');
	$d->setWhere('type', $_REQUEST['type']);
	if($d->update($data))
		transfer(_dulieuduoccapnhat, "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
	else
		transfer(_capnhatdulieubiloi, "index.php?com=about&act=capnhat&type=".$_REQUEST['type']);
}

?>