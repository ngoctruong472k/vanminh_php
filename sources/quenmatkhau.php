<?php  if(!defined('_source')) die("Error");
	
	if($_SESSION[$login_name1]==true)
	{
		transfer(_bandadangnhap, 'index');
	}
	$sql = "select ten$lang as ten,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description from #_about where type='".$type."' and hienthi=1 limit 0,1";
	$d->query($sql);
	$tintuc_detail = $d->fetch_array();
	$_SESSION['id_lang'] = 0;
	$title_cat = _quenmatkhau;		
	$title = $tintuc_detail['title'];
	$keywords = $tintuc_detail['keywords'];
	$description = $tintuc_detail['description'];

	$link_web = '<a href="">'._trangchu.'</a> '." /> ";
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
	
	if(!empty($_POST) && $_POST['recaptcha_response_3']!=''){
		$recaptcha_response_3 = $_POST['recaptcha_response_3'];
	    $recaptcha_3 = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response_3);
	    $recaptcha_3 = json_decode($recaptcha_3);
	    if ($recaptcha_3->score >= 0.5) {
			$email_lienhe =$_POST['email_lienhe'];
			
			$sql = "select * from #_user where email='".$email_lienhe."' ";
			$d->query($sql);
			$user_info = $d->fetch_array();		
			if($d->num_rows() == 1)
			{
				$password_new = ChuoiNgauNhien(10);
				$chuoingaunhien = md5($password_new);
				
				include_once "phpMailer/class.phpmailer.php";	
				$mail = new PHPMailer();
				$mail->IsSMTP(); 				/*Gọi đến class xử lý SMTP*/
				$mail->Host       = $ip_host;   /* tên SMTP server*/
				$mail->SMTPAuth   = true;       /* Sử dụng đăng nhập vào account*/
				$mail->Username   = $mail_host; /* SMTP account username*/
				$mail->Password   = $pass_mail;  
		
				/*Thiết lập thông tin người gửi và email người gửi*/
				$mail->SetFrom($mail_host,$company['ten']);
		
				/*Thiết lập thông tin người nhận và email người nhận*/
				$mail->AddAddress($user_info['email'], $user_info['ten']);
				
				/*Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply*/
				$mail->AddReplyTo($company['email'],$company['ten']);
		
				/*Thiết lập file đính kèm nếu có*/
				if(!empty($_FILES['file']))
				{
					$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
				}
				/*Thiết lập tiêu đề email*/
				$mail->Subject    = $company['ten']." xin cung cấp lại thông tin tài khoản của bạn trên website ".$_SERVER["SERVER_NAME"];
				$mail->IsHTML(true);
				
				/*Thiết lập định dạng font chữ tiếng việt*/
				$mail->CharSet = "utf-8";	
					$body = '<table>';
					$body .= '
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
						<tr>
							<th colspan="2">'.$company['ten'].' xin cung cấp lại thông tin tài khoản của bạn trên website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
						</tr>
						<tr>
							<th colspan="2">&nbsp;</th>
						</tr>
						<tr>
							<th>'._tendangnhap.' :</th><td>'.$user_info['username'].'</td>
						</tr>
						<tr>
							<th>'._matkhau.' :</th><td>'.$password_new.'</td>
						</tr>
						<tr>
							<th>Email :</th><td>'.$user_info['email'].'</td>
						</tr>';
					$body .= '</table>';
					$body.='<p style="font-family:Arial,Helvetica,sán-serif;font-size:10pt">..............................<wbr>..............................<wbr>..............................<wbr>......</p>';
			   		$body.='
			   			<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt">
				   			<strong>'.$company['ten'].'</strong><br>
							Address: '.$company['diachi'].'<br>
							Website: <a href="'.$http.$config_url.'" target="_blank">'.$config_url.'</a><br>
							Email: <a href="'.$company['email'].'" target="_blank">'.$company['email'].'</a>
						</p>
			   		';
					
					$mail->Body = $body;
					if($mail->Send())
					{
						$sql_password = "UPDATE #_user SET password='".$chuoingaunhien."' WHERE id ='".$user_info['id']."'";
						if($d->query($sql_password))
						{
							transfer(_vuilongkiemtralaiemail, "dang-nhap");
						}
						else
						{
							transfer(_hethongloi, "quen-mat-khau",false);
						}
					}
					else
					{
						transfer(_hethongloi, "quen-mat-khau",false);
					}				
			}
			else {
				transfer(_thongtinkhongchinhxac, "quen-mat-khau",false);
			}
		}
	}
	
?>
