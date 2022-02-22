<?php
	session_start();
	$session=session_id();
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	
	if(!isset($_SESSION['lang']))
	{
		$_SESSION['lang']='';
	}
	$lang=$_SESSION['lang'];		
	require_once _source."lang$lang.php";	
	//include_once _lib."AntiSQLInjection.php";
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."function_web.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _lib."functions_user.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once _source."public_sql.php";
?>  
