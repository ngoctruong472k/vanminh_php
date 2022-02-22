<!DOCTYPE html>
<html lang="vi">
<head>
    <base href="<?=$http.$config_url?>/"  />
    <?php  if ($comlink=="san-pham" or $comlink=="" ) { ?>    
    <link rel="amphtml" href="<?=getCurrentPageURL_AMP()?>" />
    <?php } ?>
    <?php if($Protocol=='https://'){?>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <?php }?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?php include _template."layout/seoweb.php";?>  
    <?php if($bgweb['hienthi'] > 0){ ?>
    <style type="text/css">
        div#main_content{ background: url(<?=_upload_hinhanh_l.$bgweb['photo']?>) repeat-y center; background-color: #000; background-size: 100%; }
    </style>
    <?php } ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <ul class="h-card the_an">
        <li class="h-fn fn"><?php if($title!='')echo $title;else echo $seo['title'];?></li>
        <li class="h-org org"><?php if($title!='')echo $title;else echo $seo['title'];?></li>
        <li class="h-tel tel"><?=replace_phone($company['dienthoai'])?></li>
        <li><a class="u-url ul" href="<?=$http.$config_url?>"><?=$http.$config_url?></a></li>
    </ul>
    <p class="h-geo geo the_an"><span class="p-latitude latitude"><?php $toado=explode( ',', $company['toado']); echo $toado[0];?></span>,<span class="p-longitude longitude"><?php echo $toado[1];?></span></p>
    <?php if($template=='index'){ ?> 
        <h1 class="the_an"><?php if($title_cat!='')echo $title_cat;else echo $seo['h1'];?></h1>
    <?php } ?>
    <div id="wapper">
        <div id="header"><?php include _template."layout/header.php"?></div>
        <div id="menu"><?php include _template."layout/menu_top.php"?></div>
        <div id="menu_mobi1"><?php include _template."layout/menu_mobi.php";?></div> 
        <div id="slider"><?php include _template."layout/slider_jssor.php";?></div>

        <?php if($template=='news_detail' || $template=='product_detail') { ?> 
            <div class="link_web"><div class="khung"><?=$link_web?></div></div>
        <?php } ?>
        <div id="main_content">
            <?php if($template=='index') { ?> 
                <?php include _template.$template."_tpl.php"?>
            <?php } else { ?>
                <div class="khungchitiet <?php if($template=='news_detail') { ?>khungchitiet0<?php } ?>">
                    <?php if($template=='news_detail' && $type!='thuong-hieu') { ?>
                        <div class="khung clear">
                            <div class="flexwb baotrangchitiet">
                                <div class="cottin1">
                                    <?php include _template.$template."_tpl.php"?>
                                </div>
                                <div class="cottin2">
                                    <?php include _template."layout/left.php"?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?> 
                        <div class="khung <?php if($template=='about' || $type=='thuong-hieu') { ?>khungchitiet1<?php } ?> khungchitiet2 clear">
                            <?php include _template.$template."_tpl.php"?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
        <?php if($template!='news_detail' && $template!='product_detail') { ?>
            <h2 class="the_an"><?php if($description!='')echo $description;else echo $seo['h2'];?></h2>
        <?php } ?>
        <?php if(!isGoogleSpeed()){?>
            <?php include _template."layout/footer.php"?>
        <?php } ?>
    </div>
    <?php if($template!='news_detail' && $template!='product_detail') { ?>
        <h3 class="the_an"><?php if($keywords!='')echo $keywords;else echo $seo['h3'];?></h3>
    <?php } ?>
    <?php if(!isGoogleSpeed()){?>
        <a id="btn-zalo" href="https://zalo.me/<?=replace_phone($company['fax']);?>">
            <img class="shake-anim" src="images/icon_zalo.png" alt="Zalo">
        </a>
        <?php include _template."layout/chatface.php";?>
        <?php if($mb_rp==1) { ?><?php include _template."layout/nhantin_goidien.php";?><?php } ?>

    <?php } ?>
    <?php include _template."layout/js.php";?>
    <?php include _template."layout/js_cart.php";?>
    <?php include_once _lib."json_strucdata.php";?>
    <?=$company['codethem']?>
    <?php include _template."layout/popup.php";?>   
</body>
</html>
