<?php

	session_start();

	@define ( '_template' , './templates/');

	@define ( '_source' , './sources/');

	@define ( '_lib' , '../libraries/');



	if(!isset($_SESSION['lang'])){

		$_SESSION['lang']='';

	}

	$lang='';

	require_once _source."lang$lang.php";



	include_once _lib."config.php";
	include_once _lib."checkSSL.php";

	include_once _lib."constant.php";

	include_once _lib."functions.php";

	include_once _lib."functions_giohang.php";

	include_once _lib."library.php";

	include_once _lib."pclzip.php";

	include_once _lib."class.database.php";	

	include_once _lib."admin_functions.php";

	include_once "simple_html_dom.php";

	$d = new database($config['database']);

 

	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	$login_name = 'NINACO';

	

	if($_REQUEST['author']){

		header('Content-Type: text/html; charset=utf-8');

		echo '<pre>';

		print_r($config['author']);

		echo '</pre>';

		die();

	}





	if(isset($_SESSION[$login_name]) || $_SESSION[$login_name]==true){

		$id_user = (int)$_SESSION['login']['id'];

		$timenow = time();

		//Thoát tất cả khi đổi user, mật khẩu hoặc quá thời gian 1 tiếng không hoạt động

		$sql="select username,password,lastlogin,user_token from #_user WHERE id ='$id_user'";

		$d->query($sql);

		$row = $d->fetch_array();		

		$cookiehash = md5(sha1($row['password'].$row['username']));

		if( $_SESSION['login_session']!=$cookiehash || ($timenow - $row['lastlogin'])>3600 ) {

			session_destroy();	

			redirect("index.php?com=user&act=login");

		}

		if($_SESSION['login_token']!==$row['user_token']) $notice_admin = '<strong>'._conguoi.'</strong>';

		else $notice_admin ='';

		$token = md5(time());

		$_SESSION['login_token'] = $token;

		//Cập nhật lại thời gian hoạt động và token		

		$d->reset();

		$sql = "update #_user set lastlogin = '$timenow',user_token = '$token' where id='$id_user'";

		$d->query($sql);



	}



	$archive = new PclZip($file);



	

	

	switch($com){

		case 'laytin':

			$source = "laytin";

			break;

		case 'bando':

			$source = "bando";

			break;	

		####Phân quyền

		case 'tags':

			$source = "tags";

			break;

		case 'httt':

			$source = "httt";

			break;

		case 'giasearch':

			$source = "giasearch";

			break;

			

		case 'phanquyen':

			$source = "phanquyen";

			break;

		case 'group':

			$source = "group";

			break;

		####Thường có

		case 'pupop':

			$source = "pupop";

			break;

		

		case 'baihat':

			$source = "baihat";

			break;

			

		case 'background':

			$source = "background";

			break;

			

		case 'vnexpress':

			$source = "vnexpress";

			break;

				

		####Đơn hàng	

		case 'order':

			$source = "donhang";

			break;

		case 'anhnen':

			$source = "anhnen";

			break;

		case 'place':

			$source = "place";

			break;	

		case 'chitietdonhang':

			$source = "chitietdonhang";

			break;

			

		case 'hinhthucgiaohang':

			$source = "hinhthucgiaohang";

			break;

			

		case 'hinhthucgiaohang':

			$source = "hinhthucgiaohang";

			break;

			

		case 'import':

			$source = "import";

			break;

			

		case 'export':

			$source = "export";

			break;

			

		case 'thanhpho':

			$source = "thanhpho";

			break;

		####Đơn hàng	

			

		case 'letruot':

			$source = "letruot";

			break;

			

		case 'slider':

			$source = "slider";

			break;

			

		case 'newsletter':

			$source = "newsletter";

			break;

			

		case 'contact':

			$source = "contact";

			break;

			

		case 'lkweb':

			$source = "lkweb";

			break;

			

		case 'video':

			$source = "video";

			break;

			

		case 'photo':

			$source = "photo";

			break;

			

		case 'about':

			$source = "about";

			break;

			

		case 'duan':

			$source = "duan";

			break;

			

		case 'congtrinh':

			$source = "congtrinh";

			break;

			

		case 'gioithieu':

			$source = "gioithieu";

			break;

			

		case 'khuyenmai':

			$source = "khuyenmai";

			break;

			

		case 'dichvu':

			$source = "dichvu";

			break;

			

		case 'news':

			$source = "news";

			break;

			

		case 'tuyendung':

			$source = "tuyendung";

			break;

			

		case 'product':

			$source = "product";

			break;

			

		case 'yahoo':

			$source = "yahoo";

			break;

			

		####Luôn tồn tại

		case 'uploadfile':

			$source = "uploadfile";

			break;

			

		case 'multi':

			$source = "multi";

			break;

			

		case 'multi_upload':

			$source = "multi_upload";

			break;

			

		case 'creatsitemap':

			$source = "creatsitemap";

			break;

			

		case 'banner':

			$source = "banner";

			break;

		case 'baiviet':

			$source = "baiviet";

			break;	

		case 'hinhanh':

			$source = "hinhanh";

			break;

			

		case 'company':

			$source = "company";

			break;

			

		case 'footer':

			$source = "footer";

			break;

		case 'com':

			$source = "com";

			break;	

		case 'lienhe':

			$source = "lienhe";

			break;

			

		case 'user':

			$source = "user";

			break;

			

		case 'meta':

			$source = "meta";

			break;

		

		case 'ngonngu':

			if(isset($_GET['lang']))

			{

				switch($_GET['lang'])

					{

						case '':

							$_SESSION['lang'] = '';

							break;

						case 'en':

							$_SESSION['lang'] = 'en';

							break;

						case 'cn':

							$_SESSION['lang'] = 'cn';

							break;

						default: 

							$_SESSION['lang'] = '';

							break;

					}

			}

			else{

				$_SESSION['lang'] = '';

			}

		redirect($_SERVER['HTTP_REFERER']);

		break;	



		####Giá trị mạc định	

		default: 

			$source = "";

			$template = "index";

			break;

	}

	

	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){

		redirect("index.php?com=user&act=login");

	}

	if(phanquyen($_SESSION['login']['com'],$_SESSION['login']['nhom'],$_GET['com'],$_GET['act'],$_GET['type'])){

		transfer(_bankhong,'index.php');

	}

	if($source!="") include _source.$source.".php";

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"

