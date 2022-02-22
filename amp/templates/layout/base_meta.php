<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="canonical" href="<?=getCurrentPageURL_CANO()?>" />
<META NAME="ROBOTS" CONTENT="noodp,index,follow" />
<meta name="author" content="<?=$company['ten']?>" />
<meta name="copyright" content="<?=$company['ten']?> [<?=$company['email']?>]" />
<meta name="DC.title" content="<?php if($template!='index')echo $title;else echo $seo['title'];?>" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="<?=$company['diachi']?>" />
<meta name="geo.position" content="<?=str_replace(',',':',$company['toado'])?>" />
<meta name="ICBM" content="<?=$company['toado']?>" />
<meta name="DC.identifier" content="<?=$http.$config_url?>/" />
<title><?php if($template!='index')echo $title;else echo $seo['title'];?></title>
<meta name="keywords" content="<?php if($template!='index')echo $keywords;else echo $seo['keywords'];?>" />
<meta name="description" content="<?php if($template!='index')echo $description;else echo $seo['description'];?>" />
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
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />