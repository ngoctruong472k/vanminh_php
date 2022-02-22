 
<amp-sidebar id='sidebar' layout='nodisplay'>
    <label>Menu</label>
    <ul class="menu_mobile">
      <li><a href="/"  >Trang chủ</a></li>
      <li><a href="/best-seller">Best seller</a></li>
      <li><a href="/thuong-hieu">Thương hiệu</a></li>
       
    </ul>
   <?php  if(count($product_danhmuc)>0){ foreach($product_danhmuc as $k1 => $v){ 
        $product_list = List_DanhMucCap2("product_list","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$v['type'],$v['id']);
    ?>
    <amp-accordion class="drop_nav">
      <section>
          <h4>  <a href="/amp/<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>  <i class="fa fa-angle-right"></i></h4>
         
          <ul>
            
          <?php foreach($product_list as $k2 => $k){ ?>
            <li><a href="/amp/<?=$k['tenkhongdau']?>"><i class="fa fa-angle-double-right"></i> <?=$k['ten']?></a>
              
            </li>
          <?php }?>
          </ul>
        
      </section>
    </amp-accordion>
    <?php } ?>
    <?php } ?>
    <ul class="menu_mobile">
      <li><a href="/gioi-thieu"  ><?=_gioithieu?></a></li>
      <li><a href="/van-chuyen-thanh-toan">Vận chuyển và thanh toán</a></li>

      <li><a href="/tin-tuc"><?=_tintuc?></a></li>

      <li><a href="/tuyen-dung"><?=_tuyendung?></a></li>

      <li><a href="/lien-he"><?=_lienhe?></a></li>

      <li><a href="/khuyen-mai-hot">Khuyến mãi hot</a></li>

      <li><a href="/san-pham-gia-tot">Sản phẩm giá tốt</a></li>
 
    </ul>
</amp-sidebar>