"http://www.w3.org/TR/html4/DTD/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php if($Protocol=='https://'){?>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php }?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php if($mb_rp==1 || $mb==1){ ?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php } else { ?>

<meta name="viewport" content="width=1349">

<style type="text/css">body{min-width: 1349px;}</style>

<?php } ?>

<title>Administrator</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/external.js"></script>

<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>

<script src="ckeditor/ckeditor.js"></script>







<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />

<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />



<!-- MultiUpload -->

<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>

<script src="js/jquery.minicolors.js"></script>

<link rel="stylesheet" href="css/jquery.minicolors.css">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">



<!--Chọn mã màu-->

<script type="text/javascript" src="media/scripts/jquery.ps-color-picker.min.js"></script>  

<script type="text/javascript">      

  $(document).ready(function(){

	 $(".cp3").CanvasColorPicker();

		$(".sub li").each(function(){

			if($(this).hasClass("<?=$_REQUEST["com"].'_'.$_REQUEST["act"]?>")){

				$(this).addClass("this");

			}

		})

		$.fn.exists = function(){return this.length>0;}

		$(".categories_li").each(function(){

			if($(this).find("ul").find("li").exists()==false){

				$(this).hide();

			}

		})

		

  });

</script>

<!--Chọn mã màu-->

<script>var base_url = 'http://<?=$config_url?>';  </script>



<!-- select -->

