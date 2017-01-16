
<div class="right-contant">
  <div class="top-slider">
	<?php
	if(!empty($home_page_videos))
	{
	?>
	
<?php
	
	echo $this->Html->css('Front/application');?>
		
	
	<div id="mantle_skin">
	<div id="carousel_and_background">
<div id="carousel">
	<div class="dark_wrapper">
		<div class="content" id="streams_box">
			<div class="focus c8">
				
				<div class="live_frontpage_player_container swf_container js-player-container player-container" id="video-1" style="height:349px">	
				<video style="width:100%;height:100%;float:left" autoplay src="<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" 
				id="player1"  
				controls="controls" preload="none"></video>
				</div>
			</div>
			<ul class="items grid c4 last">
				<li data-channel="sypherpk" data-game="Overwatch" data-scheduled="true" style="display: list-item;" class="active">
					<div class="meta">
					
					<?php
					$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.PROFILE_IMAGE_FULL_DIR."/";
					$recording_image		=	$recorded_stream_detail['User']['profile_image'];
					if($recording_image) {
					?>
						<a class="pic js-channel_discovery_link" href="" data-tt_medium="twitch_home" data-tt_content="carousel">
							<img class="p36" src="<?php echo $recordingPath.$recording_image; ?>" title="<?php echo $recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name']  ?>" alt="<?php echo $recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name']  ?>" />
						</a>
					<?php
					}				
					?>
					<h5 class="name"><?php echo $recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name']?></h5>
					
					</div>
					<h2>
						<a class="js-channel_discovery_link" href="" data-tt_medium="twitch_home" data-tt_content="carousel"><?php echo $recorded_stream_detail['Channel']['name'] ?></a>
					</h2>
					<div class="desc js-channel_discovery_desc">
						<p></p><p><?php echo $recorded_stream_detail['RecordingStream']['description']?></p>
						<br>
						<p>
						<?php echo $this->Html->link('Click here',array('controller'=>'streams','action'=>'recorded_stream_detail',$recorded_stream_detail['RecordingStream']['id']),array('alt'=>$recorded_stream_detail['RecordingStream']['title'],'title'=>$recorded_stream_detail['RecordingStream']['title'],'escape'=>false)); ?>
						
						to watch and chat!</p>

						<p><a href="partnerships,recurring" data-tt_medium="twitch_home" data-tt_content="carousel"></a></p>
						<p></p>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="nav">
		<ul class="c12">		
				<?php
	if(!empty($home_page_videos))
	{
		foreach($home_page_videos as $key=>$value)
		{ 
		?>
			<li class="c2 grid js-carousel-nav" original-title="2GGaming">
				<?php
				$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
				$recording_image		=	$value['RecordingStream']['image'];
				if($recording_image) {
				?>
					<a class="image" onclick="getdetail(<?php echo $value['RecordingStream']['id'] ?>)" data-channel="2ggaming" data-game="Super Smash Bros. for Wii U" data-scheduled="true">
					<img src="<?php echo $recordingPath.$recording_image; ?>" title="<?php echo $value['RecordingStream']['title']  ?>" alt="<?php echo $value['RecordingStream']['title']  ?>" />
					</a>					
				<?php
				}				
				?>
			</li>
		<?php
		}
	}
	else
	{
	?>
	<li>No video found.</li>
	<?php
	}
	?>
		</ul>
	</div>
	<div id="carousel_background">
		<img alt="Carousel Background" data-placeholder="https://static-cdn.jtvnw.net/ttv-platforms/background-art/404_backgroundart.jpg" onerror="BoxartImage.setPlaceholder(this);" src="https://static-cdn.jtvnw.net/ttv-platforms/background-art/404_backgroundart.jpg">
	</div>
</div>
</div>
</div>
	
	
	
	<?php
	}
	?>
  </div>
  <div class="channels-slide">
	<?php
	if(!empty($channels))
	{
		/* pr($streams);
		die; */
	?>
    <h2>FEATURED CHANNELS</h2>
    <section class="channels slider">
	<?php
/*       <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div> */
	  ?>
	  <?php
			foreach($channels as $key=>$value)
			{
				$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
				$channel_image		=	$value['Channel']['image'];
				//echo WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$channel_image;
				
				
				
				//if($channel_image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$channel_image )) {
				if($channel_image) {
				?>
					<div>
						<?php
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$value['Channel']['name'],'title'=>$value['Channel']['name'],'class'=>'imgClass')),array('controller'=>'channels','action'=>'channel_detail',$value['Channel']['id']),array('escape'=>false,'alt'=>$value['Channel']['name'],'title'=>$value['Channel']['name'])); 
							
						?>
					</div>
				<?php	
					//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
				}
			}
		}	
	  ?>
    </section>
  </div>
  <div class="channels-slide streams01">
	<?php
	if(!empty($streams))
	{
		/* pr($streams);
		die; */
	?>
		<h2>FEATURED STREAMS</h2>
		<section class="streams slider">
		
			<?php
			foreach($streams as $key=>$value)
			{
				$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
				$stream_image		=	$value['Stream']['stream_image'];
				//echo WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_image;
				
				
				
				//if($stream_image &&  file_exists(WWW_ROOT.STREAM_IMAGE_FULL_DIR.DS.$stream_image )) {
				if($stream_image) {
				?>
					<div>
				<?php
				
				$image_url = SITE_URL.'/uploads/stream_images/'.$stream_image;
				//echo $this->Html->image($image_url, array('class'=>'imgClass'));
					echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$value['Stream']['id']),array('escape'=>false,'alt'=>$value['Stream']['title'],'title'=>$value['Stream']['title'])); 
				?>
					</div>
				<?php	
					//echo $this->Image->resize($imagePath.$image, 60, 60,array(),100);
				}
			}
			?>
		 <?php /* <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
		  <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div> */ ?>
		</section>
	<?php
	}
	?>
	<?php
