<div class="right-contant">
  <?php  $this->Layout->sessionFlash(); ?>
  <div class="channels-slide option02">
   <div class="full-width-banner full-width-banner-custom" >
    <div class="home-contant">
      <div class="avtar">
      <?php
			if(!empty($channelData)){
				$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
				$image		=	$channelData['User']['profile_image'];			
				if($image &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$image )) {
					echo $this->Html->image(SITE_URL.'/timthumb.php?src='.$imagePath.$image.'&w=128&h=128&a=t',array('title'=>$channelData['User']['first_name'],'alt'=>$channelData['User']['first_name'],'class'=>''));
				} else {					
					echo $this->Html->image('Front/avtr.jpg',array('escape'=>false,'alt'=>'No Image','class'=>''));
				}
			}
		?>
		
      </div>
      <h2><?php if(!empty($channelData['Channel']['name'])){ echo $channelData['Channel']['name']; } ?></h2>
    </div>
   
   </div>
     <div class="home-contant">
      <div class="col-md-6 border">
        <h2>Channel BIO</h2>
        <!--<h4>COURSE 1 - LEARN TO BE THE BEST</h4>-->
        <p style="text-align:justify;"><?php if(!empty($channelData['Channel']['bio'])){ echo $channelData['Channel']['bio']; } ?><br />
          <br />
          <br />
          <?php if(!empty($channelData['Channel']['website'])){ 
			?>
			<a href="<?php echo $channelData['Channel']['website']; ?>"><?php $channelData['Channel']['website']; ?></a>
			<?php

		  } ?></p>
      </div>
      
      <div class="col-md-6 right_discription">
        <ul>
        <li class="viewer"><?php echo $channelData['Channel']['play_count']."&nbsp;Plays" ?></li>
		<?php if(isset($channelCountFollowData) && $channelCountFollowData >0 ){ ?>
        <li class="follower-green"><?php echo $channelData['Channel']['follower_count']."&nbsp;Followers" ?></li>
		<?php }else{ ?>
		 <li class="follower"><?php echo $channelData['Channel']['follower_count']."&nbsp;Followers" ?></li>
		<?php } ?>
		
		
			<?php
			if($this->Session->check('Auth.User.id'))
			{
				$user_id = $this->Session->read('Auth.User.id');
				if($user_id != $channelData['Channel']['user_id'] && $channelCountSubscriptionData == 0)
				{
			?>
				<li id="subscribe_channel_div" style="padding-left: 15px;">	
					<a href="javascript:;" id="subscribe_channel"><?php echo ($this->Html->image('Front/video_icn01.png')); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $channelData['Channel']['subscribe_count']."&nbsp;Subscribers" ?>					
				</li>
				<?php
				}
				elseif($user_id != $channelData['Channel']['user_id']  && $channelCountSubscriptionData > 0)
				{	?>
				
					<li id='subscribe_channel_div'><a style="padding-left: 15px;" href='javascript:;' onclick = stream_already_subscribe('<?php echo $channelData['Channel']['id']; ?>')><?php echo $this->Html->image("Front/video_icn_green.png") ?></a>&nbsp;&nbsp;<?php echo $channelData['Channel']['subscribe_count']."&nbsp;Subscribers"?></li>
					
				
					
			<?php }
			}
			else
			{
			?>
				<li>
					<a href="javascript:;" data-toggle="modal" data-target="#loginModal"><?php echo ($this->Html->image('Front/video_icn01.png')); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $channelData['Channel']['subscribe_count']."&nbsp;Subscribers" ?>
				</li>
			<?php	
			}
			?>

		
		
		<?php /* if(isset($channelCountSubscriptionData) && $channelCountSubscriptionData >0 ){ ?>
        <li class="subscriber-green"><?php echo $channelData['Channel']['subscribe_count']."&nbsp;Subscribers" ?><!--4k SUbscribers--></li>
       <?php }else{ ?>
        <li class="subscriber"><?php echo $channelData['Channel']['subscribe_count']."&nbsp;Subscribers" ?><!--4k SUbscribers--></li>
       <?php } */ ?>
		 
	   
		<?php if($this->Session->check('Auth.User.id') ){ ?>
		
			<script type="text/javascript">var switchTo5x=true;</script>
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "3c404603-90e8-4032-8931-fe478ae2f807",embeds:'true', doNotHash: false, doNotCopy: false, hashAddressBar: false,onhover: false,shorten:false});</script>
			<?php 
			$channelName ='';
			$channelBio ='';
			if(!empty($channelData['Channel']['name'])){ 
				$channelName = $channelData['Channel']['name']; 
			} 
			
			if(!empty($channelData['Channel']['bio'])){ 
				$channelBio = $channelData['Channel']['bio']; 
			} 
			
			
			$image		=	$channelData['Channel']['image'];	
			$imageProfile	=	$channelData['User']['profile_image'];	
			$imagePath	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.CHANNEL_IMAGE_FULL_DIR.'/';
			$imagePathProfile	=	IMAGE_PATH_FOR_TIM_THUMB.'/'.PROFILE_IMAGE_FULL_DIR.'/';
			
			if($image &&  file_exists(WWW_ROOT.CHANNEL_IMAGE_FULL_DIR.DS.$image )) {
				$shareImage = $imagePath.$image;
			} elseif($imageProfile &&  file_exists(WWW_ROOT.PROFILE_IMAGE_FULL_DIR.DS.$imageProfile )) 	  {
				$shareImage = $imagePathProfile.$imageProfile;
			}else{
				$shareImage = SITE_URL.'/img/logo.png';
			}
			
			?>
			 <a style="cursor:pointer;"> <span  style="color:#fff;" class="st_sharethis" st_title="<?php echo $channelName;  ?>" st_summary="<?php echo $channelBio;  ?>" st_image="<?php echo $shareImage; ?>"><li class="share">Share</li></span> </a>
			
			<?php
		  }else{
		 
				echo $this->Html->link(' <li class="share">SHARE</li>', 'javascript:;', array('escape'=>false,'class'=>'',"data-toggle"=>"modal" ,"data-target"=>"#loginModal","style"=>"color:#fff;" ));
			}
			?>
				<?php /* 
				<li class="donate">
				<?php
				//if(!empty($channelData['User']['UserDetail']['paypal_email']))
				//{
				if($this->Session->check('Auth.User.id') )
				{
				 echo $this->Html->link('Donate',array('controller'=>'channels','action'=>'donation',$channelData['Channel']['id']),array('class'=>'submit_button','escape'=>false));
				}
				//}
				?>

				</li>
				 */ ?>
        </ul>
      </div>
      
      <hr />
    </div>
    
    <div class="bottom_recorded">
      <div class="row">
      <div class="col-md-12 channel_contant">
		<h2>Recorded Videos</h2>
		<?php
		if( isset($channelData['RecordingStream']) && !empty($channelData['RecordingStream'])){
		?>
		<ul class="channel_list">
			<?php foreach($channelData['RecordingStream'] as $key => $val){	?>
			
			
			<li style="width:18%;margin-left:0px;margin-right:20px">
					<div>
						<?php
						$recordingPath		=	IMAGE_PATH_FOR_TIM_THUMB.RECORDING_IMAGE_FULL_DIR."/";
						$recording_image		=	$val['image'];
						if($recording_image) {							
						?>
						<?php echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$recordingPath.$recording_image.'&w=280&h=160&a=t',array('title'=>$val['title'],'alt'=>$val['title'])),array('controller'=>'streams','action'=>'recorded_stream_detail',$val['id']),array('escape' => false,'title'=>$val['title'],'alt'=>$val['title']));  ?>



						<?php						
						}
						else
						{
						echo $this->Html->link($this->Html->image('Front/channel-img.jpg'),array('controller'=>'streams','action'=>'recorded_stream_detail',$val['id']),array('alt'=>$val['title'],'title'=>$val['title'],'escape'=>false));	
						}
						?>		
				
					<span>
					
					<?php echo $this->Html->link(substr($val['title'], 0, 30),array('controller'=>'streams','action'=>'recorded_stream_detail',$val['id']),array('escape' => false,'title'=>$val['title'],'alt'=>$val['title'],'style'=>'color:#ffffff'));  ?>
				


					</span>
					</div>					
				</li>
			
			<?php } ?>		
		</ul>
		<?php
		}
		else
		{
			echo $this->Element('no_record_found',array('message'=>'No videos found.'));
		}	
		?>
		</div>
		
		
		<div class="col-md-12 channel_contant">
		<h2>Currently Live</h2>
		<?php
		if(!empty($live_channels))
		{
		?>
		<ul class="channel_list">
			<?php foreach($live_channels as $channel_key=>$channel_value){  ?>
			
			
			<li style="width:18%;margin-left:0px;margin-right:20px">
					<div>
						<?php
						$streamPath		=	IMAGE_PATH_FOR_TIM_THUMB.STREAM_IMAGE_FULL_DIR."/";
						$stream_image		=	$channel_value['Stream']['stream_image'];			
				//if($stream_image) {
					
						$channel_name = "&nbsp;";
						if(!empty($channel_value['Stream']['title']))
						{
							$channel_name = $channel_value['Stream']['title'];
							$channel_string = (strlen($channel_name) > 30) ? substr($channel_name,0,27).'...' : $channel_name;
						}
						$thumbnail_url = $this->Layout->get_live_channels_images($channel_value['Stream']['stream_key']);
						$check_live_stream_image = @fopen($thumbnail_url['live_stream']['thumbnail_url'],'r');
						
						if(!empty($thumbnail_url['live_stream']['thumbnail_url']) && $check_live_stream_image)
						{
						
						
						?>
						<a  alt="<?php echo $channel_string ?>" title="<?php  echo $channel_string?>" href="<?php echo $this->Html->url(array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id'])); ?>"><img style="height:158px !important;" width="280" src="<?php echo $thumbnail_url['live_stream']['thumbnail_url']; ?>"  alt="<?php echo $channel_string ?>" title="<?php  echo $channel_string?>"/></a>
						<?php
							/* echo $streamPath.$stream_image;
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$thumbnail_url['live_stream']['thumbnail_url'].'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'])); *///
						
						
						}
						else
						{
							echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=280&h=158&a=t',array('class'=>'','alt'=>$channel_string,'title'=>$channel_string,'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_string,'title'=>$channel_string)); 
						
							//echo $this->Html->link($this->Html->image(SITE_URL.'/timthumb.php?src='.$streamPath.$stream_image.'&w=320&h=180&a=t',array('class'=>'','alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title'],'class'=>'imgClass')),array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape'=>false,'alt'=>$channel_value['Stream']['title'],'title'=>$channel_value['Stream']['title']));
						}
						?>	
							
						<span>
					
						<?php echo $this->Html->link($channel_string,array('controller'=>'streams','action'=>'stream_detail',$channel_value['Stream']['id']),array('escape' => false,'title'=>$channel_value['Stream']['title'],'alt'=>$channel_value['Stream']['title'],'style'=>'color:#ffffff'));  ?>
				
						</span>
					</div>					
				</li>
			
			<?php } ?>		
		</ul>
		<?php
		}
		else
		{
			echo $this->Element('no_record_found',array('message'=>'No Stream, found.'));
		}	
		?>
		</div>
		
      <div class="col-md-4">
	  
      </div>
      </div>
    </div>
    
  </div>
  