<link href="js/select-box-searching-jquery/select2.css" rel="stylesheet"/>

<script src="js/select-box-searching-jquery/select2.js"></script>

<script>

	$(document).ready(function() {

		$(".select_danhmuc").select2();   

	});

</script>



<link rel="stylesheet" href="css/chosen/chosen.css">

<script src="css/chosen/chosen.jquery.min.js" type="text/javascript"></script>

    

<script type="text/javascript">

	$(document).ready(function() {

		$(".chosen-select").chosen();

	});

</script>

<!-- end select -->



</head>

<?php if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)){?> 

<body class="body_1">

<?php if($mb_rp==0){ ?> 

<style type="text/css">

	body{min-width: 1349px;}

</style>

<?php } ?>

<span class="vui"></span>

<script type="text/javascript">

function stt(x)

{

	var a=$(x).val();

	

	$.ajax({

			type: "POST",

			url: "ajax/ajax_hienthi.php",

			data:{

				id: $(x).attr("data-val0"),

				bang: $(x).attr("data-val2"),

				type: $(x).attr("data-val3"),

				value:a

			}

		});

		$('.vui').show();

}

function stt1(x)

{

	var a=$(x).val();

	$.ajax({

			type: "POST",

			url: "ajax/ajax_hienthi1.php",

			data:{

				id: $(x).attr("data-val0"),

				bang: $(x).attr("data-val2"),

				type: $(x).attr("data-val3"),

				value:a

			}

		});

		$('.vui').show();

}

function countChar(el) {

    var o = $('#'+el);

    var v = o.val();

    var min = parseInt(o.data('min'));

    var max = parseInt(o.data('max'));

    var len = parseInt(v.length);

    if(len < min || len > max){

        $('#status_'+el).removeClass('text-success').addClass('text-danger').text('Không tốt');

    }else{

        $('#status_'+el).removeClass('text-danger').addClass('text-success').text('Khá tốt');

    }

    $('#count_'+el).text(len);

}

$(function(){

	$('.hien_menu').toggle(function(){

		$(this).parent().children('.menu_header').slideDown(300);

		

	},function(){

		$(this).parent().children('.menu_header').slideUp(300);

	});

	$('.menu_header').prev('.hien_menu').find('.numberTop').html($('.menu_header > li').length);	

	

	var num = $('#menu').children(this).length;

	for (var index=0; index<=num; index++)

	{

		var id = $('#menu').children().eq(index).attr('id');

		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);

		$('#'+id+' .sub li:last-child').addClass('last');

	}

	$('#menu .activemenu .sub').css('display', 'block');

	$('#menu .activemenu a').removeClass('inactive');

	

	$('.color').each( function() {

	$(this).minicolors({

		control: $(this).attr('data-control') || 'hue',

		defaultValue: $(this).attr('data-defaultValue') || '',

		format: $(this).attr('data-format') || 'hex',

		keywords: $(this).attr('data-keywords') || '',

		inline: $(this).attr('data-inline') === 'true',

		letterCase: $(this).attr('data-letterCase') || 'lowercase',

		opacity: $(this).attr('data-opacity'),

		position: $(this).attr('data-position') || 'bottom left',

		change: function(value, opacity) {

			if( !value ) return;

			if( opacity ) value += ', ' + opacity;

			if( typeof console === 'object' ) {

				console.log(value);

			}

		},

		theme: 'bootstrap'

	});

});



})

</script>

<script type="text/javascript">

	$(document).ready(function(){

		$("a.btn_menu").click(function(){

			if ($("#leftSide").hasClass("leftSide_hien")) {

				$("#leftSide").removeClass("leftSide_hien");

				$("#leftSide").addClass("leftSide_an");

			}else if($("#leftSide").hasClass("leftSide_an")){

				$("#leftSide").removeClass("leftSide_an");

				$("#leftSide").addClass("leftSide_hien");

			}

			//boby

			if ($("body").hasClass("body_1")) {

				$("body").removeClass("body_1");

				$("body").addClass("bg_body");

			}else if($("body").hasClass("bg_body")){

				$("body").removeClass("bg_body");

				$("body").addClass("body_1");

			}

		});

	});