/*     <div class="home-contant">
      <div class="left-video"><?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div class="right-text">
        <h2>LIVESTREAM SEMINAR </h2>
        <h4>COURSE 1 - LEARN TO BE THE BEST</h4>
        <h6> 2h 34m  /  23 March 2009 <?php echo ($this->Html->image('Front/like.png')); ?></h6>
        <p>Our trustworthy boys from the New York Stock Exchange guide you through the wisdom of a Monthly 
          Investment Plan, with the it’s important to do research before choosing how to invest, as there are.
          ur trustworthy boys from the New York Stock Exchange guide you through the wisdom of a Monthly 
          Investment Plan, with the it’s important to do research before choosing how to invest, as there are.<br />
          <br />
          <span>Cast:</span> George Kush, Phil DeBalls,  Summer Hautehed<br />
          <span>Director:</span> George Burns</p>
        <div class="share_links">
          <ul>
            <li><a href=""><?php echo ($this->Html->image('Front/video_icn.jpg')); ?></a></li>
            <li><a href=""><?php echo ($this->Html->image('Front/heart_icn.jpg')); ?></a></li>
            <li><a href=""><?php echo ($this->Html->image('Front/share_icn.jpg')); ?></a></li>
          </ul>
        </div>
      </div>
    </div> */ ?>
  </div>
  <?php
 /*  <div class="channels-slide seminars">
    <h2>FEatured Seminars</h2>
    <section class="streams slider">
      <div> <?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div> <?php echo ($this->Html->image('Front/slide_img.jpg')); ?> </div>
      <div><?php echo ($this->Html->image('Front/slide_img.jpg')); ?> </div>
      <div> <?php echo ($this->Html->image('Front/slide_img.jpg')); ?></div>
      <div> <?php echo ($this->Html->image('Front/slide_img.jpg')); ?> </div>
    </section>
  </div> */
  ?>
</div>


<script>

function getdetail(id)
{
	$('#loading_strip_img').css('visibility','visible');	
   $.ajax({
     type: "POST",
     url: "<?php echo $this->Html->url(array("controller"=>"homes","action"=>"live_stream")) ;?>",
     data: "id=" + id, // appears as $_GET['id'] @ your backend side
     success: function(data) {         
          $('#streams_box').html(data);
     }
   });

}
</script>