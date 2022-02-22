<?php if(!defined('_lib')) die("Error");

$salt = $config['salt'];
function genAMPVideo($id){
	return '<amp-youtube data-videoid="'.$id.'" layout="responsive" width="480" height="270"></amp-youtube>';
}

function LinkConvert($str) {
	$pattern = '|<a.+?href\="(.+?)".*?>(.+?)</a>|i';
	return preg_replace_callback($pattern, function ($matches) {
        // Remove quotes
		$matches[2] = strip_tags($matches[0]);
		$link = $matches[1];
		$text = $matches[2];
		return "<a href='$link'>$text</a>";
	}, $str);
}
function VidConvert($iframeCode,$check=false) {
	$pattern = '/<iframe\s+.*?\s+src=(".*?").*?<\/iframe>/';
	if($check){
		return preg_match_all($pattern, $iframeCode, $matches);
	}
    // Extract video url from embed code
	return preg_replace_callback($pattern, function ($matches) {
        // Remove quotes
		$youtubeUrl = $matches[1];
		$youtubeUrl = trim($youtubeUrl, '"');
		$youtubeUrl = trim($youtubeUrl, "'");
		
        // Extract id
		preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $videoId);
		return $youtubeVideoId = isset($videoId[1]) ? genAMPVideo($videoId[1]) : "";
	}, $iframeCode);

}
// function seo_entities($str) {
// $res_2 = htmlentities($str, ENT_QUOTES, "UTF-8");
// $res_2 = str_replace("'","'",$str);
// $res_2 = str_replace('"','"',$str);
// return $res_2;
// }

function seo_entities($str) {
	$res_2 = htmlentities($str, ENT_QUOTES, "UTF-8");
	$res_2 = str_replace("'","&#039;",$str);
	$res_2 = str_replace('"','&quot;',$str);
	return $res_2;
}
function replace_img_src($img_tag) {
    $doc = new DOMDocument();
    $doc->loadHTML(mb_convert_encoding($img_tag, 'HTML-ENTITIES', 'UTF-8'));
    $tags = $doc->getElementsByTagName('img');

    foreach ($tags as $tag) {
        $old_src = $tag->getAttribute('src');
        $w_attr = $tag->getAttribute('width');
        $h_attr = $tag->getAttribute('height');
        if( $w_attr=='' && $h_attr==''){
       list($width, $height, $type, $attr) = getimagesize($old_src);
       $tag->setAttribute('height', $height);
       $tag->setAttribute('width', $width);
   }elseif($w_attr!='' && $h_attr==''){
    list($width, $height, $type, $attr) = getimagesize($old_src);
    $height=($w_attr*$height)/$width;
    $tag->setAttribute('height', $height);
    $tag->setAttribute('width', $$w_attr);
    $width=$w_attr;
   }elseif($w_attr=='' && $h_attr!=''){
    list($width, $height, $type, $attr) = getimagesize($old_src);
    $width=($h_attr*$width)/$height;
    $tag->setAttribute('height', $h_attr);
    $tag->setAttribute('width', $width);
   }else{
    $width=$w_attr;
    $height=$h_attr;
   }
        if($width>=250) $tag->setAttribute('layout', 'responsive');
    }
    return $doc->saveHTML();
}
function ampify($html='') {
    $html = LinkConvert($html);
    $html = VidConvert($html);
    # Replace img, audio, and video elements with amp custom elements
    # Replace img, audio, and video elements with amp custom elements
    $html = replace_img_src($html);
    $html = str_ireplace(array('<img','<video','/video>','<audio','/audio>','<iframe','/iframe>'),array('<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>','<amp-iframe','/amp-iframe>'),$html);
    # Add closing tags to amp-img custom element
   	$html = preg_replace('/<amp-img(.*?)\/?>/','<amp-img$1></amp-img>',$html);  
    $html = preg_replace('/<span(.*?)\/?>/','<span>',$html);
    $html = preg_replace('/<h3(.*?)\/?>/','<h3>',$html);
    $html = preg_replace('/<p(.*?)\/?>/','<p>',$html);
    $html = preg_replace('/<h2(.*?)\/?>/','<h2>',$html);
    $html = preg_replace('/<table(.*?)\/?>/','<table>',$html);
    $html = preg_replace('/<a style(.*?)\/?>/','</a>',$html);
    $html = preg_replace('/<div(.*?)\/?>/','<div>',$html);
    $html = preg_replace('/<strong(.*?)\/?>/','<strong>',$html);
    $html = preg_replace('/<em(.*?)\/?>/','<em>',$html);
    # Whitelist of HTML tags allowed by AMP
    $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
    # replace style to w,h
    $html = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $html);

    return $html;
}
function getCurrentPageURL_AMP() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    
        $pageURL .= $_SERVER["SERVER_NAME"]."/amp".$_SERVER["REQUEST_URI"];
    
	$pageURL = explode("&page=", $pageURL);
    return $pageURL[0];
}
function getCurrentPageURLCNC() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
   	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    
	$pageURL = explode("&page=", $pageURL);
	$pageURL = explode("?", $pageURL[0]);
	$pageURL = explode("#", $pageURL[0]);
    return $pageURL[0];

}

function get_http(){

	$pageURL = 'http';

	if ($_SERVER["HTTPS"] == "on") {

		$pageURL .= "s";

	}

	$pageURL .= "://";

	return $pageURL;

}

function madonhang($matv,$table){

	global $d;

	$sql = "select id from table_$table order by id desc limit 0,1";

	$d->query($sql);

	$result = $d->result_array();

	if(count($result)==0){

		$kq = $matv."_000001";

	} else {

		$id = $result[0]['id']+1;

		$leng = strlen($id);

		if($leng==1){

			$kq = $matv."_00000".$id;

		} else if($leng==2){

			$kq = $matv."_0000".$id;

		} else if($leng==3){

			$kq = $matv."_000".$id;

		} else if($leng==4){

			$kq = $matv."_00".$id;

		} else if($leng==5){

			$kq = $matv."_0".$id;

		} else{

			$kq = $matv."_".$id;

		}

	}

	return $kq;

}

function get_fetch_array($sql){

	global $d;

	$d->reset();

	$d->query($sql);

	$fetch = $d->fetch_array();

	return $fetch;

}



function Redirect_link_lang($id,$table){

	global $d,$row,$http,$config_url;

	$sql = "select tenkhongdau".$_SESSION['lang']." as tenkhongdau from table_".$table." where id=$id";

	$d->query($sql);

	$row = $d->fetch_array();

	if($table=='tags'){

		return $http.$config_url.'/tags/'.$row['tenkhongdau'].'-'.$id;

	} elseif($table=='tag'){

		return $http.$config_url.'/tag/'.$row['tenkhongdau'].'-'.$id;

	} else {

		return $http.$config_url.'/'.$row['tenkhongdau'];

	}

}

function encrypt_password($str){

	global $salt;

	return md5('$nina@'.$str.$salt);

}



function isGoogleSpeed(){

	if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false){

		return false;

	}

	return true;

}



function unzip_chuanhoa($s){

$s = str_replace('&#039;', "'", $s);

$s = str_replace('&quot;', '"', $s);

$s = str_replace('&lt;', '<', $s);

$s = str_replace('&gt;', '>', $s);

return $s;

}

function SoThuTu_ASC($table,$type){

	global $d;

	if($type!=''){

		$bien = " where type='".$type."'";

	}

	$d->reset();

	$sql = "select stt from #_".$table.' '.$bien." order by id desc";

	$d->query($sql);

	$row1 = $d->result_array();

	if(count($row1)>0){

		$stt1 = $row1[0]['stt']+1;

	}else{

		$stt1=1;

	}

	echo $stt1;

}



function phanquyen_menu($ten,$com,$act,$type){

	global $d;

	$l_com = $_SESSION['login']['com'];

	$nhom = $_SESSION['login']['nhom'];



	$d->reset();

	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0  limit 0,1";

	$d->query($sql);

	$com_manager = $d->result_array();

	

	if(!empty($com_manager) or $l_com=='admin'){		

		if($com==$_GET['com'] && $act==$_GET['act'] && $type==$_GET['type']){$add_class = 'class="this"';}		

		echo  "<li ".$add_class."><a href='index.php?com=".$com."&act=".$act."&type=".$type."'>".$ten."</a></li>";

	}

}



function phanquyen($l_com,$nhom,$com,$act,$type){

	//dump($nhom);

	global $d;

	

	if($com=='' or $act=='login' or $act=='logout' or $l_com=='admin'){return false;}



	$d->reset();

	$sql = "select id from #_com_quyen where id_quyen='".$nhom."' and com='".$com."' and type ='".$type."' and find_in_set('".$act."',act)>0 limit 0,1";

	$d->query($sql);

	$com_manager = $d->result_array();

	if(empty($com_manager)){

		return true;

	}else{

		return false;

	}	

}



function replace_phone ($tring){

	global $row;

   	$str=$tring;

   	$str=preg_replace('/[^0-9\ ]/','',$str);

   	$str = str_replace('.','', $str );

   	$row = str_replace(' ','', $str );

   	return $row;

}//replace_phone





function getRealIPAddress(){  

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){

        //check ip from share internet

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

        //to check ip is pass from proxy

        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }else{

        $ip = $_SERVER['REMOTE_ADDR'];

    }

    return $ip;

}

function kiemtraip($ip){

	global $d,$config;

	//Kiểm tra có IP bị khóa login hay không

	$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit WHERE login_ip =  '$ip'  ORDER BY id DESC LIMIT 1 ";

	$d->query($sql);

	if($d->num_rows() == 1){				

	  	$row = $d->result_array();			  

	  	$id_login = $row[0]['id'];			

	    $time_now = time();

	    //Kiểm tra thời gian bị khóa đăng nhập

	    if($row[0]['locked_time']>0){

		    $locked_time = $row[0]['locked_time'];		   

		    $delay_time = $config['login']['delay'];

		    $interval = $time_now  - $locked_time;

		    if($interval <= $delay_time*60){

		    	$time_remain = $delay_time*60 - $interval;

		        $msg = "Xin lỗi..!Vui lòng thử lại sau ". round($time_remain/60)." phút..!";

		        die('{"mess":"'.$msg.'"}');	           

	        }else{				        	       

	        	$sql="update #_user_limit set login_attempts = 0,attempt_time = '$time_now' ,locked_time = 0 where id = '$id_login'";

				$d->query($sql);			          

	        }	

        }		   

	}	

}



function resetip($ip){

	global $d,$config;

	//Login thành công thì reset số lần login sai và thời gian khóa

	$d->reset();

	$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";

	$d->query($sql);

	if($d->num_rows()==1){

		$row_limitlogin = $d->result_array();

        $id_login = $row_limitlogin[0]['id'];						

        $sql="update #_user_limit set login_attempts = 0,locked_time = 0 where id = '$id_login'";

		$d->query($sql);

   	}

}



function khoaip($ip){

	global $d,$config;

	$d->reset();

	$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";

	$d->query($sql);			

	if($d->num_rows()==1){//Trường hơp đã tồn tại trong database				

		$row = $d->result_array();				

		$id_login = $row[0]['id'];

		$attempt =$row[0]['login_attempts'];//Số lần thực hiện

 		$noofattmpt = $config['login']['attempt'];//Số lần giới hạn

 		 if($attempt<$noofattmpt){//Trường hợp còn trong giới hạn

			$attempt = $attempt +1;					

			$sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";

			$d->query($sql);					

			$no_ofattmpt =  $noofattmpt+1;

			$remain_attempt = $no_ofattmpt - $attempt;

			$msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';

 		 }else{//Trường hợp vượt quá giới hạn

 		 	if($row[0]['locked_time']==0){

                  $attempt = $attempt +1;

                  $timenow = time();

                  $sql="update #_user_limit set login_attempts = '$attempt' ,locked_time = '$timenow' where id = '$id_login'";

				  $d->query($sql);	                  

             }else{

                  $attempt = $attempt +1;	                  

                  $sql="update #_user_limit set login_attempts = '$attempt' where id = '$id_login'";

				  $d->query($sql);

             }



            $delay_time = $config['login']['delay'];

         	$msg = "Bạn đã hết lần thử. Vui lòng thử lại sau ".$delay_time." phút!";

 		 }

	}else{//Trường hợp IP lần đầu tiên đăng nhập sai

		$timenow = time();

		$d->reset();

		$sql="insert into #_user_limit (login_ip,login_attempts,attempt_time,locked_time) values('$ip',1,'$timenow',0)";

		$d->query($sql);

       	$remain_attempt = $config['login']['attempt'];

        $msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';		               

	}

		die('{"mess":"'.$msg.'"}');

}



function remove_dir($dir = null) {

  if (is_dir($dir)) {

    $objects = scandir($dir);



    foreach ($objects as $v) {

    	if ($v != "." && $v != ".." && $v!='.htaccess') {

	        if (filetype($dir."/".$v) == "dir") {

	        	remove_dir($dir."/".$v);

	        }else {

	        	unlink($dir."/".$v);

	        }

    	}

    }

    reset($objects);

    //rmdir($dir);

  }

}//remove_dir



