<div class="hdtop">

	<div class="khung111111 baotop">

		<a class="<?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu"><?=_gioithieu?></a>

		<span></span>

		<a class="<?php if($_REQUEST['com'] == 'van-chuyen-thanh-toan') echo 'active'; ?>" href="van-chuyen-thanh-toan">Vận chuyển và thanh toán</a>

		<span></span>

    	<a class="<?php if($_REQUEST['com'] == 'tin-tuc' || $type == 'tin-tuc') echo 'active'; ?>" href="tin-tuc"><?=_tintuc?></a>

		<span></span>

    	<a class="<?php if($_REQUEST['com'] == 'tuyen-dung' || $type == 'tuyen-dung') echo 'active'; ?>" href="tuyen-dung"><?=_tuyendung?></a>

        <span></span>

        <a class="<?php if($_REQUEST['com'] == 'lien-he' || $type == 'lien-he') echo 'active'; ?>" href="lien-he"><?=_lienhe?></a>

	</div>

</div>

<!-- <div class="khung flexwb baohd">
    <a href="./" class="logo" title="<?=$seo['alt']?>">

        <img src="<?php if($row_logo['photo']!='') echo _upload_hinhanh_l.$row_logo['photo']; else echo 'thumb/182x78/1/images/no.png';?>" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>" />

    </a>

    <div id="search">
        <input type="text" name="keyword" id="keyword" onKeyPress="doEnter(event,'keyword');" value="<?php if($tukhoa!='') { ?><?=$tukhoa;?><?php } ?>" placeholder="<?=_nhaptukhoatimkiem?>...">
        <p onclick="onSearch(event,'keyword');">TÌM KIẾM</p>
    </div> 
    <a href="<?=$company['slogan']?>" class="htch">Hệ thống Cửa hàng</a> 

    <a href="tel:<?=replace_phone($company["hotline"])?>" class="dt">Hotline: <span><?=$company['hotline']?></span></a>

</div>  -->
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-header">
  <a href="./" class="navbar-brand" title="<?=$seo['alt']?>">
        <img src="<?php if($row_logo['photo']!='') echo _upload_hinhanh_l.$row_logo['photo']; else echo 'thumb/182x78/1/images/no.png';?>" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>" />
    </a>

    <form class="form-inline my-2 my-lg-0 form-header">
      <h2 class="equipment">CÔNG TY TNHH THIẾT BỊ VĂN MINH</h2>
    <input class="form-control mr-sm-2 form-input" type="text" name="keyword" id="keyword" onKeyPress="doEnter(event,'keyword');" value="<?php if($tukhoa!='') { ?><?=$tukhoa;?><?php } ?>" placeholder="<?=_nhaptukhoatimkiem?>...">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
      <a href="tel:<?=replace_phone($company["hotline"])?>" class="dt"><span><?=$company['hotline']?> <p class="tell-people">(CSKH)</p></span>
      <span><?=$company['hotline']?> <p class="tell-people">(BS. HUNG)</p></span></a>
    </ul>
    
  </div>
</nav>
</div>
