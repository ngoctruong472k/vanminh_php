<?php if(!defined('_lib')) die("Error");

	function info_user($id)
	{
		global $d;		
		$sql = "select * from #_user where id='".$id."'";
		$d->query($sql);
		$item = $d->fetch_array();
		return $item;
	}
	
	function logout(){	
		unset($_SESSION[$login_name]);
		unset($_SESSION['login']);
		transfer(_dangxuatthanhcong, 'index');
	}
	
	function logout1(){	
		unset($_SESSION[$login_name1]);
		unset($_SESSION['login1']);
		transfer(_dangxuatthanhcong, 'index');
	}
?>