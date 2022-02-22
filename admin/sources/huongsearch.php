<?php	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	
	$urlcu = "";
	$urlcu .= (isset($_REQUEST['p'])) ? "&curPage=".addslashes($_REQUEST['p']) : "";

switch($act){
	case "man":
		get_huongsearchs();
		$template = "huongsearch/huongsearchs";
		break;
		
	case "add_huongsearch":		
		$template = "huongsearch/huongsearch_add";
		break;
		
	case "edit_huongsearch":
		get_huongsearch();
		$template = "huongsearch/huongsearch_edit";
		break;
		
	case "save_huongsearch":
		save_huongsearch();
		break;
		
	case "savestt_huongsearch":
		savestt_huongsearch();
		break;
		
	case "delete_huongsearch":
		delete_huongsearch();
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

function get_huongsearchs(){	
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;
	
	$sql="SELECT count(id) AS numrows FROM #_huongsearch where id<>0";
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
	
	$sql = "select * from #_huongsearch where id<>0 $where order by stt asc limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=huongsearch&act=man".$urlcu;
}

function get_huongsearch(){
	global $d, $item, $list_cat,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=huongsearch&act=man".$urlcu);
	$d->setTable('huongsearch');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=huongsearch&act=man".$urlcu);
	$item = $d->fetch_array();	
}

function save_huongsearch(){
	global $d,$urlcu;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=huongsearch&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			$data['giatu'] = $_POST['giatu'];
			$data['giaden'] = $_POST['giaden'];	
			$data['ten'] = $_POST['ten'];
			$data['stt'] = (int)$_POST['stt'];	

			$d->reset();
			$d->setTable('huongsearch');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=huongsearch&act=man".$urlcu);
			redirect("index.php?com=huongsearch&act=man".$urlcu);
			
	}else{ 							
			$data['ten'] = $_POST['ten'];	
			$data['giatu'] = $_POST['giatu'];	
			$data['giaden'] = $_POST['giaden'];		
			$data['stt'] = (int)$_POST['stt'];															
			$d->setTable('huongsearch');
			if($d->insert($data))
				redirect("index.php?com=huongsearch&act=man".$urlcu);
			else
				transfer("Lưu dữ liệu bị lỗi", "index.php?com=huongsearch&act=man".$urlcu);
	}
}
//===========================================================
function delete_huongsearch(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->setTable('huongsearch');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=huongsearch&act=man".$urlcu);
		$row = $d->fetch_array();
		if($d->delete())
			redirect("index.php?com=huongsearch&act=man".$urlcu);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=huongsearch&act=man".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();	
										
			$sql = "delete from #_huongsearch where id='".$id."'";
			$d->query($sql);
		} 
		redirect("index.php?com=huongsearch&act=man".$urlcu);
	}
}

?>