<div class="box_container">
    <div class="wap_pro">
        <div class="cottin1" style="position: relative;">
            <div class="flexwb">
                <div class="zoom_slick">
                    <a id="Zoom-1" class="MagicZoom" data-options="expandZoomMode: off;rightClick: true;" href="<?=_upload_sanpham_l.$row_detail['photo']?>?v=<?=time()?>" title="<?=$row_detail['ten'.$lang]?>">
                        <img src="<?php if($row_detail['photo']!='') echo _upload_sanpham_l.$row_detail['photo']; else echo 'thumb/600x600/1/images/no.png'; ?>?v=<?=time()?>"> 
                    </a>
                    <?php $count=count($hinhthem); if($count>0) {?>
                    <div class="slick">
                        <a class="item_img" data-zoom-id="Zoom-1" data-options="zoomMode: magnifier;rightClick: true;" data-image="<?=_upload_sanpham_l.$row_detail['photo']?>?v=<?=time()?>" href="<?=_upload_sanpham_l.$row_detail['photo']?>?v=<?=time()?>" title="<?=$row_detail['ten']?>"><img src="thumb/100x100/1/<?php if($row_detail['photo'] != NULL)echo _upload_sanpham_l.$row_detail['thumb'];else echo 'images/no.png';?>" alt="<?=$row_detail['ten']?>"/></a>
                        <?php foreach($hinhthem as $v){?>
                        <a class="item_img" data-zoom-id="Zoom-1" data-options="zoomMode: magnifier;rightClick: true;" data-image="<?=_upload_hinhthem_l.$v['photo']?>?v=<?=time()?>" href="<?=_upload_hinhthem_l.$v['photo']?>?v=<?=time()?>" title="<?=$v['ten']?>"><img src="<?php if($v['thumb']!=NULL) echo _upload_hinhthem_l.$v['thumb']; else echo 'images/no.png';?>" alt="<?=$v['ten']?>"/></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="product_info clear">
                    <h1 class="ten info">
                        <?=$row_detail['ten']?>
                    </h1>
                    <?php if($row_detail['masp'] != '') { ?>
                    <div class="info"><b><?=_masanpham?>:</b>
                        <?=$row_detail['masp']?>
                    </div>
                    <?php } ?>

                    <div class="info"><b><?=_luotxem?>:</b> <span><?=$row_detail['luotxem']?></span></div>
                    <div class="info">
						   <div class="chitietsanpham">
								<div class="ten-chitietsanpham">Giá bán lẻ 1-<?=$row_detail['soluongsi']-1?> sản phẩm <span class="gia">: <?php if($row_detail['gia']==0) echo _lienhe; elseif($row_detail['giacu']!=0 && $row_detail['gia']!=0) echo number_format ($row_detail['gia'],0,",",".").' đ'; else echo number_format ($row_detail['gia'],0,",",".").' đ' ?></span></div>
							</div>
							<?php if($row_detail['giasi']!=0 && $row_detail['gia']!=0) { ?>
							<div class="chitietsanpham">
								<div class="ten-chitietsanpham">Giá bán sỉ <?=$row_detail['soluongsi']?> sản phẩm trở lên <span class="gia">: <?=number_format ($row_detail['giasi'],0,",",".").' đ' ?></span></div>
							</div>
							<?php } ?>
					</div>
                    <div class="info">
                        <?php if($row_detail['gia']<$row_detail['giacu'] && $row_detail['giacu']!=0 && $row_detail['gia']!=0){?>
                        <span class="giacu"><?= number_format($row_detail['giacu'],0,'.','.').'đ'?></span> 
                        <?php } ?>
                        <span class="gia">
                            <?php if($row_detail['gia'] != 0)echo number_format($row_detail['gia'],0, ',', '.').'đ';else echo _lienhe; ?>    
                        </span>
                    </div>

                    <?php if($row_detail['gia']<$row_detail['giacu'] && $row_detail['giacu']!=0 && $row_detail['gia']!=0){?><p class="giamg">-<?php echo (100 - intval($row_detail['gia']/$row_detail['giacu']*100)).'%';?></p>
                    <?php }//?>  

                    <?php if($row_detail['mota'] != '') { ?>
                    <div class="info baonoidung clear">
                        <?=$row_detail['mota']?>
                    </div>
                    <?php } ?>
                    <?php if($kmdb['noidung']!=""){ ?>
                    <div class="info">
                        <div class="kmdb">
                            <label>KHUYẾN MÃI ĐẶC BIỆT</label>
                            <div class="clear noidung"><?=$kmdb['noidung']?></div>
                        </div>
                    </div>
                    <?php } ?>
					  <?php if($row_detail['id_size']!=''){?>
                    <div class="info">
                        <p>Chọn size: </p>
                        <div class="information-cart d-flex align-items-center flex-wrap">
                            <?php
                                $result_team_size=explode(',',$row_detail['id_size']);
                                for($i=0;$i<count($result_team_size);$i++) {  
                                    $d->reset();
                                    $result_size="select id,ten from #_product_size where hienthi =1 and id='".$result_team_size[$i]."' order by stt,id asc";
                                    $d->query($result_size);  
                                    $result_size=$d->fetch_array(); ?>

                                    <a data-id="<?=$result_size['id']?>" class=" text-decoration-none d-flex align-items-center justify-content-center <?php if($i==0) echo 'active';?>"><?=$result_size['ten']?></a>
                                <?php } ?>
                            
                        </div>
                        <?php /*
                        <select  id="idsize" name="idsize" >
                                <?php for($j=0;$j<count($result_size);$j++) { ?>
                                <option value="<?=$result_size[$j]['id']?>"><?=$result_size[$j]['ten']?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        */?>
                    </div>
                <?php }?>
                    <div class="cart">
                        <div class="price">
                            <label>Số Lượng:</label>
                            <input type="number" name="price" min="1" value="1">
                        </div>
                        <div class="button buy" data-id="<?=$row_detail['id']?>">
                            <label>Giỏ Hàng</label>
                            <p>Thêm vào giỏ hàng</p>
                        </div>
                        <div class="button buynow" data-id="<?=$row_detail['id']?>">
                            <label>Mua Ngay</label>
                            <p>Mua hàng ngay</p>
                        </div>
                    </div>
                    <div class="info">
                        <div class="clear div_mxh">
                            <a class="zalo-share-button zalo_share" data-href="<?=getCurrentPageURL_CANO()?>" data-oaid="3045141640417367223" data-layout="icon-text" data-customize="true"><span class="ti-zalo"></span>Zalo</a>
                            <div class="addthis_native_toolbox"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cottin2 chitietsp">
            <div class="zlboxs">
                <h4>Mua hàng tại <?=$company['ten']?></h4>
                <ul>
                    <?php if(count($mxh_ft1)>0){ foreach($mxh_ft1 as $v){ ?>
                    <li><?=$v['ten']?></li>
                    <?php }} ?>
                </ul>
            </div>
            <?php if(isset($thuongh['id'])){ ?>
            <div class="additional">
                <div class="item_th">
                    <a href="<?=$thuongh['tenkhongdau']?>" title="<?=$thuongh['ten']?>">
                        <img src="<?php if($thuongh['thumb']!='') echo _upload_sanpham_l.$thuongh['thumb']; else echo 'thumb/185x90/1/images/no_img.png'; ?>?v=<?=time()?>" alt="<?=$thuongh['ten']?>"/>
                    </a>
                </div>
                <h4 class="tdthuongh"><a href="<?=$thuongh['tenkhongdau']?>" title="<?=$thuongh['ten']?>"><?=$thuongh['ten']?></a></h4>
            </div>
            <?php } ?>
            <div class="additional">
                <div class="contact">
                    <?=$company_contact1['noidung']?>
                </div>
                <div class="register-to-sell">
                    Bạn muốn nhận tư vấn từ <?=$company['ten']?> <a href="lien-he">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
    <!--.wap_pro-->
    <div class="flexwb baotrangchitiet">
        <div class="cottin1">
            <div id="tabs">
                <ul id="ultabs" class="clear">
                    <li>
                        <?=_thongtin?> <?=$title_link?>
                    </li>
                </ul>

                <div id="content_tabs">
                    <div class="tab baonoidung clear">
                        <?=$row_detail['noidung']?>
                        <?php if(count($arr_tags)>0) { ?>
                        <div class="tags"><span><i class="fa fa-tags"></i> Tags:</span>
                            <?php foreach($arr_tags as $k=>$v){
                                $tags_sp = Get_Tags('tags','id',$v);
                                if($tags_sp['ten']!=''){
                            ?>
                                <a href="tags/<?=$tags_sp['tenkhongdau']?>-<?=$tags_sp['id']?>" title="<?=$tags_sp['ten']?>"><?=$tags_sp['ten']?></a>
                            <?php }} ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="5" data-width="100%"></div>
            </div>
        </div>
        <div class="cottin2">
            <?php include _template."layout/left.php"?>
        </div>
    </div>
</div>

<?php if(count($product)>0){?>
<h2 class="tieude_giua" style="margin-top: 20px;"><span><?=$title_link?> <?=_lienquan?></span></h2>
<div class="w_product">
    <?php if(count($product)>0){ foreach($product as $k=>$v){?>
        <div class="item_sp animated fadeInUp wow delayp<?=$k+1?>">
            <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
            <?php }?>
            <?php if($v['spbanchay']==1){?>
                <span class="sale"><img src="images/img/sale.png" alt="<?=$v['ten']?>"></span>
            <?php }?>
            <div class="img">
                <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                    <img data-src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/440x450/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>" class="lazy" />
                </a>
            </div>
            <h3><a class="ten" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
            <p class="gia">
                <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                <?php } ?>
            </p>
        </div>
    <?php }} ?>
</div>
<div class="pagination"><?=pagesListLimitadmin($url_link , $totalRows , $pageSize, $offset)?></div>
<?php } ?>
