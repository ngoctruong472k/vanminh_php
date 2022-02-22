<?php  if(!defined('_source')) die("Error");

	$sql = "select *,ten$lang as ten,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_detail = $d->fetch_array();
	$_SESSION['id_lang'] = 0;
	$title = $row_detail['title'];
	$keywords = $row_detail['keywords'];
	$description = $row_detail['description'];
	
	$images_facebook = $http.$config_url.'/'._upload_hinhanh_l.$row_detail['photo'];
	$title_facebook = $row_detail['title'];
	$description_facebook = trim(strip_tags($row_detail['description']));
	$url_facebook = getCurrentPageURL();


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
	
	if(!empty($_POST)){
		$ten = htmlspecialchars($_POST['ten_lienhe']);
		$diachi = htmlspecialchars($_POST['diachi_lienhe']);
		$dienthoai = htmlspecialchars($_POST['dienthoai_lienhe']);
		$email = strtolower(htmlspecialchars($_POST['email_lienhe']));
		$tieude = htmlspecialchars($_POST['tieude_lienhe']);
		$noidung = htmlspecialchars($_POST['noidung_lienhe']);

		$recaptcha_response = $_POST['recaptcha_response'];
	    $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
	    $recaptcha = json_decode($recaptcha);
	    if($recaptcha_response!=''){
			if ($recaptcha->score >= 0.5) {
				if($config['hienlienhe']==1){
					$data['hovaten'] = $ten;
		            $data['email'] = $email;
		            $data['dienthoai'] = $dienthoai;
		            $data['diachi'] = $diachi;
		            $data['tieude'] = $tieude;
		            $data['noidung'] = $noidung;
		            $data['ngaytao'] = time();
		            $data['phanhoi'] = 0;
		            
		            $d->reset();
		            $d->setTable('contact');
		            #Nếu insert bảng đơn hàng thành công thì tiếp tự insert vào bảng chi tiết đơn hàng
		            $d->insert($data);
				}
			   /*-- gui mail --*/
				include_once "phpMailer/class.phpmailer.php";	
				$mail = new PHPMailer();
				$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
				$mail->Host       = $ip_host;   // tên SMTP server
				$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
				$mail->Username   = $mail_host; // SMTP account username
				$mail->Password   = $pass_mail;  

				/*-- send mail gmail ---*/
				/*
				$mail->Host       = $ip_host;   // tên SMTP server
				$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
				$mail->Username   = $mail_host; // SMTP account username
				$mail->Password   = $pass_mail;  
				if($port_host){
					$mail->Port = $port_host;
				}
				if($secure_host){
					$mail->SMTPSecure = $secure_host;
				}
				*/
				/*-- end send mail gmail ---*/
		
				/*Thiết lập thông tin người gửi và email người gửi*/
				$mail->SetFrom($mail_host,$ten);
		
				/*Thiết lập thông tin người nhận và email người nhận*/
				$mail->AddAddress($company['email'], $company['ten']);
				
				/*Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply*/
				$mail->AddReplyTo($email,$ten);
		
				/*Thiết lập file đính kèm nếu có*/
				if(!empty($_FILES['file']))
				{
					$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
				}
				
				/*Thiết lập tiêu đề email*/
				$mail->Subject    = $tieude." - ".$ten;
				$mail->IsHTML(true);
				
				/*Thiết lập định dạng font chữ tiếng việt*/
				$mail->CharSet = "utf-8";	
					$body = '<h3>Thư liên hệ từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></h3>';
					$body .= '<table border="0" cellpadding="5px" cellspacing="1px" style="color: #000000;background: #2b3a42;width: 100%;margin-bottom: 10px;border: 1px solid #eceaea;">';
					$body .= '
						<tr bgcolor="#f5f5f5" height="40px" style="background:#2b3a42;line-height: 30px;color: #fff; font-weight: bold; fotn-family:arial;">
							<th colspan="2" style="text-align:left">THÔNG TIN LIÊN HỆ</th>
						</tr>
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Họ tên :</th><td>'.$ten.'</td>
						</tr>
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Địa chỉ :</th><td>'.$diachi.'</td>
						</tr>
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Điện thoại :</th><td>'.$dienthoai.'</td>
						</tr>
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Email :</th><td>'.$email.'</td>
						</tr>
						
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Tiêu đề :</th><td>'.$tieude.'</td>
						</tr>
						<tr bgcolor="#FFFFFF" style="color:#000000;">
							<th style="text-align:left; width:150px;">Nội dung :</th><td>'.$noidung.'</td>
						</tr>';
					$body .= '</table>';

					$mail->Body = $body;
					if($mail->Send())
						transfer(_guilienhethanhcong, "lien-he");
					else
						transfer(_guilienhethatbai, "lien-he",false);
			   /*-- end gui mail*/
			}else{
				$loicapcha = 'Not verified - show form error';
				transfer($loicapcha, "lien-he",false);
			}
		} else {
        	transfer(_guilienhethatbai, "index");
        }
	}
?>
