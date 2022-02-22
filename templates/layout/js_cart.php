<a class="cart_fix" href="gio-hang"><span><?=count($_SESSION['cart'])?></span></a>
<script>
	$(document).ready(function() {
        $(".information-cart a").click(function(event) {
            $(".information-cart a").removeClass('active');
            $(this).addClass('active');
            var id = $(this).data('id');
            $("#idsize").val(id);
			
        });
		 $(".information-cart a.active").trigger("click");
		 
    });
	$(document).ready(function(){
		// Buy
		$('body').on('click','.buy',function(event) {
			var id = $(this).data('id');
	    	var soluong = $(".price input").val();
			var size = ($(".information-cart a.active").data('id')) ? $(".information-cart a.active").data('id') : 0;
			$.ajax({
				type:'post',
				url:'ajax/cart.php',
				dataType:'json',
				data:{id,soluong,size,act:"dathang"},
				success: function(msg){data = msg;}
			})
			.done(function() {
				toastr["success"]("Thêm sản phẩm thành công!");
				$(".cart_fix span").html(data['sl']);
			})
			.fail(function() {
				toastr["warning"]("Lỗi thao tác, vui lòng thử lại!");
			})
			.always(function() {
				console.log("complete");
			});
		});
		$('body').on('click','.buynow',function(event) {
			var id = $(this).data('id');
	    	var soluong = $(".price input").val();
			var size = ($(".information-cart a.active").data('id')) ? $(".information-cart a.active").data('id') : 0;
			$.ajax({
				type:'post',
				url:'ajax/cart.php',
				dataType:'json',
				data:{id,soluong,size,act:"dathang"},
				success: function(msg){data = msg;}
			})
			.done(function() {
				setTimeout(function(){   
					window.location.href = "thanh-toan";
				}, 500);
			})
			.fail(function() {
				toastr["warning"]("Lỗi thao tác, vui lòng thử lại!");
			})
			.always(function() {
				console.log("complete");
			});
		});
		// Update cart
		$(document).ready(function() {
		    $('.qty input').change(function(event) {
		      var soluong = $(this).val();
		      var product = $(this).data('id');
			  var size = $(this).data('size');
		      $.ajax({
		        type:'POST',
		        url:'ajax/capnhat_giohang.php',
		        data:{soluong,product,size},
		        success: function(result) {
		          var getData = $.parseJSON(result);
		          $('.price[data-id='+product+size+']').html(getData.price_item);
		          $('#total-carts strong').html(getData.full_item);
		          $('.total_item').html(getData.item_total);
				  $('.updatagia[data-id='+product+size+']').html(getData.price);
		        }
		      });
		    });
		});
		// Delete
		$(".click-delete").click(function(){
			var id = $(this).data('id');
			if(confirm('Bạn có chắc muốn xóa sản phẩm này ?')){
				window.location.href="gio-hang&pid="+id+"&command=delete";
			}
		});
		<?php if($com=="thanh-toan"){ ?>
		// Thanh Toan
		$('.shipping > label').click(function(){
			$(this).parents('.shipping').addClass('active').siblings().removeClass('active');
			var id = $(this).parents(".shipping").data('id');
			var ship = $("#dist").find(':selected').attr('data-ship')
			var total = $("#total").data('total');
			if(id==1){
				$("#total .phiship span").html("—");
				$("#total .total span").html(addCommas(parseInt(total))+" đ");
				$('.shipping select').prop('required',false);
				$("input[name=phiship]").val(0);

				var id = $(".shipping .noidung ul li.active").data('id');
				$("input[name=hethong]").val(id);
			}else{
				$("input[name=hethong]").val('');
				$('.shipping select').prop('required',true);
				if (typeof ship === "undefined") {
				}else{
					$("#total .phiship span").html(addCommas(ship)+" đ");
					$("#total .total span").html(addCommas(parseInt(total)+parseInt(ship))+" đ");
					$("input[name=phiship]").val(ship);
				}
			}
		});
		$(".shipping .noidung ul li").click(function(){
			$(this).addClass('active').siblings().removeClass('active');
			var id = $(this).data('id');
			$("input[name=hethong]").val(id);
		});
		$(".pttt ul li").click(function(){
			$(this).addClass('active').siblings().removeClass('active');
			var id = $(this).data('id');
			$("input[name=httt]").val(id);
		});
		$("#city").change(function(){
			var id = $(this).val();
			$.ajax({
		        type:'POST',
		        url:'ajax/place.php',
		        data:{id_city:id,act:'dist'},
		        success: function(result) {
		          $("#dist").html(result);
		        }
		    });
		});
		$("#dist").change(function(){
			var id = $(this).val();
			var ship = $(this).find(':selected').attr('data-ship')
			var total = $("#total").data('total');
			$("input[name=phiship]").val(ship);
			if(ship==0){
				$("#total .phiship span").html("—");
			}else{
				$("#total .phiship span").html(addCommas(ship)+" đ");
			}
			$("#total .total span").html(addCommas(parseInt(total)+parseInt(ship))+" đ");
			$.ajax({
		        type:'POST',
		        url:'ajax/place.php',
		        data:{id_dist:id,act:'ward'},
		        success: function(result) {
		          $("#ward").html(result);
		        }
		    });
		});
		$(".frm_thanhtoan").submit(function(){
			$('.loading').fadeIn();
			grecaptcha.ready(function() {
    			grecaptcha.execute('<?=$site_key?>', {action: 'thanhtoan'}).then(function(token) {
    				var ten = $('.frm_thanhtoan input[name=ten]').val();
					var email = $('.frm_thanhtoan input[name=email]').val();
					var dienthoai = $('.frm_thanhtoan input[name=dienthoai]').val();
					var diachi = $('.frm_thanhtoan input[name=diachi]').val();
					var noidung = $('.frm_thanhtoan textarea[name=noidung]').val();
					var city = $('.frm_thanhtoan #city').val();
					var dist = $('.frm_thanhtoan #dist').val();
					var ward = $('.frm_thanhtoan #ward').val();
					var hethong = $('.frm_thanhtoan input[name=hethong]').val();
					var httt = $('.frm_thanhtoan input[name=httt]').val();
					var phiship = $('.frm_thanhtoan input[name=phiship]').val();
					$.ajax({
						type:'POST',
						url:'ajax/thanhtoan.php',
						data:{ten,email,dienthoai,diachi,noidung,city,dist,ward,hethong,httt,phiship,recaptcha_response:token},
						success: function(result) {
							$('.loading').fadeOut();
							if(result!=0){
								window.location.href = "dathangthanhcong.php";
							} else{
								toastr["warning"]("Hệ thống quá tải vui lòng thực hiện lại sau vài giây .");
							} 
						}
					});
    			});
    		});
			return false;
		});
		function addCommas(nStr)
		{
		    nStr += '';
		    x = nStr.split('.');
		    x1 = x[0];
		    x2 = x.length > 1 ? '.' + x[1] : '';
		    var rgx = /(\d+)(\d{3})/;
		    while (rgx.test(x1)) {
		        x1 = x1.replace(rgx, '$1' + '.' + '$2');
		    }
		    return x1 + x2;
		}
		<?php } ?>
	});
</script>