<script type="text/javascript">		
	$(document).ready(function() {
		$("#chonhet").click(function(){
			var status=this.checked;
			$("input[name='chon']").each(function(){this.checked=status;})
		});

		$('.chonngonngu li a').click(function(event) {
			var lang = $(this).attr('href');
			$('.chonngonngu li a').removeClass('active');
			$(this).addClass('active');
			$('.lang_hidden').removeClass('active');
			$('.lang_'+lang).addClass('active');
			return false;
		});
		$('#vnexpress').change(function() {
			var url_vnexpress = $(this).val();
			var type = $('#type').val();
			window.location.href = 'index.php?com=laytin&act=add&type='+type+'&url_vnexpress='+url_vnexpress;
		});

		$('#batdongsan').blur(function() {
			var url_bds = $(this).val();
			var type = $('#type').val();
			window.location.href = 'index.php?com=laytin&act=add&type='+type+'&url_bds='+url_bds;
		});
		$("#luu").click(function(){
	      var listid="";
	      var sty = '';
	      var type = "<?=$_REQUEST['type']?>";
	      $("input[name='chon']").each(function(){
	        if (this.checked) listid = listid+","+this.value;
	        })
	      listid=listid.substr(1);   //alert(listid);
	      if (listid=="") { alert("Bạn chưa chọn mục nào"); return false;}
	      hoi= confirm("Bạn có muốn lấy những mục đã chọn không?");

	      <?php if($_REQUEST['url_vnexpress']){ ?>
	      	sty = "&url_vnexpress=<?=$_REQUEST['url_vnexpress']?>";
	      <?php }else{ ?>
	      	sty = "&url_bds=<?=$_REQUEST['url_bds']?>";
	      <?php } ?>

	      if (hoi==true) document.location = "index.php?com=laytin&act=save&type=" + type + sty + "&listid=" + listid;
	    });

	});
</script>

