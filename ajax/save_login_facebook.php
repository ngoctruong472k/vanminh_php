<?php 
	include ("ajax_config.php");

	$d->reset();
	$sql="select * from table_user where email='".$_POST["email"]."' and email<>'' "; 
	$d->query($sql);
	$member = $d->result_array();
	if(count($member)>0){
		$_SESSION[$login_name] = true;
		$_SESSION['login']['isLoggedIn']=true;
		$_SESSION['login']['id'] = $member[0]['id'];
		$_SESSION['login']['name'] =$member[0]["ten"];
		$_SESSION['login']['username'] = $member[0]["username"];
		$_SESSION['login']['pass'] = $member[0]['password'];
		$_SESSION['login']['diachi'] = $member[0]['diachi'];
		$_SESSION['login']['dienthoai'] = $member[0]['dienthoai']; 	
		$_SESSION['login']['hienthi'] = $member[0]['hienthi'];
		$_SESSION['login']['role'] = $member[0]['role'];
		$result = 1;
		$email=1;
	} else {
		$d->reset();
		$sql="select * from table_user where facebook_auth_id='".$_POST["id"]."' ";
		$d->query($sql);
		$member = $d->result_array();
		if(count($member)>0){
			$_SESSION[$login_name] = true;
			$_SESSION['login']['isLoggedIn']=true;
			$_SESSION['login']['id'] = $member[0]['id'];
			$_SESSION['login']['ten'] =$member[0]["ten"];
			$_SESSION['login']['pass'] = $member[0]['password'];
			$_SESSION['login']['diachi'] = $member[0]['diachi'];
			$_SESSION['login']['dienthoai'] = $member[0]['dienthoai']; 	
			$_SESSION['login']['hienthi'] = $member[0]['hienthi'];
			$_SESSION['login']['role'] = $member[0]['role'];
			$result = 1;
			$email=0;
		} else {
			$us_name= explode('@', $_POST["email"]);
			if($_POST['log']=='facebook'){
				$data['facebook_auth_id'] = $_POST['id'];
			}else{
				$data['facebook_auth_id'] = $_POST['id'];
			}
			$data['ten'] = magic_quote(trim(strip_tags($_POST['name'])));
			$data['username'] = $us_name[0];
			$data['email'] = magic_quote(trim(strip_tags($_POST['email'])));
			$data['hienthi'] = 1;
			$data['ngaytao'] = time();
			$data['role'] = 1;
			$data['active'] = 1;
			$data['hienthi'] = 1;
			$data['com'] = "user";
			$d->reset();
			$d->setTable('user');
			if($d->insert($data)){
				$id=mysql_insert_id();
				$_SESSION[$login_name] = true;
				$_SESSION['login']['isLoggedIn']=true;
				$_SESSION['login']['username'] = $us_name[0];
				$_SESSION['login']['name'] = $_POST["name"];
				$_SESSION['login']['id'] = $id;
				if($_POST['log']=='facebook'){
					$_SESSION['login']['facebook_auth_id'] = $_POST["id"];
				}else{
					$_SESSION['login']['google_auth_id'] = $_POST["id"];
				}
	    		$result = 1;
	    	} else {
	    		$result = 0;
	    	}
		    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		    	$email=1;
		    } else {
		    	$email=0;
		    }
    	}
	}
	$result_arr = array('result' =>$result ,'ten'=>$_POST['name'],'email'=>$_POST['email']);
	echo json_encode($result_arr);
?>