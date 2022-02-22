<?php
	include ("ajax_config.php");
		
	@$pid = $_POST['pid'];
	@$thongtin = $_POST['thongtin'];
	if($_POST['soluong']>0){
		@$soluong = $_POST['soluong'];
	}else {
		@$soluong = 1;
	}
     
    
    $result_giohang = addtocart($pid,$soluong,$thongtin);

    $count = count($_SESSION['cart']);
	
	$result = array('result_giohang' => $result_giohang,'count' => $count);

	echo json_encode($result);
?>