<form name="supplier" id="validate" class="form" action="index.php?com=laytin&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">

	<div class="control_frm">
	    <div class="bc">
	        <ul id="breadcrumbs" class="breadcrumbs">
	        	<li><a href="index.php?com=laytin&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span>Cập nhật <?=$title_main?></span></a></li>
	        </ul>
	        <div class="clear"></div>
	    </div>
	</div>
	<div class="oneOne">
		<div class="oneTwo">
			<div class="widget mtop0">
				<div class="title"><img src="./images/icons/dark/record.png" alt="" class="titleIcon" />
					<h6>Thông tin bài viết</h6>
				</div>
			    <div class="formRow">
					<label>Chọn phân mục cần lấy</label>
					<div class="formRight">
						<select name="type" id="type" class="main_select select_box select_danhmuc">
							<option value="tin-tuc" <?php if($_REQUEST['type']=='tin-tuc') echo 'selected'; ?>>Tin tức</option>
						</select>
					</div>
					<div class="clear"></div>
				</div>

				<div class="formRow none">
					<label>Link Vnexpress</label>
					<div class="formRight">
						<select name="type" class="main_select select_box select_danhmuc" id="vnexpress">
							<option value="http://vnexpress.net/rss/tin-moi-nhat.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/tin-moi-nhat.rss') echo 'selected'; ?>>Tin mới nhất</option>
							<option value="http://vnexpress.net/rss/thoi-su.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/thoi-su.rss') echo 'selected'; ?>>Thơi sự</option>
							<option value="http://vnexpress.net/rss/the-gioi.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/the-gioi.rss') echo 'selected'; ?>>Thế giới</option>
							<option value="http://vnexpress.net/rss/kinh-doanh.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/kinh-doanh.rss') echo 'selected'; ?>>Kinh doanh</option>
							<option value="http://vnexpress.net/rss/giai-tri.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/giai-tri.rss') echo 'selected'; ?>>Giải trí­</option>
							<option value="http://vnexpress.net/rss/the-thao.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/the-thao.rss') echo 'selected'; ?>>Thể thao</option>
							<option value="http://vnexpress.net/rss/phap-luat.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/phap-luat.rss') echo 'selected'; ?>>Pháp luật</option>
							<option value="http://vnexpress.net/rss/giao-duc.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/giao-duc.rss') echo 'selected'; ?>>Giáo dục</option>
							<option value="http://vnexpress.net/rss/suc-khoe.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/suc-khoe.rss') echo 'selected'; ?>>Sức khỏe</option>
							<option value="http://vnexpress.net/rss/gia-dinh.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/gia-dinh.rss') echo 'selected'; ?>>Gia đình</option>
							<option value="http://vnexpress.net/rss/du-lich.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/du-lich.rss') echo 'selected'; ?>>Du lá»‹ch</option>
							<option value="http://vnexpress.net/rss/khoa-hoc.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/khoa-hoc.rss') echo 'selected'; ?>>Khoa học</option>
							<option value="http://vnexpress.net/rss/so-hoa.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/so-hoa.rss') echo 'selected'; ?>>so hoa</option>
							<option value="http://vnexpress.net/rss/oto-xe-may.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/oto-xe-may.rss') echo 'selected'; ?>>Oto xe máy</option>
							<option value="http://vnexpress.net/rss/cong-dong.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/cong-dong.rss') echo 'selected'; ?>>Cộng đồng</option>
							<option value="http://vnexpress.net/rss/tam-su.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/tam-su.rss') echo 'selected'; ?>>Tâm sự</option>
							<option value="http://vnexpress.net/rss/cuoi.rss" <?php if($_REQUEST['url_vnexpress']=='http://vnexpress.net/rss/cuoi.rss') echo 'selected'; ?>>Cưới</option>
						</select>
					</div>
					<div class="clear"></div>
				</div>
				
				<div class="formRow">
					<label>Link bất động sản</label>
					<div class="formRight">
						<input type="text" value="<?=$_REQUEST['url_bds']?>" id="batdongsan" name="link_bds" title="Link lấy từ website batdongsan.vn" class="tipS" />
					</div>
					<div class="clear"></div>
                    Note: copy 1 link <a target="_blank" href="https://batdongsan.com.vn/">https://batdongsan.com.vn/</a> của menu dán vào ô phía trên.<br  />
                    VD: https://batdongsan.com.vn/tin-thi-truong
				</div>
                
			</div>
		</div>
		<div class="oneOne">
			<div class="widget mtop0">
				<div class="title">
					<span class="titleIcon">
				    	<input type="checkbox" id="titleCheck" name="titleCheck" />
				    </span>
					<h6>Thông tin các tin</h6>
				</div>
			    <div class="formRow">
			    	<?php 
			    		if($_REQUEST['url_vnexpress']!=''){
			    		$url_page = $_REQUEST['url_vnexpress'];
			    		$arr = getXML($url_page);
			    		foreach ($arr['channel']['item'] as $k => $v) { ?>
					<div class="item_tin ">
						<input type="checkbox" name="chon" class="chon" value="<?=$k?>" style="margin:0;" id="chon_click<?=$k?>" /> <label for="chon_click<?=$k?>">&nbsp;&nbsp;<?=$k?>. <?=$v['title']?> <span style="color: #FF0000">[<?=$v['link']?>]</span></label>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
				<div class="clear1">
					<table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
			    	<?php 
			    	if($_REQUEST['url_bds']!=''){
			    		$url_page1 = $_REQUEST['url_bds'];// GET link
			    		//$arr1 = domXML($url_page1);
						$arr1 = getContent($url_page1);
						$html = str_get_html($arr1);
						$tins = $html->find('div.tintuc-row1');
						
			    		for($i=0;$i<count($tins);$i++) { 
							$tag_a = $tins[$i]->find('.link_blue',0);//truy cap vao the a
							$ten = $tag_a->innertext;//lay ten tin
							$tag_a1 = $tins[$i]->find('p',0);//truy cap vao the a
							$mota = $tag_a1->innertext;//lay ten tin
							$a_href = $tag_a->href;//lay href cua tin
						?>


					<tr class="item_tin">
						<td>
							<input type="checkbox" name="chon" class="chon" value="<?=$i?>" style="margin:0;" id="chon_click<?=$i?>" />
						</td>
						<td>
							<label for="chon_click<?=$i?>">&nbsp;&nbsp;<?=$i+1?>. <?=$ten?> <span style="color: #FF0000">[<?=$url_page1.$a_href?>]</span></label><br/>
							<label><?=$mota?></label>
						</td> 	
					</tr>
					<?php }//for ?>
					<?php } ?>
					</table>
				</div>
			</div>
		</div>
		<div class="oneOne">
			<div class="widget mtop0">
				<div class="formRow">
		        	<input type="button" class="blueB" name="luu" id="luu" value="Lưu" />
					<div class="clear"></div>
				</div>
			</div>
		</div>
   	</div>
</form>   