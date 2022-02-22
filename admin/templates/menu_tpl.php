<div class="logo"> <a href="#" target="_blank" onclick="return false;"><img src="images/logo.png"  alt="" /> </a></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1"><a class=" active" title="" href="index.php"><span><?=_trangchu?></span></a></li>

  <li class="categories_li <?php if($_REQUEST['type']=='san-pham' || $_REQUEST['com']=='order' || $_REQUEST['com']=='giasearch' || $_REQUEST['com']=='excel' || $_REQUEST['com']=='tags' || $_REQUEST['com']=='httt' || $_REQUEST['com']=='place') echo ' activemenu' ?>" id="menu2"><a href="" title="" class="exp"><span><?=_sanpham?></span><strong></strong></a>
    <ul class="sub">
      <?php phanquyen_menu(_quanly.' '._danhmuc.' 1','product','man_danhmuc','san-pham'); ?>
      <?php phanquyen_menu(_quanly.' '._danhmuc.' 2','product','man_list','san-pham'); ?>
      <?php phanquyen_menu(_quanly.' '._danhmuc.' 3','product','man_cat','san-pham'); ?>
      <?php phanquyen_menu(_quanly.' '._sanpham,'product','man','san-pham'); ?>
		<?php phanquyen_menu(_quanly.' size '._sanpham,'product','man_size','san-pham'); ?>
      <?php phanquyen_menu(_quanly.' tags '._sanpham,'tags','man','san-pham'); ?>
      <?php phanquyen_menu(_quanly.' Tỉnh/Thành Phố','place','man_city',''); ?>
      <?php phanquyen_menu(_quanly.' Quận/Huyện','place','man_dist',''); ?>
      <?php phanquyen_menu(_quanly.' Phường/Xã','place','man_ward',''); ?>
      <?php phanquyen_menu(_quanly.' Hình thức thanh toán','httt','man',''); ?>
      <?php phanquyen_menu(_quanly.' Đơn Hàng','order','man',''); ?>
    </ul>
  </li>
  
   <li class="categories_li <?php if($_REQUEST['com']=='about' || $_REQUEST['com']=='video') echo ' activemenu' ?>" id="menu_t"><a href="" title="" class="exp"><span><?=_trangtinh?></span><strong></strong></a>
    <ul class="sub">
      <?php phanquyen_menu(_gioithieu,'about','capnhat','about'); ?>
      <?php phanquyen_menu("Vận chuyển và thanh toán",'about','capnhat','van-chuyen-thanh-toan'); ?>
      <?php phanquyen_menu("Tuyển dụng",'about','capnhat','tuyen-dung'); ?>
      <?php phanquyen_menu(_lienhe,'about','capnhat','lienhe'); ?>
      <?php phanquyen_menu("Liên hệ cột phải trang chi tiết sản phẩm",'about','capnhat','lienhe1'); ?>
      <?php phanquyen_menu('Footer','about','capnhat','footer'); ?>
      <?php phanquyen_menu("KHUYẾN MÃI ĐẶC BIỆT",'about','capnhat','kmdb'); ?>
      <?php //phanquyen_menu("Thông tin thanh toán",'about','capnhat','thongtin'); ?>
      <?php //phanquyen_menu('Video','video','man',''); ?>
    </ul>
  </li>

  <li class="categories_li <?php if($_REQUEST['type']=='tin-tuc' || $_REQUEST['type']=='thuong-hieu' || $_REQUEST['type']=='chinh-sach' || $_REQUEST['com']=='bando') echo ' activemenu' ?>" id="menu_tt"><a href="" title="" class="exp"><span><?=_nhieubaiviet?></span><strong></strong></a>
    <ul class="sub">
      <?php phanquyen_menu(_quanly.' Thương hiệu','news','man','thuong-hieu'); ?>
      <?php phanquyen_menu(_quanly.' '._tintuc,'news','man','tin-tuc'); ?>
      <?php phanquyen_menu(_quanly.' '._chinhsach,'news','man','chinh-sach'); ?>
      <?php phanquyen_menu(_quanly.' Đại lý','bando','man',''); ?>
    </ul>
  </li>
   
  <li class="categories_li gallery_li <?php if($_REQUEST['com']=='anhnen' || $_REQUEST['com']=='background' || $_REQUEST['com']=='slider' || $_REQUEST['com']=='letruot' || $_REQUEST['com']=='lkweb' || $_REQUEST['com']=='yahoo' || $_REQUEST['com']=='bando') echo ' activemenu' ?>" id="menu_qc"><a href="" title="" class="exp"><span>Banner - <?=_quangcao?></span><strong></strong></a>
    <ul class="sub">
      <?php phanquyen_menu(_capnhat.' background website','background','capnhat','bgweb'); ?>
      <?php phanquyen_menu(_capnhat.' Logo','background','capnhat','logo'); ?>
      <?php phanquyen_menu(_capnhat.' Banner quảng cáo dưới khuyến mãi hot trái','background','capnhat','banner1'); ?>
      <?php phanquyen_menu(_capnhat.' Banner quảng cáo dưới khuyến mãi hot phải','background','capnhat','banner2'); ?>
      <?php phanquyen_menu(_capnhat.' Slider','slider','man_photo','slider'); ?>
      <?php phanquyen_menu(_quanly.' Hình gắn link trên danh mục sản phẩm','slider','man_photo','quangcao0'); ?>
      <?php phanquyen_menu(_quanly.' Quảng cáo cột phải chi tiết','slider','man_photo','quangcao2'); ?>
      <?php phanquyen_menu(_capnhat.' Pupop','background','capnhat','pupop'); ?>
      <?php phanquyen_menu(_quanly.' Tiêu chí trang chủ','lkweb','man','social3'); ?>
      <?php phanquyen_menu(_quanly.' Tiêu chí mua hàng','lkweb','man','social1'); ?>
    </ul>
  </li>

  <li class="categories_li setting_li <?php if($_REQUEST['com']=='company' || $_REQUEST['com']=='meta' || $_REQUEST['com']=='about' || $_REQUEST['com']=='user' || $_REQUEST['type']=='seo_website') echo ' activemenu' ?>" id="menu_cp"><a href="" title="" class="exp"><span>Nội dung khác + SEO</span><strong></strong></a>
    <ul class="sub">
      <?php phanquyen_menu(_capnhat.' '._thongtincongty,'company','capnhat',''); ?>
      <?php phanquyen_menu(_thongtinseotc,'meta','capnhat',''); ?>
      <?php phanquyen_menu(_thongtinseoweb,'news','man_seoweb','seo_website'); ?>
      <?php phanquyen_menu(_quanly.' '._taikhoan,'user','admin_edit',''); ?>
    </ul>
  </li>
</ul>



