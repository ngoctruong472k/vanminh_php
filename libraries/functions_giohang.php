<?php if(!defined('_lib')) die("Error");
	function remove_pro_thanh($pid,$com){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
		redirect($com);
	}
	function get_price_cu($pid)
	{
		global $d, $row;
		$sql = "select giacu from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['giacu'];
	}
	function check_price($pid)
	{
		global $d, $row;
		$sql = "select giacu from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		if($row['giacu']>0) return true;
		else return false;
	}
	function get_product_info($pid)
	{
		global $d, $row;
		$sql = "select *,ten$lang as ten from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row;
	}
	function get_product_mau($mau)
	{
		if($mau!=0) {
			global $d, $row;
			$sql = "select *,ten$lang as ten from #_product_mau where id=$mau";
			$d->query($sql);
			$row = $d->fetch_array();
			return $row['ten'];
		}
	}
	function get_product_size($size)
	{
		if($size!=0) {
			global $d, $row;
			$sql = "select *,ten$lang as ten from #_product_size where id=$size";
			$d->query($sql);
			$row = $d->fetch_array();
			return $row['ten'];
		}
	}
	function Get_PhiShipTheoQuan($id){
		global $d,$row,$lang;
		$sql = "select phiship from #_place_dist where id='".$id."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['phiship'];
	}//function Get_PhiShipTheoQuan
	function get_tinh($pid){
		global $d, $row, $lang;
		$sql = "select ten from table_place_city where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten'];
	}
	function get_quan($pid){
		global $d, $row, $lang;
		$sql = "select ten from table_place_dist where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten'];
	}
	function get_huyen($pid){
		global $d, $row, $lang;
		$sql = "select ten from table_place_ward where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten'];
	}

	function get_code($pid){
		global $d, $row;
		$sql = "select masp from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['masp'];
	}
		
	function get_product_name($pid){
		global $d, $row, $lang;
		$sql = "select ten$lang as ten from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['ten'];
	}
	function get_product_url($pid){
		global $d, $row,$lang;
		$sql = "select tenkhongdau from #_product where id='".$pid."'";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['tenkhongdau'];
	}
	function get_tong_tien($id=0){
		global $d;
		if($id>0){
			$d->reset();
			$sql="select gia,soluong from #_chitietdonhang where id_donhang='".$id."'";
			$d->query($sql);
			$result=$d->result_array();
			$tongtien=0;
			for($i=0,$count=count($result);$i<$count;$i++) { 
				$tongtien+=	$result[$i]['gia']*$result[$i]['soluong'];	
			}
			return $tongtien;
		}else return 0;
	}
	function get_product_photo($pid){
		global $d, $row;
		settype($id, int);
		$sql = "select thumb from #_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		return $row['thumb'];
	}
	
	function get_price($pid,$q){
		global $d, $row;
		settype($id, int);
		$sql = "select gia,giasi,soluongsi from table_product where id=$pid";
		$d->query($sql);
		$row = $d->fetch_array();
		
		if($q>=$row['soluongsi'])
		{	
				$row['gia']=$row['giasi'];
		}	
		
		return $row['gia'];
	}
	
	
	function remove_product($pid,$size,$mausac){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid'] and $size==$_SESSION['cart'][$i]['size'] and $mausac==$_SESSION['cart'][$i]['mausac']){
				unset($_SESSION['cart'][$i]);
				break;
			}//
		}//
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}//
	
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid,$q);
			$sum+=$price*$q;
		}
		return $sum;
	}
	
	function get_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$sum+=$q;
		}
		return $sum;
	}
		
	function addtocart($pid,$q,$size){
		
		/*if($pid<1 or $q<1) return;
		$code = md5($pid.$mausac.$size);
		if(is_array(@$_SESSION['cart'])){
			if(isset($_SESSION['cart'][$code])){
				$_SESSION['cart'][$code]['qty'] = $_SESSION['cart'][$code]['qty']+$q;
			}else{
				$_SESSION['cart'][$code]['productid']=$pid;
				$_SESSION['cart'][$code]['qty']=$q;
				$_SESSION['cart'][$code]['mausac']=$mausac;
				$_SESSION['cart'][$code]['size']=$size;
			}
		}
		else{
			
			$_SESSION['cart'] = array();
			$_SESSION['cart'][$code]['productid']=$pid;
			$_SESSION['cart'][$code]['qty']=$q;
			$_SESSION['cart'][$code]['mausac']=$mausac;
			$_SESSION['cart'][$code]['size']=$size;
		}*/
		if($pid<1 or $q<1) return;
		if(is_array($_SESSION['cart'])){
			if(product_exists($pid,$q,$size)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
			$_SESSION['cart'][$max]['size']=$size;
			// $_SESSION['cart'][$max]['mausac']=$mausac;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
			$_SESSION['cart'][0]['size']=$size;
			// $_SESSION['cart'][0]['mausac']=$mausac;
		}
	}
	
	function product_exists($pid,$q,$size){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid'] && $size ==$_SESSION['cart'][$i]['size']){
				$_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty']+$q;
				$flag=1;
				break;
			}
		}
		return $flag;
	}
?>