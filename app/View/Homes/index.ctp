<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "3c404603-90e8-4032-8931-fe478ae2f807",embeds:'true', doNotHash: false, doNotCopy: false, hashAddressBar: false,onhover: false,shorten:false});</script>

<div class="right-contant"> 
<div class="main_contaner home_top">
  <div class="home-top-whole">	
	<div class="flase_msg">
		<?php echo $this->Session->flash(); ?>
	</div>
	<?php
	/* if(!empty($home_page_stream_detail))
	{ */
	?>
	  <div class="home-top-sec">
	  <div class="home-top-sec1">
		<div class="row" id="streams_box">
			<?php 
			$home_page_video_count = count($home_page_videos);
			$home_page_stream_count = count($home_page_streams);
			if($home_page_stream_count>0)
			{
				$type="stream";
			}
			elseif($home_page_video_count>0)
			{
				$type="video";
			}
			echo $this->Element('Front/Streams/home_page_video_stream',array('type'=>$type));
			
			?>
		</div>
	  </div>
	</div>
  <?php
  
 /*  } */
  ?>
  </div>
  <div class="channels-slide slide_imgess slider_box">
	<?php
	
	if(!empty($home_page_streams) || !empty($home_page_videos))
	{
	?>    

    <section class="streams slider fslider">
	
	  <?php
			if(!empty($home_page_streams))
			{
				foreach($home_page_streams as $key=>$value)
				{
					
					$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
					$stream_image		=	$value['Stream']['stream_image'];
					$thumbnail_url = $this->Layout->get_live_channels_images($value['Stream']['stream_key']);
					$check_live_stream = @fopen($thumbnail_url['live_stream']['thumbnail_url'],'r');
					
					
					if(!empty($thumbnail_url['live_stream']['thumbnail_url']) && $check_live_stream)
					{
					?>
					<div class='recorded_streams_box'>
					
					<a  onclick = "getdetail('stream','<?php echo $value['Stream']['id'] ?>')" alt="<?php echo $value['Stream']['title'] ?>" title="<?php  echo $value['Stream']['title']?>" href="javascript:;"><img style="height:150px !important;" src="<?php echo $thumbnail_url['live_stream']['thumbnail_url']; ?>"  alt="<?php echo $value['Stream']['title'] ?>" title="<?php  echo $value['Stream']['title']?>"/></a>
					
					</div>
					<?php	
					}	
					else if($stream_image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_image )) { ?>
					
						<div class='recorded_streams_box'>
							<?php 
							// 208*117
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=280&h=160&a=t',array('class'=>'test','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])),'javascript:;',array("onclick"=>"getdetail('stream','".$value['Stream']['id']."')",'escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title']));
							?>	
						</div>					
						<?php
					
					} else {
					?>
					<div class='recorded_streams_box'>
					<?php
						// 208*117
						echo $this->Html->link($this->Html->image('Front/home_top_th.jpg',array('width'=>'280','height'=>'160','class'=>'','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])),'javascript:;',array("onclick"=>"getdetail('stream','".$value['Stream']['id']."')",'escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])); 	
						?>
						</div>		
						<?php
					}		
				}
			}
			if(!empty($home_page_videos))
			{
			
				foreach($home_page_videos as $key=>$value)
				{
					$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
					$recording_image		=	$value['RecordingStream']['image'];
					
					
					if($recording_image &&  file_exists(WWW_ROOT.RECORDING_IMAGE_FULL_DIR.DS.$recording_image )) { ?>
					
						<div class='recorded_streams_box'>
							<?php
							// 208*117
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=160&a=t',array('class'=>'test','alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'])),'javascript:;',array("onclick"=>"getdetail('video','".$value['RecordingStream']['id']."')",'escape'=>false,'alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title']));
							?>	
						</div>					
						<?php
					
					} else {
					?>
					<div class='recorded_streams_box'>
					<?php
						// 208*117
						echo $this->Html->link($this->Html->image('Front/home_top_th.jpg',array('width'=>'280','height'=>'160','class'=>'','alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'])),'javascript:;',array("onclick"=>"getdetail('video','".$value['RecordingStream']['id']."')",'escape'=>false,'alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'])); 	
						?>
						</div>		
						<?php
					}		
				}
			
			}	
		}	
	  ?>
    </section>
  </div>  
  </div> 
	<?php /* 
  <div class="channels-slide see_all">
	<?php
	if(!empty($popular_channels))
	{
	?>
    <h2>POPULAR CHANNELS</h2>
	
    <section class="channels slider">	
	  <?php
			foreach($popular_channels as $channel_key=>$channel_value)
			{
				$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
				$channel_image		=	$channel_value['Channel']['image'];
				
				//if($channel_image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$channel_image )) {
				if($channel_image) {
				?>
					<div>
						<?php
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'],'class'=>'imgClass')),array('controller'=>'channels','action'=>'channel_detail',$channel_value['Channel']['id']),array('escape'=>false,'alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'])); 
						?>
						<span>
						<?php
							echo $this->Html->link($channel_value['Channel']['name'],array('controller'=>'channels','action'=>'channel_detail',$channel_value['Channel']['id']),array('escape'=>false,'alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'])); 
						?>
						</span>
					</div>
				<?php	
					//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
				}
			}
		}	
	  ?>
    </section>
	
	<div class="browse-this">
		<h4>
			<?php
			echo $this->Html->link('See all Channels',array('controller'=>'channels','action'=>'index'),array('escape'=>false,'alt'=>'Channels','title'=>'Channels')); 
			?><i class="arrow_btn glyphicon glyphicon-menu-right"></i>			
		</h4>
	</div>
  </div>  */?>

   <div class="channels-slide see_all headding_small">
	<?php
	if(!empty($streams))
	{
	?>
		<h2>POPULAR CHANNELS &nbsp;&nbsp;<span><?php echo Configure::read("HOME_PAGE_POPULAR_CHANNEL_LABEL"); ?></span></h2>
		 <section class="streams slider fslider">	
			 <?php
			foreach($popular_channels as $channel_key=>$channel_value)
			{
				$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
				$channel_image		=	$channel_value['Channel']['image'];
				
				//if($channel_image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$channel_image )) {
				if($channel_image) {
				?>
					<div class='popular_channels_box'>
						
						<?php 				
						if($channel_image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$channel_image )) {
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'],'class'=>'imgClass popular_channel_tab')),'javascript:;',array("onclick"=>"popular_channels_detail('".$channel_value['Channel']['id']."')",'escape'=>false,'alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'],'name'=>$channel_value['Channel']['id'])); 
						} else {					
							
							echo $this->Html->link($this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>'')),'javascript:;',array("onclick"=>"popular_channels_detail('".$channel_value['Channel']['id']."')",'escape'=>false,'alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'],'name'=>$channel_value['Channel']['id']));
						}

						?>
						<span>
							<?php 				
							echo $this->Html->link($channel_value['Channel']['name'],'javascript:;',array("onclick"=>"popular_channels_detail('".$channel_value['Channel']['id']."')",'escape'=>false,'alt'=>$channel_value['Channel']['name'],'title'=>$channel_value['Channel']['name'],'name'=>$channel_value['Channel']['id']));
							?>	
						</span>
					</div>
				<?php	
					//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
				}
			}
		
	  ?>

		</section>
		<div  class="collapse scroll_box">		
			<?php   echo $this->Element('Front/Channel/home_page_popular_channel');?> 
		</div>
	<div class="browse-this">
		<h4>
			<?php
			echo $this->Html->link('See all Channels',array('controller'=>'channels','action'=>'index'),array('escape'=>false,'alt'=>'Channels','title'=>'Channels')); 
			?><i class="arrow_btn glyphicon glyphicon-menu-right"></i>			
		</h4>
	</div>
		
	<?php }	?>

	
  </div>
