<div class="loading_login"  id="loading_strip_img" style="visibility:hidden">
		<?php echo $this->Html->image('ajax-loader.gif', array('title'=>'loading','alt'=>'loading','id'=>'loading-image')) ?>
</div>
<?php

if($type == 'stream')
{
?>
	<div class="col-md-8 strm-video-stream" id="dasboard_video">
		<div id='wowza_player' style="background:rgba(0, 0, 0, 0.4) none repeat scroll 0 0;"></div>
		<script id='player_embed' src='//player.cloud.wowza.com/hosted/<?php echo $home_page_stream_detail['Stream']['player_id']; ?>/wowza.js' type='text/javascript'></script>
	</div>
	<div class="col-md-4 left_box">
		<div class="meta" style="margin-top:10px;margin-bottom:10px;float:left;width:100%;">
		<?php
		$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
		$image		=	$home_page_stream_detail['User']['profile_image'];			
		if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
			echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=50&h=50&a=t',array('title'=>$home_page_stream_detail['User']['first_name'].' '.$home_page_stream_detail['User']['last_name'],'style'=>'margin:0.5rem 1rem 0 0;float:left;'));
		} else {					
			echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'class'=>'user-img','alt'=>$home_page_stream_detail['User']['first_name'].' '.$home_page_stream_detail['User']['last_name'],'style'=>'margin:0.5rem 1rem 0 0;float:left;','width'=>'50px','height'=>'50px','title'=>$home_page_stream_detail['User']['first_name'].' '.$home_page_stream_detail['User']['last_name']));
		}
		?>


		<h5  style="padding-top:29px;"><?php echo $home_page_stream_detail['User']['first_name'].' '.$home_page_stream_detail['User']['last_name']?></h5>
		<p class="playing"></p>
		</div>
		<div class="clearfix"></div>
		<h2>
		<?php
		echo $home_page_stream_detail['Stream']['title'];
		?>
		</h2>
		<p style="text-align:justify"><?php echo $home_page_stream_detail['Stream']['stream_bio']?><br />
		 </p>
		 
		 <p style="text-align:justify">
		 <?php
		echo $this->Html->link('Click here',array('controller'=>'streams','action'=>'stream_detail',$home_page_stream_detail['Stream']['id']),array('style'=>'color:#4b96aa;','escape'=>false,'alt'=>$home_page_stream_detail['Stream']['title'],'title'=>$home_page_stream_detail['Stream']['title']));
		?>
		  to watch and chat live with Level | Up!
		 </p>
	</div>
<?php
}
elseif($type=='video')
{
	
?>

	<div class="col-md-8 strm-video" id="dasboard_video">
	<?php 
	if($recorded_stream_detail['RecordingStream']['video_play_button_type'] == "0")
	{
	?>

			<video style="width:100%;height:auto;margin-left:0;" controls  src="<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" 
			id="player1"  
			controls="controls" preload="none" ></video>
		
	<?php
	}
	else
	{
	?>
			<video style="width:100%;height:auto;margin-left:0;" controls  src="<?php echo $recorded_stream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" 
			id="player1"  
			controls="controls" preload="none" autoplay></video>
	<?php

	}
	?>	
		<?php if($recorded_stream_detail['RecordingStream']['video_play_button_type'] == "0"){
		?>
		<div class="play_pause_box">

		<?php echo $this->Html->image('Front/play_btn_new.png', array('title'=>'play','alt'=>'play','class'=>'play_pause_btn')) ?>

		</div>
		<?php
		}?>
		
		
		
	<?php
	/* 	<?php echo ($this->Html->image('Front/strm-video.jpg')); ?>
	<span class="play_strm"><a href="#"><?php echo ($this->Html->image('Front/play-img.png')); ?></a></span>
	<div class="prosess_bar"><span class="active-prosess"></span></div> */
	?>
	</div>
	<div class="col-md-4 left_box">
	<div class="meta" style="margin-top:10px;margin-bottom:10px;float:left;width:100%;">



	<?php
	$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
	$image		=	$recorded_stream_detail['User']['profile_image'];			
	if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
		echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=50&h=50&a=t',array('title'=>$recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name'],'style'=>'margin:0.5rem 1rem 0 0;float:left;'));
	} else {					
		echo $this->Html->image('Admin/avatar5.png',array('escape'=>false,'class'=>'user-img','alt'=>$recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name'],'style'=>'margin:0.5rem 1rem 0 0;float:left;','width'=>'50px','height'=>'50px','title'=>$recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name']));
	}
	?>


	<h5  style="padding-top:29px;"><?php echo $recorded_stream_detail['User']['first_name'].' '.$recorded_stream_detail['User']['last_name']?></h5>
	<p class="playing"></p>
	</div>
	<div class="clearfix"></div>
	<h2>
	<?php
	echo $recorded_stream_detail['RecordingStream']['title'];
	?>

	</h2>
	<?php
	/* <h4>COURSE 1 - LEARN TO BE THE BEST</h4>
	<h6> 2h 34m  /  23 March 2009 <img src="images/like.png" alt="" /></h6> */
	?>
	<p style="text-align:justify"><?php echo $recorded_stream_detail['RecordingStream']['description']?><br />
	 </p>
	 
	 <p style="text-align:justify">
	 <?php
	echo $this->Html->link('Click here',array('controller'=>'streams','action'=>'recorded_stream_detail',$recorded_stream_detail['RecordingStream']['id']),array('style'=>'color:#4b96aa;','escape'=>false,'alt'=>$recorded_stream_detail['RecordingStream']['title'],'title'=>$recorded_stream_detail['RecordingStream']['title']));
	?>
	  to watch and chat live with Level | Up!
	 </p>
	</div>
<?php
}

?>
<script type="text/javascript">

$(document).ready(function(){

	video_player_align();
	function video_player_align()
	{
		video_height = $("#dasboard_video").height();
		$(".play_pause_box").css('padding-top',parseInt(video_height/2) + 'px');
		$(".play_pause_btn").css('margin-top','-34px');
	}

	$( window ).resize(function() {
		video_player_align();
	});
	
	
	video_height = $("#player1").height();
	$(".left_box").css('height',video_height + 'px');


})
</script>

