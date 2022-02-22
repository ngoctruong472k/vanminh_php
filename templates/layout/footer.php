<div id="w_footer">
    <div id="footer" >
        <div class="khung baoft">
            <div class="footer_1">
                <?=$row_footer['noidung']?>
            </div>
            <div class="footer_2">
                <?php if($row_footer['mota']!=''){ ?>
                <div class="motaft"><?=$row_footer['mota']?></div>
                <?php } ?>
                <div class="baocs">
                <?php if(count($cs)>0){ foreach($cs as $v){?>
                    <h3 class="cs"><a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">+ <?=$v['ten']?></a></h3>
                <?php }}//?>
                </div>
            </div>
            <div class="footer_3">
                <div id="map_ft"></div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="khung flexwb">
            <p class="copy">Copyright © <?=date('Y',time())?> <span><?=$company['yahoo']?></span>. All rights reserved. Design by <a href="https://nina.vn/">NiNa Co., Ltd</a></p>
            <p class="tk"><?=_dangonline?>: <b><?php $count=count_online();echo $tong_xem=$count['dangxem'];?></b><span>|</span><?=_ngay?>: <b><?=$homnay;?></b><span>|</span><?=_thang?>: <b><?=$trongthang;?></b><span>|</span><?=_tongtruycap?>: <b><?php $count=count_online();echo $tong_xem=$count['daxem'];?></b></p>
        </div>
    </div>
</div>