<?php
	error_reporting(0);
	session_start();
	$session=session_id();
	 
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../libraries/');
	@define ( '_template' , './templates/');
 
	include_once _lib."config.php";
	include_once _lib."checkSSL.php";
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
	
	$http=$Protocol;
	include_once _lib."functions_giohang.php";
 
	
	include_once _lib."file_requick.php";
	include_once _source."counter.php";
	include_once _source."public_sql.php";
	 
?>
<!DOCTYPE html>
<html ⚡ lang="<?=$lang?>">
<head itemscope itemtype="http://schema.org/WebSite">
<?php include _template."layout/base_meta.php";?>
<?php if(!isGoogleSpeed()) include _template."layout/base_css.php";?>
<?php if(!isGoogleSpeed()) include _template."layout/base_js_amp.php";?>
</head>

<body>
<?php if(!isGoogleSpeed()) include _template."layout/base_analytics.php";?>
<?php if(!isGoogleSpeed()) include _template."layout/nav_mobile.php"; ?>
<div id="full_content" class="clearfix">
	<?php if($template=='index'){ ?> 
	    <h1 class="the_an"><?php if($title_cat!='')echo $title_cat;else echo $seo['h1'];?></h1>
	<?php } ?>
	<?php include _template."layout/header.php";?>
	<?php if(!isGoogleSpeed()) include _template.$template."_tpl.php";?>
	<?php if(!isGoogleSpeed()) include _template."layout/footer.php";?>

	
</div>
 
</body>
</html>