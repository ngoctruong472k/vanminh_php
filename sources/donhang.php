<?php  if(!defined('_source')) die("Error");

	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	$d->reset();
	$sql = "select * from #_donhang where id_user='".$_SESSION['login1']['id']."' order by ngaytao desc";
	$d->query($sql);
	$donhang = $d->result_array();
	$_SESSION['id_lang'] = 0;

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