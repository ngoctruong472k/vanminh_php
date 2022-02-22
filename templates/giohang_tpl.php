<div id="box_cart">
	<div class="wap_pro">
		<?php if(count($_SESSION['cart']) > 0){  ?>
		<h4 class="title_cart">GIỎ HÀNG CỦA BẠN (<?=count($_SESSION['cart'])?> SẢN PHẨM)</h4>
		<table class="table_cart">
			<thead>
				<tr>
					<th width="10%" class="image">Hình</th>
					<th width="40%" class="item">Sản phẩm</th>
					<th width="20%" class="qty">Size</th>
					<th width="20%" class="qty">Số lượng</th>
					<th width="20%" class="single_price">Đơn giá</th>
					<th width="10%" class="price">Thành tiền</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$max=count($_SESSION['cart']);
					for ($i=0; $i < $max; $i++) { 
						$pid=$_SESSION['cart'][$i]['productid'];					
						$q=$_SESSION['cart'][$i]['qty'];
						$pname=get_product_name($pid);
						$size=$_SESSION['cart'][$i]['size'];
						if($q==0) continue;
						$d->reset();
					  $result_size="select id,ten from #_product_size where hienthi =1 and id='".$size."' order by stt,id asc";
					  $d->query($result_size); 
					  $result_size=$d->fetch_array();
				?>
				<tr class="list-carts ">
					<td class="image">
						<a href="<?=get_product_url($pid)?>"><img src="thumb/70x70/1/<?=_upload_sanpham_l.get_product_photo($pid)?>" alt="<?=$pname?>"></a>
					</td>
					<td class="item">
						<a style="color:#3a3a3c;" href="<?=get_product_url($pid)?>"><?=$pname?></a>
						<a href="javascript:void(0);" class="click-delete" data-id="<?=$pid?>"><i class="fa fa-trash fa-lg"></i> Bỏ sản phẩm</a>
					</td>
					<td class="price">
						<a><?=$result_size['ten']?></a>
						
					</td>
					<td class="qty">
						<label class="visible-xs">Số lượng: </label>
						<input data-id="<?=$pid?>" data-size="<?=$size?>" type="number" name="soluong" value="<?=$q?>" min="1">
					</td>
					<td class="single_price">
						<p class="product-price">
							<span style="color:#383838;font-size:14px; display: block;">Giá sản phẩm:</span> 
							<b class="updatagia" data-id="<?=$pid?><?=$size?>"><?=number_format(get_price($pid,$q),0, ',', '.')?>&nbsp;đ</b>
						</p>
					</td>
					<td class="price" data-id="<?=$pid?><?=$size?>"><?=number_format((get_price($pid,$q)*$q),0, ',', '.')?>&nbsp;đ</td>
				</tr>
				<?php } ?>
				<tr class="summary" style="background: #fdfdfd; padding: 10px 0;">
					<td class="image">&nbsp;</td>
					<td>&nbsp;</td>
					<td class="text-center title_c"><b>Tổng cộng:</b></td>
					<td style="font-weight: bold;" class="total_item"><?=get_total()?></td>
					<td>
						<span class="total" id="total-carts">
							<strong><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</strong>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="bottom_cart">
			<a href="san-pham" class="continue"><i class="fa fa-reply" aria-hidden="true"></i> Tiếp tục mua hàng</a>
			<a href="thanh-toan" class="continue">Thanh Toán <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
		</div>
		<?php }else{ ?>
			<div class="empty">
				<img src="images/shopping-cart-emty-icon.webp" alt="shopping-cart-emty">
				<label>Bạn chưa mua sản phẩm nào</label>
				<a href="san-pham">Tiếp tục mua hàng</a>
			</div>
		<?php } ?>
	</div>
</div>