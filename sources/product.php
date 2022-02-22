<?php  if(!defined('_source')) die("Error");
	if($com=='san-pham-da-xem')
	{
		$template = $template1;
		$where = " hienthi=1 and find_in_set(id,'".implode(",",$_SESSION['pro_seen'])."')";
	}else{
		$template = $template1;
		if($com=='san-pham-gia-tot'){
			$where = " type='".$type."' and spmoi=1 and hienthi=1 order by stt asc";
		} elseif($com=='khuyen-mai-hot'){
			$where = " type='".$type."' and tieubieu=1 and hienthi=1 order by stt asc";
		} elseif($com=='san-pham-khac'){
			$where = " type='".$type."' and id_danhmuc=0 and hienthi=1 order by stt asc";
		} elseif($com=='best-seller'){
			$where = " type='".$type."' and spbanchay=1 and hienthi=1 order by stt asc";
		} else {
			$where = " type='".$type."' and hienthi=1 order by stt asc";
		}
		
		$link_web = '<a href="">'._trangchu.'</a> '." / ";
		$link_web.= $title_cat;
		
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
		
		$rs_seoweb = GET_SeoWebsite($com);
		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$rs_seoweb['thumb'];
		$title_facebook = $rs_seoweb['title'];
		$description_facebook = trim(strip_tags($rs_seoweb['description']));
		$url_facebook = getCurrentPageURL();

		$title = $rs_seoweb['title'];
		$keywords = $rs_seoweb['keywords'];
		$description = $rs_seoweb['description'];	
	}
	$_SESSION['id_lang'] = 0;
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_product where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_REQUEST['p'];
	$pageSize = $company['phantrang1'];/*Số item cho 1 trang*/
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