<div class="khung flexwb baomn">
    <ul class="ulmn">	  
    <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href=""><?=_trangchu?></a></li>
        <li class="line"></li>
        <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href=""><?=_trangchu?></a></li>
        <li class="line"></li>

        <!-- <li><a class="<?php if($_REQUEST['com'] == 'best-seller') echo 'active'; ?>" href="best-seller">Best seller</a></li> -->

        <li class="line"></li>

        <!-- <li><a class="<?php if($_REQUEST['com'] == 'thuong-hieu' || $type == 'thuong-hieu') echo 'active'; ?>" href="thuong-hieu">Thương hiệu</a></li> -->

        <?php if(count($product_danhmuc)>0){ foreach($product_danhmuc as $k1 => $v){ if($k1<4){

            $product_list = List_DanhMucCap2("product_list","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$v['type'],$v['id']);

        ?>
        <li class="line"></li>

        <li><a class="<?php if($_REQUEST['com'] == $v['tenkhongdau']) echo 'active'; ?>" href="<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>

            <?php if(count($product_list)>0){?>

            <ul>

                <?php foreach($product_list as $k2 => $k){ 

                    $product_cat = List_DanhMucCap3("product_cat","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$k['type'],$k['id']);

                ?>

                    <li><a href="<?=$k['tenkhongdau']?>"><?=$k['icon']!=''?'<img = src="thumb/35x35/2/'._upload_sanpham_l.$k['icon'].'" alt="'.$k['ten'].'">':''?><?=$k['ten']?></a>

                        <?php if(count($product_cat)>0){?>

                            <ul>

                                <?php foreach($product_cat as $k3 => $val){ ?>

                                    <li><a href="<?=$val['tenkhongdau']?>"><?=$val['icon']!=''?'<img = src="thumb/35x35/2/'._upload_sanpham_l.$val['icon'].'" alt="'.$val['ten'].'">':''?><?=$val['ten']?></a></li>

                                <?php }?>

                            </ul>

                        <?php }?>

                    </li>

                <?php } ?>

            </ul>

            <?php }?>

        </li>

        <?php }}} ?>
        <?php if(count($product_danhmuc)>0){ ?>
        <li class="line"></li>

        <li><a class="<?php if($_REQUEST['com'] == 'san-pham-khac') echo 'active'; ?>" href="san-pham-khac">SẢN PHẨM KHÁC</a>

            <ul>

            <?php foreach($product_danhmuc as $k1 => $v){ if($k1>3){

                $product_list = List_DanhMucCap2("product_list","*,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota",$v['type'],$v['id']);

            ?>

                <li><a class="<?php if($_REQUEST['com'] == $v['tenkhongdau']) echo 'active'; ?>" href="<?=$v['tenkhongdau']?>"><?=$v['ten']?></a>

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

            <?php }} ?> 

            </ul>

        </li>

        <?php } ?> 

    </ul>

    

</div>