<?php
    include ("ajax_config.php");

?>
<?php
if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
        remove_product($_REQUEST['pid'],$_REQUEST['size'],$_REQUEST['mausac']);
    }
    else if($_REQUEST['command']=='clear'){
        unset($_SESSION['cart']);
    }
    else if($_REQUEST['command']=='update'){
        $max=count($_SESSION['cart']);
        for($i=0;$i<$max;$i++){
            $pid=$_SESSION['cart'][$i]['productid'];
            $size=$_SESSION['cart'][$i]['size'];
            $mausac=$_SESSION['cart'][$i]['mausac'];
            $q=intval($_REQUEST['product'.$pid.$size.$mausac]);
            
            if($q>0 && $q<=99999){
                $_SESSION['cart'][$i]['qty']=$q;
            }
            else{
                $msg='Some proudcts not updated!, quantity must be a number between 1 and 99999';
            }
        }
    }
?>
<form name="form1" class="frm-cart frm-fancycart" method="post">

    <script src="js/handlecounter/js/handleCounter.js"></script>
    <script type="text/javascript">
        $(".del-procart").click(function(){
            if(confirm('Bạn muốn xóa sản phẩm này'))
            {
                var pid=$(this).data("pid");
                var mausac=$(this).data("mausac");
                var size=$(this).data("size");
                $.ajax({
                    type: "POST",
                    url:'ajax/delete_cart.php',
                    dataType: 'json',
                    data: {pid:pid,mausac:mausac,size:size},
                    success: function(kt){
                        if(kt.max>0)
                        {
                            $('.load-price-final').html(kt.tonggia);
                            $(".item-procart-"+pid+mausac+size).remove();
                        }
                        else
                        {
                            $(".tool-cart").remove();
                            $('.load-price-final').html(kt.tonggia);
                            $(".top-cart").html('<a class="empty-cart"><i class="fa fa-cart-arrow-down"></i><p>'+"<?=_khongcosanphamtronggiohang?>"+'</p></a>');
                        }
                    }
                });
            }
        });
        $(".closegh").click(function(){
            $('.mogh').css('right', '-402px');
        });
        $(".dall").click(function(){
            if(confirm('Bạn muốn xóa tất cả sản phẩm'))
            {   
                $.ajax({
                    type: "POST",
                    url:'ajax/delete_cart1.php',
                    dataType: 'json',
                    data: {},
                    success: function(kt){
                        if(kt.max>0)
                        {
                            $('.load-price-final').html(kt.tonggia);
                            $(".item-procart").remove();
                        }
                        else
                        {
                            $(".tool-cart").remove();
                            $('.load-price-final').html(kt.tonggia);
                            $(".top-cart").html('<a class="empty-cart"><i class="fa fa-cart-arrow-down"></i><p>'+"<?=_khongcosanphamtronggiohang?>"+'</p></a>');
                        }
                    }
                });
            }
        })
        function update_cart(pid,quantity,mausac,size)
        {
            var pr_trans=$(".price-transport").val();
            $.ajax({
            type: "POST",
            url: "ajax/update_cart.php",
            dataType: 'json',
            data: {pid:pid,q:quantity,mausac:mausac,size:size,pr_trans:pr_trans},
            success: function(result){
                if(result){
                    $('.load-price'+pid+mausac+size).html(result.giaban);
                    $('.load-price-cu'+pid+mausac+size).html(result.giacu);
                    $('.load-price-final').html(result.tonggia);
                    $('.load-price-coupon').html(result.tonggia_coupon);
                }
            }
            });
        }

        function xuly_coupon()
        {
            var code_coupon = document.getElementById('code-coupon').value;
            if(code_coupon!='')
            {
                document.form1.coupon.value='coupon';
                document.form1.submit(); 
            }
            else
            {
                alert("<?=_chuanhapmauudai?>");
            }
        }

        function thanhtoan_cart()
        {
            window.location="gio-hang";
        }
        $('.counter-plus').click(function() {
            var pid = $(this).parent('.handle-counter').data('id');
            var mausac = $(this).parent('.handle-counter').data('mausac');
            var size = $(this).parent('.handle-counter').data('size');
            var sl = $(this).parent('.handle-counter').find('.quantity-procat').val();
            var sluong = parseInt(sl) + 1;
            $(this).parent('.handle-counter').find('.quantity-procat').attr('value',sluong);
            update_cart(pid,sluong,mausac,size); 
        });

        $('.counter-minus').click(function() {
            var pid = $(this).parent('.handle-counter').data('id');
            var mausac = $(this).parent('.handle-counter').data('mausac');
            var size = $(this).parent('.handle-counter').data('size');
            var sl = $(this).parent('.handle-counter').find('.quantity-procat').val();
            var sluong = parseInt(sl) - 1;
            if(sluong<1){
                sluong = 1;
            }
            $(this).parent('.handle-counter').find('.quantity-procat').attr('value',sluong);
            update_cart(pid,sluong,mausac,size); 
        });
    </script>
    <div class="wrap-cart">
        <div class="top-cart">
            <input type="hidden" name="pid" />
            <input type="hidden" name="mausac" />
            <input type="hidden" name="size" />
            <input type="hidden" name="mauold" />
            <input type="hidden" name="sizeold" />
            <input type="hidden" name="coupon" />
            <input type="hidden" name="command" />
            <?php $max=count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
                $pid=$_SESSION['cart'][$i]['productid'];
                $q=$_SESSION['cart'][$i]['qty'];
                $mausac=($_SESSION['cart'][$i]['mausac']=='')?0:$_SESSION['cart'][$i]['mausac'];
                $size=($_SESSION['cart'][$i]['size']=='')?0:$_SESSION['cart'][$i]['size'];
                $pmau=get_product_mau($mausac);
                $psize=get_product_size($size);
                $proinfo=get_product_info($pid); ?>
                <div class="item-procart item-procart-<?=$pid.$mausac.$size?>">
                    <p class="pic-procart">
                        <a href="<?=$proinfo['tenkhongdau']?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img src="thumb/50x50/1/<?=_upload_sanpham_l.$proinfo['photo']?>" onerror="this.src='//placehold.it/50x50';" alt="<?=$proinfo['ten'.$lang]?>"></a>
                    </p>
                    <div class="info-procart">
                        <div class="left-info-procart flexwb">
                            <h3 class="name-procart"><a href="<?=$proinfo['tenkhongdau']?>" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
                            <a class="del-procart" data-pid="<?=$pid?>" data-mausac="<?=$mausac?>" data-size="<?=$size?>" >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="right-info-procart flexwb">
                            <div class="handle-counter handle-counter-procart<?=$pid.$mausac.$size?> w-clear" data-id="<?=$pid?>" data-mausac="<?=$mausac?>" data-size="<?=$size?>">
                                <p class="counter-minus btn-hc-pri"><i class="fa fa-minus" aria-hidden="true"></i></p>
                                <input type="text" class="quantity-procat" value="<?=$q?>" />
                                <p class="counter-plus btn-hc-pri"><i class="fa fa-plus" aria-hidden="true"></i></p>
                            </div>
                            <div class="price-procart flexwb">
                                <p class="price-new-cart">
                                    <?=number_format(get_price($pid),0, ',', '.')."Đ"?>
                                </p>
                                <p class="price-new-cart so2 load-price<?=$pid.$mausac.$size?>">
                                    <?=number_format(get_price($pid)*$q,0, ',', '.')."Đ"?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <input type="hidden" class="price-final" name="price-final">
            <input type="hidden" class="price-coupon" name="price-coupon">
        </div>
        <div class="total-procart">
            <p><?=_tongtien?>:</p>
            <p class="total-price load-price-final <?=(isset($_SESSION['coupon']['price']))?'price-line':''?>"><span class="giaload"><?=number_format(get_order_total(),0, ',', '.')?>Đ</span></p>
        </div>
        <div class="dieuchinh flexwb">
            <p><input type="button" class="thanhtoan bgcart" name="thanhtoan" onclick="thanhtoan_cart();" value="<?=_thanhtoan?>"></p>
            <p class="dieuc dall" style="cursor: pointer;">XÓA TẤT CẢ</p>
            <p class="dieuc closegh">ĐÓNG</p>
        </div>
    </div>
</form>