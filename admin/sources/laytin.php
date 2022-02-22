<?php	if(!defined('_source')) die("Error");
switch($act){
	case "add":		
		$template = "laytin/item_add";
		break;
	case "save":
		save_man();
		break;
	default:
		$template = "index";
}

function save_man(){
	
	global $d;
	// print_r($_GET);
	if($_GET['listid']){
		
		$listid = explode(",",$_GET['listid']); 
		// echo 'Tổng='.count($listid);
		// echo $type = $_REQUEST['type'];
		// die();

		if($_GET['url_bds'] && $_GET['url_bds']!=''){
			$url_page = $_GET['url_bds'];
			$url_web = '//batdongsan.com.vn';
			//$arr = domXML($url_page);
			$arr = getContent($url_page);
			$html = str_get_html($arr);
			$tins = $html->find('div.tintuc-row1');
			
			for ($i=0 ; $i<count($listid) ; $i++){
							
				$ida = (int)$listid[$i];
				
				$tag_a = $tins[$ida]->find('.link_blue',0);//truy cao vao the a
				$a_href = $tag_a->href;//lay href cua tin
				$link = $a_href;
				
				$ten = $tag_a->innertext;//lay ten tin
				$title = $ten;
				$tenkhongdau = changeTitle($ten);
				$mota = $tins[$ida]->find('p',0)->innertext;//lay mo ta
				
				//noi dung 
			 	$result1 = getContent($link);
				$html1 = str_get_html($result1);
				
				$noidung = $html1->find('#divContents',0);

				$img = $tins[$ida]->find('.bor_img',0);
				$linkimg = $img->src;
				if($linkimg){
					$arr_etc = @end(explode('.', $linkimg));
					$etc = array_pop($arr_etc);
					save_image($url_web.$linkimg,_upload_tintuc.$tenkhongdau.'.'.$etc);
				}
				$photo = $tenkhongdau.'.'.$etc;
				$thumb = $tenkhongdau.'.'.$etc;

				$hienthi = 1;
				$type = $_REQUEST['type'];
				$sql = "INSERT INTO  table_news (noidung,ten,mota,hienthi,type,tenkhongdau,photo,thumb,title) VALUES ('$noidung','$ten','$mota','$hienthi','$type','$tenkhongdau','$photo','$thumb','$title')";
				mysql_query($sql);
			}
		}
		transfer('Lấy tin hoàn tất',"index.php?com=laytin&act=add");
	}
}
?>