<?php  if(!defined('_source')) die("Error");

	$template = $template1;
	$where = " type='".$type."' and hienthi=1 order by stt asc";
	$_SESSION['id_lang'] = 0;
	/*duong dan web*/
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;

	/*Thông tin share facebook*/
	$rs_seoweb = GET_SeoWebsite($com);
	$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$rs_seoweb['thumb'];
	$title_facebook = $rs_seoweb['title'];
	$description_facebook = trim(strip_tags($rs_seoweb['description']));
	$url_facebook = getCurrentPageURL();

	$title = $rs_seoweb['title'];
	$keywords = $rs_seoweb['keywords'];
	$description = $rs_seoweb['description'];

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
	
	/*Lấy sản phẩm và phân trang*/
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_product where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_REQUEST['p'];
	$pageSize = $company['phantrang2'];/*Số item cho 1 trang*/
	$offset = 5;/*Số trang hiển thị*/			
	if ($page == "")$page = 1;
	else $page = $_REQUEST['p'];
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select *,ten$lang as ten,tenkhongdau$lang as tenkhongdau,mota$lang as mota from #_product where $where limit $bg,$pageSize";		
	$d->query($sql);
	$product = $d->result_array();	
	$url_link = getCurrentPageURL();
	
?>