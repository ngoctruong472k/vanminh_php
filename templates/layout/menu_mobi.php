<div class="header mauw">
    <a href="#menu_mobi" class="hien_menu">
        <svg width="24" height="26" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 18v2h-24v-2h24zm0-6v2h-24v-2h24zm0-6v2h-24v-2h24z" fill="#ffffff"/></svg>
    </a>
	<div id="search_mobi">
        <input type="text" name="keyword2" id="keyword2" onKeyPress="doEnter2(event,'keyword2');" value="<?php if($tukhoa!='') { ?><?=$tukhoa;?><?php } ?>" placeholder="<?=_nhaptukhoatimkiem?>...">
        <a onclick="onSearch2(event,'keyword2');"><i class="fa fa-search" aria-hidden="true" ></i></a>
    </div>
</div> 
<nav id="menu_mobi" style="height:0; overflow:hidden;">
    <ul>
        <li><a href="">Trang chủ</a></li>
        <li><a href="best-seller">Best seller</a></li>
        <li><a href="thuong-hieu">Thương hiệu</a></li>
        <?php if(count($product_danhmuc)>0){ foreach($product_danhmuc as $k1 => $v){ 
            $product_list = List_DanhMucCap2("product_list","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$v['type'],$v['id']);
        ?>
        <li><a href="<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>
            <?php if(count($product_list)>0){?>
            <ul>
                <?php foreach($product_list as $k2 => $k){ 
                    $product_cat = List_DanhMucCap3("product_cat","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$k['type'],$k['id']);
                ?>
                    <li><a href="<?=$k['tenkhongdau']?>"><?=$k['ten']?></a>
                        <?php if(count($product_cat)>0){?>
                            <ul>
                                <?php foreach($product_cat as $k3 => $val){ ?>
                                    <li><a href="<?=$val['tenkhongdau']?>"><?=$val['ten']?></a></li>
                                <?php }//?>
                            </ul>
                        <?php }?>
                    </li>
                <?php } ?>
            </ul>
            <?php }?>
        </li>
        <?php } }?>   
        <li><a href="gioi-thieu"><?=_gioithieu?></a></li>
        <li><a href="van-chuyen-thanh-toan">Vận chuyển và thanh toán</a></li>
        <li><a href="tin-tuc"><?=_tintuc?></a></li>
        <li><a href="tuyen-dung"><?=_tuyendung?></a></li>
        <li><a href="lien-he"><?=_lienhe?></a></li>
        <li><a href="khuyen-mai-hot">Khuyến mãi hot</a></li>
        <li><a href="san-pham-gia-tot">Sản phẩm giá tốt</a></li>
        <li><a data-fancybox data-type="ajax" data-src="ajax/daily.php" href="javascript:void(0)">ĐẠI LÝ</a></li>
    </ul>
</nav>