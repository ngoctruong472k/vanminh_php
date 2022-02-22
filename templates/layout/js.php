<script src="js/jquery.min.js"></script>

<script src="https://sp.zalo.me/plugins/sdk.js"></script>

<?php if($template!='index'){?>

<script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51d3c996345f1d03" async="async"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<?php }else{?>

<!-- addthis left -->

<?php /*?><script  src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-550a87e8683b580f"></script>

<div class="addthis_native_toolbox"></div>

<!-- addthis right -->

<script  src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f35a95097b30da"></script><?php */?>

<?php }//?>

<script src="js/toast/toastr.min.js"></script>

<div id="fb-root"></div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/<?php if($lang=='en')echo 'en_EN';else echo 'vi_VN' ?>/sdk.js#xfbml=1&version=v7.0<?php if($seo['api_facebook']!='') echo '&appId='.$seo['api_facebook']?>&autoLogAppEvents=1"></script>



<?php  if($template=='index' && count($slider)>0){?>

<script src="js/jssor.js"></script>

<script src="js/jssor.slider.js"></script>

<script src="js/js_jssor_slider_caption.js"></script>

<?php } ?> 



<script src="js/slick.min.js"></script>

<?php if(!isGoogleSpeed()){?>

	

	<?php if($template!='index'){ ?>

	

	<script src='js/jquery.cookie.js'></script>

	<script src='js/jquery.hoverIntent.minified.js'></script>

	<script src='js/jquery.dcjqaccordion.2.7.min.js'></script>

	<script>

		$(document).ready(function($){

			$('#accordion-1').dcAccordion({

				eventType: 'hover',//Sự kiện click hoặc hover

				autoClose: true,//Tự động đóng lại khi chuyển trang

				saveState: true,

				disableLink: false,

				speed:'slow',

				showCount: false,

				autoExpand: true,

				cookie	: 'dcjq-accordion-1',

				classExpand	 : 'dcjq-current-parent'

			});

		});

	</script>

 	<?php } ?>

	<script src="js/my_script.js"></script>

	<script src="js/jquery-migrate-1.2.1.min.js"></script>

	<script src="js/ImageScroller.js"></script>



	



	<script>

		$(document).ready(function(e) {

	        $('img').each(function(index, element) {

				if(!$(this).attr('alt') || $(this).attr('alt')=='')

				{

					$(this).attr('alt','<?=$seo['alt']?>');

				}

	        });

	    });

	</script>

	<script>

		 function doEnter(evt) {

			 var key;

			 if (evt.keyCode == 13 || evt.which == 13) {

				 onSearch(evt);

			 }

		 }



		 function onSearch(evt) {



			 var keyword = document.getElementById("keyword").value;

			 if (keyword == '') {

				 alert('<?=_chuanhaptukhoa?>');

			 } else {

				 location.href = "tim-kiem.html&keyword=" + keyword;

				 loadPage(document.location);

			 }

		 }

		function doEnter2(evt) {

			var key;

			if (evt.keyCode == 13 || evt.which == 13) {

				onSearch2(evt);

			}

		}



		function onSearch2(evt) {

			var keyword2 = document.getElementById("keyword2").value;

			if (keyword2 == '') {

				alert('<?=_chuanhaptukhoa?>');

			} else {

				location.href = "tim-kiem.html&keyword=" + keyword2;

				loadPage(document.location);

			}

		}

	</script>



	<script src="js/fancybox-3.0/jquery.fancybox.min.js?v=1494131338"></script>

	<script>

		$(document).ready(function(){

			$(".fancybox").fancybox();

			$(".clicktk").click(function() {

				$("#search").stop().slideToggle(500);

			});

			$("#menu ul li").hover(function () {

				$(this).find('>a').addClass('active2');

			}, function () {

				$(this).find('>a').removeClass('active2');

			});

			$(window).bind("scroll", function() {

				var cach_top = $(window).scrollTop();

				var heaigt_header = $('#header').height() + $('#menu').height();



				if(cach_top >= heaigt_header){

					if(!$('#menu').hasClass('fix_head fadeInDown animated')){

						$('#menu').addClass('fix_head fadeInDown animated');

					}

					$('#menu_mobi1').css('position', 'fixed');

				}else{

					$('#menu').removeClass('fix_head fadeInDown animated');

					$('#menu_mobi1').css('position', 'relative');

				}

			});

		});

	 </script>

	<?php if($mb==1 || $mb_rp==1) { ?>

	<script src="js/jquery.mmenu.min.all.js"></script>

	<script>

		$(function () {

			$('.hien_menu').click(function () {

				$('nav#menu_mobi').css({

					height: "auto"

				});

			});

			$('nav#menu_mobi').mmenu({

				extensions: ['effect-slide-menu', 'pageshadow'],

				searchfield: true,

				counters: true,

				navbar: {

					title: 'MENU'

				},

				navbars: [{

					position: 'top',

					content: ['searchfield']

				}, {

					position: 'top',

					content: ['prev', 'title', 'close']

				}, {

					position: 'bottom',

					content: ['<a>Online : <?php $count=count_online();echo $tong_xem=$count['dangxem'];?></a>', '<a>Total : <?php $count=count_online();echo $tong_xem=$count['daxem'];?></a>'

					]

				}]

			});

		});

	</script>

	<?php } ?>

	<?php if($template=='index' || $com=='lien-he' || $com=='thanh-toan'){?>

	<script src="https://www.google.com/recaptcha/api.js?render=<?=$site_key?>"></script>

	<script>

	    grecaptcha.ready(function () {

	        grecaptcha.execute('<?=$site_key?>', { action: 'contact' }).then(function (token) {

	            var recaptchaResponse = document.getElementById('recaptchaResponse');

	            if(recaptchaResponse){recaptchaResponse.value = token;}

	        });

	    });

	</script>

	<?php } ?>

	<?php if($com=='lien-he'){?>

	<script>

		$(document).ready(function(e) {

			function strtolower (str) {

			    return (str+'').toLowerCase();

			}

			$('.click_ajax').click(function(){

				if(isEmpty($('#ten_lienhe').val(), "<?=_nhaphoten?>"))

				{

					$('#ten_lienhe').focus();

					return false;

				}

				if(isEmpty($('#diachi_lienhe').val(), "<?=_nhapdiachi?>"))

				{

					$('#diachi_lienhe').focus();

					return false;

				}

				if(isEmpty($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))

				{

					$('#dienthoai_lienhe').focus();

					return false;

				}

				if(isPhone($('#dienthoai_lienhe').val(), "<?=_nhapsodienthoai?>"))

				{

					$('#dienthoai_lienhe').focus();

					return false;

				}

				if(isEmpty($('#email_lienhe').val(), "<?=_emailkhonghople?>"))

				{

					$('#email_lienhe').focus();

					return false;

				}

				var email_lienhe = strtolower($('#email_lienhe').val());

				if(isEmail(email_lienhe, "<?=_emailkhonghople?>"))

				{

					$('#email_lienhe').focus();

					return false;

				}

				if(isEmpty($('#tieude_lienhe').val(), "<?=_nhapchude?>"))

				{

					$('#tieude_lienhe').focus();

					return false;

				}

				if(isEmpty($('#noidung_lienhe').val(), "<?=_nhapnoidung?>"))

				{

					$('#noidung_lienhe').focus();

					return false;

				}

				document.frm.submit();

			});

	    });

	</script>

	<?php }?>



	<?php if($template=='product_detail'){?>

	<script>

		$(document).ready(function(){

			$('#content_tabs .tab').hide();

			$('#content_tabs .tab:first').show();

			$('#ultabs li:first').addClass('active');



			$('#ultabs li').click(function(){

				var vitri = $(this).index();

				$('#ultabs li').removeClass('active');

				$(this).addClass('active');



				$('#content_tabs .tab').hide();

				$('#content_tabs .tab:eq("'+vitri+'")').show();

				return false;

			});

		});

	</script>



	<script src="js/magiczoomplus/magiczoomplus.js"></script>

	<script>

	    $(document).ready(function(){

			$('.slick2').slick({

				  slidesToShow: 1,

				  slidesToScroll: 1,

				  arrows: false,

				  fade: false,

				  asNavFor: '.slick'

			});

			$('.slick').slick({

				  slidesToShow: 4,

				  slidesToScroll: 1,

				  asNavFor: '.slick2',

				  dots: false,

				  centerMode: false,

				  focusOnSelect: true

			});

			 return false;

	    });

	</script>

	<?php }?>



	<script>

		$(document).ready(function(e) {

			$(window).scroll(function(){

				if(!$('#video').hasClass('load_video')){

					$('#video').addClass('load_video');

					$('.load_video').load( "ajax/video1.php");

				}

				if(!$('#map_ft').hasClass('load_map')){

					$('#map_ft').addClass('load_map');

					$('.load_map').load( "ajax/map.php");

				}

			 });

		});

	</script>

	<!-- end js left-->



	<script src="js/wow.min.js"></script>

	<script>

	 	new WOW().init();

	</script>



	<script>

	  jQuery(document).ready(function($) {

	    $('.show_info').click(function(event) {

	    	if($(this).next('.box-dienthoai').hasClass('active')){

	    		$(this).next('.box-dienthoai').removeClass('active');

	    	} else {

	    		$(this).next('.box-dienthoai').addClass('active');

	    	}

	    });

	  });

	</script>

	

	<script>

	jQuery(document).ready(function () {

	    jQuery(".clickfb-box, .clickfb-top-header").on("click", function () {

	        jQuery(".clickfb-box, .clickfb-container").toggleClass("open"), jQuery(".clickfb-tooltip").length && jQuery(".clickfb-tooltip").toggle()

	    }), jQuery(".clickfb-box").hasClass("cfm") && setTimeout(function () {

	        jQuery(".clickfb-box").addClass("rubberBand animated")

	    }, 3500)

	});

	</script>

<?php } ?>

	<script src="js/lazyload.min.js"></script>

	<script>

		var myLazyLoad = new LazyLoad({

			elements_selector: ".lazy"

		});

	</script>

	<?php if($template!='index'){?>

	<script>

		$(document).ready(function() {

			$('#tinmoi').slick({

				infinite: true,

				arrows:false,

				accessibility: true,

				vertical: true, //Chay dọc

				//fade: true,//Hiệu ứng fade của slider

				slidesToShow: 4, //Số item hiển thị

				slidesToScroll: 1, //Số item cuộn khi chạy

				autoplay: true, //Tự động chạy

				autoplaySpeed: 3000, //Tốc độ chạy

				arrows: true, //Hiển thị mũi tên

				centerMode: false, //item nằm giữa

				dots: false, //Hiển thị dấu chấm

				draggable: true, //Kích hoạt tính năng kéo chuột

				mobileFirst: true

			});

		});

	</script>

	<script src="js/fotorama/fotorama.js"></script>

	<?php } else { ?>

	<script>

	$(document).ready(function(){

		$('.product_run').slick({

			dots: false,

			infinite: true,

			arrows:true,

			autoplaySpeed: 3000,

			slidesToShow: 7,

			slidesToScroll: 1,

			adaptiveHeight: true,

			vertical: false,

			autoplay: true,

			responsive: [{

				breakpoint: 966,

				settings: {

					slidesToShow: 5,

					slidesToScroll: 1,

					infinite: true

				}

			}, {

				breakpoint: 769,

				settings: {

					slidesToShow: 4,

					slidesToScroll: 1

				}

			}, {

				breakpoint: 568,

				settings: {

					slidesToShow: 3,

					slidesToScroll: 1

				}

			}, {

				breakpoint: 321,

				settings: {

					slidesToShow: 2,

					slidesToScroll: 1

				}

			}]

		});

		$('.chayth').slick({

			dots: false,

			infinite: true,

			arrows:false,

			autoplaySpeed: 3000,

			slidesToShow: 6,

			slidesToScroll: 1,

			adaptiveHeight: true,

			vertical: false,

			autoplay: true,

			pauseOnHover: true,

			responsive: [{

				breakpoint: 966,

				settings: {

					slidesToShow: 5,

					slidesToScroll: 1,

					infinite: true

				}

			}, {

				breakpoint: 768,

				settings: {

					slidesToShow: 4,

					slidesToScroll: 1

				}

			}, {

				breakpoint: 568,

				settings: {

					slidesToShow: 3,

					slidesToScroll: 1

				}

			}, {

				breakpoint: 481,

				settings: {

					slidesToShow: 2,

					slidesToScroll: 1

				}

			}]

		});

		$('.tintuc_run').slick({

			dots: false,

			infinite: true,

			arrows:false,

			autoplaySpeed: 3000,

			slidesToShow: 4,

			slidesToScroll: 1,

			adaptiveHeight: true,

			vertical: false,

			autoplay: true,

			responsive: [{

				breakpoint: 966,

				settings: {

					slidesToShow: 2,

					slidesToScroll: 1,

					infinite: true

				}

			}, {

				breakpoint: 481,

				settings: {

					slidesToShow: 2,

					slidesToScroll: 1

				}

			}]

		});

	});

	</script>

	<?php } ?>

	