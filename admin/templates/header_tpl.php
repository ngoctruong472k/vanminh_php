<?php

      $d->reset();
      $sql = "SELECT COUNT(*) as num FROM #_donhang where tinhtrang=1 ";
      $d->query($sql);
      $row_giohang = $d->fetch_array();

      $tong_count = $row_giohang['num'];
	  
	  $d->reset();
      $sql = "SELECT COUNT(*) as num_contact FROM #_contact where phanhoi=0 ";
      $d->query($sql);
      $row_ctact = $d->fetch_array();

      $tong_contact = $row_ctact['num_contact'];

    $d->reset();
      $sql = "select COUNT(*) as num_newsletter from #_newsletter where type='".$config['typedangkynhantin']."'";
      $d->query($sql);
      $row_ctact1 = $d->fetch_array();

      $tong_newsletter = $row_ctact1['num_newsletter'];
?>
<div class="wrapper">
        <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
        <div class="userNav">
            <ul>
                <li><a href="http://<?=$config_url?>" title="" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span><?=_vaoweb?></span></a></li>
                
                <li class="ddnew  <?php if($config['hiengiohang']==0) echo 'none';?>"><a href="index.php?com=order&act=man" title=""><img src="images/icons/topnav/messages.png" alt="" /><span><?=_donhangmoi?></span><span class="numberTop"><?=$tong_count?></span></a>
                    <ul class="none userMessage">
                       <li><a href="index.php?com=user&act=admin_edit" title=""><span><?=_thongtintaikhoan?></span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=dangky" title=""><span><?=_dangky?></span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=dangnhap" title=""><span><?=_dangnhap?></span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=quenmatkhau" title=""><span><?=_quenmatkhau?></span></a></li>
                        <li><a href="index.php?com=about&act=capnhat&type=thaydoithongtin" title=""><span><?=_thaydoithongtin?></span></a></li>
                        <li><a href="index.php?com=user&act=man" title=""><span><?=_quanlythanhvien?></span></a></li>
                    </ul>
                </li>
                <li class="ddnew <?php if($config['hiendangkynhantin']==0) echo 'none';?>"><a href="index.php?com=newsletter&act=man&type=<?=$config['typedangkynhantin']?>" title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Đăng ký nhận tin mới</span><span class="numberTop"><?=$tong_newsletter?></span></a></li>
                <li class="ddnew  <?php if($config['hienlienhe']==0) echo 'none';?>"><a href="index.php?com=contact&act=man" title=""><img src="images/icons/topnav/messages.png" alt="" /><span><?=_thumoi?></span><span class="numberTop"><?=$tong_contact?></span></a></li>
                <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span><?=_dangxuat?></span></a></li>
                <li class="none"><a style="height: 28px;display: flex;flex-wrap: wrap;align-items: center;" href="index.php?com=ngonngu&lang=" title=""><img style=" display: inline-block;vertical-align: middle;margin: 0 10px;" src="images/vi.png" alt="" /></a></li>
                <li class="none"><a style="height: 28px;display: flex;flex-wrap: wrap;align-items: center;" href="index.php?com=ngonngu&lang=en" title=""><img style=" display: inline-block;vertical-align: middle;margin: 0 10px;"  src="images/en.png" alt="" /></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?php //$_SESSION['login']['role']; ?>

