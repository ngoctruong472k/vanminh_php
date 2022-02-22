<?php

include ("ajax_config.php");

/*--------------------------------------------------------------------------------------*/

?>

<script src="./js/lazyload.min.js"></script>
<script>
    var myLazyLoad = new LazyLoad({
        elements_selector: ".lazy"
    });
</script>

<?php
 
$id=$_REQUEST['id'];

$d->reset();
if($id==0){
$sql="select count(id) as c from #_product where type='san-pham' and hienthi=1 and noibat=1 order by stt,id desc ";
} else {
$sql="select count(id) as c from #_product where type='san-pham' and id_danhmuc='".$id."' and hienthi=1 and noibat=1 order by stt,id desc ";
}
$d->query($sql);
$tmp=$d->fetch_array();

$total=$tmp['c'];
 
$p=$_REQUEST['p'];
if($p<1){
    $p=1;
}
$pr=$company['phantrang'];
$pp=3;
$limit=($p-1)*$pr;
$tt_page=ceil($total/$pr);

if($tt_page>1)
{ 
    $k=($p-1-ceil($pp/2)>0)?$p-1-ceil($pp/2):0; 
    for ($i=$p-1; $i >$k ; $i--) { 
        $phantrang="<div data-p='".$i."' data-id='".$id."'>".$i."</div>".$phantrang;
    }
    if($p>=1)
    {
        $phantrang="<div class='dau' data-p='1' data-id='".$id."'><i class='fa fa-angle-double-left' aria-hidden='true'></i></div>".$phantrang;
    }
    $phantrang.="<div class='active' data-p='".$p."'>".$p."</div>";
    $k=($p+1+ceil($pp/2)<$tt_page)?$p+1+ceil($pp/2):$tt_page;
    for ($i=$p+1; $i <= $k; $i++) { 
        $phantrang.="<div data-p='".$i."' data-id='".$id."'>".$i."</div>";
    }
    if($p<=$tt_page)
    {
        $phantrang.="<div class='cuoi' data-p='".$tt_page."' data-id='".$id."'><i class='fa fa-angle-double-right' aria-hidden='true'></i></div>";
    }
}

if($id==0){
$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where type='san-pham' and noibat=1 and hienthi=1 order by stt, id desc limit $limit,$pr";
} else {
$sql = "select *,ten$lang as ten, tenkhongdau$lang as tenkhongdau, mota$lang as mota from #_product where id_danhmuc='".$id."' and type='san-pham' and noibat=1 and hienthi=1 order by stt, id desc limit $limit,$pr";
}
$d->query($sql);
$sanpham1 = $d->result_array();


if(count($sanpham1)>0) { ?>
    <div class="iajax ajax-res" data-id="<?=$id?>">
        <div class="w_product">
            <?php foreach($sanpham1 as $k=>$v){?>
                <div class="item_sp animated fadeInUp delayp<?=$k+1?>">
                    <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                        <span class="giamgia">-<?php echo (100 - intval($v['gia']/$v['giacu']*100)).'%';?></span>
                    <?php }?>
                    <div class="img">
                        <a href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>">
                            <img src="<?php if($v['thumb']!='') echo _upload_sanpham_l.$v['thumb']; else echo 'thumb/600x600/1/images/no.png'; ?>?v=<?=time()?>" alt="<?=$v['ten']?>"  />
                        </a>
                    </div>
                    <h3><a class="ten" href="<?=$v['tenkhongdau']?>" title="<?=$v['ten']?>"><?=$v['ten']?></a></h3>
                    <p class="gia">
                        <?php if($v['giacu']>0 && ($v['giacu']>$v['gia']) && $v['gia']>0){?>
                        <span class="giacu"><?php if($v['gia']>0)echo number_format($v['giacu'],0, ',', '.').' đ'; ?></span>
                        <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                        <?php } else { ?>
                        <span><?=_gia?>:
                            <span class="giaban"><?php if($v['gia']>0)echo number_format($v['gia'],0, ',', '.').' đ';else echo _lienhe; ?></span>
                        </span>
                        <?php } ?>
                    </p>
                </div>
            <?php }//?>
        </div>
            <div class="clear"></div>
        <div class="ajax_paging">
            <?=$phantrang?>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function(e){
        $('.spnoibat').each(function(){
            var id = $(this).find('.tieude_giua').data('id');
            $.ajax({
                url: 'ajax/sanpham.php',
                type: 'POST',
                dataType: 'html',
                cache: false,
                data: {id:id},
                success:function(res){
                    $('.showsp').html(res);
                }
            });
        });   
        $('.showsp').on('click', '.ajax_paging div', function(event) {
            var t=$(this);
            var p =t.data('p');
            var id =t.data('id');
            $.ajax({
                url: 'ajax/sanpham.php',
                type: 'POST',
                dataType: 'html',
                cache: false,
                data: {id:id,p:p},
                success:function(res){
                    t.parents('.showsp').html(res);
                }
            });
        });
     });
</script>
<style type="text/css">

.showsp{width: 100%;}
.ajax_paging{text-align: center; display: flex; justify-content: center; margin-bottom: 20px; margin-top: 5px;}
.ajax_paging div{margin: 0px 5px; width: 30px; height: 30px;color: #7f7f7f;line-height: 30px;
font-family:'Roboto-Regular'; font-size: 14px; background: #f4f4f4; cursor: pointer;}
.ajax_paging div.dau,.ajax_paging div.cuoi{line-height: 30px;}
.ajax_paging div.active {background: #189eff; color: #f5faf5; cursor:pointer;pointer-events: none;}
.ajax_paging div:hover {background: #189eff; color: #f5faf5;}

</style>