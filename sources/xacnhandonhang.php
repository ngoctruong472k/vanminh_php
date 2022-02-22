<?php  if(!defined('_source')) die("Error");
	$madonhang = $_SESSION['xacnhan_madonhang'];

	$d->reset();
	$sql = "select * from #_donhang where madonhang='".$madonhang."'";	
	$d->query($sql);
	$row_detail_donhang = $d->fetch_array();

	$d->reset();
	$sql = "select *,ten$lang as ten from #_httt where id='".$row_detail_donhang['httt']."'";	
	$d->query($sql);
	$row_httt = $d->fetch_array();
	
	$link_web = '<a href="">'._trangchu.'</a> '." / ";
	$link_web.= $title_cat;
?>