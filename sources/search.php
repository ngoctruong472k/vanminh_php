<?php  if(!defined('_source')) die("Error");
	
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
	$_SESSION['id_lang'] = 0;
	if(isset($_REQUEST['keyword'])){
		$tukhoa =  $_REQUEST['keyword'];
		$tukhoa = trim(strip_tags($tukhoa));    	
							

		$where = " (ten$lang LIKE '%$tukhoa%' or masp LIKE '%$tukhoa%') and hienthi=1 and type='".$type."' order by stt,id desc";
		
		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_REQUEST['p'];
		if($template=='product' || $template=='product_detail') { 
			$pageSize = $company['phantrang1'];//Số item cho 1 trang
		} else { 
			$pageSize = $company['phantrang2'];//Số item cho 1 trang
		}
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_REQUEST['p'];
		$page--;
		$bg = $pageSize*$page;		
		
		$d->reset();
		$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,mota$lang as mota,thumb,photo,masp,gia,giacu,type from #_product where $where limit $bg,$pageSize";		
		$d->query($sql);
		$product = $d->result_array();	
		$url_link = getCurrentPageURL();
	}	
?>