<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "meta/item_add";
		break;
	case "save":
		save_gioithieu();
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
function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_meta limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d,$config,$urlcu;
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=meta&act=capnhat");
	
	if($photo = upload_image("file", _format_duoihinh,_upload_hinhanh,'images_facebook')){
		$data['photo'] = $photo;
		$data['thumb'] = create_thumb($data['photo'], 400, 240, _upload_hinhanh,'images_facebook',2);
		delete_file(_upload_hinhanh.$data['photo']);
		$d->setTable('meta');			
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['thumb']);
		}
	}
	$data['api_facebook'] = $_POST['api_facebook'];
	foreach ($config['lang'] as $key => $value) {
		$data['alt'.$key] = magic_quote($_POST['alt'.$key]);	
		$data['h1'.$key] = magic_quote($_POST['h1'.$key]);
		$data['h2'.$key] = magic_quote($_POST['h2'.$key]);
		$data['h3'.$key] = magic_quote($_POST['h3'.$key]);
		$data['title'.$key] = magic_quote($_POST['title'.$key]);
		$data['keywords'.$key] = magic_quote($_POST['keywords'.$key]);
		$data['description'.$key] = magic_quote($_POST['description'.$key]);				
	}	
	$d->reset();
	$d->setTable('meta');
	if($d->update($data))
		header("Location:index.php?com=meta&act=capnhat");
	else
		transfer(_capnhatdulieubiloi, "index.php?com=meta&act=capnhat");
}

?>