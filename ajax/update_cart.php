<?php
	include ("ajax_config.php");

	$pid = $_POST['pid'];
	$q = $_POST['q'];
	$mausac = $_POST['mausac'];
	$size = $_POST['size'];
	$pr_trans = $_POST['pr_trans'];
	
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++)
	{
		if($pid==$_SESSION['cart'][$i]['productid'] && $mausac==$_SESSION['cart'][$i]['mausac'] && $size==$_SESSION['cart'][$i]['size'])
		{
			if($q) $_SESSION['cart'][$i]['qty'] = $q;
			break;
		}
	}
	$giaban = number_format(get_price($pid)*$q,0, ',', '.')."đ";
	$giacu = number_format(get_price_cu($pid)*$q,0, ',', '.')."đ";
	$tonggia = number_format(get_order_total()+$pr_trans,0, ',', '.')."đ";

	if(isset($_SESSION['coupon']['total']))
	{
		$tonggia_coupon = number_format(get_total_price_coupon(get_order_total()+$pr_trans),0, ',', '.')."đ";
		$_SESSION['coupon']['total']=get_total_price_coupon(get_order_total()+$pr_trans);
	}
	else
	{
		$tonggia_coupon=0;
	}

	$data = array('giaban' => $giaban,'giacu' => $giacu, 'tonggia' => $tonggia, 'tonggia_coupon' => $tonggia_coupon);
	echo json_encode($data);
?>