<?php 

	include ("ajax_config.php");
	
	$id = $_REQUEST['id'];
	$d->reset();
	$sql = "select phiship from #_place_dist where id=".$id." ";
	$d->query($sql);
	$phi_quan = $d->fetch_array();
	$phiship=$phi_quan['phiship'];
	$tonggia = get_order_total();
	$tongtien_phi = get_order_total() +$phiship;
	
?>
<p class="phiship"><?=_phiship?>: <?=number_format($phiship,0,'.','.').' VNĐ'?></p>
<p class="phiship"><?=_tonggia?>: <?=number_format($tonggia,0,'.','.').' VNĐ'?></p>
<p class="tongtien_phi"><?=_tongthanhtoan?>:<span><?=number_format($tongtien_phi,0,'.','.').' VNĐ'?></span></p>