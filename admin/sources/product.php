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
		$template = "product/items";
		break;		
	case "add":				
		$template = "product/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "product/item_add";
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
		$template = "product/loais";
		break;
	case "add_item":		
		$template = "product/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "product/loai_add";
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
		$template = "product/cats";
		break;
	case "add_cat":		
		$template = "product/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "product/cat_add";
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
		$template = "product/lists";
		break;
	case "add_list":		
		$template = "product/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;

	#===================================================
	case "man_gia":
		get_items_gia();
		$template = "product/gia/items";
		break;
	case "add_gia":		
		$template = "product/gia/item_add";
		break;
	case "edit_gia":		
		get_item_gia();
		$template = "product/gia/item_add";
		break;
	case "save_gia":
		save_item_gia();
		break;
	case "delete_gia":
		delete_item_gia();
		break;
	#===================================================
	case "man_size":
		get_items_size();
		$template = "product/size/items";
		break;
	case "add_size":		
		$template = "product/size/item_add";
		break;
	case "edit_size":		
		get_item_size();
		$template = "product/size/item_add";
		break;
	case "save_size":
		save_item_size();
		break;
	case "delete_size":
		delete_item_size();
		break;
	#===================================================
	case "man_mau":
		get_items_mau();
		$template = "product/mau/items";
		break;
	case "add_mau":		
		$template = "product/mau/item_add";
		break;
	case "edit_mau":		
		get_item_mau();
		$template = "product/mau/item_add";
		break;
	case "save_mau":
		save_item_mau();
		break;
	case "delete_mau":
		delete_item_mau();
		break;
		
	#===================================================	
	case "man_danhmuc":
		get_danhmucs();
		$template = "product/danhmucs";
		break;
		
	case "add_danhmuc":		
		$template = "product/danhmuc_add";
		break;
		
	case "edit_danhmuc":		
		get_danhmuc();
		$template = "product/danhmuc_add";
		break;
		
	case "save_danhmuc":
		save_danhmuc();
		break;
	case "delete_danhmuc":
		delete_danhmuc();
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
	//=== tim kiem chi tiet -=====
	$where.=" and id<>0"; 
	if($_GET["ngaybd"]!=''){
	$ngaybatdau = $_GET["ngaybd"];	
	$Ngay_arr = explode("/",$ngaybatdau); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày <br>";} else $ngaybatdau=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao>=".strtotime($ngaybatdau)." ";
	}

	if($_GET["ngaykt"]!=''){
	 $ngayketthuc = $_GET["ngaykt"];	
	$Ngay_arr = explode("/",$ngayketthuc); // array(17,11,2010)
	if (count($Ngay_arr)==3) {
		$ngay = $Ngay_arr[0]; //17
		$thang = $Ngay_arr[1]; //11
		$nam = $Ngay_arr[2]; //2010
		if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày <br>";} else  $ngayketthuc=$nam."-".$thang."-".$ngay;
	}	
		$where.=" and ngaytao<=".strtotime($ngayketthuc)." ";
		
	}

	
	if($_GET["key"]!=''){
		$where.=" and (ten like '%".$_GET["key"]."%')  ";
	}
	//sotien
	if($_GET["sotien"]!='' && $_GET["sotien"]>0){
		$sql="select giatu,giaden from #_giasearch where id='".$_GET["sotien"]."'";
		$d->query($sql);
		$giatim=$d->fetch_array();
		if($giatim!=null){
			$where.=" and gia>=".$giatim['giatu']." and gia<=".$giatim['giaden']." ";		
		}
	}
	//======end tim kiem chi tiet=====
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
	$url_link="index.php?com=product&act=man".$urlcu;
}

