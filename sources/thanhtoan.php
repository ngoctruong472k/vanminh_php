<?php  if(!defined('_source')) die("Error");	
	
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	
	//bando
	$d->reset();
	$sql = "select id,ten,diachi from #_bando where hienthi=1 order by stt desc,id asc";
	$d->query($sql);
	$hethong = $d->result_array();

	$d->reset();
	$sql = "select id,ten,noidung from #_httt where hienthi=1 order by stt desc,id asc";
	$d->query($sql);
	$httt = $d->result_array();

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
	$_SESSION['id_lang'] = 0;
	if(count($_SESSION['cart'])>0){
		#Lấy tỉnh thành phố
		$d->reset();
		$sql = "select id,ten from #_place_city where hienthi=1 order by stt desc,id asc";
		$d->query($sql);
		$place_city = $d->result_array();
		
		#Lấy hình thức thanh toán
		$d->reset();
		$sql = "select id,ten$lang as ten from #_httt order by stt asc";
		$d->query($sql);
		$hinhthuc_tt = $d->result_array();	
		
		#Lấy thông tin user nếu đã đăng nhập
		$d->reset();
		$sql_info_user = "select * from #_user where id='".$_SESSION['login']['id']."' and role!=3";
		$d->query($sql_info_user);
		$info_user = $d->fetch_array();


		if(!empty($_POST)){
			#Lấy thông tin đơn hàng
			$hoten = htmlspecialchars($_POST['hoten']);
			$dienthoai = htmlspecialchars($_POST['dienthoai']);
			$diachi = htmlspecialchars($_POST['diachi']);
			$email = htmlspecialchars($_POST['email']);
			$noidung = htmlspecialchars($_POST['noidung']);
			$httt = (int)$_POST['httt'];
			$thanhpho = (int)$_POST['thanhpho'];
			$quan = (int)$_POST['quan'];
			$phuong = (int)$_POST['phuong'];
			$ip = getRealIPAddress();
			$id_user = (int)$_SESSION['login1']['id'];
			
			//validate dữ liệu
			$hoten = trim(strip_tags($hoten));
			$dienthoai = trim(strip_tags($dienthoai));	
			$diachi = trim(strip_tags($diachi));	
			$email = trim(strip_tags($email));	
			$noidung = trim(strip_tags($noidung));
			
			$tonggia = get_order_total();
		
			$phiship =  Get_PhiShipTheoQuan($quan);
			$tongtien_phiship = $tonggia + $phiship;

			$ngaydangky = time();
			$ngaycapnhat = time();
		
			
			$recaptcha_response = $_POST['recaptcha_response'];
		    $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
		    $recaptcha = json_decode($recaptcha);

		    /**/
		    	/*-- capcha google --*/
				$donhangmau = date('dmY').'NN';
				
				#Kiểm tra mã đơn hàng lớn nhất trong ngày
				$d->reset();
				$sql = "select id,madonhang from #_donhang where madonhang like '$donhangmau%' order by id desc limit 0,1";
				$d->query($sql);
				$max_order = $d->fetch_array();
				
				#Nếu không tồn tại đơn hàng nào trong ngày hôm nay
				if(empty($max_order['id']))
				{
					$songaunhien = 101;
				}
				else
				{
					(int)$songaunhien =  substr($max_order['madonhang'],10)+1;
				}
				#Mã đơn hàng của đơn hàng hiện tại là
				$madonhang = date('dmY').'NN'.$songaunhien;
				$_SESSION['xacnhan_madonhang']=$madonhang;
				//dump($tonggia);
				$d->reset();
				$data['madonhang'] = $madonhang;
				$data['hoten'] = $hoten;
				$data['dienthoai'] = $dienthoai;
				$data['diachi'] = $diachi;
				$data['email'] = $email;
				$data['httt'] = $httt;
				$data['phithem'] = $phithem;
				$data['tonggia'] = $tonggia;
				$data['thanhpho'] = $thanhpho;
				$data['quan'] = $quan;
				$data['noidung'] = $noidung;
				$data['ngaytao'] = $ngaydangky;
				$data['tinhtrang'] = 1;
				$data['ngaycapnhat'] = $ngaycapnhat;
				$data['ip'] = $ip;
				$data['id_user'] = $id_user;
				$d->setTable('donhang');
			
				#Nếu insert bảng đơn hàng thành công thì tiếp tự insert vào bảng chi tiết đơn hàng
				if($d->insert($data)){
					if(is_array($_SESSION['cart'])){
						$max = count($_SESSION['cart']);
						$coloi = false;
						for($i=0;$i<$max;$i++){
							$pid = $_SESSION['cart'][$i]['productid'];
							$q = $_SESSION['cart'][$i]['qty'];
							$size=get_product_size($_SESSION['cart'][$i]['size']);     
							$mausac=get_product_mau($_SESSION['cart'][$i]['mausac']);	
							$pmasp = get_code($pid);					
							$pname = get_product_name($pid);
							$pphoto = get_product_photo($pid);
							$pgia = get_price($pid,$q);
							$ptonggia+= get_price($pid,$q)*$q;
							
							#Nếu số lượng bàng ko thì bỏ qua
							if($q == 0) continue;
							//=== ly id don hang===
							$d->reset();
							$sql = "select id from #_donhang order by id desc limit 0,1";
							$d->query($sql);
							$kq_donhang = $d->fetch_array();
							$id_donhang = $kq_donhang['id'];
							//=== end id don hang===
							$d->reset();
							$data1['madonhang'] = $madonhang;
							$data1['masp'] = $pmasp;
							$data1['ten'] = $pname;
							$data1['size'] = $size;
							$data1['mausac'] = $mausac;
							$data1['gia'] = $pgia;
							$data1['soluong'] = $q;
							$data1['tonggia'] = $ptonggia;
							$data1['ngaytao'] = $ngaydangky;
							$data1['photo'] = $pphoto;
							$data1['id_donhang'] = $id_donhang;
							$data1['id_sanpham'] = $pid;
							$d->setTable('chitietdonhang');

							if($d->insert($data1))
							{
								$coloi = true;
							}	
							else
							{
								transfer(_cau2, "thanh-toan",false);
							}
						}
						
						#Nếu insert bảng chitietdonhang thành công thì bắt đầu gửi mail
						if($coloi == true){
					    	/*-- hoàn tất --*/
					    	include_once "phpMailer/class.phpmailer.php";	
							$mail = new PHPMailer();
							$mail->IsSMTP(); 				// Gọi đến class xử lý SMTP
							$mail->Host       = $ip_host;   // tên SMTP server
							$mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
							$mail->Username   = $mail_host; // SMTP account username
							$mail->Password   = $pass_mail;  
					
							//Thiết lập thông tin người gửi và email người gửi
							$mail->SetFrom($mail_host,$_POST['ten_lienhe']);
							
							$mail->AddAddress($email, 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
							$mail->AddCC($company['email'], 'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
							//Thiết lập email nhận email hồi đáp
							
							//nếu người nhận nhấn nút Reply
							$mail->AddReplyTo($email,'Đơn hàng từ website '.$_SERVER["SERVER_NAME"]);
							//$mail->AddCC($company['email']);
							/*=====================================
							 * THIET LAP NOI DUNG EMAIL
							*=====================================*/
							//Thiết lập tiêu đề
							$mail->Subject    = "Đơn hàng từ website ".$_SERVER["SERVER_NAME"];
							$mail->IsHTML(true);
							//Thiết lập định dạng font chữ
							$mail->CharSet = "utf-8";	
							$body = '<h2 style="font-size: 20px;">Cảm ơn quý khách đã đặt hàng tại '.$_SERVER["SERVER_NAME"].'</h2>';
							$body .= '<div style="width: 100%;margin-bottom: 20px;">Đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.</div>';	
							$body .= '<table border="0" cellpadding="5px" cellspacing="1px" style="color: #000000;background: #2b3a42;width: 100%;margin-bottom: 10px;border: 1px solid #eceaea;">';
							$body .= '
								<tr bgcolor="#f5f5f5" height="40px" style="background:#2b3a42;line-height: 30px;color: #fff; font-weight: bold; fotn-family:arial;">
									<th colspan="2" style="text-align:left">THÔNG TIN ĐƠN HÀNG</th>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th colspan="2">&nbsp;</th>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left" width="115px">Mã đơn hàng </th><td> '.$madonhang.'</td>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Họ tên</th><td> '.$hoten.'</td>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Địa chỉ</th><td> '.$diachi.'</td>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Email</th><td> '.$email.'</td>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Điện thoại</th><td> '.$dienthoai.'</td>
								</tr>';
							/*$body .= '
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Phí ship</th><td> '.number_format($phiship,0, ',', '.').' VNĐ'.'</td>
								</tr>';*/
							$body .= '
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Tổng tiền</th><td> '.number_format($ptonggia,0, ',', '.').' VNĐ'.'</td>
								</tr>
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Tổng thanh toán</th><td> '.number_format($tongtien_phiship,0, ',', '.').' VNĐ'.'</td>
								</tr>
								
								<tr bgcolor="#FFFFFF" style="color:#000000;">
									<th style="text-align:left">Ghi Chú</th><td> '.$noidung.'</td>
								</tr>
								';
							$body .= '</table>';
							
							
							#------------Chi tiết đơn hàng---------------------
							$body.='<table border="0" cellpadding="5px" cellspacing="1px" style="color:#000000; background:#2b3a42; width:100%;">';
							if(is_array($_SESSION['cart']))
							{
								$body.= '<tr bgcolor="#f5f5f5" height="40px" style="background:#2b3a42;line-height: 30px;color: #fff; font-weight: bold; fotn-family:arial;">
									<td style="text-align:center;">Tên sản phẩm</td>
									<td style="text-align:center;" class="gh_an">Hình Ảnh</td> ';
								$body.= '	
									<td align="center">Size</td>  
									 ';
								$body.= '	
									<td align="center">Giá</td>
									<td align="center">Số Lượng</td>
									<td align="center" class="gh_an">Thành tiền</td>
								</tr>';
								$max=count($_SESSION['cart']);
								for($i=0;$i<$max;$i++){
									$pid=$_SESSION['cart'][$i]['productid'];
									$size=get_product_size($_SESSION['cart'][$i]['size']);     
									$mausac=get_product_mau($_SESSION['cart'][$i]['mausac']);	
									$q=$_SESSION['cart'][$i]['qty'];
									$pmasp=get_code($pid);					
									$pname=get_product_name($pid);
									$pphoto=get_product_photo($pid);
													
									if($q==0) continue;
									
									$body.= '<tr bgcolor="#FFFFFF" style="color:#000000;">';
									$body.='<td width="20%">'.$pname.'</td>';
									$body.='<td width="15%" style="text-align:center;" class="gh_an"><img src="'.$config_url.'/upload/sanpham/'.$pphoto.'" style="max-height:35px;" /></td>';
									$body.= '<td width="5%" align="center">'.$size.'</td>';
									/*$body.= '<td width="10%" align="center">'.$mausac.'</td>';*/
									$body.='<td width="17%" align="center">'.number_format(get_price($pid,$q),0, ',', '.').' VNĐ</td>';				
									$body.='<td width="8%" align="center">'.$q.'</td>';                 
									$body.='<td width="15%" align="center" class="gh_an">'.number_format(get_price($pid,$q)*$q,0, ',', '.') .'&nbsp;VNĐ</td>
									</tr>';
								}
								/*$body.='<tr bgcolor="#f5f5f5" height="30px"><td colspan="7">PHÍ SHIP: '.number_format($phiship,0, ',', '.').'&nbsp; VNĐ</td></tr>';*/
								$body.='<tr bgcolor="#f5f5f5" height="30px"><td colspan="6" align="right">TỔNG TIỀN: <span style="color: #f00; font-weight: bold; fotn-family:arial;">'.number_format(get_order_total(),0, ',', '.').'&nbsp; VNĐ</span></td></tr>';
								$body.='<tr bgcolor="#f5f5f5" height="30px" align="right"><td colspan="6">TỔNG THANH TOÁN:  <span style="color: #f00; font-weight: bold; fotn-family:arial;">'.number_format($tongtien_phiship,0, ',', '.').'&nbsp; VNĐ</span></td></tr>';
							}
							else{
								$body.='<tr bgColor="#FFFFFF"><td>Không có sản phẩm nào trong giỏ hàng!</td>';
							}
					   		$body.='</table>';
					   		$body.='<div style="width: 100%;margin: 10px 0;">---------------------------</div>';
					   		$body.='<b style="width: 100%;">'.$company['ten'].'</b>';
					   		$body.='<p style="width: 100%;">Địa chỉ: '.$company['diachi'].'</p>';
					   		$body.='<p style="width: 100%;">Website: <a href="'.$company['website'].'">'.$company['website'].'</a></p>';
					   		$body.='<p style="width: 100%;">Email: '.$company['email'].'</p>';
					   		#------------Chi tiết đơn hàng---------------------
			
							$mail->Body = $body;
							$_SESSION['cart']=0;
							unset($_SESSION['cart']);
							if($recaptcha_response==''){
								if ($recaptcha->score >= 0) {
									if($mail->Send()){
										transfer(_cau1.$madonhang, "xac-nhan-don-hang",false);
									}else{
										transfer(_cau1.$madonhang, "xac-nhan-don-hang",false);
									}
								}else{
									$loicapcha = 'Not verified - show form error'; // chưa xác minh
								}
							} else {
								transfer(_cau6, "index");
							}
					    	/*-- end hoàn tất --*/
						}
		            }
					else{
						transfer(_cau5, "index",false);
					}
				}
				else
					transfer(_cau6, "index",false);	
		    	/*-- end capcha goole --*/
		    
		}/*-- kiem tra form hoan tat --*/
	}else{
		transfer(_cau4, "index",false);
	}
?>

