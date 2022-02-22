<?php  if(!defined('_source')) die("Error");	

	$title_cat = "Thêm username";	
	$title = "Thêm username";	
	$_SESSION['id_lang'] = 0;
	if(!empty($_POST)){
		if(strtoupper($_POST['capcha']) != $_SESSION['key'])
		{
			transfer(_mabaovesai, "add-user.html");
		}
		else
		{
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$sql = "INSERT INTO  table_user (username,password,role) VALUES ('$username','$password',1)";	
			if(mysql_query($sql)==true)
			{
				transfer(_dangkythanhcong, "index.html");
			}
			else
			{
				transfer(_hethongloi, "add-user.html");
			}
		}
	}		
?>