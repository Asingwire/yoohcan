<div class="right-contant">
   <?php /* <span class="chat-slide"><?php echo $this->Html->link($this->Html->image('Front/open-chat.png'),'javascript:;',array('escape'=>false)); ?></span> */ ?>
  <div class="channels-slide streams01">
    <div class="bottom_recorded secound-option">
      <div class="row">
      <div class="streaming-mid col-md-8 streaming-mid-full">
      <div class="strem_vdo text-center">
	  <?php //echo $this->Html->image('Front/chat-video.jpg') ?>
	  
		<?php
		if(!empty($latest_live_stream))
		{ 
			
		?>

		<a id='dash_url' href='<?php echo $latest_live_stream['Stream']['stream_mpd_url']; ?>'></a>
		<a id='hls_url' href='<?php echo $latest_live_stream['Stream']['stream_hls_url']; ?>'></a>
		<a id='poster_url' href='<?php //echo $latest_live_stream['Stream']['image']; ?>'></a>
	  	
	  	<div class="player-wrapper">
		<div id="player"></div>
		</div>
			<script type="text/javascript">
		   		 var conf = {
		       				key:       "09ce9730-07fd-46ea-be09-210c0907d5bf",
		        			source: {
		          					dash:        "//bitmovin-a.akamaihd.net/content/MI201109210084_1/mpds/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.mpd",
		          					hls:         "//bitmovin-a.akamaihd.net/content/MI201109210084_1/m3u8s/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.m3u8"	
		          					//poster:      "//bitmovin-a.akamaihd.net/content/MI201109210084_1/poster.jpg"
		        			}
		    				};

		    	conf.source.dash = document.getElementById("dash_url").getAttribute("href");
				conf.source.hls = document.getElementById("hls_url").getAttribute("href");


		    	var player = bitmovin.player("player");
		    	player.setup(conf).then(function(value) {
		        // Success
		        console.log("Successfully created bitmovin player instance");
		        console.log(conf.source.dash);
		    			}, function(reason) {
		        // Error!
		        console.log("Error while creating bitmovin player instance");
		    			});
			</script>




		<?php
		}
		else
		{
			//echo "Please create stream first.";
			echo $this->Html->image('Front/offline_img3.png',array('alt'=>'offline','title'=>'offline'));
			
		}
		/* else if(!empty($latest_recorded_stream))
		{
		 */
		?>
			<?php
		/* 	<script src="jwplayer.js" type="text/javascript;"></script>
			<?php echo $this->Html->script('jwplayer/jwplayer'); ?>
			<script type="text/javascript;">jwplayer.key="HglrMHMi9wUmSJ+Jmc/zE1SekGmhSi61k4mISw==";</script>
			<div id="player"></div>
			<script type="text/javascript;">
			
			jwplayer("player").setup({
				file: "<?php echo $latest_recorded_stream['RecordingStream']['download_url']; ?>",  
				image: "http://www.yoohcan.tv/img/Front/slide_img.jpg",
				width: "100%",
				aspectratio: "12:5",
				autostart: true
			});

			</script> */
			?>
		<?php
		/* } */
		?>
	  </div>
    <h1>RELATED VIDEOS</h1>
	<?php
	if(!empty($related_recorded_stream))
	{
	?>
     <ul class="channel_list">
	
	<?php
	
		foreach($related_recorded_stream as $key=>$value)
		{
		?>
			<li>
			<?php 
				$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
				$recording_image		=	$value['RecordingStream']['image'];
				if($recording_image) {
				
					echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=158&a=t',array('title'=>$value['RecordingStream']['title'],'alt'=>$value['RecordingStream']['title'])),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('escape' => false,'title'=>$value['RecordingStream']['title'],'alt'=>$value['RecordingStream']['title']));
					
				}
				else
				{
					echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$value['RecordingStream']['id']),array('alt'=>$value['RecordingStream']['title'],'title'=>$value['RecordingStream']['title'],'escape'=>false));	
				}
			?>
			</li>
		<?php
		}
	?>
   </ul>
   <?php
   
	}
	else
	{
		echo $this->Element('no_record_found',array('message'=>'No videos found.')); 
	}
   ?>
    </div>
      <div class="col-md-4"></div>
      </div>
    </div>
    
  </div>

	
  

</div>
 <?php echo ($this->element('Front/footer'))?>