<?php
	include ("ajax_lib.php");

	$vl = $_POST['vl'];
	$demso = mb_strlen($vl);
	if($demso <= 9 || $demso >= 71){
		$tinhtrang = _khongtot;
		$class = 'text-danger';
	}
	else {
		$tinhtrang = _khatot;
		$class = 'text-success';
	}
	$array_list = array(
		'so' => $demso,
		'tt' => $tinhtrang,
		'ss' => $class
	);
	echo json_encode($array_list);
?>