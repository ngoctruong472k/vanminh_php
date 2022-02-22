<?php
	include ("ajax_config.php");
	$d = new database($config['database']);

	$pid = $_POST['pid'];
	$mausac = $_POST['mausac'];
	$size = $_POST['size'];

	remove_product($pid,$size,$mausac);
	$max=count($_SESSION['cart']);
	$tonggia=number_format(get_order_total(),0, ',', '.')."đ";

	$data = array('tonggia' => $tonggia, 'max' => $max);
	echo json_encode($data);
?>