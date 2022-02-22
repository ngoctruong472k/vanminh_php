<?php if(!defined('_lib')) die("Error");

	error_reporting(E_ALL & ~E_NOTICE & ~8192);

	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$http = 'http://';

	$config_url=$_SERVER["SERVER_NAME"];

	

	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'nn02501720_db';
	$config['database']['refix'] = 'table_';



	$config['salt']='uU6GHcIq%m';

	//$config['arrayDomainSSL']=array("yourdomainssl.com.vn");

	//kiem tra pphien ban php

	if (version_compare(phpversion(), '7.0.0', '<')) {

	   $config['database']['dbtype'] = 'mysql';

	}else{

		$config['database']['dbtype'] = 'mysqli';

	}

	$ip_host = '115.84.183.204';

	$mail_host = 'contact@damiansportvietnam.com';

	$pass_mail = 'i7U9j8TR';

	

	$config['lang']=array(''=>'Tiếng Việt');#Danh sách ngôn ngữ

	

	define ( 'NN_MSHD' , '2501720w'); //Mã số HĐ

	define ( 'NN_AUTHOR' , 'nguyenvietnam.nina@gmail.com');

	//cấu hình thông tin do google cung cấp Version 3.0

	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	
	// $site_key    = '6LfSDs4ZAAAAAGZCgns3geQVF4hvppV8fIl5PYlj';
	// $recaptcha_secret  = '6LfSDs4ZAAAAANJoYcuiV-4Mud5a10__w4GVtqJ7';

	$site_key = '6Ld4Z7wUAAAAALjXil9lOr6V6xlxXCqyrUuErLa7';
	$recaptcha_secret = '6Ld4Z7wUAAAAAAgWOrJ-5nEfjUwSztByKU0Q1RvR';

	$mb_rp = 1;

	$mb = 0;

	$tnn = '';

	$config['quantri'] = 0;

	$config['hienlienhe'] = 0; //hiển thị liên hệ trong trang quản trị và lưu dữ liệu vào trang quan trị khi gửi

	$config['hiendangkynhantin'] = 0;//hiển thị đăng ký nhận tin trong trang quản trị

	$config['typedangkynhantin'] = 'dknt';//hiển thị type đăng ký nhận tin trong trang quản trị

	$config['hiengiohang'] = 0;//hiển thị giỏ hàng trong trang quản trị



	/*$config['author']['name'] = 'Nguyễn Viết Nam';

	$config['author']['email'] = 'nguyenvietnam.nina@gmail.com';

	$config['author']['timefinish'] = '';*/



	// send mail gmail

	// $ip_host = 'smtp.gmail.com';

	// $secure_host = "tls";

	// $port_host = 587;

	// $mail_host = 'autosendnoreply01@gmail.com';

	// $pass_mail = 'ntfocjyshxgoxqbg';

	

	$fw_conf['firewall']='0'; //Bat tat firewall

	$fw_conf['max_lockcount']=10;//So lan toi da phat hien dau hieu DDOS va khoa IP do vinh vien 

	$fw_conf['max_connect']=15;//So ket noi toi da dc gioi han boi $fw_conf['time_limit']

	$fw_conf['time_limit']=3;//Thoi gian dc thuc hien toi da $fw_conf['max_connect'] ket noi

	$fw_conf['time_wait']=5;//Thoi gian cho de dc mo khoa khi IP bi khoa tam thoi

	$fw_conf['email_admin']='nina@nina.vn';//Email lien lac voi Admin

	$fw_conf['htaccess']=".htaccess";//Duong dan toi file htaccess tren server

	$fw_conf['ip_allow']='127.0.0.1';

	$fw_conf['ip_deny']='';

	$config['login']['delay'] =2;

	$config['login']['attempt']=5;

	$config['arrayDomainSSL']=array("damiansportvietnam.com");

?>