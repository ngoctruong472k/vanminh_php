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
		$template = "news/items";
		break;		
	case "add":				
		$template = "news/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "news/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	#===================================================	
	case "man_item":
		get_loais();
		$template = "news/loais";
		break;
	case "add_item":		
		$template = "news/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "news/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	#===================================================	
	case "man_cat":
		get_cats();
		$template = "news/cats";
		break;
	case "add_cat":		
		$template = "news/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "news/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	#===================================================	
	case "man_list":
		get_lists();
		$template = "news/lists";
		break;
	case "add_list":		
		$template = "news/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "news/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;

	
	#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "news/danhmucs";
		break;
		
	case "add_danhmuc":		
		$template = "news/danhmuc_add";
		break;
		
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "news/danhmuc_add";
		break;
		
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
		break;
	#===================================================	
	case "man_seoweb":
		get_seowebs();
		$template = "news/seo_website/items";
		break;
		
	case "add_seoweb":		
		$template = "news/seo_website/item_add";
		break;
		
	case "edit_seoweb":		
		get_seoweb();
		$template = "news/seo_website/item_add";
		break;
		
	case "save_seoweb":
		save_seoweb();
		break;
	case "delete_seoweb":
		delete_seoweb();
		break;
	default:
		$template = "index";
}
#====================================
function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

function get_items(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}	
	if((int)$_REQUEST['id_danhmuc']!='')
	{
		$where.=" and id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".(int)$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".(int)$_REQUEST['id_cat']."";
	}
	if((int)$_REQUEST['id_item']!='')
	{
		$where.=" and id_item=".(int)$_REQUEST['id_item']."";
	}

	if($_GET["key"]!=''){
		$where.=" and (ten like '%".$_GET["key"]."%')  ";
	}
	
	$where.= " order by stt asc,id_danhmuc,id_list,id_cat,id_item,id desc";

	$sql="SELECT count(id) AS numrows FROM #_product where id<>0 $where";
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
	
	$sql = "select *,ten$lang as ten from #_product where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man".$urlcu;
}

function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=newsact=man".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man".$urlcu);
	$item = $d->fetch_array();
	
}

