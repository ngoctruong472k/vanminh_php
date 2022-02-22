<?php

	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$d = new database($config['database']);
 

	#Thông tin seo web title + Keyword + Description

	$sql_seo = "select *,alt$lang as alt,h1$lang as h1,h2$lang as h2,h3$lang as h3,title$lang as title,keywords$lang as keywords,description$lang as description from #_meta limit 0,1";

	$d->query($sql_seo);

	$seo= $d->fetch_array();	

	

	#Thông tin công ty

	$sql_company = "select *,ten$lang as ten,diachi$lang as diachi,yahoo$lang as yahoo,slogan$lang as slogan,slogan1$lang as slogan1,slogan2$lang as slogan2,slogan3$lang as slogan3 from #_company limit 0,1";

	$d->query($sql_company);

	$company= $d->fetch_array();



	$data_sitemap = array(

		

		array("tbl"=>"product_danhmuc","field"=>"idl","com"=>"san-pham","type"=>"san-pham"),

		array("tbl"=>"product_list","field"=>"idl","com"=>"san-pham","type"=>"san-pham"),

		array("tbl"=>"product_cat","field"=>"idl","com"=>"san-pham","type"=>"san-pham"),

		array("tbl"=>"product","field"=>"id","com"=>"san-pham","type"=>"san-pham"),



		array("tbl"=>"about","field"=>"id","com"=>"gioi-thieu","type"=>"about"),

		array("tbl"=>"about","field"=>"id","com"=>"van-chuyen-thanh-toan","type"=>"van-chuyen-thanh-toan"),

		array("tbl"=>"product","field"=>"id","com"=>"tin-tuc","type"=>"tin-tuc"),

		array("tbl"=>"about","field"=>"id","com"=>"tuyen-dung","type"=>"tuyen-dung"),

		array("tbl"=>"product","field"=>"id","com"=>"thuong-hieu","type"=>"thuong-hieu"),

		array("tbl"=>"product","field"=>"id","com"=>"chinh-sach","type"=>"chinh-sach"),

		array("tbl"=>"about","field"=>"id","com"=>"lien-he","type"=>"lienhe"),



	);



	switch($com)

	{

		case 'gioi-thieu':

			$type = "about";

			$title_cat = _gioithieu;

			$source = "about";

			$template = "about";

			$type_og = "article";

			break;



		case 'van-chuyen-thanh-toan':

			$type = "van-chuyen-thanh-toan";

			$title_cat = "Vận chuyển và thanh toán";

			$source = "about";

			$template = "about";

			$type_og = "article";

			break;



		case 'tuyen-dung':

			$type = "tuyen-dung";

			$title_cat = _tuyendung;

			$source = "about";

			$template = "about";

			$type_og = "article";

			break;

			

		case 'tin-tuc':

			$type = "tin-tuc";

			$title_cat = _tintuc;

			$title_link = _tintuc;

			$source = "news";

			$template1 = "news";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;

			

		case 'thuong-hieu':

			$type = "thuong-hieu";

			$title_cat = "Thương Hiệu";

			$title_link = "Thương Hiệu";

			$source = "news";

			$template1 = "news";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;

			

		case 'chinh-sach':

			$type = "chinh-sach";

			$title_cat = _chinhsach;

			$title_link = _chinhsach;

			$source = "news";

			$template1 = "news";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;

			

		case 'lien-he':

			$type = "lienhe";

			$title_cat = _lienhe;

			$source = "contact";

			$template = "contact";

			$type_og = "article";

			break;



		case 'tim-kiem':

			$type = "san-pham";

			$title = _ketquatimkiem;

			$title_cat = _ketquatimkiem;

			$source = "search";

			$template = "product";

			break;

		case 'tags':

			$source = "tags";

			$template = "product";

			break;	

		case 'tag':

			$source = "tag";

			$template = "news";

			break;

							

		case 'san-pham':

			$type = "san-pham";

			$title_cat = _sanpham;

			$title_link = _sanpham;

			$source = "product";

			$template1 = "product";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;	

				

		case 'best-seller':

			$type = "san-pham";

			$title_cat = "Best Seller";

			$title_link = "Best Seller";

			$source = "product";

			$template1 = "product";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;



		case 'khuyen-mai-hot':

			$type = "san-pham";

			$title_cat = "Khuyến mãi hot";

			$title_link = "Khuyến mãi hot";

			$source = "product";

			$template1 = "product";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;



		case 'san-pham-gia-tot':

			$type = "san-pham";

			$title_cat = "Sản phẩm giá tốt";

			$title_link = "Sản phẩm giá tốt";

			$source = "product";

			$template1 = "product";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;



		case 'san-pham-khac':

			$type = "san-pham";

			$title_cat = "Sản phẩm khác";

			$title_link = "Sản phẩm khác";

			$source = "product";

			$template1 = "product";

			$type_og = isset($_GET['id']) ? "article" : "object";

			break;

		case 'gio-hang':

			$title_cat = "Giỏ Hàng";

			$title_link = "Giỏ Hàng";

			$source = "giohang";

			$template = "giohang";

			$type_og = "article";

			break;

		case 'thanh-toan':

			$title_cat = "Thanh Toán";

			$title_link = "Thanh Toán";

			$source = "thanhtoan";

			$template = "thanhtoan";

			$type_og = "article";

			break;

		

		case 'ngonngu':

			if(isset($_GET['lang']))

			{

				switch($_GET['lang'])

				{

					case '':

					$_SESSION['lang'] = '';

					break;

					case 'en':

					$_SESSION['lang'] = 'en';

					break;

					default:

					$_SESSION['lang'] = '';

					break;

				}

			}

			else{

				$_SESSION['lang'] = '';

			}

		if($_SESSION['id_lang']>0){

			$link_lang=Redirect_link_lang($_SESSION['id_lang'],$_SESSION['table_lang']);

			redirect($link_lang);

		}else{

			redirect($_SERVER['HTTP_REFERER']);

		}

		break;	

										

		default: 

			$source = "all";

			break;

	}

	if($source!="") include _source.$source.".php";	

	if($_REQUEST['com']=='logout')

	{

		session_unregister($login_name1);

		header("Location:index.php");

	}



	$arr_animate =array("bounce","flash","pulse","rubberBand","shake","swing","tada","wobble","jello","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","bounceOut","bounceOutDown","bounceOutLeft","bounceOutRight","bounceOutUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","fadeOut","fadeOutDown","fadeOutDownBig","fadeOutLeft","fadeOutLeftBig","fadeOutRight","fadeOutRightBig","fadeOutUp","fadeOutUpBig","flip","flipInX","flipInY","flipOutX","flipOutY");



	

?>