</script>

	<a class="btn_menu" href="javascript:void()">menu</a>

	<div id="leftSide" class="leftSide_hien"><?php include _template."menu_tpl.php";?></div>

    <!-- Right side -->

        <div id="rightSide">

        	<!-- Top fixed navigation -->

       		<div class="topNav"><?php include _template."header_tpl.php";?></div>

    		<div class="wrapper">

    			<?php if($notice_admin!='') echo '<div class="nNote nFailure"><p>'.$notice_admin.'</p></div>';?>

    			<?php include _template.$template."_tpl.php";?>	

    		</div>

        </div>

        <div class="clear"></div>

    </body>

<?php }else {?>

    <body class="nobg loginPage" style="overflow:hidden;">   

    <?php include _template.$template."_tpl.php";?>

    <!-- Footer line -->

    <div id="footer">

        <div class="wrapper">Powered by <a href="http://www.nina.vn" title="<?=_degisnby?>"><?=_degisnby?></a></div>

    </div>

    <?php /*?><canvas id="canvas"></canvas>

    <script type="text/javascript" src="js/phaohoa.js"></script><?php */?>

    </body>

<?php } ?>





<script type="text/javascript">

    $(document).ready(function(e) {

    	$('.themstt').blur(function() {

            var dem=$(this).val();

            $(this).attr('value', dem);

            stt(this);

        });

    	$('.themstt1').blur(function() {

            var dem=$(this).val();

            $(this).attr('value', dem);

            stt1(this);

        });

    });

</script>

<script type="text/javascript">

$(document).ready(function() {

	function to_slug(str){

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

	    return str;

	}

	$('.ck_editor').parent('.formRight').css({width:'100%','margin-top':'30px','float':'none'});

	$('.ck_editor').each(function(index, el) {

		var id=$(this).attr('id');

		CKEDITOR.replace( id, {

		height : 400,

		entities: false,

        basicEntities: false,

        entities_greek: false,

        entities_latin: false,

		skin:'office2013',

		filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

		filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

		filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

		filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

		filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

		filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

		allowedContent:

			'h1 h2 h3 p blockquote strong em;' +

			'a[!href];' +

			'img(left,right)[!src,alt,width,height];' +

			'table tr th td caption;' +

			'span{!font-family};' +

			'span{!color};' +

			'span(!marker);' +

			'del ins'

		});



	});

});

	

</script>

<script type="text/javascript">

	$(document).ready(function(e) {

		

        $("a.diamondToggle").click(function(){

			if($(this).attr("rel")==0){

				$.ajax({

					type: "POST",

					url: "ajax/ajax_hienthi.php",

					data:{

						id: $(this).attr("data-val0"),

						bang: $(this).attr("data-val2"),

						type: $(this).attr("data-val3"),

						value:1

					}

				});

				$(this).addClass("diamondToggleOff");

				$(this).attr("rel",1);

				

			}else{

				

				$.ajax({

					type: "POST",

					url: "ajax/ajax_hienthi.php",

					data:{

						id: $(this).attr("data-val0"),

						bang: $(this).attr("data-val2"),

						type: $(this).attr("data-val3"),

						value:0

						}

				});

				$(this).removeClass("diamondToggleOff");

						$(this).attr("rel",0);

			}



		});

    });

</script>