function save_item(){

	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			if($_REQUEST['type']=='thuong-hieu') { 
				$data['thumb'] = create_thumb($data['photo'], 185, 90, _upload_sanpham,$file_name,2);
			} else {
				$data['thumb'] = create_thumb($data['photo'], 286, 247, _upload_sanpham,$file_name,1);
			}
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);								
			}
		}
		$id_tags = $_POST['list_tags'];
		if (count($id_tags)>0) {
			foreach ($id_tags as $key => $value) {
				if ($value!="") {
					if ($key==0) {
						$data['id_tags'] .= $value;
					}else{
						$data['id_tags'] .= ','.$value;
					}
				}
			}
		}else{
			$data['id_tags']='';
		}
		
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];		
		$data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_nhasanxuat'] = (int)$_POST['id_nhasanxuat'];					
		$data['masp'] = $_POST['masp'];			
		$data['gia'] = str_replace(',','',$_POST['gia']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['nhasanxuat'] = $_POST['nhasanxuat'];
		$data['size'] = trim($_POST['size']);
		$data['mausac'] = trim($_POST['mausac']);				
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['spmoi'] = isset($_POST['spmoi']) ? 1 : 0;
		$data['tieubieu'] = isset($_POST['tieubieu']) ? 1 : 0;
		$data['spbanchay'] = isset($_POST['spbanchay']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaysua'] = time();
		$data['soluong'] = $_POST['soluong'];
		$data['video'] = $_POST['video'];
		$data['link'] = $_POST['link'];
		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);	
			$data['noidung1'.$key] = magic_quote($_POST['noidung1'.$key]);
			$data['noidung2'.$key] = magic_quote($_POST['noidung2'.$key]);
			$data['noidung3'.$key] = magic_quote($_POST['noidung3'.$key]);		
			$data['title'.$key] = magic_quote($_POST['title'.$key]);
			$data['keywords'.$key] = magic_quote($_POST['keywords'.$key]);
			$data['description'.$key] = magic_quote($_POST['description'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}			
		}		
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data))
		{
				if (isset($_FILES['files'])) {
				 $arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
				 $arr_chuoi = str_replace('[','',$arr_chuoi);
				 $arr_chuoi = str_replace(']','',$arr_chuoi);
				 $arr_file_del = explode(',',$arr_chuoi);
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							//dump(in_array(($_FILES['files']['name'][$i]),$arr));
							$file['name'] = $_FILES['files']['name'][$i];
							$file['type'] = $_FILES['files']['type'][$i];
							$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
							$file['error'] = $_FILES['files']['error'][$i];
							$file['size'] = $_FILES['files']['size'][$i];
							$file_name = images_name($_FILES['files']['name'][$i]);
							$photo = upload_photos($file, _format_duoihinh, _upload_hinhthem,$file_name);
							$data1['photo'] = $photo;
							$data1['thumb'] = create_thumb($data1['photo'], 100, 100, _upload_hinhthem,$file_name,1);	
							$data1['ten'] = $_POST['tensp'][$i];
							$data1['stt'] = $_POST['stthinh'][$i];
							$data1['type'] = $_POST['type'];	
							$data1['id_hinhanh'] = $id;
							$data1['hienthi'] = 1;
							$d->setTable('hinhanh');
							$d->insert($data1);
						}
					}
				}
	        }
			redirect("index.php?com=news&act=man".$urlcu);
		}
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man".$urlcu);
	}else{

		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name))
		{
			$data['photo'] = $photo;		
			if($_REQUEST['type']=='thuong-hieu') { 
				$data['thumb'] = create_thumb($data['photo'], 185, 90, _upload_sanpham,$file_name,2);
			} else {
				$data['thumb'] = create_thumb($data['photo'], 286, 247, _upload_sanpham,$file_name,1);
			}	
		}
		
		$id_tags = $_POST['list_tags'];
		if (count($id_tags)>0) {
			foreach ($id_tags as $key => $value) {
				if ($value!="") {
					if ($key==0) {
						$data['id_tags'] .= $value;
					}else{
						$data['id_tags'] .= ','.$value;
					}
				}
			}
		}
		
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];		
		$data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_nhasanxuat'] = (int)$_POST['id_nhasanxuat'];				
		$data['masp'] = $_POST['masp'];			
		$data['gia'] = str_replace(',','',$_POST['gia']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['nhasanxuat'] = $_POST['nhasanxuat'];				
		$data['stt'] = $_POST['stt'];
		$data['size'] = trim($_POST['size']);
		$data['mausac'] = trim($_POST['mausac']);
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['spmoi'] = isset($_POST['spmoi']) ? 1 : 0;
		$data['tieubieu'] = isset($_POST['tieubieu']) ? 1 : 0;
		$data['spbanchay'] = isset($_POST['spbanchay']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_POST['type'];
		$data['video'] = $_POST['video'];
		$data['link'] = $_POST['link'];

		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);	
			$data['noidung1'.$key] = magic_quote($_POST['noidung1'.$key]);
			$data['noidung2'.$key] = magic_quote($_POST['noidung2'.$key]);
			$data['noidung3'.$key] = magic_quote($_POST['noidung3'.$key]);		
			$data['title'.$key] = $_POST['title'.$key];
			$data['keywords'.$key] = $_POST['keywords'.$key];
			$data['description'.$key] = $_POST['description'.$key];	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}		
		}
		$d->setTable('product');
		if($d->insert($data))
		{
			$id=mysql_insert_id();
			$type=$_POST['type'];

				if (isset($_FILES['files'])) {
				 $arr_chuoi = str_replace('"','',$_POST['jfiler-items-exclude-files-0']);
				 $arr_chuoi = str_replace('[','',$arr_chuoi);
				 $arr_chuoi = str_replace(']','',$arr_chuoi);
				 $arr_file_del = explode(',',$arr_chuoi);
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){
						if(!in_array(($_FILES['files']['name'][$i]),$arr_file_del,true))
						{
							//dump(in_array(($_FILES['files']['name'][$i]),$arr));
							$file['name'] = $_FILES['files']['name'][$i];
							$file['type'] = $_FILES['files']['type'][$i];
							$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
							$file['error'] = $_FILES['files']['error'][$i];
							$file['size'] = $_FILES['files']['size'][$i];
							$file_name = images_name($_FILES['files']['name'][$i]);
							$photo = upload_photos($file, _format_duoihinh, _upload_hinhthem,$file_name);
							$data1['photo'] = $photo;
							$data1['thumb'] = create_thumb($data1['photo'], 100, 100, _upload_hinhthem,$file_name,1);	
							$data1['ten'] = $_POST['tensp'][$i];
							$data1['stt'] = $_POST['stthinh'][$i];
							$data1['type'] = $_POST['type'];
							$data1['id_hinhanh'] = $id;
							$data1['hienthi'] = 1;
							$d->setTable('hinhanh');
							$d->insert($data1);
						}
					}
				}
	        }

			redirect("index.php?com=news&act=man".$urlcu);
		}
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man".$urlcu);
	}
}


