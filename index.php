<?php
	session_start();
	$session=session_id();
	unset($_SESSION['lang']);
	@define ( '_source' , './sources/');
	@define ( '_lib' , './libraries/');
	if(isset($_SESSION['phienban'])){
		$phienban = $_SESSION['phienban'];
	}
	include_once _lib."config.php";
	// include_once _lib."checkSSL.php";
	//$http=$Protocol;
	if($mb==1) {
		include_once _lib."Mobile_Detect.php";
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		if($deviceType =='phone'){
		        //if($phienban=='desktop'){
		        //    @define ( '_template' , './templates/');
		        //}else{
			@define ( '_template' , './m/'); 
		        //}
		}else{
		        //if($phienban=='mobile'){
		        //    @define ( '_template' , './m/'); 
		        //}else{
			@define ( '_template' , './templates/');
		        //}
		}
	} else {
		@define ( '_template' , './templates/');
	}
	/*
	if (file_exists(_lib."nina_firewall.php")){
		include_once _lib."nina_firewall.php";
	}*/
	include_once _lib."constant.php";
	include_once _lib."function_web.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	$d->reset();
	$sql_company = "select * from #_company limit 0,1";
	$d->query($sql_company);
	$company= $d->fetch_array();
	if(!isset($_SESSION['lang']) && isset($company['ngonngu'])){
		$_SESSION['lang']=$company['ngonngu'];
	}
	$lang=$_SESSION['lang'];
	require_once _source."lang$lang.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once _source."public_sql.php";
	if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		addtocart($pid,1);
		redirect("gio-hang.html");
	}
	if($mb==1) {
		if($deviceType =='phone'){
	        //if($phienban=='desktop'){
	        //    include_once "desktop_tpl.php";
	        //}else{
			include_once "mobile_tpl.php";
	        //}
		}else{
	        //if($phienban=='mobile'){
	        //   include_once "mobile_tpl.php";
	        //}else{
			include_once "desktop_tpl.php";
	        //}
		}
	} else {
		include_once "desktop_tpl.php";
	}
?>