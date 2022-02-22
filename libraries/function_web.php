<?php if(!defined('_lib')) die("Error");
function Replace_Array($string){
	$arr1 = explode(',', $string);
	$arr= array_unique($arr1);
	return $arr;
}//Replace_Array

function Get_Tags($table,$bien_id,$id){
	global $d,$row,$lang;
	$where = " where ".$bien_id."=".$id;
	$sql = "select id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type from #_".$table.' '.$where;
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//List_Options

function Get_Tags1($table,$type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,type from #_".$table." where type='".$type."' and noibat=1 and hienthi=1 order by stt, id desc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//List_Options

function Get_HinhThucThanhToan($id){
	global $d,$row,$lang;
	$sql = "select noidung$lang as noidung from #_httt where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function Get_HinhThucThanhToan
function List_Video(){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,link from #_video where hienthi=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_Video
function List_anhnen($type){
	global $d,$row,$lang;
	$sql = "select * from #_anhnen where hienthi=1 and type='".$type."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function List_Video

function List_bando(){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten from #_bando where hienthi=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_Video

function Get_DuongDan($table, $option, $id){
	global $d,$row,$lang;
	$sql = "select ".$option." from #_".$table." where id='".$id."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function Get_DuongDan
function List_HoTroTrucTuyen(){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,dienthoai,email,yahoo,skype,facebook from #_yahoo where hienthi=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_HoTroTrucTuyen
function List_BaiViet($type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,thumb,photo,type,mota$lang as mota,ngaytao from #_product where hienthi=1 and type='".$type."' order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_TinTucNoiBat
function List_BaiVietNoiBat($type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,thumb,photo,type,mota$lang as mota,ngaytao from #_product where hienthi=1 and type='".$type."' and noibat=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_TinTucNoiBat
function List_BaiVietMoi($type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,thumb,photo,type,mota$lang as mota,ngaytao from #_product where hienthi=1 and type='".$type."' and spmoi=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_TinTucMoi
function List_BaiVietTieuBieu($type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,thumb,photo,type,mota$lang as mota,ngaytao from #_product where hienthi=1 and type='".$type."' and tieubieu=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_TinTucTieuBieu
function List_BaiVietBanChay($type){
	global $d,$row,$lang;
	$sql = "select *,id,ten$lang as ten,tenkhongdau$lang as tenkhongdau,thumb,photo,type,mota$lang as mota,ngaytao from #_product where hienthi=1 and type='".$type."' and spbanchay=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_TinTucBanChay
function GET_SeoWebsite($com){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,title$lang as title,keywords$lang as keywords,description$lang as description from #_product where hienthi=1 and tenkhongdau='".$com."' ";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function GET_SeoWebsite
function List_SanPhamTheoDanhMuc($option,$type,$id){
	global $d,$row;
	$sql = "select ".$option." from #_product where hienthi=1 and type='".$type."' and id_danhmuc=".$id." and noibat=1 order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_SanPhamTheoDanhMuc
function Get_Fanpage($w,$h,$link){
	global $d,$row;
	$row = "<div class='fb-page' data-href=".$link." data-tabs='timeline' data-width=".$w." data-height=".$h." data-small-header='true' data-adapt-container-width='true' data-hide-cover='true' data-show-facepile='true'><blockquote cite=".$link." class='fb-xfbml-parse-ignore'><a href=".$link.">Facebook</a></blockquote></div>";
	return $row;
}//function Get_NoiDung
function Get_NoiDung($type){
	global $d,$row,$lang;
	$sql = "select *,noidung$lang as noidung,mota$lang as mota,ten$lang as ten,photo from #_about where type='".$type."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function Get_NoiDung
function List_MangXaHoi($type){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,mota$lang as mota,link,photo from #_lkweb where hienthi=1 and type='".$type."' order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_MangXaHoi
function List_HinhAnh($type){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,mota$lang as mota,mota1$lang as mota1,link,photo from #_slider where hienthi=1 and type='".$type."' order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_HinhAnh
function Get_HinhAnh($type){
	global $d,$row,$lang;
	$sql = "select *,ten$lang as ten,mota$lang as mota,photo$lang as photo,link,hienthi from #_background where hienthi=1 and type='".$type."'";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}//function Get_HinhAnh
function List_DanhMucCap1($table, $op_table, $type){
	global $d,$row;
	$sql = "select ".$op_table." from table_".$table." where hienthi=1 and type='".$type."' order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_DanhMucCap1
function List_DanhMucCap2($table, $op_table, $type, $idDanhMuc){
	settype($idDanhMuc,"int");
	global $d,$row;
	$sql = "select ".$op_table." from table_".$table." where hienthi=1 and type='".$type."' and id_danhmuc=".$idDanhMuc." order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_DanhMucCap2
function List_DanhMucCap3($table, $op_table, $type, $idList){
	settype($idList,"int");
	global $d,$row;
	$sql = "select ".$op_table." from table_".$table." where hienthi=1 and type='".$type."' and id_list=".$idList." order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_DanhMucCap3
function List_DanhMucCap4($table, $op_table, $type, $idCat){
	settype($idCat,"int");
	global $d,$row;
	$sql = "select ".$op_table." from table_".$table." where hienthi=1 and type='".$type."' and id_cat=".$idCat." order by stt asc";
	$d->query($sql);
	$row = $d->result_array();
	return $row;
}//function List_DanhMucCap3
?>