//===========================================================
function delete_item(){
	global $d,$urlcu;
	if($_REQUEST['type']!=''){
		$id_catt="&type=".$_REQUEST['type'];
	}
	if($_REQUEST['p']!=''){ 
		$id_catt.="&p=".$_REQUEST['p'];
	}
		
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);			
			}
		$sql = "delete from #_product where id='".$id."'";
		$d->query($sql);
		
		}
		if($d->query($sql)){
			/*-- Xoa anh --*/
			$d->reset();
			$sql = "select id,thumb, photo from #_hinhanh where id_hinhanh='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_hinhthem.$row['photo']);
					delete_file(_upload_hinhthem.$row['thumb']);			
				}
			}
			$sql = "delete from #_hinhanh where id_hinhanh='".$id."'";
			$d->query($sql);
			/* -- end xoa --*/
			redirect("index.php?com=news&act=man".$id_catt."");
		}
		else
			transfer(_xoadulieubiloi, "index.php?com=news&act=man".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
			
			/*-- Xoa anh --*/
			
			$d->reset();
			$sql = "select id,thumb, photo from #_hinhanh where id_hinhanh='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_hinhthem.$row['photo']);
					delete_file(_upload_hinhthem.$row['thumb']);			
				}
			}
			$sql = "delete from #_hinhanh where id_hinhanh='".$id."'";
			$d->query($sql);
			/* -- end xoa --*/
		}
		} 
		redirect("index.php?com=news&act=man".$urlcu);
		} 
		else 
		transfer(_khongnhanduocdulieu, "index.php?com=news&act=man".$urlcu);	

}

#====================================

function get_loais(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}	
	if((int)$_REQUEST['id_danhmuc']!='')
	{
		$where.=" and id_danhmuc=".$_REQUEST['id_danhmuc']."";
	}
	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat']."";
	}
	$where.=" order by stt,id desc";

	
	$sql="SELECT count(id) AS numrows FROM #_product_item where id<>0 $where";
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
	
	$sql = "select *,ten$lang as ten from #_product_item where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_item".$urlcu;
}

function get_loai(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_item".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man_item".$urlcu);
	$item = $d->fetch_array();
}

function save_loai(){
	
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_item".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){	
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);		
			$d->setTable('product_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				//delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];	
		$data['id_cat'] = $_POST['id_cat'];			
		$data['stt'] = $_POST['stt'];
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
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=news&act=man_item".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man_item".$urlcu);
	}else{		
		 if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);			
		}
		$data['type'] = $_POST['type'];
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
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
		
		$d->setTable('product_item');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_item".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man_item".$urlcu);
	}
}
//===========================================================

