 
<header itemscope itemtype="https://schema.org/WPHeader">
    <div id="logo" class="clearfix">
        <a href="/amp" ><amp-img src="/<?php if($row_logo['photo']!='') echo _upload_hinhanh_l.$row_logo['photo']; else echo 'thumb/182x78/1/images/no.png';?>" width="182" height="78"  ></amp-img></a>
    </div>
    <div id="header_fix" class="clearfix">
        <div class="header_fix_box clearfix">
            <button class="navmenu_link" title="Menu" on='tap:sidebar.toggle'><i class="fa fa-bars"></i></button>    
            <!-- <a class="search_open"><i class="fa fa-search"></i></a>   -->
        </div>
        <!--------------- /Khung Tìm kiếm ------------------>
         
    </div>
</header> 
<div class="slider">
  <amp-carousel type="slides"
    width="1920"
    height="637"
    layout="responsive"
    controls
    loop
    autoplay
    delay="3000"
    data-next-button-aria-label="Go to next slide"
    data-previous-button-aria-label="Go to previous slide">
    <?php for($i=0;$i<count($slider);$i++){?>
    <amp-img src="/thumb/1920x637/1/<?=_upload_hinhanh_l.$slider[$i]['photo']?>"
    width="1920"
    height="637"
    layout="responsive"></amp-img>
    <?php } ?>
  </amp-carousel>
</div>