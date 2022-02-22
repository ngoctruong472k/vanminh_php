<?php 

	include ("ajax_config.php");
	
	$hoten = trim(strip_tags($_POST['txt_hoten']));
	$dienthoai = trim(strip_tags($_POST['txt_dienthoai']));
	$email = trim(strip_tags($_POST['txt_email']));
	$noidung = trim(strip_tags($_POST['txt_loinhan']));
	$ngaytao=time();
	if(!empty($_POST)){
		
		//=== luu database ===
		$d ->reset();
		$sql="INSERT INTO table_newsletter (hoten,dienthoai,email,noidung,ngaytao) VALUES ('$hoten','$dienthoai','$email','$noidung','$ngaytao')";
		$d -> query($sql);
		//=== end luu database===
			include_once "../sources/phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
			$mail->Host       = $ip_host;   // tên SMTP server
			$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
			$mail->Username   = $mail_host; // SMTP account username
			$mail->Password   = $pass_mail;  
	
			//Thiết lập thông tin người gửi và email người gửi
			$mail->SetFrom($mail_host,$hoten);
	
			//Thiết lập thông tin người nhận và email người nhận
			$mail->AddAddress($company['email'], $company['ten']);
			
			//Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($email,$ten);
	
			//Thiết lập file đính kèm nếu có
			if(!empty($_FILES['file']))
			{
				$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);	
			}
			
			//Thiết lập tiêu đề email
			$mail->Subject    = $ten;
			$mail->IsHTML(true);
			
			//Thiết lập định dạng font chữ tiếng việt
			$mail->CharSet = "utf-8";	
				$body = '<table>';
				$body .= '
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th colspan="2">Thư đăng ký từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></th>
					</tr>
					<tr>
						<th colspan="2">&nbsp;</th>
					</tr>
					<tr>
						<th>Họ tên :</th><td>'.$hoten.'</td>
					</tr>
					<tr>
						<th>Điện thoại :</th><td>'.$dienthoai.'</td>
					</tr>
					<tr>
						<th>Email :</th><td>'.$email.'</td>
					</tr>
					<tr>
						<th>Nội dung :</th><td>'.$noidung.'</td>
					</tr>';
				$body .= '</table>';

				$mail->Body = $body;
				if($mail->Send())
				{
					$return['thongbao'] = _guilienhethanhcong;
					$return['nhaplai'] = 'nhaplai';
				}
				else
				{
					$return['thongbao'] = _guilienhethatbai;
					$return['nhaplai'] = '2';
				}
		}
	echo json_encode($return);
?>