function delete_loai(){
	global $d,$urlcu;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
				//Reset danh mục			
				$sql = "select * from #_product where id_item='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product SET id_item=0 WHERE id_item=".$id."";
					$d->query($sql);
				}		
		$d->reset();		
		
			//Xóa danh mục cấp 2			
			$sql = "select *,id,thumb,photo from #_product_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_item where id='".$id."'";
				$d->query($sql);
			}
		if($d->query($sql))
			redirect("index.php?com=news&act=man_item".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=news&act=man_item".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	
				//Reset danh mục			
				$sql = "select * from #_product where id_item='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product SET id_item=0 WHERE id_item=".$id."";
					$d->query($sql);
				}	

				$d->reset();
				//Xóa danh mục cấp 2			
				$sql = "select *,id,thumb,photo from #_product_item where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_sanpham.$row['photo']);
						delete_file(_upload_sanpham.$row['thumb']);	
					}
					$sql = "delete from #_product_item where id='".$id."'";
					$d->query($sql);
				}
			
		} 
		redirect("index.php?com=news&act=man_item".$urlcu);
	}
	
}

##===================================================
function get_cats(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}		
	if((int)$_REQUEST['id_danhmuc']!='')
	{
		$where.=" and id_danhmuc=".(int)$_REQUEST['id_danhmuc']."";
	}
	if((int)$_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".(int)$_REQUEST['id_list']."";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by id_danhmuc,id_list,stt,id desc";
	
	$sql="SELECT count(id) AS numrows FROM #_product_cat where id<>0 $where";
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
	
	$sql = "select *,ten$lang as ten from #_product_cat where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_cat".$urlcu;

}

function get_cat(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_cat".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man_cat".$urlcu);
	$item = $d->fetch_array();	
}

function save_cat(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_cat".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{	
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);						
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				//delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
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
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=news&act=man_cat".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man_cat".$urlcu);
	}
	else{				
		 if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);						
		}
		$data['type'] = $_POST['type'];
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
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
		$d->setTable('product_cat');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_cat".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man_cat".$urlcu);
	}
}
//===========================================================
function delete_cat(){
	global $d,$urlcu;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);	
				//Reset danh mục			
				$sql = "select * from #_product_item where id_cat='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_item SET id_cat=0 WHERE id_cat=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product where id_cat='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product SET id_cat=0 WHERE id_cat=".$id."";
					$d->query($sql);
				}		
		$d->reset();		
			
			//Xóa danh mục cấp 3
			$sql = "select *,id,thumb,photo from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			
		if($d->query($sql))
			redirect("index.php?com=news&act=man_cat".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=news&act=man_cat".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
				//Reset danh mục			
				$sql = "select * from #_product_item where id_cat='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_item SET id_cat=0 WHERE id_cat=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product where id_cat='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product SET id_cat=0 WHERE id_cat=".$id."";
					$d->query($sql);
				}

				$d->reset();
				//Xóa danh mục cấp 3
				$sql = "select *,id,thumb,photo from #_product_cat where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_sanpham.$row['photo']);
						delete_file(_upload_sanpham.$row['thumb']);	
					}
					$sql = "delete from #_product_cat where id='".$id."'";
					$d->query($sql);
				}
			
		} redirect("index.php?com=news&act=man_cat".$urlcu);
	}
							
}

##====================================================
function get_lists(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$paging,$urlcu;

	if($_REQUEST['type']!='')
	{
		$where.=" and type='".$_REQUEST['type']."'";
	}		
	if((int)$_REQUEST['id_danhmuc']!='')
	{
		$where.=" and id_danhmuc=".$_REQUEST['id_danhmuc']."";
	}
	if($_REQUEST['key']!='')
	{
		$where.=" and ten like '%".$_REQUEST['key']."%'";
	}
	$where.=" order by id_danhmuc,stt,id desc";

	$sql="SELECT count(id) AS numrows FROM #_product_list where id<>0 $where";
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
	
	$sql = "select *,ten$lang as ten from #_product_list where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link="index.php?com=news&act=man_list".$urlcu;
}

