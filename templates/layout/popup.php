<?php if($popup['hienthi']==1 && $_SESSION['pupop']==false){?>
<div id="frm_popup" class="pupop_hien">
    <div class="khung_popup">
        <a class="close_popup">X</a>
        <div class="frame_popup">
	        <a href="<?=$popup['link']?>" title="<?=$company['ten']?>">
	        	<img src="<?=_upload_hinhanh_l.$popup['photo']?>" alt="<?=$company['ten']?>"/>
	        </a>
        </div>
    </div>
</div>
<?php $_SESSION['pupop']=true; } ?>

<script>
	$(document).ready(function(e) {
		$(".close_popup, #frm_popup").click(function(){
			$("#frm_popup").removeClass("pupop_hien");
			$("#frm_popup").addClass("pupop_an");
		})
    });
</script>