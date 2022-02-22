<?php 

	include ("ajax_config.php");
	
	$d->reset();
	$sql_video = "select id,ten$lang as ten,link from #_video where hienthi=1 order by stt,id desc";
	$d->query($sql_video);
	$video = $d->result_array();
	
?>
<div class="flexwb">
<div class="video_popup1 left_video" style="position: relative;">
	<img src="thumb/404x270/1/images/no.png" alt="" style="opacity: 0;width: 100%;">
	<iframe title="<?=$video[0]['ten']?>" width="100%" src="https://www.youtube.com/embed/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[0]['link'], $matches);echo $matches[1];?>" frameborder="0" allowfullscreen></iframe>
</div>

<script>
    $(document).ready(function(){
      $('.video-info ul').slick({
            lazyLoad: 'ondemand',
            infinite: true,//Hiển thì 2 mũi tên
            accessibility:true,
            vertical:false,//Chay dọc
            //fade: true,//Hiệu ứng fade của slider
            slidesToShow: 3,    //Số item hiển thị
            slidesToScroll: 1, //Số item cuộn khi chạy
            autoplay:true,  //Tự động chạy
            autoplaySpeed:1500,  //Tốc độ chạy
            arrows:false, //Hiển thị mũi tên
            centerMode:false,  //item nằm giữa
            dots:false,  //Hiển thị dấu chấm
            draggable:true,  //Kích hoạt tính năng kéo chuột
			responsive: [{
				breakpoint: 320,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					infinite: true
				}
			}]
      });
    });
</script>
<div class="video-info khung_chay">
	<ul>
		<?php for($i=0,$count_video=count($video);$i<$count_video;$i++){?>
		<?php
		    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[$i]['link'], $matches);
		    $id_video =	$matches[1];
		?>
		<li style="display: block;width: calc(100% - 10px);margin: 0 5px;border: none !important;">
			<a href="<?=$id_video?>" class="run-video" style="width: 100%;overflow: hidden; position: relative;display: block;">
				<img src="./images/img/play.png" alt="Play video" style="position:absolute;top:0;left:0;right:0;bottom:0;margin:auto;transform:scale(1);z-index: 2;">
				<img src="thumb/128x93/1/images/no.png" alt="" style="opacity: 0;width: 100%;">
				<img src="https://img.youtube.com/vi/<?php preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video[$i]['link'], $matches);echo $matches[1]; ?>/0.jpg" width="100%" border="0" class="hinhvd"/>
			</a>
		</li>
		<?php } ?> 
	</ul>
	<div class="clear"></div>
</div>
</div>
<script>
	$(document).ready(function(e) {
		 $('#clickvideo').change(function(){
			var src = 'https://www.youtube.com/embed/'+$(this).val();
			$('.left_video iframe').attr('src',src);
		});
		 $('.run-video').click(function() {
		 	var src = 'https://www.youtube.com/embed/' + $(this).attr('href');
		 	$('.left_video iframe').attr('src', src);
		 	return false;
		 });
    });
</script>