/* Begin Kiểm Tra Pro Seen */

function product_seen_exists($id)

{

	if(!in_array($id, $_SESSION['pro_seen']))

		$_SESSION['pro_seen'][count($_SESSION['pro_seen'])]=$id;

}

/* End Kiểm Tra Pro Seen */

/*-- function simple_html_dom--*/

function domXML_1($url){

	$xml = simplexml_load_file($url);

	return $xml;

}

function domXML($url){

	$xml = simplexml_load_file($url);

	return $xml;

}

function save_image($inPath,$outPath)

{ //Download images from remote server

	$in=    fopen($inPath, "rb");

	$out=   fopen($outPath, "wb");

	while ($chunk = fread($in,8192))

	{

	    fwrite($out, $chunk, 8192);

	}

	fclose($in);

	fclose($out);

}

function getXML($url){

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_POSTFIELDS, "xmlRequest=" . $input_xml);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);

	$data = curl_exec($ch);

	curl_close($ch);

	$array_data = json_decode(json_encode(simplexml_load_string($data)), true);



	return $array_data;

}



function getContent($url)

{

	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,  $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7);

    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");

    curl_setopt($ch, CURLOPT_HEADER, 0);

    

    $result = curl_exec($ch);

    return $result;

}

/*-- end ----*/

function pagesListLimitadmin($url , $totalRows , $pageSize = 5, $offset = 5){

	if ($totalRows<=0) return "";

	$totalPages = ceil($totalRows/$pageSize);

	if ($totalPages<=1) return "";		

	if( isset($_GET["p"]) == true)  $currentPage = $_GET["p"];

	else $currentPage = 1;

	settype($currentPage,"int");	

	if ($currentPage <=0) $currentPage = 1;	

	$firstLink = "<li><a href=\"{$url}\" class=\"dau\"><i class='fa fa-angle-double-left' aria-hidden='true'></i></a><li>";

	$lastLink="<li><a href=\"{$url}&p={$totalPages}\" class=\"cuoi\"><i class='fa fa-angle-double-right' aria-hidden='true'></i></a></li>";

	$from = $currentPage - $offset;	

	$to = $currentPage + $offset;

	if ($from <=0) { $from = 1;   $to = $offset*2; }

if ($to > $totalPages) { $to = $totalPages; }

	for($j = $from; $j <= $to; $j++) {

	   if ($j == $currentPage) $links = $links . "<li><a href='#' class='active'>{$j}</a></li>";		

	   else{				

		$qt = $url. "&p={$j}";

		$links= $links . "<li><a href = '{$qt}'>{$j}</a></li>";

	   } 	   

	} //for

	return '<ul class="pages">'.$firstLink.$links.$lastLink.'</ul>';

}



function magic_quote($str, $id_connect=false)	

{	

	if (is_array($str))

	{

		foreach($str as $key => $val)

		{

			$str[$key] = escape_str($val);

		}		

		return $str;

	}

	if (is_numeric($str)) {

		return $str;

	}	

	if(get_magic_quotes_gpc()){

		$str = stripslashes($str);

	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))

	{

		return mysql_real_escape_string($str, $id_connect);

	}

	elseif (function_exists('mysql_escape_string'))

	{

		return mysql_escape_string($str);

	}

	else

	{

		return addslashes($str);

	}

}

//Get code youtube

function getYoutubeIdFromUrl($url) {

    $parts = parse_url($url);

    if(isset($parts['query'])){

        parse_str($parts['query'], $qs);

        if(isset($qs['v'])){

            return $qs['v'];

        }else if($qs['vi']){

            return $qs['vi'];

        }

    }

    if(isset($parts['path'])){

        $path = explode('/', trim($parts['path'], '/'));

        return $path[count($path)-1];

    }

    return false;

}

function images_name($tenhinh)

	{

		$rand=rand(10,9999);

		$ten_anh=explode(".",$tenhinh);

		$result = changeTitle($ten_anh[0])."-".$rand;

		return $result; 

	}

function escape_str($str, $id_connect=false)	

{	

	if (is_array($str))

	{

		foreach($str as $key => $val)

		{

			$str[$key] = escape_str($val);

		}

		

		return $str;

	}

	

	if (is_numeric($str)) {

		return $str;

	}

	

	if(get_magic_quotes_gpc()){

		$str = stripslashes($str);

	}



	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))

	{

		return "'".mysql_real_escape_string($str, $id_connect)."'";

	}

	elseif (function_exists('mysql_escape_string'))

	{

		return "'".mysql_escape_string($str)."'";

	}

	else

	{

		return "'".addslashes($str)."'";

	}

}





function phanquyen_tv($com,$quyen,$act,$type){

	global $d;

	$text_act = explode('_',$act);

	$text_act = $text_act[1];

	

	$d->reset();

	$sql = "select * from #_phanquyen where id='".$quyen."' ";

	$d->query($sql);

	$phanquyen = $d->fetch_array();



	$d->reset();

	$sql = "select * from #_com where ten_com='".$com."' and act ='".$text_act."' and type ='".$type."' ";

	$d->query($sql);

	$com_manager = $d->fetch_array();



	$xem_s = json_decode($phanquyen['xem']);

	$them_s = json_decode($phanquyen['them']);

	$xoa_s = json_decode($phanquyen['xoa']);

	$sua_s = json_decode($phanquyen['sua']);



	$xem_arr = explode('|',"capnhat|man|man_list|man_cat|man_item|man_danhmuc");

	$them_arr = explode('|',"add|add_cat|add_list|add_item|add_danhmuc|save|save_list|save_cat|save_item|save_danhmuc");

	$xoa_arr = explode('|',"delete|delete_list|delete_cat|delete_item,delete_danhmuc");

	$sua_arr = explode('|',"edit|edit_list|edit_cat|edit_item|edit_danhmuc|save|save_list|save_cat|save_item|save_danhmuc");



	if(in_array($act,$xem_arr)){

		if(in_array($com_manager['id'].'|1',$xem_s)){

			return 1;

		} else {

			return 0;

		}

	} elseif(in_array($act,$them_arr)) {

		//dump($com_manager['id'].'|1');

		if(in_array($com_manager['id'].'|1',$them_s)){

			return 1;

		} else {

			return 0;

		}

	} elseif(in_array($act,$xoa_arr)){

		if(in_array($com_manager['id'].'|1',$xoa_s)){

			return 1;

		} else {

			return 0;

		}

	} elseif(in_array($act,$sua_arr)){

		if(in_array($com_manager['id'].'|1',$sua_s)){

			return 1;

		} else {

			return 0;

		}

	} else {

		return 0;

	}



			

}

