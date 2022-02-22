<?php  if(!defined('_source')) die("Error");

	$id =  addslashes($_REQUEST['id']);

	if(isset($id))
	{	
		
		$d->reset();
		$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as description from #_tags where id='".$id."'";
		$d->query($sql);
		$row_detail = $d->fetch_array();

		$_SESSION['id_lang'] = $row_detail['id'];
		$_SESSION['table_lang'] = "tags";
		
		$images_facebook = $http.$config_url.'/'._upload_hinhanh_l.$row_detail['photo'];
		$title_facebook = $row_detail['title'];
		$description_facebook = trim(strip_tags($row_detail['description']));
		$url_facebook = getCurrentPageURL();
		
		$title = $row_detail['title'];
		$keywords = $row_detail['keywords'];
		$description = $row_detail['description'];
		
		$title_cat = $row_detail['ten'];	
		$title_bar = $row_detail['ten'];

		$where = "FIND_IN_SET (".$id.", id_tags) order by stt asc";

		#Lấy sản phẩm và phân trang
		$d->reset();
		$sql = "SELECT count(id) AS numrows FROM #_product where $where";
		$d->query($sql);	
		$dem = $d->fetch_array();
		
		$totalRows = $dem['numrows'];
		$page = $_REQUEST['p'];
		$pageSize = $company['phantrang1'];//Số item cho 1 trang
		$offset = 5;//Số trang hiển thị				
		if ($page == "")$page = 1;
		else $page = $_REQUEST['p'];
		$page--;
		$bg = $pageSize*$page;
	
		$d->reset();
		$sql = "select *,ten$lang as ten,tenkhongdau$lang as tenkhongdau,mota$lang as mota from #_product where ".$where." limit $bg,$pageSize ";
		$d->query($sql);
		$product = $d->result_array();
		$url_link = getCurrentPageURL();
	
	}
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
		

?>