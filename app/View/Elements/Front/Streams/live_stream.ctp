<?php //pr($recorded_stream_detail);die; ?>
<div class="focus c8">
	<div class="loading_login"  id="loading_strip_img" style="visibility:hidden">
		<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
	</div>
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
		