function get_item(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=productact=man".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man".$urlcu);
	$item = $d->fetch_array();
	
}
//Đóng dấu watermark
function imagecreatefromfile($image_path,$img_watermark) {
    // retrieve the type of the provided image file
    list($width, $height, $image_type) = getimagesize($image_path);
    // select the appropriate imagecreatefrom* function based on the determined
	 //dump($image_path);
    switch ($image_type)
    {
      case IMAGETYPE_GIF: return imagecreatefromgif($image_path); break;
      case IMAGETYPE_JPEG: return imagecreatefromjpeg($image_path); break;
      case IMAGETYPE_PNG: return imagecreatefrompng($image_path); break;
      default: return ''; break;
    }
  }

function saveImageWaterMark($img){
	 $image = imagecreatefromfile($img);
  if (!$image) die('Unable to open image');
  $info = getimagesize ($img);

  // if($info[0] > 500) { // neu file anh co kick thuyoc  < 500px lay watermark la file ie-small
  // $watermark = imagecreatefromfile('../watermark.php');
  // $info1 = getimagesize ('../watermark.php'); // kick thuoc file watermark
  // }else{
  // neu lon hon 500px
  $watermark = imagecreatefromfile('../upload/hinhanh/logo-2072.png'.$img_watermark); //
  $info1 = getimagesize ('../upload/hinhanh/logo-2072.png'.$img_watermark); // kick thuoc file watermark

  //}
  if (!$image) die('Unable to open watermark');
  $w0 = $info[0];// chieu dai hinh goc
  $w1 = $info1[0];// chieu dai watermark


  $watermark_pos_x =($w0-$w1)/2;// canh giua trai fai //
 // $watermark_pos_x = 8 ;// vi tri cach goc trai  //
  //$watermark_pos_x = $w0-20-$w1;// vi tri cach goc phai  //

  $watermark_pos_y = (imagesy($image) - imagesy($watermark))/2;// canh giua tren duoi
  //$watermark_pos_y = (imagesy($image) - imagesy($watermark)) - 10;// cach duoi 10px
  imagecopy($image, $watermark,  $watermark_pos_x, $watermark_pos_y, 0, 0,
    imagesx($watermark), imagesy($watermark));
  // output watermarked image to browser
 //header('Content-Type: image/jpeg');
  if(end(explode(".",$img)) == "png"){// neu file
  	imagepng($image, $img, 0.9);  // chat luong 0->1 cho file png
  }else{
    imagejpeg($image, $img, 100); // chat luong 0->100 cho file jpg
  }
  // remove the images from memory
  imagedestroy($image);//huy
  imagedestroy($watermark);//huy
}

