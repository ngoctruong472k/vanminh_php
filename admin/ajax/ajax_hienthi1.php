<?php 
	include ("ajax_lib.php");

	if(isset($_POST["id"])){
		$type = htmlspecialchars($_POST["type"]);
		$bang = htmlspecialchars($_POST["bang"]);
		$value = htmlspecialchars($_POST["value"]);
		$d->reset();
		$data[$type]=$value;
		$d->setTable(str_replace('table_','',$bang));
		$d->setWhere('id', $_REQUEST['id']);
		if($d->update($data)){
			echo 'success!';
		}
	}
?>