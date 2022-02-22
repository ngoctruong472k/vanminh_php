<?php  if(!defined('_source')) die("Error");

	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	
	$sql = "select *,ten$lang as ten,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description from #_about where type='".$type."' limit 0,1";
	$d->query($sql);
	$row_detail = $d->fetch_array();
	$_SESSION['id_lang'] = 0;
	$title = $row_detail['title'];
	$keywords = $row_detail['keywords'];
	$description = $row_detail['description'];
	
	$images_facebook = $http.$config_url.'/'._upload_hinhanh_l.$row_detail['photo'];
	$title_facebook = $row_detail['title'];
	$description_facebook = trim(strip_tags($row_detail['description']));
	$url_facebook = getCurrentPageURL();

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
	
?>