function phanquyen_edit($quyen,$role,$vitri){

	global $d,$kiemtra;

	

	$d->reset();

	$sql = "select * from #_phanquyen where id='".$quyen."' ";

	$d->query($sql);

	$phanquyen = $d->fetch_array();

	

	$com_s = json_decode($phanquyen['com']);

	$vitri_s = json_decode($phanquyen['table_vitri']);

	$sua_s = json_decode($phanquyen['sua']);

	

	if($role==3){

		$kiemtra = 1;	

	} else {

		for($i=0;$i<count($vitri_s);$i++){

			if($vitri_s[$i] == $vitri ){

				if(in_array($i.'|1',$sua_s)){

					$kiemtra = 1;

				}

			} 

		}

	}

	return $kiemtra;

			

}









// dem so nguoi online 

function count_online(){



	global $d;

	$time = 600; // 10 phut

	$ssid = session_id();



	// xoa het han

	$sql = "delete from #_online where time<".(time()-$time);

	$d->query($sql);

	//

	$sql = "select id,session_id from #_online order by id desc";

	$d->query($sql);

	$result['dangxem'] = $d->num_rows();

	$rows = $d->result_array();

	$i = 0;

	while(($rows[$i]['session_id'] != $ssid) && $i++<$result['dangxem']);

	

	if($i<$result['dangxem']){

		$sql = "update #_online set time='".time()."' where session_id='".$ssid."'";

		$d->query($sql);

		$result['daxem'] = $rows[0]['id'];

	}

	else{

		$sql = "insert into #_online (session_id, time) values ('".$ssid."', '".time()."')";

		$d->query($sql);

		$result['daxem'] = mysql_insert_id();

		$result['dangxem']++;

	}

	

	return $result; // array('dangxem'=>'', 'daxem'=>'')

}



//Lấy ngày

function make_date($time,$dot='.',$lang='vi',$f=false){

	

	$str = ($lang == 'vi') ? date("n{$dot}Y",$time) : date("n{$dot}Y",$time);

	if($f){

		$thu['vi'] = array('Chủ nhật','Thứ 2','Thứ 3','Thứ 4','Thứ 5','Thứ 6','Thứ 7');

		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

		$str = $thu[$lang][date('w',$time)].' / '.$str;

	}

	return $str;

}



//Alert

function alert($s){

	echo '<script language="javascript"> alert("'.$s.'") </script>';

}



function delete_file($file){

	return @unlink($file);

}



//Upload file

function upload_image($file, $extension, $folder, $newname=''){

	if(isset($_FILES[$file]) && !$_FILES[$file]['error']){

		

		$ext = end(explode('.',$_FILES[$file]['name']));

		$name = basename($_FILES[$file]['name'], '.'.$ext);

		

		if($name!='sitemap')

		{

			$name=changeTitleImage($name).'-'.fns_Rand_digit(0,9,4);

		}

		$newname = $name.'.'.$ext;



		if(strpos($extension, $ext)===false){

			alert('Chỉ hỗ trợ upload file dạng '.$extension);

			return false; // không hỗ trợ

		}

		

		

		if($newname=='' or file_exists($folder.$_FILES[$file]['name']))

			for($i=0; $i<100; $i++){

				if(!file_exists($folder.$name.$i.'.'.$ext)){

					$_FILES[$file]['name'] = $name.$i.'.'.$ext;

					break;

				}

			}

		else

		{

			$_FILES[$file]['name'] = $newname;

		}



		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{

			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))				        { 

				return false;

			}

		}

		return $_FILES[$file]['name'];

	}

	return false;

}

function upload_photos($file, $extension, $folder, $newname=''){

	if(isset($file) && !$file['error']){

		

		$ext = end(explode('.',$file['name']));

		$name = basename($file['name'], '.'.$ext);

		//alert('Chỉ hỗ trợ upload file dạng '.$ext);

		if(strpos($extension, $ext)===false){

			alert('Chỉ hỗ trợ upload file dạng '.$ext.'-////-'.$extension);

			return false; // không hỗ trợ

		}

		

		if($newname=='' && file_exists($folder.$file['name']))

			for($i=0; $i<100; $i++){

				if(!file_exists($folder.$name.$i.'.'.$ext)){

					$file['name'] = $name.$i.'.'.$ext;

					break;

				}

			}

		else{

			$file['name'] = $newname.'.'.$ext;

		}

		

		if (!copy($file["tmp_name"], $folder.$file['name']))	{

			if ( !move_uploaded_file($file["tmp_name"], $folder.$file['name']))	{

				return false;

			}

		}

		return $file['name'];

	}

	return false;

}

//Tạo hình khác

function thumb_image($file, $width, $height, $folder){	



	if(!file_exists($folder.$file))	return false; // không tìm thấy file

	

	if ($cursize = getimagesize ($folder.$file)) {					

		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);

		$info = pathinfo($file);

		

		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);

		

		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),

					'gif' => array('imagecreatefromgif', 'imagegif'),

					'png' => array('imagecreatefrompng', 'imagepng'));

		$func = $types[$info['extension']][0];

		$src = $func($folder.$file); 

		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);

		$func = $types[$info['extension']][1];

		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);

		

		return $func($dst, $folder.$new_file) ? $new_file : false;

	}

}





function setWidthHeight($width, $height, $maxWidth, $maxHeight){

	$ret = array($width, $height);

	$ratio = $width / $height;

	if ($width > $maxWidth || $height > $maxHeight) {

		$ret[0] = $maxWidth;

		$ret[1] = $ret[0] / $ratio;

		if ($ret[1] > $maxHeight) {

			$ret[1] = $maxHeight;

			$ret[0] = $ret[1] * $ratio;

		}

	}

	return $ret;

}



//Chuyển trang có thông báo

function transfer($msg,$page="index",$stt=true) {

	 $showtext = $msg;

	 $page_transfer = $page;

	 include("./templates/transfer_tpl.php");

	 exit();

}

//Chuyển trang không thông báo

function redirect($url=''){

	echo '<script language="javascript">window.location = "'.$url.'" </script>';

	exit();

}

//Quay lại trang trước

function back($n=1){

	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';

	exit();

}

//Thay thế ký tự đặc biệt

function chuanhoa($s){

	$s = str_replace("'", '&#039;', $s);

	$s = str_replace('"', '&quot;', $s);

	$s = str_replace('<', '&lt;', $s);

	$s = str_replace('>', '&gt;', $s);

	return $s;

}





