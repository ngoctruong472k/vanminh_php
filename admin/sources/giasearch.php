<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&curPage=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "man":
		get_giasearchs();
		$template = "giasearch/giasearchs";
		break;
		
	case "add_giasearch":		
		$template = "giasearch/giasearch_add";
		break;
		
	case "edit_giasearch":
		get_giasearch();
		$template = "giasearch/giasearch_add";
		break;
		
	case "save_giasearch":
		save_giasearch();
		break;
		
	case "savestt_giasearch":
		savestt_giasearch();
		break;
		
	case "delete_giasearch":
		delete_giasearch();
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

function get_giasearchs(){	
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	$sql="SELECT count(id) AS numrows FROM #_giasearch where id<>0";
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
	
	$sql = "select * from #_giasearch where id<>0 $where order by stt asc, id desc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=giasearch&act=man".$urlcu;
}

function get_giasearch(){
	global $d, $item, $list_cat,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=giasearch&act=man".$urlcu);
	$d->setTable('giasearch');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=giasearch&act=man".$urlcu);
	$item = $d->fetch_array();	
}

function save_giasearch(){
	global $d,$config,$urlcu;
	
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=giasearch&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$data['giatu'] = str_replace(',','',$_POST['giatu']);
			$data['giaden'] = str_replace(',','',$_POST['giaden']);
			$data['stt'] = $_POST['stt'];
			$data['ngaytao'] = time();
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			foreach ($config['lang'] as $key => $value) {
				$data['ten'.$key] = $_POST['ten'.$key];	
				if($_POST['tenkhongdau'.$key]=='') {
					$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
				}else{
					$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
				}
			}
			$d->reset();
			$d->setTable('giasearch');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer(_capnhatdulieubiloi, "index.php?com=giasearch&act=man".$urlcu);
			redirect("index.php?com=giasearch&act=man".$urlcu);
			
	}else{ 							
			$data['giatu'] = str_replace(',','',$_POST['giatu']);
			$data['giaden'] = str_replace(',','',$_POST['giaden']);
			$data['stt'] = $_POST['stt'];
			$data['ngaytao'] = time();
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			foreach ($config['lang'] as $key => $value) {
				$data['ten'.$key] = $_POST['ten'.$key];	
				if($_POST['tenkhongdau'.$key]=='') {
					$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
				}else{
					$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
				}
			}															
			$d->setTable('giasearch');
			if($d->insert($data))
				redirect("index.php?com=giasearch&act=man".$urlcu);
			else
				transfer(_luudulieubiloi, "index.php?com=giasearch&act=man".$urlcu);
	}
}
//===========================================================
function delete_giasearch(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('giasearch');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=giasearch&act=man".$urlcu);
		$row = $d->fetch_array();
		if($d->delete())
			redirect("index.php?com=giasearch&act=man".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=giasearch&act=man".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();	
										
			$sql = "delete from #_giasearch where id='".$id."'";
			$d->query($sql);
		} 
		redirect("index.php?com=giasearch&act=man".$urlcu);
	}
}

?>