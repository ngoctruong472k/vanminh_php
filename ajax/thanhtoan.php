<?php
	include ("ajax_config.php");

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {
	    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	    $recaptcha_response = $_POST['recaptcha_response'];
	    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	    $recaptcha = json_decode($recaptcha);
	    if ($recaptcha->score >= 0.9) {
			if($_POST['phiship']==0) $phi_vc = 'Miển phí'; else $phi_vc = number_format ($_POST['phiship'],0,",",",").' đ';
			
			include_once "../phpMailer/class.phpmailer.php";	
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host       = $ip_host;
			$mail->SMTPAuth   = true;
			$mail->Username   = $mail_host;
			$mail->Password   = $pass_mail;  
			$mail->SetFrom($mail_host,$company['ten']);
			$mail->AddAddress($company['email'],$company['ten']);
			if($_POST['email'] != ''){ $mail->AddAddress($_POST['email'], $_POST['ten']); }
			$mail->Subject    = 'Thông tin đặt hàng';
			$mail->IsHTML(true);
			$mail->CharSet = "utf-8";	
			$body = '<table border="0" width="100%">';
			$body .= '<tr><th align="left" colspan="2"><table width="100%"><tr><td><font size="4">Thông tin đặt hàng từ website <a href="'.get_http().$config_url.'">'.$company['ten'].'</a></font></td></tr></table></th></tr>';
			$body .= '<tr><th width="30%" align="left">Họ tên :</th><td>&nbsp; '.$_POST['ten'].'</td></tr>';
			$body .= '<tr><th align="left">Email :</th><td>&nbsp; '.$_POST['email'].'</td></tr>';
			$body .= '<tr><th align="left">Điện thoại :</th><td>&nbsp; '.$_POST['dienthoai'].'</td></tr>';
			$body .= '<tr><th align="left">Địa chỉ :</th><td>&nbsp; '.$_POST['diachi'].'</td></tr>';
			$body .= '<tr><th align="left">Nội dung :</th><td>&nbsp; '.$_POST['noidung'].'</td></tr>';
			if($_POST['httt']!=""){
				$sql_company = "select id,ten from #_httt where id = '".$_POST['httt']."' limit 0,1";
				$d->query($sql_company);
				$httt= $d->fetch_array();
				
				$body .= '<tr><th align="left">Phương thức thanh toán :</th><td>&nbsp; '.$httt['ten'].'</td></tr>';
			}
			if($_POST['hethong']!=""){
				$sql_company = "select id,ten,diachi from #_bando where id = '".$_POST['hethong']."' limit 0,1";
				$d->query($sql_company);
				$hethong= $d->fetch_array();

				$body .= '<tr><th align="left">Lấy tại cửa hàng :</th><td>'.$hethong['ten'].' ('.$hethong['diachi'].')</td></tr>';
			}
			$body .= '<tr><th align="left">Phí vận chuyển:</th><td>&nbsp; '.$phi_vc.'</td></tr>';
			$body .= '<tr><th align="left" colspan="2">&nbsp;</th></tr>';
			$body.='<tr><td height="19" colspan="2" align="right" valign="top" class="content" style="background: #D2E6DD;"><span class="cat"></span>
			<table border="1" bordercolor="#0099CC" align="center" cellpadding="5px" cellspacing="5px" width="100%">';
			if(is_array($_SESSION['cart']))
			{
				$body.='<tr bgcolor="#16AAB8"><td>Thứ tự</td><td>Hình ảnh</td><td>Tên</td><td>Giá</td><td>Số lượng</td><td>Tổng giá</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);

					if($q==0) continue;
					$body.='<tr><td>'.($i+1).'</td>';
					$body.='<td> <a href="'.get_http().$config_url.'/'.get_product_url($pid).'" target="_blank"><img src="'.get_http().$config_url.'/upload/sanpham/'.get_product_photo($pid).'" width="70" /></a></td>';
					$body.='<td><a href="'.get_http().$config_url.'/'.get_product_url($pid).'" target="_blank">'.$pname.'</a></td>';
					$body.='<td>'.number_format(get_price($pid),0, ',', '.').'&nbsp;đ</td>';
					$body.='<td>'.$q.'</td>';                    
					$body.='<td>'.number_format(get_price($pid)*$q,0, ',', '.') .'&nbsp;đ</td>';
					$body.='</tr>';
				}
				$body.='<tr><td colspan="6"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td> '; 
				$body.='<b> Tổng giá : '. number_format(get_order_total(),0, ',', '.') .' &nbsp;đ</b></td></tr></table></td></tr>';
				$body.='<tr><td colspan="6"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td> '; 
				$body.='<b> Phí vận chuyển : '. number_format($_POST['phiship'],0, ',', '.') .' &nbsp;đ</b></td></tr></table></td></tr>';
				$body.='<tr><td colspan="6"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td> '; 
				$body.='<b> Thanh Toán : '. number_format(get_order_total()+$_POST['phiship'],0, ',', '.') .' &nbsp;đ</b></td>
				</tr>
				</table>
				</td></tr>';
			}
			else{
				$body.='<tr bgColor="#FFFFFF"><td>There are no items in your shopping cart!</td>';
			}
			$body.=' </table><span class="cat"></span>
			</td>
			</tr>';
			$body.='<tr><th align="left" colspan="2">&nbsp;</th></tr><tr><td colspan="2" align="left"><p><h2>'.$company['ten'].'</h2></p><p>Địa chỉ : '.$company['diachi'].'</p><p>Điện thoại : '.$company['hotline'].'</p><p>Email : '.$company['email'].'</p><p>Website : <a href="'.get_http().$config_url.'/">'.$company['ten'].'</a></p><td> <tr>'; 
			$body .= '</table>';

			$mail->Body = $body;
			if($mail->Send()){
				$mahoadon = madonhang('DH','donhang');
				$ngaydangky = time();
				$tonggia = get_order_total();
				
				$data_o['madonhang'] = $mahoadon;
				$data_o['hoten'] = $_POST['ten'];
				$data_o['dienthoai'] = $_POST['dienthoai'];
				$data_o['diachi'] = $_POST['diachi'];
				$data_o['noidung'] = $_POST['noidung'];
				$data_o['email'] = $_POST['email'];
				$data_o['httt'] = $_POST['httt'];
				$data_o['tonggia'] = $tonggia;
				$data_o['ngaytao'] = $ngaydangky;
				$data_o['tinhtrang'] = 1;
				$data_o['thanhpho'] = $_POST['city'];
				$data_o['quan'] = $_POST['dist'];
				$data_o['phuong'] = $_POST['ward'];
				$data_o['nhanhang'] = $_POST['hethong'];
				$data_o['phivanchuyen'] = $_POST['phiship'];
				$d->setTable('donhang');	
				if($d->insert($data_o)){ 
					$d->reset();
					$sql = "select id from #_donhang where madonhang = '".$mahoadon."'";
					$d->query($sql);
					$donhang = $d->fetch_array();

					$id_order = $donhang['id'];
				}

				$max=count($_SESSION['cart']);
				$dem = 0;
				for($i=0;$i<$max;$i++){
					$pid = $_SESSION['cart'][$i]['productid'];
					$q = $_SESSION['cart'][$i]['qty'];
					$pname = get_product_name($pid);
					$gia = get_price($pid);
					if($q==0) continue;
					$data1['id_sanpham'] = (int)$pid;
					$data1['id_donhang'] = (int)$id_order;
					$data1['ten'] = magic_quote($pname);
					$data1['gia'] = (float)$gia;
					$data1['soluong'] = (int)$q;
					$d->setTable('chitietdonhang');	
					if($d->insert($data1)){ $dem++; }
				}
				if($dem == $max){ echo 1; unset($_SESSION['cart']); }else{ echo 0; }
			}
	    }else{
	    	echo 0;
	    }
	}
?>