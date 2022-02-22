<!-- <div class="menuhd">

    <div class="khung flexwba">

        <div class="flexwba">

            <a class="kmh" href="khuyen-mai-hot">Khuyến mãi hot</a>

            <a class="spgt" href="san-pham-gia-tot">Sản phẩm giá tốt</a>

        </div>

        <a class="daily" data-fancybox data-type="ajax" data-src="ajax/daily.php" href="javascript:void(0)">ĐẠI LÝ</a>

    </div>

</div> -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul>
                <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>"
                     href=""><?=_trangchu?></a></li>
                <li>a</li>
                <li>a</li>
                <li>a</li>
            </ul>
        </div>
        <div class="col-md-9"><?php if($template=='index' && count($slider)>0){?>


            <div class="khung_chay">

                <div id="slider1_container" class="sl_a">

                    <div data-u="slides" class="sl_a">

                        <?php if(count($slider)>0){ foreach($slider as $k=>$v){ ?>

                        <div>

                            <a href="<?=$v['link']?>" target="_blank" title="<?=$v['ten']?>">

                                <img src="thumb/1920x637/1/<?=_upload_hinhanh_l.$v['photo']?>" alt="<?=$v['ten']?>"
                                    title="<?=$v['ten']?>" />
                            </a>
                        </div>

                        <?php }} ?>

                    </div>

                    <span u="arrowleft" class="jssora05l"></span>

                    <span u="arrowright" class="jssora05r"></span>

                </div>

            </div>

            <?php } ?>
        </div>
    </div>
</div>
