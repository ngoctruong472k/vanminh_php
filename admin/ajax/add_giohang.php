<?php
	include ("ajax_lib.php");
	
	@$pid = $_POST['pid'];
	if($_POST['soluong']>0){
		@$soluong = $_POST['soluong'];
	}else {
		@$soluong = 1;
	}
    
    
    $result_giohang = addtocart($pid,$soluong);

    $count = count($_SESSION['cart']);
	
	$result = array('result_giohang' => $result_giohang,'count' => $count);

	echo json_encode($result);
?>