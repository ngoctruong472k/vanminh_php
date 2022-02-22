<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="SHORTCUT ICON" href="<?=$http.$config_url?>/<?=_upload_hinhanh_l.$company['faviconthumb']?>" type="image/x-icon" />
<link rel="canonical" href="<?=getCurrentPageURL_CANO()?>" />
<META NAME="ROBOTS" CONTENT="noodp,index,follow" />
<meta name="author" content="<?=$company['ten']?>" />
<meta name="copyright" content="<?=$company['ten']?> [<?=$company['email']?>]" />
<?php /*?>Meta Geo<?php */?>
<meta name="DC.title" content="<?php if($template!='index')echo $title;else echo $seo['title'];?>" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="<?=$company['diachi']?>" />
<meta name="geo.position" content="<?=str_replace(',',':',$company['toado'])?>" />
<meta name="ICBM" content="<?=$company['toado']?>" />
<meta name="DC.identifier" content="<?=$http.$config_url?>/" />

<?php /* if($com == '' || $com == 'san-pham'){ ?>
<link rel="amphtml" href="<?=getCurrentPageURL_AMP()?>" />
<?php } ?>
<link rel="canonical" href="<?=getCurrentPageURL()?>" />

<?php /*?>Meta Geo<?php */?>
<?php /*?>Meta Ngôn ngữ<?php */?>
<?php /*?><meta name="language" content="Việt Nam">
<meta http-equiv="content-language" content="vi" />
<meta content="VN" name="geo.region" />
<meta name="DC.language" scheme="utf-8" content="vi" />
<meta property="og:locale" content="vi_VN" /><?php */?>
<?php /*?>Meta Ngôn ngữ<?php */?>
<?php /*?>Meta seo web<?php */?>
<title><?php if($template!='index')echo $title;else echo $seo['title'];?></title>
<meta name="keywords" content="<?php if($template!='index')echo $keywords;else echo $seo['keywords'];?>" />
<meta name="description" content="<?php if($template!='index')echo $description;else echo $seo['description'];?>" />
<?php /*?>Meta seo web<?php */?>
<?php /*?>Meta facebook<?php */?>
<meta property="og:image" content="<?php if($template!='index') echo $images_facebook;else echo $http.$config_url.'/'._upload_hinhanh_l.$seo['thumb']?>" />
<meta property="og:image:alt" content="<?php if($template!='index')echo $title_facebook;else echo $seo['title'];?>" />
<meta property="og:title" content="<?php if($template!='index')echo $title_facebook;else echo $seo['title'];?>" />
<meta property="og:url" content="<?php if($template!='index') echo $url_facebook;else echo $http.$config_url.'/';?>" />
<meta property="og:site_name" content="<?=$http.$config_url?>/" />
<meta property="og:description" content="<?php if($template!='index')echo $description_facebook;else echo $seo['description'];?>" />
<meta property="og:type" content="<?=$type_og?>" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="<?=$company['tiwtter'];?>" />
<meta name="twitter:creator" content="<?=$company['tiwtter'];?>" />

<?php if(!isGoogleSpeed()){?>
	<?php if($template!='index'){?>
	<link href="css/pro_detail.css" rel="stylesheet" />
	<link rel="stylesheet" href="js/confirm/jquery-confirm.css" />
	<link href="js/fotorama/fotorama.css" type="text/css" rel="stylesheet" />
	<link href="css/tab.css" rel="stylesheet" />
	<link href="js/magiczoomplus/magiczoomplus.css" rel="stylesheet"  media="screen"/>
	<?php }?>
	<link href="css/popup.css" rel="stylesheet" />
	<link href="css/cart1.css" rel="stylesheet" />
	<link href="js/fontawesome/css/font-awesome.css" rel="stylesheet" />
	<link href="js/fancybox-3.0/jquery.fancybox.min.css?v=1494131338" media="screen" rel="stylesheet" />
	<?php if($mb==1 || $mb_rp==1) { ?>
	<link href="css/jquery.mmenu.all.css" rel="stylesheet" />
	<?php } ?>
	<link href="css/animate.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/slick.css"/>
	<link rel="stylesheet" href="css/slick-theme.css"/>
<?php } ?>
<?php if($template=='index' && count($slider)>0){?>
	<link href="css/css_jssor_slider.css" rel="stylesheet" />
<?php } ?>
<?php if($com=='album'){?>
	<link href="js/photobox/photobox.css" rel="stylesheet" type="text/css" />
	
	<link rel='stylesheet' href='js/unitegallery/unite-gallery.css' type='text/css' /> 
<?php } ?>
<link href="css/font.css" rel="stylesheet" />
<link href="css/default.css" rel="stylesheet" />
<link href="style.css" rel="stylesheet" />
<link href="js/toast/toastr.min.css" rel="stylesheet" type="text/css" />
<?php if($com=="gio-hang"){ ?>
<link href="css/giohang.css" rel="stylesheet" />
<?php } ?>
<?php if($com=="thanh-toan"){ ?>
<link href="css/thanhtoan.css" rel="stylesheet" />
<?php } ?>
<?=$company['code_header']?>