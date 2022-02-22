<?php  if(!defined('_source')) die("Error");
	
	if($_SESSION[$login_name1]==true)
	{
		transfer(_bandadangnhap, 'dang-nhap');
	}
	#Chi tiết bài viết
	$sql = "select ten$lang as ten,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description from #_about where type='".$type."' and hienthi=1 limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$_SESSION['id_lang'] = 0;
	$title_cat = _dangnhap;		
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
	
	if(!empty($_POST) && $_POST['recaptcha_response_2']!=''){
		$recaptcha_response_2 = $_POST['recaptcha_response_2'];
	    $recaptcha_2 = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response_2);
	    $recaptcha_2 = json_decode($recaptcha_2);
	    if ($recaptcha_2->score >= 0.5) {
			$email =$_POST['email'];
			$password = $_POST['matkhau'];
			
			$sql = "select id,username,password,email,active from #_user where email='".$email."'";
			$d->query($sql);	
			if($d->num_rows() == 1)
			{
				$row = $d->fetch_array();
				if($row['active'] != 0)
				{	
					if($row['password'] == md5($password))
					{
						$_SESSION[$login_name1] = true;
						$_SESSION['login1']['id'] = $row['id'];
						$_SESSION['login1']['username'] = $row['username'];
						transfer(_dangnhapthanhcong, "thay-doi-thong-tin");
					}
					else 
					{ 
						transfer(_matkhaukhongdung, "dang-nhap",false);
					 }
				}
				else {
						transfer(_taikhoanchuakichhoat, "dang-nhap",false);
					}
			}
			else {
				transfer(_tendangnhapkhongtontai, "dang-nhap",false);
			}
		}else{
	    	transfer(_hethongloi, "dang-nhap",false);
	    }
	}
	
	
?>