##====================================================
function get_list(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_list".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man_list".$urlcu);
	$item = $d->fetch_array();	
}
##====================================================
function save_list(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_list".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);		
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				//delete_file(_upload_sanpham.$row['thumb']);			
			}
		}
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
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
		
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=news&act=man_list".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man_list".$urlcu);
	}else{		
		 if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);
		}
		$data['type'] = $_POST['type'];
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
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
		
		$d->setTable('product_list');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_list".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man_list".$urlcu);
	}
}

//===========================================================

function delete_list(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);	
				//Reset danh mục			
				$sql = "select * from #_product_cat where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_cat SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product_item where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_item SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{	
					$sql = "UPDATE table_product SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}	
		$d->reset();		
		
			//Xóa danh mục cấp 2			
			$sql = "select *,id,thumb,photo from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
			
		
		if($d->query($sql))
			redirect("index.php?com=news&act=man_list".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=news&act=man_list".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	
				//Reset danh mục			
				$sql = "select * from #_product_cat where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_cat SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product_item where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_item SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product where id_list='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{	
					$sql = "UPDATE table_product SET id_list=0 WHERE id_list=".$id."";
					$d->query($sql);
				}	
			$d->reset();
			
				//Xóa danh mục cấp 2			
				$sql = "select *,id,thumb,photo from #_product_list where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_sanpham.$row['photo']);
						delete_file(_upload_sanpham.$row['thumb']);	
					}
					$sql = "delete from #_product_list where id='".$id."'";
					$d->query($sql);
				}
			
		} 
		redirect("index.php?com=news&act=man_list".$urlcu);
	}
}