function save_item(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 440, 450, _upload_sanpham,$file_name,2);	
			//saveImageWaterMark(_upload_sanpham.$data['photo']);
			//delete_file(_upload_sanpham.$data['photo']);
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);								
			}
		}
		/*-- save danh muc size --*/
		$id_size = $_POST['id_list_chon'];
		if (count($id_size)>0) {
			foreach ($id_size as $key => $value) {
				if ($value!="") {
					if ($key==0) {
						$data['id_size'] .= $value;
					}else{
						$data['id_size'] .= ','.$value;
					}
				}
			}
		}else{
			$data['id_size']='';
		}
		/*-- end save danh muc size --*/
		/*-- save danh muc tags --*/
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
		/*-- end save danh muc tags --*/
		$data['thuonghieu'] = (int)$_POST['thuonghieu'];	
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];		
		$data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];	
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_nhasanxuat'] = (int)$_POST['id_nhasanxuat'];				
		$data['masp'] = magic_quote($_POST['masp']);			
		$data['gia'] = str_replace(',','',$_POST['gia']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['giasi'] = str_replace(',','',$_POST['giasi']);
		$data['soluongsi'] = $_POST['soluongsi'];
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
		//==== quan ly kho hang ==
		$d->reset();
		$sql = "select banra,tonkho,soluong from table_product where id='".$id."'";
		$d->query($sql);
		$product_qlk = $d->fetch_array();
		$soluongbandau = $_POST['soluong'];
		$soluongbanra= $product_qlk['banra'];
		$soluongtonkho= $soluongbandau - $soluongbanra;
		
		$sql_capnhat = "UPDATE table_product 
						SET tonkho='".$soluongtonkho."' 
						WHERE id='".$id."' ";
		mysql_query($sql_capnhat);
		//== end quan ly kho han===
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
			mysql_query("DELETE FROM table_protag where id_pro = '$id'");
			if(trim($_POST['tag'])!=''){
			  $arrTags = explode(",", $_POST['tag']);
			  $type=$_POST['type'];
			  foreach ($arrTags as $tag)
			  {
				 $tag = trim($tag);
				 if($tag!=""){
				 //Lấy id của tag có tên là $tag, nếu ko có thì thêm mới
				 $d->reset();
				 $sql= "select id from table_tags where ten='".$tag."' and type='$type'";
				 $d->query($sql);
				 $kiemtratag = $d->result_array();
	  			 
				 if (count($kiemtratag)!=0)
				 {
					  $idTag = $kiemtratag[0]['id'];
				 }
				 else
				 {
					  mysql_query("insert into table_tags(ten,type) values ('$tag','$type')");
					  $idTag = mysql_insert_id();
				 }
			  
				  //Insert dữ liệu vào table Articles_Tags
				  mysql_query("insert into table_protag(id_pro,id_tag) values ($id, $idTag)");
				  mysql_query("DELETE FROM table_tags where id NOT IN (SELECT id_tag from table_protag)");
				  }
			  }
			}
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
			redirect("index.php?com=product&act=man".$urlcu);
		}
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man".$urlcu);
	}else{

		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name))
		{
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 440, 450, _upload_sanpham,$file_name,2);	
			//saveImageWaterMark(_upload_sanpham.$data['photo']);
			//delete_file(_upload_sanpham.$data['photo']);
		}
		/*-- save danh muc size --*/
		$id_size = $_POST['id_list_chon'];
		if (count($id_size)>0) {
			foreach ($id_size as $key => $value) {
				if ($value!="") {
					if ($key==0) {
						$data['id_size'] .= $value;
					}else{
						$data['id_size'] .= ','.$value;
					}
				}
			}
		}
		/*-- end save danh muc size --*/
		/*-- save danh muc tags --*/
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
		/*-- end save danh muc tags --*/
		$data['thuonghieu'] = (int)$_POST['thuonghieu'];
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
		$data['type'] = $_POST['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['spmoi'] = isset($_POST['spmoi']) ? 1 : 0;
		$data['tieubieu'] = isset($_POST['tieubieu']) ? 1 : 0;
		$data['spbanchay'] = isset($_POST['spbanchay']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['soluong'] = $_POST['soluong'];
		$data['video'] = $_POST['video'];
		$data['link'] = $_POST['link'];
		$data['giasi'] = str_replace(',','',$_POST['giasi']);
		$data['soluongsi'] = $_POST['soluongsi'];
		
		//==== quan ly kho hang ==
		$data['tonkho']= $_POST['soluong'];
		//== end quan ly kho han===
		
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
		if($d->insert($data))
		{
			$id=mysql_insert_id();
			 $type=$_POST['type'];
			mysql_query("DELETE FROM table_protag where id_pro = '$id'");
			if(trim($_POST['tag'])!=''){
			  $arrTags = explode(",", $_POST['tag']);
			  foreach ($arrTags as $tag)
			  {
				 $tag = trim($tag);
				 if($tag!=""){
				 //Lấy id của tag có tên là $tag, nếu ko có thì thêm mới
				 $d->reset();
				 $sql= "select id from table_tags where ten='".$tag."' and type='$type'";
				 $d->query($sql);
				 $kiemtratag = $d->result_array();
	  			 
				 if (count($kiemtratag)!=0)
				 {
					  $idTag = $kiemtratag[0]['id'];
				 }
				 else
				 {
					  mysql_query("insert into table_tags(ten,type) values ('$tag','$type')");
					  $idTag = mysql_insert_id();
				 }
			  
				  //Insert dữ liệu vào table Articles_Tags
				  mysql_query("insert into table_protag(id_pro,id_tag) values ($id, $idTag)");
				  }
			  }
			}
			
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
			redirect("index.php?com=product&act=man".$urlcu);
		}
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man".$urlcu);
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
			redirect("index.php?com=product&act=man".$id_catt."");
		}
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man".$urlcu);
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
		redirect("index.php?com=product&act=man".$urlcu);
		} 
		else 
		transfer(_khongnhanduocdulieu, "index.php?com=product&act=man".$urlcu);	

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
	$url_link="index.php?com=product&act=man_item".$urlcu;
}