function themdau($s){

	$s = addslashes($s);

	return $s;

}



function bodau($s){

	$s = stripslashes($s);

	return $s;

}

//Show mảng

function dump($arr, $exit=1){

	echo "<pre>";	

		var_dump($arr);

	echo "<pre>";	

	if($exit)	exit();

}

//Phân trang

	function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')

	{

		if($curPg<1) $curPg=1;

		if($mxR<1) $mxR=5;

		if($mxP<1) $mxP=5;

		$totalRows=count($r);

		if($totalRows==0)	

			return array('source'=>NULL, 'paging'=>NULL);

		$totalPages=ceil($totalRows/$mxR);

		if($curPg > $totalPages) $curPg=$totalPages;

		

		$_SESSION['maxRow']=$mxR;

		$_SESSION['curPage']=$curPg;



		$r2=array();

		$paging="";

		

		//-------------tao array------------------

		$start=($curPg-1)*$mxR;

		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;

		#echo $start;

		#echo $end;

		

		$j=0;

		for($i=$start;$i<$end;$i++)

			$r2[$j++]=$r[$i];

			

		//-------------tao chuoi------------------

		$curRow = ($curPg-1)*$mxR+1;	

		if($totalRows>$mxR)

		{

			$start=1;

			$end=1;

			$paging1 ="";				 	 

			for($i=1;$i<=$totalPages;$i++)

			{	

				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))

				{

					if($start==1) $start=$i;

					if($i==$curPg){

						$paging1.=" <span>".$i."</span> ";//dang xem

					} 		  	

					else    

					{

						$paging1 .= " <a href='".$url."&curPage=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	

					}

					$end=$i;	

				}

			}//tinh paging

			//$paging.= "Go to page :&nbsp;&nbsp;" ;

			#if($curPg>$mxP)

			#{

				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau

				

				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc

				$paging .=" <a href='".$url."&curPage=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc

			#}

			$paging.=$paging1; 

			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  

			#{

				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				$paging .=" <a href='".$url."&curPage=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				

				$paging .=" <a href='".$url."&curPage=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi

			#}

		}

		$r3['curPage']=$curPg;

		$r3['source']=$r2;

		$r3['paging']=$paging;

		#echo '<pre>';var_dump($r3);echo '</pre>';

		return $r3;

	}

function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')

	{

		if($curPg<1) $curPg=1;

		if($mxR<1) $mxR=5;

		if($mxP<1) $mxP=5;

		$totalRows=count($r);

		if($totalRows==0)	

			return array('source'=>NULL, 'paging'=>NULL);

		$totalPages=ceil($totalRows/$mxR);

		if($curPg > $totalPages) $curPg=$totalPages;

		

		$_SESSION['maxRow']=$mxR;

		$_SESSION['curPage']=$curPg;



		$r2=array();

		$paging="";

		

		//-------------tao array------------------

		$start=($curPg-1)*$mxR;

		$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;

		#echo $start;

		#echo $end;

		

		$j=0;

		for($i=$start;$i<$end;$i++)

			$r2[$j++]=$r[$i];

			

		//-------------tao chuoi------------------

		$curRow = ($curPg-1)*$mxR+1;	

		if($totalRows>$mxR)

		{

			$start=1;

			$end=1;

			$paging1 ="";				 	 

			for($i=1;$i<=$totalPages;$i++)

			{	

				if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))

				{

					if($start==1) $start=$i;

					if($i==$curPg){

						$paging1.=" <span>".$i."</span> ";//dang xem

					} 		  	

					else    

					{

						$paging1 .= " <a href='".$url."&p=".$i."'  class=\"{$class_paging}\">".$i."</a> ";	

					}

					$end=$i;	

				}

			}//tinh paging

			//$paging.= "Go to page :&nbsp;&nbsp;" ;

			#if($curPg>$mxP)

			#{

				$paging .=" <a href='".$url."' class=\"{$class_paging}\" >&laquo;</a> "; //ve dau

				

				#$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc

				$paging .=" <a href='".$url."&p=".($curPg-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc

			#}

			$paging.=$paging1; 

			#if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  

			#{

				#$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				$paging .=" <a href='".$url."&p=".($curPg+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

				

				$paging .=" <a href='".$url."&p=".($totalPages)."' class=\"{$class_paging}\" >&raquo;</a> "; //ve cuoi

			#}

		}

		$r3['curPage']=$curPg;

		$r3['source']=$r2;

		$r3['paging']=$paging;

		$r3['total']=$totalRows;

		#echo '<pre>';var_dump($r3);echo '</pre>';

		return $r3;

	}





//Phân trang nằm giữa

function paging_giua($r, $url='', $curPg=1, $mxR=5, $maxP=5, $class_paging='')

    {

        if($curPg<1) $curPg=1;

        if($mxR<1) $mxR=5;

        if($maxP<1) $maxP=5;

        $totalRows=count($r);

        if($totalRows==0)    

            return array('source'=>NULL, 'paging'=>NULL);

        $totalPages=ceil($totalRows/$mxR);

        

        if($curPg > $totalPages) $curPg=$totalPages;

        

        $_SESSION['maxRow']=$mxR;

        $_SESSION['curPage']=$curPg;



        $r2=array();

        $paging="";

        

        //-------------tao array------------------

        $start=($curPg-1)*$mxR;

        $end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;

        #echo $start;

        #echo $end;

        

        $j=0;

        for($i=$start;$i<$end;$i++)

            $r2[$j++]=$r[$i];

        

        if($totalRows>$mxR){     

        //-------------tao chuoi------------------

        $from = $curPg - 2;

        $to = $curPg + 2;

        if($curPg <= $totalPages && $curPg >= $totalPages-1){$from = $totalPages - 4;}

        if ($from <=0) { $from = 1;   $to = 5; }

        if ($to > $totalPages) { $to = $totalPages; } 

        for($j = $from; $j <= $to; $j++) {

           if ($j == $curPg){

               $paging1.=" <span>".$j."</span> ";

           } 

           else{                            

            $paging1 .= " <a class='paging transitionAll' href='".$url."&p=".$j."'>".$j."</a> ";    

           }       

        } //for

        $paging .=" <a href='".$url."' >&laquo;</a> "; //ve dau

                

                #$paging .=" <a href='".$url."&curPage=".($start-1)."' class=\"{$class_paging}\" >&#8249;</a> "; //ve truoc

                $paging .=" <a href='".$url."&p=".($curPg-1)."' >&#8249;</a> "; //ve truoc

            #}

            $paging.=$paging1; 

            #if(((int)(($curPg-1)/$mxP+1)*$mxP) < $totalPages)  

            #{

                #$paging .=" <a href='".$url."&curPage=".($end+1)."' class=\"{$class_paging}\" >&#8250;</a> "; //ke

                $paging .=" <a href='".$url."&p=".($curPg+1)."' >&#8250;</a> "; //ke

                

                $paging .=" <a href='".$url."&p=".($totalPages)."' >&raquo;</a> "; //ve cuoi        

        }

        $r3['curPage']=$curPg;

        $r3['source']=$r2;

        $r3['paging']=$paging;

        $r3['total']=$totalRows;

        #echo '<pre>';var_dump($r3);echo '</pre>';

        return $r3;

    }



	

