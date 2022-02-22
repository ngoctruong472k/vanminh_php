<div id="footer1">
	<table class="table_goidien mauw">
		<tbody>
			<tr>
				<td>
                	<a class="link_title blink_me show_info" title="<?=$seo['alt']?>"><img src="images/goidien.png" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>"> <?=_goidien?></a>
                	<div class="box-dienthoai clear">
                        <a href="tel:<?=replace_phone($company["dienthoai"])?>" title="<?=$company["dienthoai"]?>"><?=$company["dienthoai"]?></a>
                        <a href="tel:<?=replace_phone($company["hotline"])?>" title="<?=$company["hotline"]?>"><?=$company["hotline"]?></a>
                    </div>
				</td>
				<td>
                	<a class="link_title show_info" title="<?=$seo['alt']?>"><img src="images/tuvan.png" alt="<?=$seo['alt']?>" title="<?=$seo['alt']?>"> <?=_sms?></a>
        			<div class="box-dienthoai clear">
                        <a href="sms:<?=replace_phone($company["dienthoai"])?>" title="<?=$company["dienthoai"]?>"><?=$company["dienthoai"]?></a>
                        <a href="sms:<?=replace_phone($company["hotline"])?>" title="<?=$company["hotline"]?>"><?=$company["hotline"]?></a>
                    </div>
                </td>
				<td><a class="link_title" href="<?=$company["link"]?>" title="<?=$seo['alt']?>"><img src="images/chiduong.png" alt="<?=$seo['alt']?>"  title="<?=$seo['alt']?>"><?=_chiduong?></a>
				</td>
			</tr>
		</tbody>
	</table>
</div>