<?php if(!defined('_lib')) die("Error");

$product_danhmuc = List_DanhMucCap1("product_danhmuc","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota","san-pham");
$tintuc_danhmuc = List_DanhMucCap1("product_danhmuc","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota","cong-trinh");
$tintuc_danhmuc1 = List_DanhMucCap1("product_danhmuc","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota","du-an");
$tintuc_danhmuc2 = List_DanhMucCap1("product_danhmuc","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota","dich-vu");
$row_logo = Get_HinhAnh("logo");
$bgweb = Get_HinhAnh("bgweb");
$row_banner = Get_HinhAnh("banner");
$row_banner1 = Get_HinhAnh("banner1");
$row_banner2 = Get_HinhAnh("banner2");
$row_banner3 = Get_HinhAnh("banner3");
$row_banner4 = Get_HinhAnh("banner4");
$row_banner5 = Get_HinhAnh("banner5");
$popup = Get_HinhAnh("pupop");
$slider = List_HinhAnh("slider");
$doitac=List_HinhAnh("doitac");
$mxh_ft = List_MangXaHoi("social");
$mxh_ft1 = List_MangXaHoi("social1");
$mxh_ft3 = List_MangXaHoi("social3");
$row_about = Get_NoiDung("about");
$row_footer = Get_NoiDung("footer");
$company_contact = Get_NoiDung("lienhe");
$company_contact1 = Get_NoiDung("lienhe1");
$row_fanpage = Get_Fanpage("367","261",$company['fanpage']);
$thuonghieu = List_BaiVietNoiBat("thuong-hieu");
$tc = List_BaiVietNoiBat("tieu-chi");
$hotro = List_HoTroTrucTuyen();
$quangcao2 = List_HinhAnh("quangcao2");
$quangcao = List_HinhAnh("quangcao");
$row_tintuc = List_BaiVietNoiBat("tin-tuc");
$cs = List_BaiVietNoiBat("chinh-sach");

if($template=='product_detail'){
	$productm = List_BaiVietBanChay($type);
} else {
	if($template=='news_detail'){
		$productbc = List_BaiVietBanChay('san-pham');
	} else {
		$productm = List_BaiVietNoiBat($type);
	}
}
$video = List_Video();
$bando = List_bando();
$nen = List_anhnen('background');
$condau = Get_HinhAnh("condau");
if($condau['photo']!=''){ 
	$_SESSION['imgcondau'] = $condau['photo'];
}
$ta = Get_Tags1("tags","san-pham");
?>