function get_loai(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_item".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_item".$urlcu);
	$item = $d->fetch_array();
}

function save_loai(){
	
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_item".$urlcu);
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
			redirect("index.php?com=product&act=man_item".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_item".$urlcu);
	}else{	
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			//$data['thumb'] = create_thumb($data['photo'], 200, 200, _upload_sanpham,$file_name,2);			
		}

		$data['type'] = $_POST['type'];
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['title'] = $_POST['title'];
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
			redirect("index.php?com=product&act=man_item".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_item".$urlcu);
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
			redirect("index.php?com=product&act=man_item".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_item".$urlcu);
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
		redirect("index.php?com=product&act=man_item".$urlcu);
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
	$url_link="index.php?com=product&act=man_cat".$urlcu;

}

function get_cat(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_cat".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_cat".$urlcu);
	$item = $d->fetch_array();	
}

function save_cat(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	$icon_name=$_FILES['icon']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_cat".$urlcu);
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
		if($icon = upload_image("icon", _format_duoihinh, _upload_sanpham,$icon_name)){
			$data['icon'] = $icon;						
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['icon']);				
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
			redirect("index.php?com=product&act=man_cat".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_cat".$urlcu);
	}
	else{				
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;						
		}
		if($icon = upload_image("icon", _format_duoihinh, _upload_sanpham,$icon_name)){
			$data['icon'] = $icon;						
		}

		$data['type'] = $_POST['type'];
		$data['id_danhmuc'] = (int)$_POST['id_danhmuc'];
		$data['id_list'] = $_POST['id_list'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['noibat'] = isset($_POST['noibat']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_POST['type'];
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
			redirect("index.php?com=product&act=man_cat".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_cat".$urlcu);
	}
}
//===========================================================
function delete_cat(){
	global $d,$urlcu;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);	
		//Reset danh mục			
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
			$sql = "select *,id,thumb,photo, icon from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
					delete_file(_upload_sanpham.$row['icon']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			
		if($d->query($sql))
			redirect("index.php?com=product&act=man_cat".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_cat".$urlcu);

	

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
			$sql = "select *,id,thumb,photo,icon from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
					delete_file(_upload_sanpham.$row['icon']);	
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
			
		} redirect("index.php?com=product&act=man_cat".$urlcu);
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
	$url_link="index.php?com=product&act=man_list".$urlcu;
}

##====================================================
function get_list(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_list".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_list".$urlcu);
	$item = $d->fetch_array();	
}
##====================================================
function save_list(){
	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	$icon_name=$_FILES['icon']['name'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_list".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);			
			}
		}
		if($icon = upload_image("icon", _format_duoihinh, _upload_sanpham,$icon_name)){
			$data['icon'] = $icon;		
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['icon']);			
			}
		}

		$data['type'] = $_POST['type'];
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
			redirect("index.php?com=product&act=man_list".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_list".$urlcu);
	}else{		
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
		}
		if($icon = upload_image("icon", _format_duoihinh, _upload_sanpham,$icon_name)){
			$data['icon'] = $icon;		
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
			redirect("index.php?com=product&act=man_list".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_list".$urlcu);
	}
}

//===========================================================

