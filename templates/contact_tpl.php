<h1 class="tieude_giua"><?=$title_cat?></h1>
<div class="w_contact clear">
    <div class="content11">
    <?=$row_detail['noidung']?></div>
    <div class="frm_lienhe">
        <form method="post" name="frm" class="frm" action="lien-he" enctype="multipart/form-data">
            <div class="loicapcha thongbao"></div>
            <div class="item_lienhe clear">
                <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                <input name="ten_lienhe" type="text" id="ten_lienhe" placeholder="<?=_hovaten?>" />
            </div> 
            <div class="item_lienhe clear">
                <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                <input name="diachi_lienhe" type="text" id="diachi_lienhe" placeholder="<?=_diachi?>" />
            </div>
            <div class="item_lienhe clear">
                <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                <input name="dienthoai_lienhe" type="text" id="dienthoai_lienhe" placeholder="<?=_dienthoai?>" />
            </div>
            <div class="item_lienhe clear">
                <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                <input name="email_lienhe" type="text" id="email_lienhe" placeholder="<?=_email?>" />
            </div>
            <div class="item_lienhe clear">
                <div class="icon"><i class="fa fa-location-arrow" aria-hidden="true"></i></div>
                <input name="tieude_lienhe" type="text" id="tieude_lienhe" placeholder="<?=_chude?>" />
            </div>

            <div class="item_lienhe">
                <textarea name="noidung_lienhe" id="noidung_lienhe" rows="5" placeholder="<?=_noidung?>"></textarea>
            </div>
            <div class="item_lienhe">
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            </div>
            <div class="item_lienhe">
                <input type="button" value="<?=_gui?>" class="click_ajax mauw" />
                <input type="button" value="<?=_nhaplai?>" class="mauw" onclick="document.frm.reset();" />
            </div>
        </form>
    </div>
</div>
<div class="bando"><?=$company['code_bando']?></div>