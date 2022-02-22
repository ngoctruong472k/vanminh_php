<?php
	include ("ajax_config.php");
	$id = $_REQUEST['id'];
	$row_httt = Get_HinhThucThanhToan($id);
	echo $row_httt['noidung'];
?>