<?php  if(!defined('_source')) die("Error");
	
	if($_SESSION[$login_name1]==true)
	{
		transfer(_bandadangnhap, 'dang-nhap');
	}
	$sql = "select ten$lang as ten,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description from #_about where type='".$type."' and hienthi=1 limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$_SESSION['id_lang'] = 0;
	$title_cat = _dangky;		
	$title = $tintuc_detail['title'];
	$keywords = $tintuc_detail['keywords'];
	$description = $tintuc_detail['description'];

	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	
	/*-Trang Chu --*/
	$BreadcrumbList ='<ol itemscope itemtype="https://schema.org/BreadcrumbList">';
	$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
	$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'">';
	$BreadcrumbList.='<span itemprop="name">'._trangchu.'</span>';
	$BreadcrumbList.='</a>';
	$BreadcrumbList.='<meta itemprop="position" content="1" />';
	$BreadcrumbList.='</li>';
	$BreadcrumbList.=' › ';
	/*-- Trang Chu --*/
	$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
	$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$com.'">';
	$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';
	$BreadcrumbList.='</a>';
	$BreadcrumbList.='<meta itemprop="position" content="2" />';
	$BreadcrumbList.='</li>';
	$BreadcrumbList.='</ol>';

	if(!empty($_POST) && $_POST['recaptcha_response_1']!=''){
		$recaptcha_response_1 = $_POST['recaptcha_response_1'];
	    $recaptcha_1 = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response_1);
	    $recaptcha_1 = json_decode($recaptcha_1);

		if ($recaptcha_1->score >= 0.5) {
			$data['username'] = magic_quote(trim(strip_tags($_POST['tendangnhap'])));
			$d->reset();
			$d->setTable('user');
			$d->setWhere('username', $data['username']);
			$d->select();

			if($d->num_rows()>0){
				transfer(_tendangnhapdatontai, "dang-ky",false);
			}else{
				$data['password'] = md5($_POST['matkhau']);
				$data['ten'] = magic_quote(trim(strip_tags($_POST['ten_lienhe'])));
				$data['diachi'] = magic_quote(trim(strip_tags($_POST['diachi_lienhe'])));
				$data['dienthoai'] = magic_quote(trim(strip_tags($_POST['dienthoai_lienhe'])));
				$data['email'] = magic_quote(trim(strip_tags($_POST['email_lienhe'])));
				$data['gioitinh'] = magic_quote(trim(strip_tags($_POST['gioitinh_lienhe'])));
				$time1 =$_POST['ngaysinh_lienhe'];
				$Ngay_arr = explode("/",$time1); // array(17,11,2010)
				if (count($Ngay_arr)==3) {
					$ngay = $Ngay_arr[0]; //17
					$thang = $Ngay_arr[1]; //11
					$nam = $Ngay_arr[2]; //2010
					if (checkdate($thang,$ngay,$nam)==false){ $coloi=true; $error_ngaysinh = "Bạn nhập chưa đúng ngày sinh<br>";} else $time1=$nam."-".$thang."-".$ngay;
				}
				$data['ngaysinh'] =strtotime($time1);
				$data['role'] = 1;
				$data['active'] = 1;
				$data['hienthi'] = 1;
				$data['ngaytao'] = time();
				$data['com'] = "user";
				
				$d->setTable('user');
				if($d->insert($data)){
					transfer(_dangkythanhcong, "dang-nhap");
				}
				else
				{
					transfer(_hethongloi, "dang-ky",false);
				}
			}
		}else{
			transfer(_hethongloi, "dang-ky",false);
	    }
	}
?>