##==========================================================
function get_danhmucs(){
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

	$sql="SELECT count(id) AS numrows FROM #_product_danhmuc where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select *,ten$lang as ten from #_product_danhmuc where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=news&act=man_danhmuc'.$urlcu;
}
//===========================================================
function get_danhmuc(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_danhmuc".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man_danhmuc".$urlcu);
	$item = $d->fetch_array();	
}
//===========================================================
function save_danhmuc(){

	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_danhmuc".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 300, 200, _upload_sanpham,$file_name,2);
			//delete_file(_upload_sanpham.$data['photo']);	
			$d->setTable('product_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
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
		
		$d->setTable('product_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=news&act=man_danhmuc".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man_danhmuc".$urlcu);
	}else{			
		  if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 300, 200, _upload_sanpham,$file_name,2);	
			//delete_file(_upload_sanpham.$data['photo']);			
		}
		$data['type'] = $_POST['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();	
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
		
		$d->setTable('product_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_danhmuc&".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man_danhmuc".$urlcu);
	}
}

//===========================================================

function delete_danhmuc(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);	
			//Reset danh mục			
			$sql = "select * from #_product_list where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				$sql = "UPDATE table_product_list SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
				$d->query($sql);
			}
			//Reset danh mục			
			$sql = "select * from #_product_cat where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				$sql = "UPDATE table_product_cat SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
				$d->query($sql);
			}
			//Reset danh mục			
			$sql = "select * from #_product_item where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				$sql = "UPDATE table_product_item SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
				$d->query($sql);
			}
			//Reset danh mục			
			$sql = "select * from #_product where id_danhmuc='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				$sql = "UPDATE table_product SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
				$d->query($sql);
			}		
		$d->reset();		
		
			//Xóa danh mục cấp 2			
			$sql = "select *,id,thumb,photo from #_product_danhmuc where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
				}
				$sql = "delete from #_product_danhmuc where id='".$id."'";
				$d->query($sql);
			}

		if($d->query($sql))
			redirect("index.php?com=news&act=man_danhmuc".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=news&act=man_danhmuc".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
				//Reset danh mục			
				$sql = "select * from #_product_list where id_danhmuc='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_list SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product_cat where id_danhmuc='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_cat SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product_item where id_danhmuc='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product_item SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
					$d->query($sql);
				}
				//Reset danh mục			
				$sql = "select * from #_product where id_danhmuc='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					$sql = "UPDATE table_product SET id_danhmuc=0 WHERE id_danhmuc=".$id."";
					$d->query($sql);
				}

				$d->reset();
				//Xóa danh mục cấp 2			
				$sql = "select *,id,thumb,photo from #_product_danhmuc where id='".$id."'";
				$d->query($sql);
				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_sanpham.$row['photo']);
						delete_file(_upload_sanpham.$row['thumb']);	
					}
					$sql = "delete from #_product_danhmuc where id='".$id."'";
					$d->query($sql);
				}
			
		}
		redirect("index.php?com=news&act=man_danhmuc".$urlcu);
	}
	else 
		transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_danhmuc".$urlcu);
}
##==========================================================
function get_seowebs(){
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

	$sql="SELECT count(id) AS numrows FROM #_product where id<>0 $where";
	$d->query($sql);	
	$dem=$d->fetch_array();
	$totalRows=$dem['numrows'];
	$page=$_GET['p'];
	
	$pageSize=20;
	$offset=5;
						
	if ($page=="")
		$page=1;
	else 
		$page=$_GET['p'];
	$page--;
	$bg=$pageSize*$page;		
	
	$sql = "select *,ten$lang as ten from #_product where id<>0 $where limit $bg,$pageSize";		
	$d->query($sql);
	$items = $d->result_array();	
	$url_link='index.php?com=news&act=man_seoweb'.$urlcu;
}
//===========================================================
function get_seoweb(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_seoweb".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=news&act=man_seoweb".$urlcu);
	$item = $d->fetch_array();	
}
//===========================================================
function save_seoweb(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_seoweb".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 400, 240, _upload_sanpham,$file_name,2);
			//delete_file(_upload_sanpham.$data['photo']);	
			$d->setTable('product_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);				
			}
		}
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];		
			$data['title'.$key] = $_POST['title'.$key];
			$data['keywords'.$key] = $_POST['keywords'.$key];
			$data['description'.$key] = $_POST['description'.$key];	
		}
		
		$d->setTable('product');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=news&act=man_seoweb".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=news&act=man_seoweb".$urlcu);
	}else{			
		  if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 400, 240, _upload_sanpham,$file_name,2);	
			//delete_file(_upload_sanpham.$data['photo']);			
		}
		$data['type'] = $_POST['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();	
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['type'] = $_POST['type'];
		$data['description'] = $_POST['description'];
		$data['tenkhongdau'] = changeTitle($_POST['ten']);
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];		
			$data['title'.$key] = $_POST['title'.$key];
			$data['keywords'.$key] = $_POST['keywords'.$key];
			$data['description'.$key] = $_POST['description'.$key];		
		}
		
		$d->setTable('product');
		if($d->insert($data))
			redirect("index.php?com=news&act=man_seoweb&".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=news&act=man_seoweb".$urlcu);
	}
}

//===========================================================

function delete_seoweb(){
	global $d,$urlcu;
	if($_REQUEST['type']!=''){
		$id_catt="&type=".$_REQUEST['type'];
	}
	if($_REQUEST['p']!=''){ 
		$id_catt.="&p=".$_REQUEST['p'];
	}
		
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,thumb, photo from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);			
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		redirect("index.php?com=news&act=man_seoweb".$id_catt."");
		}else transfer(_xoadulieubiloi, "index.php?com=news&act=man_seoweb".$urlcu);
	}elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$d->reset();
			$sql = "select id,thumb, photo from #_product where id='".$id."'";
			$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
	} 
	redirect("index.php?com=news&act=man_seoweb".$urlcu);
	} 
	else 
	transfer(_khongnhanduocdulieu, "index.php?com=news&act=man_seoweb".$urlcu);	
}
?>