function delete_list(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);		
		$d->reset();		
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

			//Xóa danh mục cấp 2			
			$sql = "select *,id,thumb,photo,icon from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
					delete_file(_upload_sanpham.$row['icon']);	
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
			
		if($d->query($sql))
			redirect("index.php?com=product&act=man_list".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_list".$urlcu);
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
					$sql = "UPDATE table_product_cat SET id_list=0 WHERE id_list='".$id."'";
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
			$sql = "select *,id,thumb,photo,icon from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);	
					delete_file(_upload_sanpham.$row['icon']);	
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
			
		} 
		redirect("index.php?com=product&act=man_list".$urlcu);
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
	$url_link='index.php?com=product&act=man_danhmuc'.$urlcu;
}
//===========================================================
function get_danhmuc(){
	global $d, $item,$urlcu;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_danhmuc".$urlcu);
	
	$sql = "select *,ten$lang as ten from #_product_danhmuc where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_danhmuc".$urlcu);
	$item = $d->fetch_array();	
}
//===========================================================
function save_danhmuc(){

	global $d,$config,$urlcu;
	$file_name=$_FILES['file']['name'];
	$file_name1=$_FILES['file1']['name1'];
	$file_name2=$_FILES['file2']['name2'];
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_danhmuc".$urlcu);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){		
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 250, 250, _upload_sanpham,$file_name,2);
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
		if($photo1 = upload_image("file1", _format_duoihinh, _upload_sanpham,$file_name1)){
			$data['photo1'] = $photo1;	
			$data['thumb1'] = create_thumb($data['photo1'], 230, 313, _upload_sanpham,$file_name,1);
			$d->setTable('product_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo1']);	
				delete_file(_upload_sanpham.$row['thumb1']);				
			}
		}
		if($photo2 = upload_image("file2", _format_duoihinh, _upload_sanpham,$file_name2)){
			$data['photo2'] = $photo2;	
			$data['thumb2'] = create_thumb($data['photo2'], 230, 313, _upload_sanpham,$file_name,1);
			$d->setTable('product_danhmuc');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo2']);	
				delete_file(_upload_sanpham.$row['thumb2']);				
			}
		}
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
		
		$d->setTable('product_danhmuc');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_danhmuc".$urlcu);
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_danhmuc".$urlcu);
	}else{			
		  if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], 250, 250, _upload_sanpham,$file_name,2);			
		}		
		  if($photo1 = upload_image("file1", _format_duoihinh, _upload_sanpham,$file_name1)){
			$data['photo1'] = $photo1;
			$data['thumb1'] = create_thumb($data['photo1'], 230, 313, _upload_sanpham,$file_name1,2);		
		}		
		  if($photo2 = upload_image("file2", _format_duoihinh, _upload_sanpham,$file_name2)){
			$data['photo2'] = $photo2;
			$data['thumb2'] = create_thumb($data['photo2'], 230, 313, _upload_sanpham,$file_name2,2);		
		}
		$data['type'] = $_POST['type'];
		if($_POST['tenkhongdau']=='') {
			$data['tenkhongdau'] = changeTitle($_POST['ten']);
		}else{
			$data['tenkhongdau']=changeTitle($_POST['tenkhongdau']);
		}
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
		
		$d->setTable('product_danhmuc');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_danhmuc&".$urlcu);
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_danhmuc".$urlcu);
	}
}

//===========================================================

function delete_danhmuc(){
	global $d,$urlcu;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);	 	
		$d->reset();		
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

			//Xóa danh mục cấp 2			
			$sql = "select *,id,thumb,photo from #_product_danhmuc where id=".$id."";
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
			redirect("index.php?com=product&act=man_danhmuc".$urlcu);
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_danhmuc".$urlcu);
	}
	elseif (isset($_GET['listid'])==true)
	{
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

				//Xóa danh mục cấp 1			
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
		redirect("index.php?com=product&act=man_danhmuc".$urlcu);
	} 
	else transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_danhmuc".$urlcu);
}

function get_items_size()
{
	global $d, $items;
	$type=$_REQUEST['type'];

	$sql = "select *,ten$lang as ten from #_product_size where id<>0";
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (ten LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item_size()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_size&type=".$type."");	
	$sql = "select *,ten$lang as ten from #_product_size where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_size&type=".$type."");
	$item = $d->fetch_array();
}

