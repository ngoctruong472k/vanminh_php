<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
switch($act){
	case "man":
		get_mails();
		$template = "contact/items";
		break;
	
	case "add":

		$template = "contact/item_add";
		break;
	
	case "edit":
		get_mail();
		$template = "contact/item_add";
		break;	
		
	case "send":
		send();
		break;
	
	case "save":
		save_mail();
		break;	
	
	case "delete":
		delete();
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

function get_mails(){
	global $d, $items;

	$sql = "select * from #_contact where id<>0 ";
	if($_REQUEST['key']!='')
	{
		$sql.=" and email like '%".$_REQUEST['key']."%'";
	}
	$sql.=" order by stt,id desc";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieuchuakhoitao, "index.php");
	$items = $d->result_array();
}

function get_mail(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer(_khongnhanduocdulieu, "index.php?com=contact&act=man");
	
	$sql = "select * from #_contact where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer(_dulieukhongcothuc, "index.php?com=contact&act=man");
	$item = $d->fetch_array();
}

function save_mail(){
	global $d;
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=contact&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		$data['tieude'] = $_POST['tieude'];
		$data['hovaten'] = $_POST['hovaten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$data['email'] = $_POST['email'];
		$data['noidung'] = $_POST['noidung'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('contact');
		$d->setWhere('id', $id);
		if($d->update($data))
				redirect("index.php?com=contact&act=man");
		else
			transfer(_capnhatdulieubiloi, "index.php?com=contact&act=man");
	}else{
				
		$data['tieude'] = $_POST['tieude'];
		$data['hovaten'] = $_POST['hovaten'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$data['email'] = $_POST['email'];
		$data['noidung'] = $_POST['noidung'];
		$data['stt'] = $_POST['stt'];
		
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('contact');
		if($d->insert($data))
			redirect("index.php?com=contact&act=man");
		else
			transfer(_luudulieubiloi, "index.php?com=contact&act=man");
	}
}

function delete(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$sql = "delete from #_contact where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=contact&act=man");
		else
			transfer(_xoadulieubiloi, "index.php?com=contact&act=man");
	}else transfer(_khongnhanduocdulieu, "index.php?com=contact&act=man");	
}

function send(){
	global $d,$ip_host,$mail_host,$pass_mail;

	$file_name= changeTitle($_FILES['file']['name']);
	
	if(empty($_POST)) transfer(_khongnhanduocdulieu, "index.php?com=contact&act=man");
	
	if($file = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF', _upload_hinhanh,$file_name)){
		$data['file'] = $file;
	}	
	
	$d->setTable('company');
	$d->select();
	$company_mail = $d->fetch_array();
	
	if(isset($_POST['listid'])){
		include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// G???i ?????n class x??? l?? SMTP
			$mail->Host       = $ip_host;   // t??n SMTP server
			$mail->SMTPAuth   = true;       // S??? d???ng ????ng nh???p v??o account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail; 
			
		//Thiet lap thong tin nguoi gui va email nguoi gui
		$mail->SetFrom($company_mail['email'], $company_mail['ten']);

		$listid = explode(",",$_POST['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select email from #_contact where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
			while($row = $d->fetch_array()){
			$mail->AddAddress($row['email'], $company_mail['ten']);
			}
			}
		}
		//Thi???t l???p ti??u ?????
		$mail->Subject    = '['.$_POST['ten'].']';
		$mail->IsHTML(true);
		//Thi???t l???p ?????nh d???ng font ch???
		$mail->CharSet = "utf-8";	
		$body = $_POST['noidung'];
		
		$mail->Body = $body;
		if($data['file']){
			$mail->AddAttachment(_upload_hinhanh.$data['file']);
		}
		if($mail->Send())
			transfer("Th??ng tin ???? ???????c g???i ??i.", "index.php?com=contact&act=man");
		else
			transfer("H??? th???ng b??? l???i, xin th??? l???i sau.", "index.php?com=contact&act=man");
	
	}
	
}
?>