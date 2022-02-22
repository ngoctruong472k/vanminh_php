<?php if(count($support_online)!=0){?>
<div id="ser_onl">
	<div class="label_serv_onl active"><?=_hotrotructuyen?></div>
    <div class="cont_serv_onl" style="display: none;">
        <table width="100%">
			<tbody>  
                <?php foreach ($support_online as $key => $value) {?>
                <tr>
	                <td style="padding:3px">
                        <span class="name_supporter"><?=$value['ten']?></span>
                    </td>
	                <td style="padding:3px; text-align:center;">
                        <?php $get_yahoo=explode("@",$value['yahoo']);?>
                        <a href="ymsgr:sendim?<?=$value['yahoo']?>" class="yahoo_supporter"><img src="http://opi.yahoo.com/online?u=<?=$get_yahoo[0]?>&m=g&t=1" height="16"></a>
                        <a href="skype:<?=$value['skype']?>?call" class="skype_supporter"><img src="images/ic_skype.png" height="20"></a>
                    </td>
                </tr>
                <tr>
                    <td style="padding:3px">
                        <span class="phone_supporter"><i class="fa fa-phone"></i> <?=$value['dienthoai']?></span>
                    </td>
                    <td style="padding:3px">
                        <a href="mailto:<?=$value['email']?>" class="mail_supporter"><i class="fa fa-envelope"></i> <?=$value['email']?></a>
                    </td>
            	</tr>
                <?php }?>
        	</tbody>
    	</table>
    </div>
</div>
<?php }?>