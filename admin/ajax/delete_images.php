<?php
		include ("ajax_lib.php");

	$d = new database($config['database']);
	
	$id=$_POST['id'];
	$table=$_POST['table'];
	$links=$_POST['links'];

	$d->reset();
	$sql = "select id,photo,thumb from #_$table where id='".$id."'";
	$d->query($sql);
	$row = $d->result_array();

	if(count($row)>0){
		for($i=0;$i<count($row);$i++){
			delete_file('../'.$links.$row[$i]['photo']);
			delete_file('../'.$links.$row[$i]['thumb']);
		}
		$sql = "delete from #_$table where id='".$id."'";
		$d->query($sql);
	}
	
?>
