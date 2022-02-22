<script src="/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<!--CUSTOM SCRIPT-->
<script type="text/javascript">
$(function(){
    $('#btnSearch').click(function(evt){
        onSearch(evt);
    });
});
function onSearch(evt){
    var keyword = document.frm_search.keyword;
    if( keyword.value == '' || keyword.value =='<?=_timkiem?>...'){alert('Please enter a keyword !'); keyword.focus(); return false;}
    location.href='http://<?=$config_url?>/tim-kiem/keyword='+keyword.value;    
}
function doEnter(evt){
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
	    onSearch(evt);
	}else{
	    return false;   
	}
}
function isEmail_t(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function onNewsletter(){
    var mail_nl=$("#cont_dkmail").val();
	if(isEmail_t(mail_nl)){
		alert(mail_nl);
		$.ajax({
            url:'ajax/add_newsletter.php',
            type: "POST",
            dataType: 'html',
            data: {mail_nl:mail_nl},
            success: function(res){
            	if(res==1){
            		alert("Email của bạn đã được ghi nhận");
					$("#cont_dkmail").val("");
            	}else if(res==-1){
            		alert("Có lỗi xảy ra. Vui lòng thử lại !");
					$("#cont_dkmail").focus();
            	}else{
            		alert("Email đã tồn tại trong hệ thống");
					$("#cont_dkmail").focus();
            	}
                
            }
        });
        return false;
	}else{
		alert("Email bạn nhập không đúng định dạng");
		$("#cont_dkmail").focus();
		return false;
	}
}
function doEnterNewsletter(evt){
	var key;
	if(evt.keyCode == 13 || evt.which == 13){
	    onNewsletter();
	}else{
	    return false;   
	}
}
</script>
<script>
$(document).ready(function() {
	$(".invi_loading").animate({"visibility": "visible", "opacity": 1}, 500).removeClass('invi_loading');
	//Newsletter
	$(".btn_dkmail").click(function(event) {
		onNewsletter();
	});
});
</script>
<!--Check script-->
<script language="javascript" src="/js/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.getElementById('ten'), "<?=_nhacnho_ten?>")){
		document.getElementById('ten').focus();
		return false;
	}
	if(isEmpty(document.getElementById('dienthoai'), "<?=_nhacnho_dienthoai?>")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	if(!isNumber(document.getElementById('dienthoai'), "<?=_error_dienthoai?>")){
		document.getElementById('dienthoai').focus();
		return false;
	}
	if(!check_email(document.frm.email.value)){
		alert("<?=_error_email?>");
		document.frm.email.focus();
		return false;
	}
	if(isEmpty(document.getElementById('chude'), "<?=_nhacnho_chude?>")){
		document.getElementById('chude').focus();
		return false;
	}
	if(isEmpty(document.getElementById('noidung'), "<?=_nhacnho_noidung?>")){
		document.getElementById('noidung').focus();
		return false;
	}
	document.frm.submit();
}
</script>

<!--Nav mobile-->
<script>
	$(document).ready(function() {
		$(".show_sub").click(function(event) {
			var curSub=$(this).attr('data-rel');
			if($(this).hasClass('active')){
				$(".subNav_"+curSub).stop().slideUp();
				$(this).removeClass('active');
				$(this).find('i').removeClass('fa-rotate-90');
			}else{
				$(".subNav_"+curSub).stop().slideDown();
				$(this).addClass('active');
				$(this).find('i').addClass('fa-rotate-90');
			}
		});
	});
</script>
<!--header mobile-->
<script src="/js/jquery.sticky-kit.js"></script>
<script>
	$(document).ready(function() {
		$("#header_fix").stick_in_parent({
	    	parent: "body"
	    });
	    $(".search_open").click(function(){
            if($(".search_box_hide").hasClass('opening')){
                $(".search_box_hide").removeClass('opening');
                $(".search_box_hide").stop().slideUp();
            }else{
                $(".search_box_hide").addClass('opening');
                $(".search_box_hide").stop().slideDown();
            }
        });
	});
</script>