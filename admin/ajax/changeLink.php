<?php
	include ("ajax_lib.php");

	$vl = $_POST['vl'];
	$title = changeTitle($vl);
	$array_list = array(
		'das' => str_replace(" ","",$title)
	);
	echo json_encode($array_list);
?>