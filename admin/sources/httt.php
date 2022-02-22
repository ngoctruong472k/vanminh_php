<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&p=".addslashes($_REQUEST['p']) : "";

//===========================================================
switch($act){
	case "man":
		get_items();
		$template = "httt/items";
		break;
	case "add":
		$template = "httt/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "httt/item_add";
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

	$sql="SELECT count(id) AS numrows FROM #_httt where id<>0 $where";
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
	
	$sql = "select * from #_httt where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=httt&act=man".$urlcu;

}
//===========================================================
function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=httt&act=man".$urlcu);
	
	$sql = "select * from #_httt where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc,"index.php?com=httt&act=man".$urlcu);
	$item = $d->fetch_array();
}
//===========================================================
function save_item(){
	global $d,$config,$urlcu;
	$file_name = $_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=httt&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
		$id =  themdau($_POST['id']);		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('httt');
		$d->setWhere('id', $id);
		if($d->update($data))			
				redirect("index.php?com=httt&act=man".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=httt&act=man".$urlcu);
	}else{

		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}	
		}
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('httt');
		if($d->insert($data))
			redirect("index.php?com=httt&act=man".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=httt&act=man".$urlcu);
	}
}
//===========================================================
function delete_item(){
	global $d,$urlcu;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_httt where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_khac.$row['photo']);
			}
			$sql = "delete from #_httt where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=httt&act=man");
		else
			transfer(_xoadulieubiloi, "index.php?com=httt&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_httt where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){}
			$sql = "delete from #_httt where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=httt&act=man".$urlcu);} else transfer(_khongnhanduocdulieu, "index.php?com=httt&act=man".$urlcu);
}

?>


