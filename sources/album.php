<?php
	
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	
	$where = " type='".$type."' and hienthi=1 order by stt,id desc";
	$_SESSION['id_lang'] = 0;
	#Lấy sản phẩm và phân trang
	$d->reset();
	$sql = "SELECT count(id) AS numrows FROM #_slider where $where";
	$d->query($sql);	
	$dem = $d->fetch_array();
	
	$totalRows = $dem['numrows'];
	$page = $_GET['p'];
	$pageSize = 30;//Số item cho 1 trang
	$offset = 5;//Số trang hiển thị				
	if ($page == "")$page = 1;
	else $page = $_GET['p'];
	$page--;
	$bg = $pageSize*$page;		
	
	$d->reset();
	$sql = "select ten$lang as ten,photo from #_slider where $where limit $bg,$pageSize";		
	$d->query($sql);
	$album = $d->result_array();	
	$url_link = getCurrentPageURL();

	#Thông tin share facebook
	$rs_seoweb = GET_SeoWebsite($com);
	$images_facebook = 'http://'.$config_url.'/'._upload_sanpham_l.$rs_seoweb['thumb'];
	$title_facebook = $rs_seoweb['title'];
	$description_facebook = trim(strip_tags($rs_seoweb['description']));
	$url_facebook = getCurrentPageURL();

	$title = $rs_seoweb['title'];
	$keywords = $rs_seoweb['keywords'];
	$description = $rs_seoweb['description'];
?>