<?php 
	// $d->reset();
	// $sql = "select noidung$lang as noidung from #_about where type='thongtin' limit 0,1";
	// $d->query($sql);
	// $thongtin = $d->fetch_array();
?>
<div id="thanhtoan">
	<div class="wap_pro">
		<form class="frm_thanhtoan" action="" accept-charset="UTF-8" method="post" name="frm" enctype="multipart/form-data">
			<div class="thongtin">
				<h4><?=$company['ten']?></h4>
				<input class="input" type="text" name="ten" placeholder="Họ tên" required>
				<input class="input" type="email" name="email" placeholder="Email">
				<input class="input" type="tel" name="dienthoai" placeholder="Số điện thoại" pattern="[0-9]{10}" required>
				<input class="input" type="text" name="diachi" placeholder="Địa chỉ" required>
				<div id="shipping">
					<div class="shipping active" data-id="0">
						<label>Giao hàng</label>
						<div class="noidung box_select">
							<div class="select">
								<label>Tỉnh/Thành</label>
								<select id="city" required>
									<option>Chọn Tỉnh/Thành</option>
									<?php foreach ($place_city as $key => $value) { ?>
									<option value="<?=$value['id']?>"><?=$value['ten']?></option>
									<?php } ?>
								</select>
							</div>
							<div class="select">
								<label>Quận/Huyện</label>
								<select id="dist" required>
									<option>Chọn Quận/Huyện</option>
								</select>
							</div>
							<div class="select">
								<label>Phường/Xã</label>
								<select id="ward" required>
									<option>Chọn Phường/Xã</option>
								</select>
							</div>
						</div>
					</div>
					<div class="shipping" data-id="1">
						<label>Lấy tại cửa hàng</label>
						<div class="noidung">
							<?php if(count($hethong) > 0){ ?>
							<ul>
								<?php foreach ($hethong as $key => $value) { ?>
								<li data-id="<?=$value['id']?>" <?=$key==0?'class="active"':''?>>
									<label><?=$value['ten']?></label>
									<p><?=$value['diachi']?></p>
								</li>
								<?php } ?>
							</ul>
							<?php }else{ ?>
							<p>Không tìm thấy thông tin cửa hàng</p>
							<?php } ?>
							<input type="hidden" name="hethong" value="">
						</div>
					</div>
				</div>
				<?php if(count($httt) > 0){ ?>
				<div class="pttt">
					<label>Hình thức thanh toán</label>
					<ul class="noidung">
						<?php foreach ($httt as $key => $value) { ?>
						<li data-id="<?=$value['id']?>" <?=$key==0?'class="active"':''?>>
							<label><?=$value['ten']?></label>
							<div class="content"><?=$value['noidung']?></div>
						</li>
						<?php } ?>
					</ul>
					<input type="hidden" name="httt" value="<?=$httt[0]['id']?>">
				</div>
				<?php } ?>
				<textarea class="input" name="noidung" placeholder="Nội dung..." rows="4"></textarea>
				<?php /* if($thongtin['noidung']!=""){ ?><div class="thongtin_content"><?=$thongtin['noidung']?></div><?php } */ ?>
			</div>
			<div class="info_cart">
				<ul>
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
					<li>
						<a class="img" href="<?=get_product_url($pid)?>" data-q="<?=$q?>"><img src="thumb/70x70/1/<?=_upload_sanpham_l.get_product_photo($pid)?>" alt="<?=$pname?>"></a>
						<h3><a href="<?=get_product_url($pid)?>"><?=$pname?></a></h3>
						<p><?=number_format(get_price($pid,$q),0, ',', '.')?>&nbsp;đ</p>
						<p>Size: <?=$result_size['ten']?></p>
					</li>
					<?php } ?>
				</ul>
				<div id="total" data-total="<?=get_order_total()?>">
					<p>
						<label>Giá tiền</label>
						<span><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</span>
					</p>
					<p class="phiship">
						<label>Phí giao hàng</label>
						<span>—</span>
						<input type="hidden" name="phiship" value="0">
					</p>
					<p class="total">
						<label>Tổng đơn hàng</label>
						<span><?=number_format(get_order_total(),0, ',', '.')?>&nbsp;đ</span>
					</p>
				</div>
				<button>Thanh Toán</button>
			</div>
			<div class="loading"><img src="images/loading.gif" alt="loading"></div>
		</form>
	</div>
</div>