<div class="right-contant">
  
  <div class="channel_contant option02">
   <div class="full-width-banner full-width-banner-newcustom">
    <div class="home-contant">
      <div class="avtar">
     <!-- <a href="#"><img src="images/avtr.jpg" alt="" /></a>-->
	  
	  <?php
			if(!empty($categoryData)){
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CATEGORY_IMAGE_FULL_DIR.'/';
				$image		=	$categoryData['Category']['image'];			
				if($image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$image )) {
					echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=128&h=128&a=t',array('title'=>$categoryData['Category']['name'],'alt'=>$categoryData['Category']['name'],'class'=>''));
				} else {					
					echo $this->Html->image('Front/avtr.jpg',array('escape'=>false,'alt'=>'No Image','class'=>''));
				}
			}
		?>
		
      </div>
      <h2><?php if(!empty($categoryData['Category']['name'])){ echo $categoryData['Category']['name']; } ?></h2>
    </div>
   
   </div>

	<div class="header_title">
		<ul class="grib_contrl channel_tab">
		
		<li><?php
	
		echo $this->Html->link('Streams','javascript:;',array('id'=>'stream_link','escape'=>false,'class'=>'Grid View category_detail_tab_link category_stream_video_tab'));

		?></li>
		<li><?php echo $this->Html->link('Videos','javascript:;',array('id'=>'video_link','escape'=>false,'class'=>'List View category_detail_tab_link')) ?></li>

		</ul>
	</div>
	<div id="category_streams_videos_container" style="position:relative;min-height:115px">
		<?php echo ($this->element('Front/Category/ele_stream_videos'));?>
	</div>
    
  </div>
 
</div>
<?php echo ($this->element('Front/footer'))?>
<script type="text/javascript">
	
	$(document).ready(function(){
	
		<?php
		$categorybackImagePath		=	IMAGE_PATH_FOR_TIM_THUMB.CATEGORY_BACKGROUND_IMAGE_FULL_DIR."/";
		$category_background_image		=	$categoryData['Category']['background_image'];
		if($category_background_image) {
			//$banner_image = "url(http://localhost/yoohcan/img/Front/banner-img.jpg) repeat-x center bottom";
			$image_url = SITE_URL.'/timthumb.php?src='.$categorybackImagePath.$category_background_image.'&w=1645&h=550&zc=2';
			
		}
		else
		{
			$ch_url = SITE_URL.'/img/Front/banner-img.jpg';
			
			//$banner_image = "url(http://localhost/yoohcan/img/Front/banner-img.jpg) repeat-x center bottom";
		}
		$banner_image = "url($image_url)";
		?>
		banner_image = '<?php echo $banner_image  ?>';
		$(".full-width-banner").css("background", banner_image);
		
		// $("#category_streams_videos_container").html('<div class="loding_img"><img  "margin-top:50px;" src="'+SiteUrl+'img/ajax-loader.gif"></div>');
		
		$(".category_detail_tab_link").on('click',function(){
			tab_link = $(this).attr('id');
			
			$("#category_streams_videos_container").html('<div class="loding_img"><img  "margin-top:50px;" src="'+SiteUrl+'img/ajax-loader.gif"></div>');
			if(tab_link == 'video_link')
			{
				url = '<?php  echo $this->Html->url(array('controller'=>'categories','action'=>'category_detail_ajax_tab',$id,'type'=>'videos'));?>';
				$("#video_link").addClass('category_stream_video_tab');
				$("#stream_link").removeClass('category_stream_video_tab');
				
			}
			else
			{
				url = '<?php  echo $this->Html->url(array('controller'=>'categories','action'=>'category_detail_ajax_tab',$id,'type'=>'streams'));?>';
				$("#video_link").removeClass('category_stream_video_tab');
				$("#stream_link").addClass('category_stream_video_tab');
			}
			
			$.ajax({
			   url:url,
			   success: function(data)
			   {
				  $("#category_streams_videos_container").html(data); // show respsonse from the php script.
			   }
			});
		
		})
	
	})
</script>