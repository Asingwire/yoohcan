
<div class="home-contant popular_channels_ele_box">

	<?php 
	if(empty($home_page_recordinstream_detail['RecordingStream']['video_play_button_type']) && !isset($home_page_recordinstream_detail['RecordingStream']['video_play_button_type'])){ ?>
	<div class="left-video" id="popular_video">
			<video style="width:100%;height:auto;margin-left:0;" controls  src="" type="video/mp4" 
			id="popular_player1" controls="controls" preload="none" autoplay>			
			</video>
	</div>

	<?php }else{ ?>

      <div class="left-video  strm-video"  id="popular_video">
		<?php 
		if(isset($home_page_recordinstream_detail['RecordingStream']['video_play_button_type']) && $home_page_recordinstream_detail['RecordingStream']['video_play_button_type'] == "0")
		{
		?>

			<video style="width:100%;height:auto;margin-left:0;" controls  src="<?php echo $home_page_recordinstream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" id="popular_player1" controls="controls" preload="none" ></video>
			
			<div class="play_pause_popular_box heightCls" >
			<a style="padding-left: 15px;" href='javascript:;' onclick="viewerStream('<?php echo $home_page_recordinstream_detail['RecordingStream']['id'] ?>','<?php echo $home_page_recordinstream_detail['RecordingStream']['channel_id']; ?>')">
			<?php echo $this->Html->image('Front/play_btn_new.png', array('title'=>'play','alt'=>'play','class'=>'play_pause_popular_btn')) ?></a>
			</div>
			
		<?php
		}
		elseif(isset($home_page_recordinstream_detail['RecordingStream']['video_play_button_type']) && $home_page_recordinstream_detail['RecordingStream']['video_play_button_type'] == "1")
		{
		?>			
			<video style="width:100%;height:auto;margin-left:0;" controls  src="<?php echo $home_page_recordinstream_detail['RecordingStream']['download_url']; ?>" type="video/mp4" id="popular_player1" controls="controls" preload="none" autoplay></video>
		<?php
		}
		?>
	  </div>
	  
	  <?php } ?>
	  
      <div class="right-text">
        <h2><?php echo $popular_channels_detail['Channel']['name']?></h2>
        
        <?php /* <h6> 2h 34m  /   <?php echo date('d-M-Y',strtotime($popular_channels_detail['Channel']['created'])); ?> <?php //echo ($this->Html->image('Front/like.png')); ?></h6>  */?>
        <p><?php echo $popular_channels_detail['Channel']['bio']?>
          <br />		  
		<p style="text-align:justify">
			<?php
				echo $this->Html->link('Click here',array('controller'=>'channels','action'=>'channel_detail',$popular_channels_detail['Channel']['id']),array('style'=>'color:#4b96aa;','escape'=>false,'alt'=>$popular_channels_detail['Channel']['name'],'title'=>$popular_channels_detail['Channel']['name']));
			?>			
		</p>

		<?php 
	/* 	if($popular_channels_detail['ChannelFollower']['is_follow'] == 0){
			$relValWall = 'Follow';
			$heart_img = 'Front/heart_icn.png';
		}else{
			$relValWall = 'Following';
			$heart_img = 'Front/heart-icn-green.png';
		}  */
		?>

	   
      </div>
</div>
<script type="text/javascript">
	video_player_popular_align();
	function video_player_popular_align()
	{			
		video_height = $("#dasboard_video").height();
		$(".play_pause_popular_box").css('padding-top',parseInt(video_height/3.5) + 'px');
		$(".play_pause_popular_btn").css('margin-top','-30px');
		
	}
	
	$(document).ready(function(){
		video_player_popular_align();
	})		
	
	video_height = $("#player1").height();
	// alert(video_height);
	$(".left_box").css('height',video_height + 'px');
	
	$(document).on('click',".play_pause_popular_btn",function(){
		var myPopularVideo = document.getElementById("popular_player1"); 
		if (myPopularVideo.paused)
		{
			$('.play_pause_popular_box').css('display','none');
			myPopularVideo.play();
		}
		else 
		{
			myPopularVideo.pause(); 
		}
	})
	function playPause()
	{ 
		if (myPopularVideo.paused)
		{
			$('.play_pause_popular_box').css('display','none');
			myPopularVideo.play();
		}
		else 
		{
			myPopularVideo.pause(); 
		} 
	}	
</script>

	