</div>
<?php echo ($this->element('Front/footer'))?>
<script type="text/javascript">
	
	$(document).ready(function(){
	
		<?php
		$channelPath		=	IMAGE_PATH_FOR_TIM_THUMB.CHANNEL_IMAGE_FULL_DIR."/";
		$channel_image		=	$channelData['Channel']['image'];
		if($channel_image) {
			//$banner_image = "url(http://localhost/yoohcan/img/Front/banner-img.jpg) repeat-x center bottom";
			$image_url = SITE_URL.'/timthumb.php?src='.$channelPath.$channel_image.'&w=1645&h=550&zc=2';
			
		}
		else
		{
			$image_url = SITE_URL.'/img/Front/banner-img.jpg';
			
			//$banner_image = "url(http://localhost/yoohcan/img/Front/banner-img.jpg) repeat-x center bottom";
		}
		$banner_image = "url($image_url)";
		?>
		banner_image = '<?php echo $banner_image  ?>';
		$(".full-width-banner").css("background", banner_image);
	
	
	})
	
	
	
	
	
	$(document).ready(function(){		
		
		$(document).on('click','#subscribe_channel',function(){	
			$('#channel_box').modal('show');			
		});		
		
	});
	
	
	
	
	
	
	
	
</script>



	<div class="modal md1" id="channel_box" role="dialog">
		<div class="modal-dialog md-width">
		  <!-- Modal content-->
		<div class="modal-content md-content">
			<div class="modal-header md-header">          
			  <h4 class="modal-title">Subscribe Featured Streams</h4>
			   <div class="delete_btn"><button type="button" class="close" style="right:1px" data-dismiss="modal">×</button></div>
			</div>			
			<div id="channel_data" class="modal-body md-body">
				<?php echo $this->Element('/Front/Channel/channel_info_subscribe_home'); ?>
			</div>
		</div>		  
		</div>
	</div>