<?php  if(!defined('_source')) die("Error");

if(isset($_REQUEST['com'])){

	$id =  addslashes($_REQUEST['com']);

	/*if(count($config['lang'])>1){

		$tenkhongdau = "( tenkhongdau='".$id."'";

		foreach($config['lang'] as $k => $v){ if($k!=''){

			$tenkhongdau .= " or tenkhongdau".$k."='".$id."'";

		}}

		$tenkhongdau .= " )";

	} else {

		$tenkhongdau = "tenkhongdau='".$id."'";

	}*/

	$tenkhongdau = "tenkhongdau".$lang."='".$id."'";



	/*--- danh muc cap 1 ---*/

	$d->reset();

	$sql = "select ten$lang as ten,id,type from #_product_danhmuc where hienthi=1 and ".$tenkhongdau."";

	$d->query($sql);

	$kq_search = $d->result_array();

 

	if(count($kq_search)>0){

		$type_og = "object";

		$type = $kq_search[0]['type'];

		if($type=='san-pham'){

			$template = 'product';

			$comlink= 'san-pham';

			$title_link = _sanpham;

		}elseif($type=='dich-vu'){

			$template = 'news';

			$comlink= 'dich-vu';

			$title_link = _dichvu;

		}else{

			$template = 'news';

			$comlink= 'tin-tuc';

			$title_link = _tintuc;

		}



		$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as description from #_product_danhmuc where ".$tenkhongdau." limit 0,1";

		$d->query($sql);

		$title_bar = $d->fetch_array();

		

		$_SESSION['id_lang'] = $title_bar['id'];

		$_SESSION['table_lang'] = "product_danhmuc";	



		$title_cat = $title_bar['ten'];

		$title = $title_bar['title'];

		$keywords = $title_bar['keywords'];

		$description = $title_bar['description'];

		

		$where = " type='".$type."' and id_danhmuc='".$title_bar['id']."' and hienthi=1 order by stt asc";

		

		/*duong dan link*/

		$link_web = '<a href="">'._trangchu.'</a> '." / ";

		$link_web.= '<a href="'.$comlink.'">'.$title_link."</a> / ";

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

		/*-- Com --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$comlink.'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_link.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="2" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 1 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$title_bar['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="3" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.='</ol>';



		/*Thông tin share facebook*/

		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$title_bar['photo'];

		$title_facebook = $title_bar['title'];

		$description_facebook = trim(strip_tags($title_bar['description']));

		$url_facebook = getCurrentPageURL();



		/*Lấy sản phẩm và phân trang*/

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

		$offset = 5;/*Số trang hiển thị*/			

		if ($page == "")$page = 1;

		else $page = $_REQUEST['p'];

		$page--;

		$bg = $pageSize*$page;		

		

		$d->reset();

		$sql = "select *,ten$lang as ten,mota$lang as mota,tenkhongdau$lang as tenkhongdau from #_product where $where limit $bg,$pageSize";		

		$d->query($sql);

		$product = $d->result_array();	

		$url_link = getCurrentPageURL();

		return false;

	}/*danh muc cap 1*/



	/*--- danh muc cap 2 ---*/

	$d->reset();

	$sql = "select ten$lang as ten,id,type from #_product_list where hienthi=1 and ".$tenkhongdau."";

	$d->query($sql);

	$kq_search = $d->result_array();

	if(count($kq_search)>0){

		$type_og = "object";

		$type = $kq_search[0]['type'];

		if($type=='san-pham'){

			$template = 'product';

			$comlink= 'san-pham';

			$title_link = _sanpham;



		}elseif($type=='dich-vu'){

			$template = 'news';

			$comlink= 'dich-vu';

			$title_link = _dichvu;

		}else{

			$template = 'news';

			$comlink= 'tin-tuc';

			$title_link = _tintuc;

		}



		$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as description from #_product_list where ".$tenkhongdau." limit 0,1";

		$d->query($sql);

		$title_bar = $d->fetch_array();

		

		$_SESSION['id_lang'] = $title_bar['id'];

		$_SESSION['table_lang'] = "product_list"; 



		$title_cat = $title_bar['ten'];

		$title = $title_bar['title'];

		$keywords = $title_bar['keywords'];

		$description = $title_bar['description'];

	

		$where = " type='".$type."' and id_list='".$title_bar['id']."' and hienthi=1 order by stt asc";

		

		/*link duong dan*/

		$link_danhmuc = Get_DuongDan("product_danhmuc","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_danhmuc']);

		

		$link_web = '<a href="">'._trangchu.'</a> '." / ";

		$link_web.= '<a href="'.$comlink.'">'.$title_link."</a> / ";

		$link_web.= "<a href=".$link_danhmuc['tenkhongdau'].">".$link_danhmuc['ten']." </a>"." / ";

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

		/*-- Com --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$comlink.'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_link.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="2" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 1 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_danhmuc['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_danhmuc['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="3" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 2 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$title_bar['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="4" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.='</ol>';

		

		/*Thông tin share facebook*/

		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$title_bar['photo'];

		$title_facebook = $title_bar['title'];

		$description_facebook = trim(strip_tags($title_bar['description']));

		$url_facebook = getCurrentPageURL();



		/*Lấy sản phẩm và phân trang*/

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

		$offset = 5;/*Số trang hiển thị*/			

		if ($page == "")$page = 1;

		else $page = $_REQUEST['p'];

		$page--;

		$bg = $pageSize*$page;		

		

		$d->reset();

		$sql = "select *,ten$lang as ten,mota$lang as mota,tenkhongdau$lang as tenkhongdau from #_product where $where limit $bg,$pageSize";		

		$d->query($sql);

		$product = $d->result_array();	

		$url_link = getCurrentPageURL();

		return false;

	}/*danh muc cap 2*/



	/*--- danh muc cap 3 ---*/

	$d->reset();

	$sql = "select ten$lang as ten,id,type from #_product_cat where hienthi=1 and ".$tenkhongdau."";

	$d->query($sql);

	$kq_search = $d->result_array();

	if(count($kq_search)>0){

		$type_og = "object";

		$type = $kq_search[0]['type'];

		if($type=='san-pham'){

			$template = 'product';

			$comlink= 'san-pham';

			$title_link = _sanpham;

		}elseif($type=='dich-vu'){

			$template = 'news';

			$comlink= 'dich-vu';

			$title_link = _dichvu;

		}else{

			$template = 'news';

			$comlink= 'tin-tuc';

			$title_link = _tintuc;

		}



		$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as description from #_product_cat where ".$tenkhongdau." limit 0,1";

		$d->query($sql);

		$title_bar = $d->fetch_array();

		

		$_SESSION['id_lang'] = $title_bar['id'];

		$_SESSION['table_lang'] = "product_cat";



		$title_cat = $title_bar['ten'];

		$title = $title_bar['title'];

		$keywords = $title_bar['keywords'];

		$description = $title_bar['description'];

	

		$where = " type='".$type."' and id_cat='".$title_bar['id']."' and hienthi=1 order by stt asc";

		

		/*link duong dan*/

		$link_danhmuc = Get_DuongDan("product_danhmuc","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_danhmuc']);

		$link_list = Get_DuongDan("product_list","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_list']);

		

		$link_web = '<a href="">'._trangchu.'</a> '." / ";

		$link_web.= '<a href="'.$comlink.'">'.$title_link."</a> / ";

		$link_web.= "<a href=".$link_danhmuc['tenkhongdau'].">".$link_danhmuc['ten']." </a>"." / ";

		$link_web.= "<a href=".$link_list['tenkhongdau'].">".$link_list['ten']." </a>"." / ";

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

		/*-- Com --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$comlink.'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_link.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="2" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 1 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_danhmuc['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_danhmuc['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="3" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 2 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_list['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_list['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="4" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 3 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$title_bar['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="5" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		$BreadcrumbList.='</ol>';



		/*Thông tin share facebook*/

		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$title_bar['photo'];

		$title_facebook = $title_bar['title'];

		$description_facebook = trim(strip_tags($title_bar['description']));

		$url_facebook = getCurrentPageURL();



		/*Lấy sản phẩm và phân trang*/

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

		return false;

	}/*danh muc cap 3*/



	/*--- danh muc cap 4 ---*/

	$d->reset();

	$sql = "select ten$lang as ten,id,type from #_product_item where hienthi=1 and ".$tenkhongdau."";

	$d->query($sql);

	$kq_search = $d->result_array();

	if(count($kq_search)>0){

		$type_og = "object";

		$type = $kq_search[0]['type'];

		if($type=='san-pham'){

			$template = 'product';

			$comlink= 'san-pham';

			$title_link = _sanpham;

		}elseif($type=='dich-vu'){

			$template = 'news';

			$comlink= 'dich-vu';

			$title_link = _dichvu;

		}else{

			$template = 'news';

			$comlink= 'tin-tuc';

			$title_link = _tintuc;

		}



		$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as keywords from #_product_item where ".$tenkhongdau." limit 0,1";

		$d->query($sql);

		$title_bar = $d->fetch_array();

		

		$_SESSION['id_lang'] = $title_bar['id'];

		$_SESSION['table_lang'] = "product_item";



		$title_cat = $title_bar['ten'];

		$title = $title_bar['title'];

		$keywords = $title_bar['keywords'];

		$description = $title_bar['description'];

	

		$where = " type='".$type."' and id_item='".$title_bar['id']."' and hienthi=1 order by stt asc";

		

		/*link duong dan*/

		$link_danhmuc = Get_DuongDan("product_danhmuc","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_danhmuc']);

		$link_list = Get_DuongDan("product_list","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_list']);

		$link_cat = Get_DuongDan("product_cat","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$title_bar['id_cat']);

		

		$link_web = '<a href="">'._trangchu.'</a> '." / ";

		$link_web.= '<a href="'.$comlink.'">'.$title_link."</a> / ";

		$link_web.= "<a href=".$link_danhmuc['tenkhongdau'].">".$link_danhmuc['ten']." </a>"." / ";

		$link_web.= "<a href=".$link_list['tenkhongdau'].">".$link_list['ten']." </a>"." / ";

		$link_web.= "<a href=".$link_cat['tenkhongdau'].">".$link_cat['ten']." </a>"." / ";

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

		/*-- Com --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$comlink.'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_link.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="2" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 1 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_danhmuc['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_danhmuc['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="3" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 2 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_list['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_list['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="4" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 3 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_cat['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$link_cat['ten'].'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="5" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- danh muc 4 --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$title_bar['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="6" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		$BreadcrumbList.='</ol>';



		/*Thông tin share facebook*/

		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$title_bar['photo'];

		$title_facebook = $title_bar['title'];

		$description_facebook = trim(strip_tags($title_bar['description']));

		$url_facebook = getCurrentPageURL();



		/*Lấy sản phẩm và phân trang*/

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

		return false;

	}/*danh muc cap 4*/



	/*--- Chi Tiet ---*/

	$d->reset();

	$sql = "select ten$lang as ten,id,type from #_product where hienthi=1 and ".$tenkhongdau."";

	$d->query($sql);

	$kq_search = $d->result_array();

	if(count($kq_search)>0){

		$type_og = "article";

		$type = $kq_search[0]['type'];

		if($type=='san-pham'){

			$template = 'product_detail';

			$comlink= 'san-pham';

			$title_link = _sanpham;



			// Khuyen mai dac biet

			$d->reset();

			$sql = "SELECT noidung FROM #_about where type = 'kmdb'";

			$d->query($sql);	

			$kmdb = $d->fetch_array();

			

		}elseif($type=='dich-vu'){

			$template = 'news_detail';

			$comlink= 'dich-vu';

			$title_link = _dichvu;

		}elseif($type=='thuong-hieu'){

			$template = 'news_detail';

			$comlink= 'thuong-hieu';

			$title_link = "Thương hiệu";

		}elseif($type=='du-an'){

			$template = 'news_detail';

			$comlink= 'du-an';

			$title_link = _duan;

		}elseif($type=='cong-trinh'){

			$template = 'news_detail';

			$comlink= 'cong-trinh';

			$title_link = _congtrinh;

		}elseif($type=='gioi-thieu'){

			$template = 'news_detail';

			$comlink= 'gioi-thieu';

			$title_link = _gioithieu;

		}elseif($type=='chinh-sach'){

			$template = 'news_detail';

			$comlink= 'chinh-sach';

			$title_link = _chinhsach;

		}else{

			$template = 'news_detail';

			$comlink= 'tin-tuc';

			$title_link = _tintuc;

		}



		/*Cập nhật lượt xem*/

		$sql_lanxem = "UPDATE #_product SET luotxem=luotxem+1  WHERE tenkhongdau ='".$id."'";

		$d->query($sql_lanxem);



		//Chi tiết sản phẩm

		$sql_detail = "select *,id,ten$lang as ten,mota$lang as mota,noidung$lang as noidung,title$lang as title,keywords$lang as keywords,description$lang as description,giasi,soluongsi from #_product where hienthi=1 and ".$tenkhongdau." limit 0,1";

		$d->query($sql_detail);

		$row_detail = $d->fetch_array();



		$_SESSION['id_lang'] = $row_detail['id'];

		$_SESSION['table_lang'] = "product";



		/*-- lay tags --*/

		if($row_detail['id_tags']){

			$arr_tags = Replace_Array($row_detail['id_tags']);

		}

		/*-- end lay tags --*/



		/* Lấy màu */

		$d->reset();

		$sql = "select * from #_product_mau where hienthi=1 and type='".$row_detail['type']."' and id_product='".$row_detail['id']."' order by stt asc";

		$d->query($sql);

		$mau = $d->result_array();



		/* Lấy size */

		$d->reset();

		$sql = "select * from #_product_size where hienthi=1 and type='".$row_detail['type']."' and find_in_set(id,'".$row_detail['id_size']."') order by stt asc";

		$d->query($sql);

		$size = $d->result_array();

		

		$d->reset();

        $sql = "select * from #_product where type='thuong-hieu' and hienthi=1 and id='".$row_detail['thuonghieu']."'";      

        $d->query($sql);

        $thuongh = $d->fetch_array(); 

		

		$d->reset();

        $sql = "select * from #_product where type='san-pham' and hienthi=1 and thuonghieu='".$row_detail['id']."' order by stt asc, id desc";      

        $d->query($sql);

        $productth = $d->result_array(); 

        

		/* Begin Lưu Session Product Đã Xem

		product_seen_exists($row_detail['id']);

		/* End Lưu Session Product Đã Xem */

		

		$title_cat = $row_detail['ten'];

		$title = $row_detail['title'];	

		$keywords = $row_detail['keywords'];

		$description = $row_detail['description'];





		/*Thông tin share facebook*/

		$images_facebook = $http.$config_url.'/'._upload_sanpham_l.$row_detail['photo'];

		$title_facebook = $row_detail['title'];

		$description_facebook = trim(strip_tags($row_detail['description']));

		$url_facebook = getCurrentPageURL();

		

		/*link duong dan*/

		$link_danhmuc = Get_DuongDan("product_danhmuc","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$row_detail['id_danhmuc']);

		$link_list = Get_DuongDan("product_list","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$row_detail['id_list']);

		$link_cat = Get_DuongDan("product_cat","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$row_detail['id_cat']);

		$link_item = Get_DuongDan("product_item","id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type",$row_detail['id_item']);

		

		$link_web = '<a href="">'._trangchu.'</a> '." / ";

		$link_web.= "<a href=".$comlink.">".$title_link."</a> / ";

		$number_content = 2;

		if($link_danhmuc['ten']!=''){

		$link_web.= "<a href=".$link_danhmuc['tenkhongdau'].">".$link_danhmuc['ten']." </a>"." / ";

		$number_content = $number_content + 1;

		}

		if($link_list['ten']!=''){

		$link_web.= "<a href=".$link_list['tenkhongdau'].">".$link_list['ten']." </a>"." / ";

		$number_content = $number_content + 1;

		}

		if($link_cat['ten']!=''){

		$link_web.= "<a href=".$link_cat['tenkhongdau'].">".$link_cat['ten']." </a>"." / ";

		$number_content = $number_content + 1;

		}

		if($link_item['ten']!=''){

		$link_web.= "<a href=".$link_item['tenkhongdau'].">".$link_item['ten']." </a>"." / ";

		$number_content = $number_content + 1;

		}

		$link_web.= $title_cat;

		$number_content = $number_content + 1;

		

		/*-Trang Chu --*/

		$BreadcrumbList ='<ol itemscope itemtype="https://schema.org/BreadcrumbList">';

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'">';

		$BreadcrumbList.='<span itemprop="name">'._trangchu.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="1" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		/*-- Com --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$comlink.'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_link.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="2" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.=' › ';

		if($link_danhmuc['ten']!=''){

			/*-- danh muc 1 --*/

			$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

			$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_danhmuc['tenkhongdau'].'">';

			$BreadcrumbList.='<span itemprop="name">'.$link_danhmuc['ten'].'</span>';

			$BreadcrumbList.='</a>';

			$BreadcrumbList.='<meta itemprop="position" content="3" />';

			$BreadcrumbList.='</li>';

			$BreadcrumbList.=' › ';

		}

		if($link_list['ten']!=''){

			/*-- danh muc 2 --*/

			$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

			$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_list['tenkhongdau'].'">';

			$BreadcrumbList.='<span itemprop="name">'.$link_list['ten'].'</span>';

			$BreadcrumbList.='</a>';

			$BreadcrumbList.='<meta itemprop="position" content="4" />';

			$BreadcrumbList.='</li>';

			$BreadcrumbList.=' › ';

		}

		if($link_cat['ten']!=''){

			/*-- danh muc 3 --*/

			$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

			$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_cat['tenkhongdau'].'">';

			$BreadcrumbList.='<span itemprop="name">'.$link_cat['ten'].'</span>';

			$BreadcrumbList.='</a>';

			$BreadcrumbList.='<meta itemprop="position" content="5" />';

			$BreadcrumbList.='</li>';

			$BreadcrumbList.=' › ';

		}

		if($link_item['ten']!=''){

			/*-- danh muc 4 --*/

			$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

			$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$link_item['tenkhongdau'].'">';

			$BreadcrumbList.='<span itemprop="name">'.$link_item['ten'].'</span>';

			$BreadcrumbList.='</a>';

			$BreadcrumbList.='<meta itemprop="position" content="6" />';

			$BreadcrumbList.='</li>';

			$BreadcrumbList.=' › ';

		}

		/*-- san pham --*/

		$BreadcrumbList.='<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

		$BreadcrumbList.='<a itemprop="item" href="'.$http.$config_url.'/'.$row_detail['tenkhongdau'].'">';

		$BreadcrumbList.='<span itemprop="name">'.$title_cat.'</span>';

		$BreadcrumbList.='</a>';

		$BreadcrumbList.='<meta itemprop="position" content="'.$number_content.'" />';

		$BreadcrumbList.='</li>';

		$BreadcrumbList.='</ol>';

		

		/*Hình ảnh khác của sản phẩm*/

		$sql_hinhthem = "select id,ten$lang as ten,thumb,photo from #_hinhanh where id_hinhanh='".$row_detail['id']."' and type='".$type."' and hienthi=1 order by stt asc";

		$d->query($sql_hinhthem);

		$hinhthem = $d->result_array();



		/*Sản phẩm cùng loại*/

		

		$where = " type='".$type."'";

		if($row_detail['id_danhmuc']>0){

		$where.=" and id_danhmuc='".$row_detail['id_danhmuc']."' ";

		}

		if($row_detail['id_list']>0){

		$where.=" and id_list='".$row_detail['id_list']."' ";

		}

		if($row_detail['id_cat']>0){

		$where.=" and id_cat='".$row_detail['id_cat']."' ";

		}

		if($row_detail['id_item']>0){

		$where.=" and id_item='".$row_detail['id_item']."' ";

		}

		$where.=" and tenkhongdau".$lang."<>'".$id."' and hienthi=1 order by stt asc";



		



		/*Lấy sản phẩm và phân trang*/

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

		return false;

	}/*Chi tiet*/



	if($id!='index'){

		$d->reset();

		$sql = "select ten$lang as ten,id,type from #_product where hienthi=1 and ".$tenkhongdau."";

		$d->query($sql);

		$kq_search = $d->result_array();

		if(empty($kq_search)){

			$template = '404';

			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

			return false;

		}

	}

	else{

		$type_og = "website";

		$template='index';

		$_SESSION['id_lang'] = 0;

	

		$d->reset();

		$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where type='san-pham' and hienthi=1 and spbanchay=1 order by stt,id desc limit 0,10";		

		$d->query($sql);

		$product = $d->result_array();	



		$d->reset();

		$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where type='thuong-hieu' and hienthi=1 and noibat=1 order by stt,id desc";		

		$d->query($sql);

		$thuonghieu = $d->result_array();	



		$d->reset();

		$sql = "select * from #_slider where type='quangcao0' and hienthi=1 order by stt,id desc";		

		$d->query($sql);

		$quangc0 = $d->result_array();

		

		$d->reset();

		$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product_danhmuc where type='san-pham' and hienthi=1 and noibat=1 order by stt,id desc";		

		$d->query($sql);

		$productdm = $d->result_array();

		$url_full_link=$_SERVER['REQUEST_URI'];

		if($url_full_link=='/'){

			$url_link = getCurrentPageURL().'index.html';

		}else{

			$url_link = getCurrentPageURL();

		}

	}

}else{

	$type_og = "website";	

	$template='index';

	$_SESSION['id_lang'] = 0;		

	

	$d->reset();

	$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where type='san-pham' and hienthi=1 and spbanchay=1 order by stt,id desc limit 0,10";		

	$d->query($sql);

	$product = $d->result_array();	



	$d->reset();

	$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where type='thuong-hieu' and hienthi=1 and noibat=1 order by stt,id desc";		

	$d->query($sql);

	$thuonghieu = $d->result_array();	



	$d->reset();

	$sql = "select * from #_slider where type='quangcao0' and hienthi=1 order by stt,id desc";		

	$d->query($sql);

	$quangc0 = $d->result_array();



	$d->reset();

	$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product_danhmuc where type='san-pham' and hienthi=1 and noibat=1 order by stt,id desc";		

	$d->query($sql);

	$productdm = $d->result_array();



	$url_full_link=$_SERVER['REQUEST_URI'];

	if($url_full_link=='/'){

		$url_link = getCurrentPageURL().'index';

	}else{

		$url_link = getCurrentPageURL();

	}

}

?>