<script type="text/javascript">

	function formatMoney(n, c, d, t) {

	  var c = isNaN(c = Math.abs(c)) ? 2 : c,

	    d = d == undefined ? "." : d,

	    t = t == undefined ? "," : t,

	    s = n < 0 ? "-" : "",

	    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),

	    j = (j = i.length) > 3 ? j % 3 : 0;



	  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

	};

	function GetGiaCu() {

	    var price = $('#giacu').val().trim();

	    $('#giacu').val(price);

	    var text = formatMoney(price)+' VND';

	    $('#price_text').html(text);

		//$('#giaantext').val(text);

	}

	function GetGiaBan() {

	    var price = $('#giaban').val().trim();

	    $('#giaban').val(price);

	    var text = formatMoney(price)+' VND';

	    $('#price_text2').html(text);

		//$('#giaantext').val(text);

	}

</script>

<!-- <canvas id="constellationel"></canvas>

<script src="js/rockv.js"></script> -->



<!-- cong dung nhan shift chon duoc nhieu checkbox -->

<script>

	$(document).ready(function () {

		var $chkboxes = $('.checker');

		var lastChecked = null;

		$('.checker').click(function (e) {

			if (!$(this).find('span').hasClass('checked')) {

				lastChecked = this;

				return;

			}

			if (e.shiftKey) {

				var start = $chkboxes.index(this);

				var end = $chkboxes.index(lastChecked);

				console.log(start + ' = ' + end);

				var between = $chkboxes.slice(Math.min(start, end), Math.max(start, end) + 1);

				console.log(between);

				between.children('span').addClass('checked');

				between.children('span').find('input[name=chon]').prop('checked', true);

			}

			lastChecked = this;

		});

	});

</script>  

<!-- end -->

<script type="text/javascript">

	$(document).ready(function() {

		$('.ten').keyup(function(event) {

			var vl = $(this).val();

			var  ischeck = $('#checkurl').prop('checked');

			if(ischeck !=0 && ischeck!=''){

				$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdau').attr("value",data.das);

					}

				});

			}

		});

		$('.tenen').keyup(function(event) {

			var vl = $(this).val();

			var  ischeck = $('#checkurlen').prop('checked');

			if(ischeck !=0 && ischeck!=''){

				$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdauen').attr("value",data.das);

					}

				});

			}

		});

		$('.tenen').keyup(function(event) {

			var vl = $(this).val();

			var  ischeck = $('#checkurlcn').prop('checked');

			if(ischeck !=0 && ischeck!=''){

				$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdaucn').attr("value",data.das);

					}

				});

			}

		});

		$("#checkurl").click(function(){

			if($('#checkurl').prop('checked')){

				var vl = $(".ten").val();

			 	$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdau').attr("value",data.das);

					}

				});

			}

		});

		$("#checkurlen").click(function(){

			if($('#checkurlen').prop('checked')){

				var vl = $(".tenen").val();

			 	$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdauen').attr("value",data.das);

					}

				});

			}

		});

		$("#checkurlcn").click(function(){

			if($('#checkurlcn').prop('checked')){

				var vl = $(".tenen").val();

			 	$.ajax({

					url: 'ajax/changeLink.php',

					type: 'POST',

					dataType: "JSON",

					data: {vl: vl},

					success: function(data){

						$('#tenkhongdaucn').attr("value",data.das);

					}

				});

			}

		});

		$('.conso').priceFormat({

			limit: 13,

			prefix: '',

			centsLimit: 0

		});

		/*select danhmuc*/

		$(".select_dmbaiviet").change(function() {

			var child = $(this).data("child");

			var levell = $(this).data('level');

			var types = $(this).data('type');

			$.ajax({

				url: 'ajax/ajax_dmbaiviet.php',

				type: 'POST',

				data: {level: levell,

						id:$(this).val(),

						type: types},

				success:function(data){

					var op = "<option value='0'>Chọn Danh Mục</option>";



					if(levell=='0'){

						$("#id_list").html(op);

						$("#id_cat").html(op);

						$("#id_item").html(op);

					}else if(levell=='1'){

						$("#id_cat").html(op);

						$("#id_item").html(op);

					}else if(levell=='2'){

						$("#id_iem").html(op);

					}

					$("#"+child).html(data);

				}

			});

		});

		/*end select danhmuc*/

	});	

</script>

</html>

