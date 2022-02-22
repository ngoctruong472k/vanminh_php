<?php  if(!defined('_source')) die("Error");
    //duong dan web
    $link_web = '<a href="">'._trangchu.'</a> '." / ";
    $link_web.= $title_cat;
    if(!empty($_POST['dienthoai_lh']))
    {       
        $hoten_lh = htmlspecialchars($_POST['hoten_lh']);
        $email_lh = htmlspecialchars($_POST['email_lh']);
        $dienthoai_lh = htmlspecialchars($_POST['dienthoai_lh']);
        $diachi_lh = htmlspecialchars($_POST['diachi_lh']);
        $noidung_lh = htmlspecialchars($_POST['noidung_lh']);
        $ngaytao=time();

        $d->reset();
        $sql_kt_mail="SELECT email FROM table_newsletter WHERE email='".$email_lh."'";
        $d->query($sql_kt_mail);
        $kt_mail=$d->result_array();
        if(count($kt_mail)>0){
            transfer(_emaildadangky, "index");
        } else {
                
         // Make and decode POST request:
        $recaptcha_response1 = $_POST['recaptcha_response'];
        $recaptcha1 = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response1);
        $recaptcha1 = json_decode($recaptcha1);

        
        if($recaptcha_response1!=''){
            $data['hoten'] = $hoten_lh;
            $data['email'] = $email_lh;
            $data['dienthoai'] = $dienthoai_lh;
            $data['diachi'] = $diachi_lh;
            $data['noidung'] = $noidung_lh;
            $data['ngaytao'] = $ngaytao;
            $data['type'] = $config['typedangkynhantin'];
            
            $d->reset();
            $d->setTable('newsletter');
            $d->insert($data);

            if ($recaptcha1->score < 0.5) {
              $loicapcha = _thulienhespam;
            } else {
               /*-- gui mail --*/
                include_once "phpMailer/class.phpmailer.php";   
                $mail = new PHPMailer();
                $mail->IsSMTP();                // Gọi đến class xử lý SMTP
                $mail->Host       = $ip_host;   // tên SMTP server
                $mail->SMTPAuth   = true;       // Sử dụng đăng nhập vào account
                $mail->Username   = $mail_host; // SMTP account username
                $mail->Password   = $pass_mail;  
        
                //Thiết lập thông tin người gửi và email người gửi
                $mail->SetFrom($mail_host,$hoten_lh);
        
                //Thiết lập thông tin người nhận và email người nhận
                $mail->AddAddress($company['email'], $company['ten']);
                
                //Thiết lập email nhận hồi đáp nếu người nhận nhấn nút Reply
                $mail->AddReplyTo($email_lh,$hoten_lh);
        
                //Thiết lập file đính kèm nếu có
                if(!empty($_FILES['file']))
                {
                    $mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']); 
                }
                
                //Thiết lập tiêu đề email
                $mail->Subject    = $hoten_lh;
                $mail->IsHTML(true);
                
                //Thiết lập định dạng font chữ tiếng việt
                $mail->CharSet = "utf-8"; 

                    $body = '<h3>Email đăng ký nhận tin từ website <a href="'.$_SERVER["SERVER_NAME"].'">'.$_SERVER["SERVER_NAME"].'</a></h3>'; 
                    $body .= '<table border="0" cellpadding="5px" cellspacing="1px" style="color: #000000;background: #2b3a42;width: 100%;margin-bottom: 10px;border: 1px solid #eceaea;">';
                    $body .= '
                        <tr bgcolor="#f5f5f5" height="40px" style="background:#2b3a42;line-height: 30px;color: #fff; font-weight: bold; fotn-family:arial;">
                            <th colspan="2" style="text-align:left;">THÔNG TIN ĐĂNG KÝ NHẬN TIN</th>
                        </tr>
                        <tr bgcolor="#FFFFFF" style="color:#000000;">
                            <th style="text-align:left; width:150px;">Họ tên :</th><td>'.$hoten_lh.'</td>
                        </tr>
                        <tr bgcolor="#FFFFFF" style="color:#000000;">
                            <th style="text-align:left; width:150px;">Email :</th><td>'.$email_lh.'</td>
                        </tr>
                        <tr bgcolor="#FFFFFF" style="color:#000000;">
                            <th style="text-align:left; width:150px;">Điện thoại :</th><td>'.$dienthoai_lh.'</td>
                        </tr>
                        <tr bgcolor="#FFFFFF" style="color:#000000;">
                            <th style="text-align:left; width:150px;">Địa chỉ :</th><td>'.$diachi_lh.'</td>
                        </tr>
                        <tr bgcolor="#FFFFFF" style="color:#000000;">
                            <th style="text-align:left; width:150px;">Nội dung :</th><td>'.$noidung_lh.'</td>
                        </tr>';
                    $body .= '</table>';
    
                    $mail->Body = $body;
                    if($mail->Send()){
                        transfer(_guiemailthanhcong, "index");
                    }
                    else{
                        transfer(_guiemailthatbai, "index");
                    }
               /*-- end gui mail*/
                } 
            } else{ transfer(_guiemailthatbai, "index"); }
        }
    }
?>
