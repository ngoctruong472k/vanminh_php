<?php
getMemberByEmail($_POST["email"],$_POST["name"]);
 function getMemberByEmail($email,$name){
		global $d;
		dump($_POST);
		$sarray = array();
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$sarray["msg"]="Email không đúng định dạng.";
			$sarray["stt"]=0;
		}else{
			$d->reset();
			$sql = "select * from #_member where email = '".$email."'";
			$d->query($sql);
			if($d->num_rows() == 0){
				$arr=explode("@",$email);
				$data["password"]= md5($arr[0]);
				$data["old_password"]=($arr[0]);
				$data["username"]=$arr[0];
				$data["ten_vi"]=$name;
				$data["hienthi"]=1;
				$data["trangthai"]=1;
				$data["email"]=$email;
				$data["com"]="user";
				$d->setTable("member");
				if($d->insert($data)){
					$iduser = mysql_insert_id();
					$_SESSION['login_web']['id'] = $iduser;
					$_SESSION['login_web']['username'] = $data["username"];
					$_SESSION['login_web']['ten'] = $name;
					$_SESSION['login_web']['com'] = "user";
					$sarray["msg"]="Đăng nhập thành công";
					$sarray["stt"]=1;
				}else{
					$sarray["msg"]="Đăng nhập thất bại";
					$sarray["stt"]=0;
				}
				
			}else{
				$rs = $d->fetch_array();
				$_SESSION['login_web']['id'] = $rs["id"];
				$_SESSION['login_web']['username'] = $rs["username"];
				$_SESSION['login_web']['ten'] = $rs["ten_vi"];
				$_SESSION['login_web']['com'] = $rs["com"];
				$sarray["msg"]="Đăng nhập thành công";
				$sarray["stt"]=1;
				
			
			}
		}
		echo json_encode($sarray);
	die;
	}