//Cắt chuỗi

function catchuoi($chuoi,$gioihan){

// nếu độ dài chuỗi nhỏ hơn hay bằng vị trí cắt

// thì không thay đổi chuỗi ban đầu

if(strlen($chuoi)<=$gioihan)

{

return $chuoi;

}

else{

/*

so sánh vị trí cắt

với kí tự khoảng trắng đầu tiên trong chuỗi ban đầu tính từ vị trí cắt

nếu vị trí khoảng trắng lớn hơn

thì cắt chuỗi tại vị trí khoảng trắng đó

*/

if(strpos($chuoi," ",$gioihan) > $gioihan){

$new_gioihan=strpos($chuoi," ",$gioihan);

$new_chuoi = substr($chuoi,0,$new_gioihan)."...";

return $new_chuoi;

}

// trường hợp còn lại không ảnh hưởng tới kết quả

$new_chuoi = substr($chuoi,0,$gioihan)."...";

return $new_chuoi;

}

}

/*

str = str.toLowerCase();        

    str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');    

    str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');    

    str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');    

    str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');    

    str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');    

    str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');    

    str = str.replace(/đ/gi, 'd');

    str = str.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');    

    str = str.replace(/ /gi, "-");    

    str = str.replace(/\-\-\-\-\-/gi, '-');    

    str = str.replace(/\-\-\-\-/gi, '-');    

    str = str.replace(/\-\-\-/gi, '-');    

    str = str.replace(/\-\-/gi, '-');    

    str = '@' + str + '@';    

    str = str.replace(/\@\-|\-\@|\@/gi, '');    

    str = str.replace(/[^\w\-]+/g, '')

*/

function stripUnicode($str){

  if(!$str) return false;

   $unicode = array(

     'a'=>'à|á|ạ|ả|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',

     'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

     'd'=>'đ',

     'D'=>'Đ',

     'e'=>'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',

   	  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

   	  'i'=>'í|ì|ỉ|ĩ|ị',	  

   	  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

     'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

   	  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

     'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

   	  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

     'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

     ''=>'`|~|!|@|#|\|$|%|^|&|*|(|\|)|+|=|,|.|/|?|>|<|"|:|;|_|–|[|]|{|}'



   );

   foreach($unicode as $khongdau=>$codau) {

     	$arr=explode("|",$codau);

   	  $str = str_replace($arr,$khongdau,$str);

   }

return $str;

}// Doi tu co dau => khong dau

function changeTitle($str)

{

	$str = stripUnicode($str);

	$str = strtolower($str);

	$str = trim($str);

	$str = preg_replace('/([\s]+)/', '-', $str);

	$str = preg_replace("/[\/_|+ -]+/", '-', $str);

	$str = str_replace("'","",$str);

	$str = str_replace("  "," ",$str);

	$str = str_replace(" ","-",$str);

	return $str;

}

function changeTitleImage($str)

{

	$str = stripUnicode($str);

	$str = strtolower($str);

	$str = trim($str);

	$str = preg_replace('/([\s]+)/', '-', $str);

	$str = preg_replace("/[\/_|+ -]+/", '-', $str);

	$str = str_replace("'","",$str);

	$str = str_replace("  "," ",$str);

	$str = str_replace(" ","-",$str);

	return $str;

}



//Lấy dường dẫn hiện tại

function getCurrentPageURL() {

    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

    $pageURL .= "://";

     

        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

    

	$pageURL = explode("&p=", $pageURL);

    return $pageURL[0];

}

function getCurrentPageURL_CANO() {

    $pageURL = 'http';

    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

    $pageURL .= "://";

    

        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

     

    $pageURL = str_replace("amp/", "", $pageURL);

    $pageURL = explode("&=", $pageURL);

    $pageURL = explode("?", $pageURL[0]);

    $pageURL = explode("#", $pageURL[0]);

    $pageURL = explode("index", $pageURL[0]);

    return $pageURL[0];

}

//Tạo hình ảnh kahcs

function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1'){





		$ext = end(explode('.',$file_name));

		$name = basename($file_name, '.'.$ext);

		$name=changeTitleImage($name);

		$file_name = $name.'.'.$ext;



// ACQUIRE THE ARGUMENTS - MAY NEED SOME SANITY TESTS?



$new_width   = $width;

$new_height   = $height;



 if ($new_width && !$new_height) {

        $new_height = floor ($height * ($new_width / $width));

    } else if ($new_height && !$new_width) {

        $new_width = floor ($width * ($new_height / $height));

    }

	

$image_url = $folder.$file;

$origin_x = 0;

$origin_y = 0;

// GET ORIGINAL IMAGE DIMENSIONS

$array = getimagesize($image_url);

if ($array)

{

    list($image_w, $image_h) = $array;

}

else

{

     die("NO IMAGE $image_url");

}

$width=$image_w;

$height=$image_h;



// ACQUIRE THE ORIGINAL IMAGE

$image_ext = trim(strtolower(end(explode('.', $image_url))));

switch(strtoupper($image_ext))

{

     case 'JPG' :

     case 'JPEG' :

         $image = imagecreatefromjpeg($image_url);

		 $func='imagejpeg';

         break;

     case 'PNG' :

         $image = imagecreatefrompng($image_url);

		 $func='imagepng';

         break;

	 case 'GIF' :

	 	 $image = imagecreatefromgif($image_url);

		 $func='imagegif';

		 break;



     default : die("UNKNOWN IMAGE TYPE: $image_url");

}