function save_item_size()
{
	global $d,$config,$urlcu;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_size&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		$id =  themdau($_POST['id']);		
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}	
		
		$data['gia'] = (int)$_POST['gia'];			
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('product_size');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data))

		{
			redirect("index.php?com=product&act=man_size".$urlcu."");
		}
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_size".$urlcu."");
	}
	else
	{	
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}
		$data['gia'] = (int)$_POST['gia'];		
		$data['type'] = $type;
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('product_size');
		if($d->insert($data))
		{		
			redirect("index.php?com=product&act=man_size&type=".$type."");
		}
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_size&type=".$type."");
	}
}

function delete_item_size()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_size where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			$sql = "delete from #_product_size where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_size&type=".$type."");
		}
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_size&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_size where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				$sql = "delete from #_product_size where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=product&act=man_size&type=".$type."");
	} 
	else transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_size&type=".$type."");
}

function get_items_mau()
{
	global $d, $items;
	$type=$_REQUEST['type'];
	
	$sql = "select *,ten$lang as ten from #_product_mau where id<>0";
	
	if($_REQUEST['id_product']>0)
	{
	$sql.=" and id_product='".$_REQUEST['id_product']."'";
	}
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (ten LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item_mau()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_mau&type=".$type."");	
	$sql = "select *,ten$lang as ten from #_product_mau where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=product&act=man_mau&type=".$type."");
	$item = $d->fetch_array();
}

function save_item_mau()
{
	global $d,$config,$urlcu;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_mau&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 50, 50, _upload_sanpham,$file_name,2);	
			$d->setTable('product_mau');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_sanpham.$row['photo']);	
				delete_file(_upload_sanpham.$row['thumb']);								
			}
		}
		
		$data['id_product'] = $_POST['id_product'];

		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}
		$data['gia'] = (int)$_POST['gia'];
		$data['loaihienthi'] = (int)$_POST['loaihienthi'];
		$data['mau'] = magic_quote($_POST['mau']);

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('product_mau');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data))
		{
			if(isset($_POST['referer_link']))
				redirect($_POST['referer_link']);
			else
				redirect("index.php?com=product&act=man_mau".$urlcu."");
		}
		else
			transfer(_capnhatdulieubiloi, "index.php?com=product&act=man_mau".$urlcu."");
	}
	else
	{	
		if($photo = upload_image("file", _format_duoihinh, _upload_sanpham,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 50, 50, _upload_sanpham,$file_name,2);	
		}

		$data['id_product'] = $_POST['id_product'];
		foreach ($config['lang'] as $key => $value) {
			$data['ten'.$key] = $_POST['ten'.$key];	
			$data['ten'.$key] = $_POST['ten'.$key];	
			if($_POST['tenkhongdau'.$key]=='') {
				$data['tenkhongdau'.$key] = changeTitle($_POST['ten'.$key]);
			}else{
				$data['tenkhongdau'.$key]=changeTitle($_POST['tenkhongdau'.$key]);
			}
		}
		$data['gia'] = (int)$_POST['gia'];
		$data['loaihienthi'] = (int)$_POST['loaihienthi'];
		$data['mau'] = magic_quote($_POST['mau']);
		$data['type'] = $type;
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('product_mau');
		if($d->insert($data))
		{		
			redirect("index.php?com=product&act=man_mau&type=".$type."");
		}
		else
			transfer(_luudulieubiloi, "index.php?com=product&act=man_mau&type=".$type."");
	}
}

function delete_item_mau()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_mau where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_sanpham.$row['photo']);
				delete_file(_upload_sanpham.$row['thumb']);
			}
			$sql = "delete from #_product_mau where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_mau&type=".$type."");
		}
		else
			transfer(_xoadulieubiloi, "index.php?com=product&act=man_mau&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_mau where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_sanpham.$row['photo']);
					delete_file(_upload_sanpham.$row['thumb']);
				}
				$sql = "delete from #_product_mau where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=product&act=man_mau&type=".$type."");
	} 
	else transfer(_khongnhanduocdulieu, "index.php?com=product&act=man_mau&type=".$type."");
}
?>