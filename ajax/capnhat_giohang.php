<?php
	include ("ajax_config.php");

	@$q = $_POST['soluong'];
	@$product = $_POST['product'];
	@$size = $_POST['size'];
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$sizeid=$_SESSION['cart'][$i]['size'];
		if($pid==$product && $sizeid==$size){
			if($q>0 && $q<=999){
				$soluong = str_replace(",", '.', $q);
				$_SESSION['cart'][$i]['qty']=$soluong;
			}
			$_SESSION['cart'][$i]['mausac'] == $_POST['mausac'];
		}
	}
	$price = number_format(get_price($product,$q),0, ',', '.')." &nbsp;đ";
	$price_item = number_format(get_price($product,$q)*$q,0, ',', '.')." &nbsp;đ";
	$full_item = number_format(get_order_total(),0, ',', '.')." &nbsp;đ";
	$get_order_info = array('price' => $price ,'price_item' => $price_item ,'full_item' => $full_item,'item_total' => get_total());
	echo json_encode($get_order_info);
?>