// scale down and add borders

	if ($zoom_crop == 3) {



		$final_height = $height * ($new_width / $width);



		if ($final_height > $new_height) {

			$new_width = $width * ($new_height / $height);

		} else {

			$new_height = $final_height;

		}



	}



	// create a new true color image

	$canvas = imagecreatetruecolor ($new_width, $new_height);

	imagealphablending ($canvas, false);



	// Create a new transparent color for image

	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);



	// Completely fill the background of the new image with allocated color.

	imagefill ($canvas, 0, 0, $color);



	// scale down and add borders

	if ($zoom_crop == 2) {



		$final_height = $height * ($new_width / $width);

		

		if ($final_height > $new_height) {

			

			$origin_x = $new_width / 2;

			$new_width = $width * ($new_height / $height);

			$origin_x = round ($origin_x - ($new_width / 2));



		} else {



			$origin_y = $new_height / 2;

			$new_height = $final_height;

			$origin_y = round ($origin_y - ($new_height / 2));



		}



	}



	// Restore transparency blending

	imagesavealpha ($canvas, true);



	if ($zoom_crop > 0) {



		$src_x = $src_y = 0;

		$src_w = $width;

		$src_h = $height;



		$cmp_x = $width / $new_width;

		$cmp_y = $height / $new_height;



		// calculate x or y coordinate and width or height of source

		if ($cmp_x > $cmp_y) {



			$src_w = round ($width / $cmp_x * $cmp_y);

			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);



		} else if ($cmp_y > $cmp_x) {



			$src_h = round ($height / $cmp_y * $cmp_x);

			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);



		}



		// positional cropping!

		if ($align) {

			if (strpos ($align, 't') !== false) {

				$src_y = 0;

			}

			if (strpos ($align, 'b') !== false) {

				$src_y = $height - $src_h;

			}

			if (strpos ($align, 'l') !== false) {

				$src_x = 0;

			}

			if (strpos ($align, 'r') !== false) {

				$src_x = $width - $src_w;

			}

		}



		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);



    } else {



        // copy and resize part of an image with resampling

        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);



    }

	

$ext = end(explode('.',$file_name));

$file_name = basename($file_name, '.'.$ext);

$new_file=$file_name.fns_Rand_digit(0,9,4).'_'.round($new_width).'x'.round($new_height).'.'.$image_ext;

// SHOW THE NEW THUMB IMAGE

if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);

else $func($canvas, $folder.$new_file,floor ($quality * 0.09));



return $new_file;

}



//Lấy chuỗi ngẫu nhiên

function ChuoiNgauNhien($sokytu){

$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";

for ($i=0; $i < $sokytu; $i++){

	$vitri = mt_rand( 0 ,strlen($chuoi) );

	$giatri= $giatri . substr($chuoi,$vitri,1 );

}

return $giatri;

} 



function yahoo($nick_yahoo='nina',$icon='1'){

	

	$link = '<a href="ymsgr:sendIM?"'.$nick_yahoo.'"><img src="https://opi.yahoo.com/online?u="'.$nick_yahoo.'"&amp;m=g&amp;t="'.$icon.'""></a>';

	return $link;

}



function check_yahoo($nick_yahoo='nina'){

	$file = @fopen("https://opi.yahoo.com/online?u=".$nick_yahoo."&m=t&t=1","r");

	$read = @fread($file,200);

	

	if($read==false || strstr($read,"00"))

		$img = '<img src="../images/yahoo_offline.png" />';

	else

		$img = '<img src="../images/yahoo_online.png" />';

	return '<a href="ymsgr:sendIM?'.$nick_yahoo.'">'.$img.'</a>';

}



function skype($nick_skype='nina',$icon='1'){

	

	$link = '<a href="skype:"'.$nick_skype.'"?call><img src="https://mystatus.skype.com/bigclassic/"'.$nick_skype.'""></a>';

	return $link;

}



function check_skype($nick_skype='nina'){

	if(strlen(@file_get_contents("https://mystatus.skype.com/bigclassic/".$nick_skype))>2000)

	$img = '<img src="../images/skype_online.png" />';

	else

		$img = '<img src="../images/skype_offline.png" />';

	return '<a href="skype:'.$nick_skype.'?call">'.$img.'</a>';

}



function checkPermission(){

	global $d, $row;

	$sql = "select secretkey from #_user where id='".$_SESSION['login']['id']."'";

	$d->query($sql);

	$row = $d->fetch_array();

	if($_SESSION['login']['secretkey']){

		if(!empty($row) && $_SESSION['login']['secretkey']==$row['secretkey']){

			return true;

		}else{

			session_unset();

			$_SESSION['login'] = null;

			return false;

		}

	}else{

		session_unset();

		$_SESSION['login'] = null;

		return false;

	}

}

function doc3so($so)

{

    $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );

    $aso = array ( "0","1","2","3","4","5","6","7","8","9" );

    $kq = "";

    $tram = floor($so/100); // Hàng trăm

    $chuc = floor(($so/10)%10); // Hàng chục

    $donvi = floor(($so%10)); // Hàng đơn vị

    if($tram==0 && $chuc==0 && $donvi==0) $kq = "";

    if($tram!=0)

    {

        $kq .= $aso[$tram] . "";

        if ($chuc == 0){ 

        	$kq .= "0"; 

        	if ($donvi == 0){ $kq .= "0"; } else {

	        	$kq .= $aso[$donvi];

	        }

    	} else {

        	$kq .= $aso[$chuc]."";

        	if ($donvi == 0){ $kq .= "0"; } else {

	        	$kq .= $aso[$donvi];

	        }

        }



    } else {

		if($chuc != 0)

		{

		        $kq .= $aso[$chuc] . "";

		        if($donvi == 0){ $kq .= "0"; } else {$kq .= "";}

		}

	}

    if ($chuc == 1) $kq .= "";

    switch ($donvi)

    {

        case 1:

            if (($chuc != 0) && ($chuc != 1))

            {

                $kq .= "1";

            }

            else

            {

                $kq .= $aso[$donvi];

            }

            break;

        case 5:

            if ($chuc == 0)

            {

                $kq .= $aso[$donvi];

            }

            else

            {

                $kq .= " 5 ";

            }

            break;

        default:

            if ($donvi != 0)

            {

                   $kq .= $aso[$donvi];

            }

            break;

    }

    if($kq=="")

    $kq=0;   

    return $kq;

}

function doctien($number)

