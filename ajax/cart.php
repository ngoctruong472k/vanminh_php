<?php
	include ("ajax_config.php");
	
	$act = magic_quote(trim(strip_tags($_POST['act'])));
	
	switch($act){
		case "dathang":
			order();
			break;
		case "dangnhap":
			check_user();
			break;
		default:
			break;
	}

function order()
{

	global $d;
	$id = intval($_POST['id']);
	$soluong = intval($_POST['soluong']);
	$size = intval($_POST['size']);
	addtocart($id,$soluong,$size);

	$danhmucps = get_fetch_array("select id,ten from #_product where id='".$id."' ");

	$return['thongbao'] = "<p class='line-cart'>"._bandamuathanhcong." [<span class='cl-orange'>".$danhmucps['ten']."</span>]</p>";
	$return['ok'] = '';
	$return['sl'] = count($_SESSION['cart']);
	echo json_encode($return);
}
?>