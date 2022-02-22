<?php
	include ("ajax_lib.php");

	$table = $_POST['table'];
	$id = $_POST['id'];
	$value = $_POST['value'];

	$data['stt'] = $value;
	$d->setTable($table);
	$d->setWhere('id', $id);
	$d->update($data);


?>
	
	