{

$donvi="";

$tiente=array("nganty" => " nghìn tỷ ","ty" => " tỷ ","trieu" => " triệu ","ngan" =>" nghìn ","tram" => " trăm ");

$num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');

$vitri=strpos($num_f,',');

$num_cut=substr($num_f,0,$vitri);

$mang=explode(" ",$num_cut);

$sophantu=count($mang);

switch($sophantu)

{

    case '5':

            $nganty=doc3so($mang[0]);

            $text=$nganty;

            $ty=doc3so($mang[1]);

            $trieu=doc3so($mang[2]);

            $ngan=doc3so($mang[3]);

            $tram=doc3so($mang[4]);

            if((int)$mang[1]!=0)

            {

                $text.=$tiente['ngan'];

                $text.=$ty.$tiente['ty'];

            }

            else

            {

                $text.=$tiente['nganty'];

            }

            if((int)$mang[2]!=0)

                $text.=$trieu.$tiente['trieu'];

            if((int)$mang[3]!=0)

                $text.=$ngan.$tiente['ngan'];

            if((int)$mang[4]!=0)

                $text.=$tram;

            $text.=$donvi;

            return  $text;

            

            

    break;

    case '4':

            $ty=doc3so($mang[0]);

            $text=$ty.$tiente['ty'];

            $trieu=doc3so($mang[1]);

            $ngan=doc3so($mang[2]);

            $tram=doc3so($mang[3]);

            if((int)$mang[1]!=0)

                $text.=$trieu.$tiente['trieu'];

            if((int)$mang[2]!=0)

                $text.=$ngan.$tiente['ngan'];

            if((int)$mang[3]!=0)

                $text.=$tram;

            $text.=$donvi;

            return $text;

            

            

    break;

    case '3':

            $trieu=doc3so($mang[0]);

            $text=$trieu.$tiente['trieu'];

            $ngan=doc3so($mang[1]);

            $tram=doc3so($mang[2]);

            if((int)$mang[1]!=0)

                $text.=$ngan.$tiente['ngan'];

            if((int)$mang[2]!=0)

                $text.=$tram;

            $text.=$donvi;

            return $text;

    break;

    case '2':

            $ngan=doc3so($mang[0]);

            $text=$ngan.$tiente['ngan'];

            $tram=doc3so($mang[1]);

            if((int)$mang[1]!=0)

                $text.=$tram;

            $text.=$donvi;

            return $text;

                

    break;

    case '1':

            $tram=doc3so($mang[0]);

            $text=$tram.$donvi;

            return $text;

            

    break;

    default:

        echo "Xin lỗi số quá lớn không thể đổi được";

    break;

}

}

/*







function doc_so($so)

{

    $so = preg_replace("([a-zA-Z{!@#$%^&*()_+<>?,.}]*)","",$so);

    if (strlen($so) <= 21)

    {

        $kq = "";

        $c = 0;

        $d = 0;

        $tien = array ( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ", " tỷ tỷ" );

        for ($i = 0; $i < strlen($so); $i++)

        {

            if ($so[$i] == "0")

                $d++;

            else break;

        }

        $so = substr($so,$d);

        for ($i = strlen($so); $i > 0; $i-=3)

        {

            $a[$c] = substr($so, $i, 3);

            $so = substr($so, 0, $i);

            $c++;

        }

        $a[$c] = $so;

        for ($i = count($a); $i > 0; $i--)

        {

            if (strlen(trim($a[$i])) != 0)

            {

                if (doc3so($a[$i]) != "")

                {

                    if (($tien[$i-1]==""))

                    {

                        if (count($a) > 2)

                            $kq .= " không trăm lẻ ".doc3so($a[$i]).$tien[$i-1];

                        else $kq .= doc3so($a[$i]).$tien[$i-1];

                    }

                    else if ((trim(doc3so($a[$i])) == "mười") && ($tien[$i-1]==""))

                    {

                        if (count($a) > 2)

                            $kq .= " không trăm ".doc3so($a[$i]).$tien[$i-1];

                        else $kq .= doc3so($a[$i]).$tien[$i-1];

                    }

                    else

                    {

                    $kq .= doc3so($a[$i]).$tien[$i-1];

                    }

                }

            }

        }

        return $kq;

    }

    else

    {

        return "Số quá lớn!";

    }

} 

*/ 

/*Phân trong có dấu ...*/

/*Code source 

$per_page = 9; // Set how many records do you want to display per page.

$startpoint = ($page * $per_page) - $per_page;

$limit = ' limit '.$startpoint.','.$per_page;



$url = getCurrentPageURL();

$paging = pagination($where,$per_page,$page,$url);

*/

/*code template <div class="paging"><?=$paging?></div> */

function pagination($query,$per_page=10,$page=1,$url='?'){   

    global $d; 



    $sql = "SELECT COUNT(*) as `num` FROM {$query}";

    $d->query($sql);

    $row = $d->fetch_array();

    $total = $row['num'];

    $adjacents = "2"; 

      

    $prevlabel = "&lsaquo; Prev";

    $nextlabel = "Next &rsaquo;";

    $lastlabel = "Last &rsaquo;&rsaquo;";

      

    $page = ($page == 0 ? 1 : $page);  

    $start = ($page - 1) * $per_page;                               

      

    $prev = $page - 1;                          

    $next = $page + 1;

      

    $lastpage = ceil($total/$per_page);

      

    $lpm1 = $lastpage - 1; // //last page minus 1

      

    $pagination = "";

    if($lastpage > 1){   

        $pagination .= "<ul class='pagination'>";

        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";

              

            if ($page > 1) $pagination.= "<li><a href='{$url}&page={$prev}'>{$prevlabel}</a></li>";

              

        if ($lastpage < 7 + ($adjacents * 2)){   

            for ($counter = 1; $counter <= $lastpage; $counter++){

                if ($counter == $page)

                    $pagination.= "<li><a class='current'>{$counter}</a></li>";

                else

                    $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    

            }

          

        } elseif($lastpage > 5 + ($adjacents * 2)){

              

            if($page < 1 + ($adjacents * 2)) {

                  

                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    

                }

                $pagination.= "<li class='dot'>...</li>";

                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";  

                      

            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                  

                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";

                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";

                $pagination.= "<li class='dot'>...</li>";

                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    

                }

                $pagination.= "<li class='dot'>..</li>";

                $pagination.= "<li><a href='{$url}&page={$lpm1}'>{$lpm1}</a></li>";

                $pagination.= "<li><a href='{$url}&page={$lastpage}'>{$lastpage}</a></li>";      

                  

            } else {

                  

                $pagination.= "<li><a href='{$url}&page=1'>1</a></li>";

                $pagination.= "<li><a href='{$url}&page=2'>2</a></li>";

                $pagination.= "<li class='dot'>..</li>";

                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";

                    else

                        $pagination.= "<li><a href='{$url}&page={$counter}'>{$counter}</a></li>";                    

                }

            }

        }

          

            if ($page < $counter - 1) {

                $pagination.= "<li><a href='{$url}&page={$next}'>{$nextlabel}</a></li>";

                $pagination.= "<li><a href='{$url}&page=$lastpage'>{$lastlabel}</a></li>";

            }

          

        $pagination.= "</ul>";        

    }

      

    return $pagination;

}



?>