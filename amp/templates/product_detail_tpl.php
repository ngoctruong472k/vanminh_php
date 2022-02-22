<div class="sub_main textWhite clearfix">
    <div class="lb_main clearfix">
        <h3><?=$row_detail["ten"]?></h3>
    </div>

    <div class="cont_main clearfix">
        <amp-carousel width="600" height="600" layout="responsive" type="slides">
            <amp-img src="/<?=_upload_sanpham_l.$row_detail["photo"]?>" width="600" height="600" layout="responsive"></amp-img>
            <?php for ($i=0,$countha=count($hinhthem); $i < $countha; $i++) {?>
            <amp-img src="/<?=_upload_sanpham_l.$hinhthem[$i]['photo']?>" width="600" height="600" layout="responsive"></amp-img>
            <?php }?>
        </amp-carousel>
        <div class="rightProdetail clearfix">
            <?php if($row_detail["masp"]!=''){?>
              <p><b><?=_masanpham?>:</b> <span><?=$row_detail["masp"]?></span></p>
            <?php }?>
              <p><b><?=_luotxem?>:</b> <span><?=$row_detail["luotxem"]?></span></p>
              <div class="price_box clearfix">
                   <b>Giá bán :</b>
                   <strong class="price_detail">
                       <?php if($row_detail["gia"]==0){?>
                         Liên Hệ
                       <?php }else{?>
                         <?php if($row_detail["giacu"]==0){?>
                           <?=number_format($row_detail["gia"])?> VNĐ
                         <?php }else{?>
                           <b><?=number_format($row_detail["gia"])?> VNĐ </b> - <i class="giacu gach"><span class=" "><?=number_format($row_detail["giacu"])?> VNĐ</span> </i>
                         <?php }?>
                       <?php }?>
                   </strong>
               </div>
               <div class="button_add clearfix">
                  <a href="http://<?=$config_url?>/<?=$row_detail['tenkhongdau']?>">
                  <input type="submit" class="button button-primary" name="add-to-cart" value="Đặt hàng"   />
                  </a>
                  
               </div>
        </div>
        <div class="fullProdetail clearfix">
             
                <?php if($kmdb["noidung"]!=''){?>
                <div class="kmdb">
                     <label>KHUYẾN MÃI ĐẶC BIỆT</label>
                    <div class="noidung"><?=ampify($kmdb["noidung"])?></div>
                </div> 
                <?php }?>
           
                <?php if($row_detail["noidung"]!=''){?>
                <section>
                    <h4>Thông tin sản phẩm</h4>
                    <div><?=ampify(($row_detail["noidung"]))?></div>
                </section>
                <?php }?>
        </div>
        <div id="social">
            <amp-social-share type="twitter" width="30" height="22"></amp-social-share>
            <amp-social-share type="facebook" width="30" height="22" data-attribution=629584947171673></amp-social-share>
            <amp-social-share type="gplus" width="30" height="22"></amp-social-share>
            <amp-social-share type="email" width="30" height="22"></amp-social-share>
        </div>
        <?php if($row_detail["tags"]!=''){?>
        <div class="tag_detail clearfix">
            Tags: &nbsp; <?=show_tags_amp($row_detail["tags"])?>
        </div>
        <?php }?>
    </div>
</div>
<?php if(count($product)!=0){?>
<div class="sub_main clearfix">
    <div class="lb_main clearfix">
        <h3>Sản phẩm liên quan</h3>
    </div>
    <div id="sanpham">
        <div class="title"><h2><?=$title_tcat?></h2></div>
        <div class="box_sanpham">
          <?php foreach($product as $k=>$v){ if($k<10){?>
              <div class="item_sp">
                  <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                      <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
                  <?php }?>
                  <?php if($v['spbanchay']==1){?>
                      <span class="sale"><amp-img width="78" height="25"  src="/images/img/sale.png"  ></amp-img></span>
                  <?php }?>
                  <div class="img">
                      <a href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                          <amp-img width="440" height="450" layout="responsive"  src="/<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/440x450/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" ></amp-img>
                      </a>
                  </div>
                  <h3><a class="ten" href="/amp/<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                  <p class="gia">
                      <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                      <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                      <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                      <?php } ?>
                  </p>
              </div>
          <?php }} ?>
        </div>
      </div>
      <div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
</div>
<?php }?>