<?php /* 

   <div class="channels-slide">
	<?php
	if(!empty($streams))
	{
	?>
		<h2>FEATURED STREAMS</h2>
		 <section class="streams slider fslider">		
			<?php
			foreach($streams as $key=>$value)
			{
				$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
				$stream_image		=	$value['Stream']['stream_image'];
				if($stream_image) {	?>
				<div class='featured_streams_box'>
				
					<?php 				
					echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'class'=>'imgClass')),'javascript:;',array("onclick"=>"featured_streams_detail('".$value['Stream']['id']."')",'escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'name'=>$value['Stream']['id']));
					?>
				</div>
				
				
			<?php 					
				}
			}
			?>
		</section>
		
	<?php }	?>

		<div  class="collapse">
	     <?php   echo $this->Element('Front/Streams/featured_streams_details');?> 
		</div>
  </div>
  */ ?>

	<div class="channels-slide see_all headding_small">
	<?php
	if(!empty($featured_categories))
	{
	?>
    <h2>FEATURED CATEGORIES&nbsp;&nbsp;<span><?php echo Configure::read("HOME_PAGE_FEATURE_CATEGORY_LABEL"); ?></span></h2>
    <section class="channels slider">
	
	  <?php
			foreach($featured_categories as $categories_key=>$categories_value)
			{
				$categoryPath		=	IMAGE_PATH_FOR_TIM_THUMB.CATEGORY_IMAGE_FULL_DIR."/";
				$category_image		=	$categories_value['Category']['image'];			
				if($category_image) {
				?>
					<div>
						<?php
							if($category_image &&  file_exists(WWW_ROOT.CATEGORY_IMAGE_FULL_DIR.DS.$category_image )) {
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$categoryPath.$category_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$categories_value['Category']['name'],'title'=>$categories_value['Category']['name'],'class'=>'imgClass')),array('controller'=>'categories','action'=>'category_detail',$categories_value['Category']['id']),array('escape'=>false,'alt'=>$categories_value['Category']['name'],'title'=>$categories_value['Category']['name'])); 
						} else {					
						
							echo $this->Html->link($this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>'')),array('controller'=>'categories','action'=>'category_detail',$categories_value['Category']['id']),array('escape'=>false,'alt'=>$categories_value['Category']['name'],'title'=>$categories_value['Category']['name'])); 
						}
						?>
						<span>
						<?php
							echo $this->Html->link($categories_value['Category']['name'],array('controller'=>'categories','action'=>'category_detail',$categories_value['Category']['id']),array('escape'=>false,'alt'=>$categories_value['Category']['name'],'title'=>$categories_value['Category']['name'])); 
							
						?>
						</span>
					</div>
				<?php	
					
				}
			}
			
	  ?>
    </section>
	<div class="browse-this">
		<h4>
			<?php
			echo $this->Html->link('See All Categories',array('controller'=>'categories','action'=>'index'),array('escape'=>false,'alt'=>'categories','title'=>'categories')); 
			?><i class="arrow_btn glyphicon glyphicon-menu-right"></i>			
		</h4>
		
	</div>
	<?php } ?>
  </div>
	<div class="home_social_news">
	<p>Follow the latest Yoohcan news </p>
	<p>
	<?php
	if(!empty(Configure::read('FACEBOOK_LINK')))
	{	
	?>
	<a href="<?php echo Configure::read('FACEBOOK_LINK'); ?>">FACEBOOK</a>
	<?php
	}
	if(!empty(Configure::read('TWITTER_LINK')))
	{	
	?>
	<a href="<?php echo Configure::read('TWITTER_LINK'); ?>">TWITTER</a>
	<?php
	}
	if(!empty(Configure::read('LINKDIN_LINK')))
	{
	?>
	<a href="<?php echo Configure::read('LINKDIN_LINK'); ?>">LINKEDIN</a>
	<?php
	}
	if(!empty(Configure::read('INSTAGRAM_LINK')))
	{
	?>
	<a href="<?php echo Configure::read('INSTAGRAM_LINK'); ?>">INSTAGRAM</a>
	<?php
	}
	?>
	</p>
	</div>

  
  <div class="channels-slide streams01 see_all headding_small">
	<?php
	if(!empty($upcoming_streams))
	{
	?>
    <h2>UPCOMING STREAMS&nbsp;&nbsp;<span><?php echo Configure::read("HOME_PAGE_UPCOMING_STREAM_LABEL"); ?></span></h2>
    <section class="channels slider">
	
	  <?php
			foreach($upcoming_streams as $key=>$value)
			{
				$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
				$stream_image		=	$value['Stream']['stream_image'];			
				if($stream_image) {
				?>
					<div>
						<?php
							if($stream_image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_image )) {
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title']));  
						} else {					
						
							
							echo $this->Html->link($this->Html->image('Front/channel-img.jpg',array('escape'=>false,'alt'=>'No Image','class'=>'')),array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])); 
							
							
						}
						
							
						?>
						<span>
						<?php
							echo $this->Html->link($value['Stream']['title'],array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])); 
							
						?>
						</span>
					</div>
				<?php	
					
				}
			}
			
	  ?>
    </section>
	<div class="browse-this">
		<h4>
			<?php
			echo $this->Html->link('See All Upcoming Streams',array('controller'=>'streams','action'=>'upcoming_streams_listing'),array('escape'=>false,'alt'=>'Upcoming Streams','title'=>'Upcoming Streams')); 
			?><i class="arrow_btn glyphicon glyphicon-menu-right"></i>			
		</h4>
	</div>
  </div>
  <?php } ?>
  
  <div class="channels-slide streams01 see_all">
	<?php
	if(!empty($live_channels))
	{
	?>
    <h2>LIVE CHANNELS</h2>
    <section class="channels slider">
	
	  <?php
			foreach($live_channels as $channel_key=>$channel_value)
			{
				$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
				$stream_image		=	$channel_value['Stream']['stream_image'];			
				//if($stream_image) {
				$thumbnail_url = $this->Layout->get_live_channels_images($channel_value['Stream']['stream_key']);
					
					
				
				?>
					<div>
						<?php
						
							
							$check_live_stream_image = @fopen($thumbnail_url['live_stream']['thumbnail_url'],'r');
							if(!empty($thumbnail_url['live_stream']['thumbnail_url']) && $check_live_stream_image)
							{
							
							?>
							<a  alt="<?php echo $channel_value['Stream']['title'] ?>" title="<?php  echo $channel_value['Stream']['title']?>" href="<?php echo $this->Html->url(array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id'])); ?>"><img style="height:118px !important;" width="280" src="<?php echo $thumbnail_url['live_stream']['thumbnail_url']; ?>"  alt="<?php echo $channel_value['Stream']['title'] ?>" title="<?php  echo $channel_value['Stream']['title']?>"/></a>
							<?php
								/* echo $streamPath.$stream_image;
								echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$thumbnail_url['live_stream']['thumbnail_url'].'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'])); */
							
							
							}
							else
							{
								echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'])); 
							
								//echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title']));
							}
							// 
							
						?>
						<span>
						<?php
							echo $this->Html->link($channel_value['Stream']['title'],array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'])); 
							
						?>
						</span>
					</div>
				<?php	
					
				//}
			}
		}	
	  ?>
    </section>
	<?php
	if(!empty($live_channels))
	{
	?>
	<div class="browse-this">
		<h4>
			<?php
			echo $this->Html->link('See All Live Channels',array('controller'=>'channels','action'=>'live_channels'),array('escape'=>false,'alt'=>'Live Channels','title'=>'Live Channels')); 
			?><i class="arrow_btn glyphicon glyphicon-menu-right"></i>			
		</h4>
	</div>
	<?php } ?>
  </div>
  
  
  
  
  
  
</div>
<?php echo ($this->element('Front/footer'))?>


<script type="text/javascript">
	
	$(document).ready(function(){
	
		<?php
			
		$bannerPath = IMAGE_PATH_FOR_TIM_THUMB.BANNER_IMAGE_FULL_DIR."/";

		
	
		if($banner_image) {
			
			$image_url = SITE_URL.'/timthumb.php?src='.$bannerPath.$banner_image.'&w=1645&h=550&a=t';
			// $image_url = SITE_URL.'/img/Front/banner-img.jpg';
		
			// echo'<pre>';print_r($channelPath);die;
			
		}
		else
		{
			$image_url = SITE_URL.'/img/Front/top_bg1.jpg';
			
			
		}
		$banner_image = "url($image_url)";
		?>
		banner_image = '<?php echo $banner_image  ?>';
		
		$(".home_top").css("background", banner_image);
		 $(".home_top").css("background-repeat", 'no-repeat');
		 //$(".home_top").css("background-center", 'background-size:cover');
		$(".home_top").css("backgound-size", 'cover');
		
		// 'background-repeat' : 'no-repeat'
	
	
	})
</script>




<script type="text/javascript">

	function video_player_align()
	{
		video_height = $("#dasboard_video").height();
		$(".play_pause_box").css('padding-top',parseInt(video_height/2) + 'px');
		$(".play_pause_btn").css('margin-top','-34px');
	}

	$( window ).resize(function() {
		video_player_align();
	});
	
	
	$(document).ready(function(){
		video_height = $("#player1").height();
		$(".left_box").css('height',video_height + 'px');
		
		video_player_align();
	})

	$(document).on('click',".play_pause_btn",function(){

		var myVideo=document.getElementById("player1"); 
		if (myVideo.paused)
		{
			$('.play_pause_box').css('display','none');
			myVideo.play();
		}
		else 
		{
			myVideo.pause(); 
		}
	})

</script>


<script type="text/javascript">


var myVideo=document.getElementById("player1"); 

function playPause()
{ 
	if (myVideo.paused)
	{

		$('.play_pause_box').css('display','none');
		myVideo.play();
	}
	else 
	{
		myVideo.pause(); 
	} 
}



function getdetail(type,id)
{
	
   $.ajax({
    type: "POST",
    url: "<?php echo $this->Html->url(array("controller"=>"homes","action"=>"get_home_page_video_stream_detail")) ;?>",
     data: {id:id,type:type}, // appears as $_GET['id'] @ your backend side
     success: function(data) {         
          $('#streams_box').html(data);
     }
   });

}

function popular_channels_detail(id){

 $.ajax({
   type: "POST",  
    url: "<?php echo $this->Html->url(array("controller"=>"homes","action"=>"popular_channels_detail")) ;?>",
     data:  {id:id},
	 async:false,
	 cache:false,
     success: function(data) {	 
			$('.collapse').html(data);
			
			
			var height = 600;
			$('.collapse').each(function(i, value){
				height += parseInt($(this).height());
			});			
			height += '';
			$('html,body').animate({scrollTop: height});
			
			
			//$('html,body').animate({ scrollTop: $('.collapse').offset().top - ( $(window).height() - $('.collapse').outerHeight(true) ) / 2  }, 200);
			
			
			
     }
  });
   
}
$(".popular_channels_box").click(function () {
	$(".popular_channels_box").removeClass("active");    
	$(this).addClass("active");   
	$( ".collapse" ).fadeIn("slow");		
	// $("html, body").animate({  scrollTop: $(document).height() },2000);
});

/*  function featured_streams_detail(id){

 $.ajax({
   type: "POST",  
    url: "<?php echo $this->Html->url(array("controller"=>"homes","action"=>"get_home_page_featured_stream_detail")) ;?>",
     data:  "id=" + id,
	 async:false,
	 cache:false,
     success: function(data) {	 
          $('.collapse~').html(data);
			if (typeof(stButtons) != "undefined") {
				stButtons.locateElements();
			}
		  
     }
   });
   
} */



// $('.featured_streams_box:first-child').addClass('active');
/* 	$(".featured_streams_box").click(function () {
		$(".featured_streams_box").removeClass("active");    
		$(this).addClass("active");   
		$( ".collapse" ).fadeIn("slow");		
		// $("html, body").animate({  scrollTop: $(document).height() },2000);
	}); */
	
	$(".recorded_streams_box").click(function () {
		$(".recorded_streams_box").removeClass("active"); 
		$(this).addClass("active");  		
		
	});


function followStream(stream_id,channel_id) { 	
			var url = SITE_URL + 'streams/follow_ajax';			
			var value = $('.followPostCl_' + stream_id).attr('rel');
		
			var stream_id = stream_id;
			var channel_id = channel_id;
			var status = value == 'Follow' ? '1' : '0';
			var param1 = new Object();
			param1.user_id = '<?php echo $this->Session->read('Auth.User.id'); ?>';
			param1.stream_id = stream_id;
			param1.channel_id = channel_id;
			param1.status = status;				
			$.ajax({
				url: '<?php echo $this->Html->url(array('controller'=>'streams','action'=>'follow_ajax')); ?>',
				type: "POST",
				async: false,
				data: {
					data: param1,
				},
				success: function (response) {
					if (value == 'Follow') {
							$('.followPostCl_' + stream_id).attr('rel', 'Following');
							// ""+SiteUrl+"/img/Front/heart-icn-green.png"
							
							$('.reposttext_' + stream_id).attr("src", ""+SiteUrl+"/img/Front/heart-icn-green.png")
								
						} else if (value == 'Following') {
							$('.followPostCl_' + stream_id).attr('rel', 'Follow');
							// $('.reposttext_' + stream_id).text('Follow');	
							$('.reposttext_' + stream_id).attr("src", ""+SiteUrl+"/img/Front/heart_icn.png")							
						}
					obj = jQuery.parseJSON(response);					
				},
				error: function (request, status, error) {
					alert(error);
				}
			});
		}





/* function subscribe_stream(){
			$.ajax({
				url: "<?php echo $this->Html->url(array("controller"=>"channels","action"=>"subscribe")) ;?>",
				type: "POST",
				async: false,
				data: {channel_id:'<?php echo $featured_stream_detail['Channel']['id']; ?>',stream_id:'<?php echo $featured_stream_detail['Stream']['id']; ?>'},
				success: function (data) {
								
				},
				
			});
		}  */


</script>

    