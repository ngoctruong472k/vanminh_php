<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_photo();
		$template = "anhnen/item_add";
		break;
	case "save":
		save_photo();
		break;
	case "delete_img":
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

function get_photo(){
	global $d, $item;

	$sql = "select * from #_anhnen where type='".$_REQUEST['type']."' limit 0,1";
	$d->query($sql);
	if($d->num_rows()==0)
	{
		$data['hienthi'] = '1';
		$data['type'] = $_REQUEST['type'];
		
		$d->setTable('anhnen');
		if($d->insert($data))
			transfer(_dulieukhoitao,"index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
		else
			transfer(_dulieukhoitaoloi,"index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
	}
	$item = $d->fetch_array();

}


function save_photo(){
	global $d;
	$file_name=fns_Rand_digit(0,9,15);
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);

	if($photo = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
		$data['photo'] = $photo;
		$d->setTable('anhnen');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			delete_file(_upload_hinhanh.$row['photo']);
		}
	}	
	$data['color'] = $_POST['color'];
	$data['color_pro'] = $_POST['color_pro'];
	$data['trangthai'] = $_POST['repeat'];
	$data['bgsize'] = $_POST['bgsize'];

	$data['position_y'] = $_POST['position_y'];
	$data['position_x'] = $_POST['position_x'];
	$data['type']=$_REQUEST['type'];
	$data['fix']=$_REQUEST['fix'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$d->reset();
	$d->setTable('anhnen');
	$d->setWhere('type', $_REQUEST['type']);
	if(!$d->update($data)) transfer(_capnhatdulieubiloi, "index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
	redirect("index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
			
}
function delete_photo(){
	global $d;		
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id, photo from #_anhnen where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo']);	
			}
		$sql = "UPDATE #_anhnen SET photo ='' WHERE  id = '".$id."'";
		$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
		else
			transfer(_xoadulieubiloi, "index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
	}else transfer(_khongnhanduocdulieu, "index.php?com=anhnen&act=capnhat&type=".$_REQUEST['type']);
}
?>	